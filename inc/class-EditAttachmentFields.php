<?php
/**
 * Add fields to the edit attachment screen
 */
class Pixelgrade_EditAttachmentFields extends Pixelgrade_Singleton {

	/**
	 * The constructor.
	 *
	 * Adds in appropriate actions for attachment fields editor, meta boxes and saving.
	 *
	 * @param string $version The current class version.
	 * @param array $args Optional. Various arguments for the initialization.
	 */
	public function __construct( $version = '1.0.0', $args = array() ) {
		// Allow others to make changes to the arguments.
		$args = apply_filters( 'pixelgrade_edit_attachment_fields_init_args', $args );

		// Get going with the initialization
		$this->init( $args );
	}

	/**
	 * Initialize the fields.
	 *
	 * @param array $args Optional
	 *
	 * @return void
	 */
	public function init( $args = array() ) {
//		add_action( 'admin_enqueue_scripts', array( $this, 'adminEnqueueScripts' ) );

		add_action( 'wp_enqueue_media', array( $this, 'addMediaTemplatesFields' ) );
		add_filter( 'media_send_to_editor', array( $this, 'filterMediaSendToEditor' ), 10, 3 );

		add_filter( 'attachment_fields_to_edit', array( $this, 'fieldsToEdit' ), 10, 2 );
		add_filter( 'attachment_fields_to_save', array( $this, 'saveFields' ), 10, 2 );
		add_action( 'wp_ajax_save-attachment', array( $this, 'saveFieldsAjax' ), -1 );
		add_action( 'wp_ajax_save-attachment-compat', array( $this, 'saveFieldsAjaxCompat' ), -1 );

		add_filter( 'the_content', array( $this, 'addCreditsToContentMedia' ), 100, 1 );

//		add_action( 'add_meta_boxes', array( $this, 'configure_meta_boxes' ), 10, 2 );
	}

	public function addCreditsToContentMedia( $content) {
		// Add the credits to all images wrapped in <figure> - those that have captions
		$content = preg_replace(
			'/(<figure[^>]*>\s*<\s*img(?:.+?(?=data-credits))\s*data-credits="([^"]*)"[^>]*>)(<figcaption class="wp-caption-text">)(.+?(?=<\/figcaption>))(<\/figcaption><\/figure>)/miu',
			'$1$3$4<span class="credits">$2</span>$5',
			$content
		);

		// Now we need to handle the images that have credits but don't have a caption
		$content = preg_replace_callback(
			'/<figure[^>]*>.*<\/figure>|((?:<a[^>]*>\s*)?<img(?:.+?(?=data-credits))\s*data-credits="([^"]*)"[^>]*>(?:\s*<\/a>)?)/miu',
			// in the callback function, if Group 1 (the image) or Group 2 (the data-credits attribute) is empty,
			// set the replacement to the whole match,
			// i.e. don't replace
			array( $this, 'wrapImagesCallback' ),
			$content );

		return $content;
	}

	public function wrapImagesCallback( $match ) {
		if ( empty( $match[1] ) || empty( $match[2] ) ) {
			return $match[0];
		}

		return '<figure class="wp-caption">' . $match[1] . '<figcaption class="wp-caption-text"><span class="credits">' . $match[2] . '</span></figcaption></figure>';
	}

	/**
	 * Add our fields to the media templates.
	 */
	public function addMediaTemplatesFields() {
		// We will remove the default hook
		remove_action( 'admin_footer', 'wp_print_media_templates' );

		// We will add our our hook where we will catch the output of wp_print_media_templates and modify it
		add_action( 'admin_footer', array( $this, 'insertFieldsIntoMediaTemplates' ) );

		// Print the scripts responsible for handling changes in the media views
		add_action( 'admin_footer', array( $this, 'printMediaViewScripts' ), 11 );
	}

	/**
	 * Insert our fields in the media templates.
	 */
	public function insertFieldsIntoMediaTemplates() {
		ob_start();
		wp_print_media_templates();
		$tpl = ob_get_clean();
		// To future-proof a bit, search first for the template and then for the section.
		if ( ( $idx = strpos( $tpl, 'tmpl-image-details' ) ) !== false
		     && ( $before_idx = strpos( $tpl, '<label class="setting alt-text">', $idx ) ) !== false ) {
			ob_start();
			?>
			<label class="setting pixelgrade-credits credits">
				<span>Credits</span>
				<input type="text" data-setting="credits" value="{{ data.model.credits }}" />
			</label>
			<?php
			$my_section = ob_get_clean();
			$tpl = substr_replace( $tpl, $my_section, $before_idx, 0 );
		}
		echo $tpl;
	}

