# image-resize
WordPress image resize plugin

Usage:
=====
Usage example:

					<a href="'.get_the_permalink().'"><img src="'.nabimgresize(wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ), "390px", "470px", false).'" width="390px" height="470px" class="img-responsive" /></a>
