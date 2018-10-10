<?php
/**
Plugin Name: Automatic Alt for images
Plugin URI: https://www.joseconti.com/
Description: Rellena todo de forma automatica todos los campos de las imágenes aen el moento en que se suben. Solo debes preocuparte de subierlas con un nombre representaticvo
Version: 1.0.0
Author: José Conti
Author URI: https://www.joseconti.com/
Tested up to: 4.9.8
Copyright: (C) 2018 José Conti
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */
function automatic_alt_for_uploaded_image( $post_id_pre ) {

	$post_id = esc_html( $post_id_pre );
	if ( wp_attachment_is_image( $post_id ) ) {
		$img_title = get_post( $post_id )->post_title;
		$img_title = preg_replace( '%\s*[-_\s]+\s*%', ' ', $img_title );
		$img_title = ucwords( strtolower( $img_title ) );
		$img_meta  = array(
			'ID'           => $post_id,
			'post_title'   => $img_title,
			'post_excerpt' => $img_title,
			'post_content' => $img_title,
		);
		update_post_meta( $post_id, '_wp_attachment_image_alt', $img_title );
		wp_update_post( $img_meta );
	}
}
add_action( 'add_attachment', 'automatic_alt_for_uploaded_image' );