	/**
	 * Print the JS that handles the interaction between the editor and the WP Media modal.
	 *
	 * Inspired by wpeditimage TinyMCE plugin updateImage()
	 * wp-includes/js/tinymce/plugins/wpeditimage/plugin.js
	 */
	public function printMediaViewScripts() {
		?>
		<script type="text/javascript">
			jQuery(function ($) {
				if (wp && wp.media && wp.media.events) {
					wp.media.events.on( 'editor:image-edit', function (data) {
						data.metadata.credits = data.editor.dom.getAttrib( data.image, 'data-credits' );
					} );
					wp.media.events.on( 'editor:image-update', function (data) {
						var imageNode, captionNode, wrap, wrapNode, credits, dl, dd, width, height, id, attrs, align, className, html, parent;

						// Update the credits in the data attribute - this will be the source of truth
						// The rest is just for editor preview
						data.editor.dom.setAttrib( data.image, 'data-credits', data.metadata.credits );

						// @todo For now we won't output the credits in the Visual Editor preview. The code bellow is a start to do that but it lacks the handling of switching between visual and text mode.

						// width = data.metadata.width;
						// height = data.metadata.height;
						//
						// if ( data.metadata.size === 'custom' ) {
						// 	width = data.metadata.customWidth;
						// 	height = data.metadata.customHeight;
						// }
						//
						// if ( data.image.parentNode && data.image.parentNode.nodeName === 'A' && ! hasTextContent( data.image.parentNode ) ) {
						// 	imageNode = data.image.parentNode;
						// } else {
						// 	imageNode = data.image;
						// }
						//
						// wrapNode = data.editor.dom.getParent( imageNode, '.mceTemp' );
						// captionNode = data.editor.dom.getParent( imageNode, 'dl.wp-caption' );
						//
						// // We already have the caption wrappers
						// if ( captionNode ) {
						// 	// First determine if we already have the temporary credits markup
						// 	dd = data.editor.dom.select('.wp-credits-dd', captionNode);
						// 	if (dd.length) {
						// 		if ( data.metadata.credits ) {
						// 			dom.setHTML(dd[0], data.metadata.credits);
						// 		} else {
						// 			// We have no credits text - remove the element
						// 			data.editor.dom.remove( dd[0] );
						// 		}
						// 	} else if ( data.metadata.credits ) {
						// 		// We need to create a <dd>, but only if we have some credits text
						// 		dd = data.editor.dom.create('dd', {'class': 'wp-credits-dd'}, data.metadata.credits);
						// 		captionNode.append( dd );
						// 	}
						// } else {
						// 	if ( data.metadata.credits ) {
						// 		// Create the caption node
						//
						// 		// First recreate the logic from the wpeditimage TinyMCE plugin updateImage()
						// 		id = data.metadata.attachment_id ? 'attachment_' + data.metadata.attachment_id : null;
						// 		align = 'align' + (data.metadata.align || 'none');
						// 		className = 'wp-caption ' + align;
						//
						// 		if (data.metadata.captionClassName) {
						// 			className += ' ' + data.metadata.captionClassName.replace(/[<>&]+/g, '');
						// 		}
						// 		if (!data.editor.getParam('wpeditimage_html5_captions')) {
						// 			width = parseInt(width, 10);
						// 			width += 10;
						// 		}
						//
						// 		html = '<dt class="wp-caption-dt"></dt><dd class="wp-caption-dd"></dd><dd class="wp-credits-dd">' + data.metadata.credits + '</dd>';
						// 		dl = data.editor.dom.create('dl', {
						// 			'id': id,
						// 			'class': className,
						// 			'style': 'width: ' + width + 'px'
						// 		}, html);
						//
						// 		// We don't have a caption but somehow we have a wrapper - use it
						// 		if (wrapNode) {
						// 			wrapNode.append(dl);
						// 		} else {
						// 			// we need to create the TinyMCE temp node
						// 			wrap = data.editor.dom.create('div', {'class': 'mceTemp'});
						// 			wrap.append(dl);
						//
						// 			if (parent = data.editor.dom.getParent(imageNode, 'p')) {
						// 				parent.parentNode.insertBefore(wrap, parent);
						// 			} else {
						// 				imageNode.parentNode.insertBefore(wrap, imageNode);
						// 			}
						//
						// 			data.editor.$(wrap).find('dt.wp-caption-dt').append(imageNode);
						//
						// 			if (parent && data.editor.dom.isEmpty(parent)) {
						// 				data.editor.dom.remove(parent);
						// 			}
						// 		}
						// 	}
						// }
						//
						// data.editor.nodeChanged();
					} );
				}
			});
		</script>
		<?php
	}

