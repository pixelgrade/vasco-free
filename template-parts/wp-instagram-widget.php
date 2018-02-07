<li class="<?php echo esc_attr( $liclass ); ?>">
	<a href="<?php echo esc_url( $item['link'] ); ?>"
	   target="<?php echo esc_attr( $target ); ?>"
	   class="<?php echo esc_attr( $aclass ); ?>">
		<img src="<?php echo esc_url( $item[$size] ) ?>"
		     title='<?php echo wp_strip_all_tags( esc_attr( $item['description'] ) ); ?>'
		     alt='<?php echo wp_strip_all_tags( esc_attr( $item['description'] ) ); ?>'
		     class="<?php echo esc_attr( $imgclass ) ?>"/>
	</a>
</li>
