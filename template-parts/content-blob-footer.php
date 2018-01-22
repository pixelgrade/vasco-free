<?php
$show_blobs = pixelgrade_option( 'show_blobs', false );
if ( $show_blobs ): ?>
	<div class="blob  blob--footer">
		<div class="blob__part  blob__part--1">
			<?php get_template_part( 'template-parts/svg/content-blob-1' ); ?>
		</div>
		<div class="blob__part  blob__part--2">
			<?php get_template_part( 'template-parts/svg/content-blob-2' ); ?>
		</div>
		<div class="blob__part  blob__part--3">
			<?php get_template_part( 'template-parts/svg/content-blob-2' ); ?>
		</div>
		<div class="blob__part  blob__part--4">
			<?php get_template_part( 'template-parts/svg/content-blob-3' ); ?>
		</div>
	</div>
<?php endif; ?>