	/**
	 * Add our credits data attribute to the editor inserted media.
	 *
	 * @param string $html
	 * @param int $id
	 * @param $attachment
	 *
	 * @return string
	 */
	public function filterMediaSendToEditor( $html, $id, $attachment ) {
		$html = preg_replace( '/<\s*img\s*(.+?(?=\/>|>))/ms', '<img $1 data-credits="' . get_post_meta( $id, '_credits', true ) . '"', $html );

		return $html;
	}

	/**
	 * Creates an array of video fields to edit based on transcoded videos.
	 *
	 * @param array $fields Attachment fields.
	 * @param stdClass $post The post object.
	 *
	 * @return array Modified attachment fields.
	 */
	public function fieldsToEdit( $fields, $post ) {
		$post_id = absint( $post->ID );

		if ( ! isset( $fields['credits'] ) ) {
			$fields['credits'] = array(
				'label' => __('Credits', '__theme_txtd' ),
				'input' => 'text',
				'value' => get_post_meta( $post_id, '_credits', true ),
			);
		}

		return $fields;
	}

	/**
	 * Save our custom attachment fields as attachment meta when editing the media.
	 *
	 * @param array $post
	 * @param array|null $attachment
	 *
	 * @return array
	 */
	public function saveFields( $post, $attachment = null ) {
		if ( $attachment === null && isset( $_POST['attachment'] ) ) {
			$attachment = $_POST['attachment'];
		}

		$post_id = absint( $post['ID'] );

		if ( isset( $attachment['credits'] ) ) {
			update_post_meta( $post_id, '_credits', $attachment['credits'] );
		}

		return $post;
	}

	/**
	 * Save our custom attachment compat fields as attachment meta on AJAX fields call.
	 */
	public function saveFieldsAjax() {
		if ( ! isset( $_REQUEST['id'] ) || ! isset( $_REQUEST['changes'] ) ) {
			return;
		}

		if ( ! $id = absint( $_REQUEST['id'] ) ) {
			return;
		}

		check_ajax_referer( 'update-post_' . $id, 'nonce' );

		if ( ! current_user_can( 'edit_post', $id ) ) {
			wp_send_json_error();
		}

		$changes = $_REQUEST['changes'];
		$post    = get_post( $id, ARRAY_A );

		if ( 'attachment' != $post['post_type'] ) {
			return;
		}

		if ( isset( $changes['credits'] ) ) {
			update_post_meta( $id, '_credits', $changes['credits'] );
		}
	}

	/**
	 * Save our custom attachment compat fields as attachment meta on AJAX compat fields call.
	 */
	public function saveFieldsAjaxCompat() {
		if ( ! isset( $_REQUEST['id'] ) || ! $id = absint( $_REQUEST['id'] ) ) {
			return;
		}

		if ( empty( $_REQUEST['attachments'] ) || empty( $_REQUEST['attachments'][ $id ] ) ) {
			return;
		}
		$attachment_data = $_REQUEST['attachments'][ $id ];

		check_ajax_referer( 'update-post_' . $id, 'nonce' );

		if ( ! current_user_can( 'edit_post', $id ) ) {
			return;
		}

		$post = get_post( $id, ARRAY_A );

		if ( 'attachment' != $post['post_type'] ) {
			return;
		}

		if ( isset( $attachment_data['credits'] ) ) {
			update_post_meta( $id, '_credits', $attachment_data['credits'] );
		}
	}
}

// Fire it up
add_action( 'init', array( 'Pixelgrade_EditAttachmentFields', 'instance' ) );
