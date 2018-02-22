<?php
/**
 * Starter Content Exporter Compatibility File.
 *
 * @link https://github.com/pixelgrade/starter_content_exporter
 *
 * @package Vasco
 * @since 1.0.0
 */

/**
 * Handle the Gallery Widget export.
 *
 * @param array $widget_data The widget instance values.
 * @param string $widget_type The widget type.
 * @param array $matching_data The matching import/export data like old-new post IDs, old-new attachment IDs, etc.
 *
 * @return array The modified widget data.
 */
function vasco_handle_media_gallery_widget_export( $widget_data, $widget_type, $matching_data ) {
	// Replace the gallery attachment IDs with the new ones
	if ( ! empty( $widget_data['ids'] ) && ( ! empty( $matching_data['placeholders'] || ! empty( $matching_data['ignored_images'] ) ) ) ) {
		foreach ( $widget_data['ids'] as $key => $current_id ) {
			$new_id = false;

			// Search through the placeholder attachments
			foreach ( $matching_data['placeholders'] as $old_id => $new_attachment_details ) {
				if ( $current_id === $old_id && ! empty( $new_attachment_details['id'] ) ) {
					$new_id = $new_attachment_details['id'];
					break;
				}
			}

			if ( empty( $new_id ) ) {
				// Search through the ignored attachments
				foreach ( $matching_data['ignored_images'] as $old_id => $new_attachment_details ) {
					if ( $current_id === $old_id && ! empty( $new_attachment_details['id'] ) ) {
						$new_id = $new_attachment_details['id'];
						break;
					}
				}
			}

			if ( ! empty( $new_id ) ) {
				$widget_data['ids'][ $key ] = $new_id;
			}
		}
	}

	return $widget_data;
}
add_filter( 'pixcare_sce_widget_data_export_media_gallery', 'vasco_handle_media_gallery_widget_export', 10, 3 );
