<?php 
function google_reviews_get_meta( $value ) {
	global $post;
	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}
function google_reviews_add_meta_box() {
	add_meta_box(
		'editor-editor',
		__( 'User Details', 'editor' ),
		'google_reviews_html',
		'review',
		'advanced',
		'high'
	);
}
add_action( 'add_meta_boxes', 'google_reviews_add_meta_box' );

function google_reviews_html( $post) {
	wp_nonce_field( '_editor_nonce', 'editor_nonce' ); 
	?>
	<p>Name &amp; Excerpt</p>
	<p>
		<label for="editor_name"><?php _e( 'Name', 'editor' ); ?></label><br>
		<input type="text" name="editor_name" id="editor_name" value="<?php echo google_reviews_get_meta( 'editor_name' ); ?>">
	</p>
	<p>
		<label for="review_link"><?php _e( 'Google Review Link', 'editor' ); ?></label><br>
		<input type="text" name="review_link" id="review_link" value="<?php echo google_reviews_get_meta( 'review_link' ); ?>">
	</p>
	<p>
		<label for="editor_excerpt"><?php _e( 'Excerpt', 'editor' ); ?></label><br>
		<textarea style="width:400px;height:200px;" name="editor_excerpt" id="editor_excerpt" maxlength="1000"><?php echo google_reviews_get_meta( 'editor_excerpt' ); ?></textarea>
	</p>
	<p>
	<style>
	/* ADMIN */
	.admin-star:before {
		font-family: "dashicons";
		content: "\f155";
		padding-right: 5px;
		font-size: 14px;
		color: #FFC42D;
	}
	</style>
	<?php 
	$star_rating = get_post_meta($post->ID, 'star_rating', true);
	?>
    <label class="admin-star">Rating:  </label>
		<select name="star_rating" id="star_rating">
			<option value="0" <?php selected( $star_rating, '0' ); ?>>0</option>
			<option value="0.5" <?php selected( $star_rating, '0.5' ); ?>>0.5</option>
			<option value="1" <?php selected( $star_rating, '1' ); ?>>1</option>
			<option value="1.5" <?php selected( $star_rating, '1.5' ); ?>>1.5</option>
			<option value="2" <?php selected( $star_rating, '2' ); ?>>2</option>
			<option value="2.5" <?php selected( $star_rating, '2.5' ); ?>>2.5</option>
			<option value="3" <?php selected( $star_rating, '3' ); ?>>3</option>
			<option value="3.5" <?php selected( $star_rating, '3.5' ); ?>>3.5</option>
			<option value="4" <?php selected( $star_rating, '4' ); ?>>4</option>
			<option value="4.5" <?php selected( $star_rating, '4.5' ); ?>>4.5</option>
			<option value="5" <?php selected( $star_rating, '5' ); ?>>5</option>
		</select>
	</p>
	<?php
}

function google_reviews_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['editor_nonce'] ) || ! wp_verify_nonce( $_POST['editor_nonce'], '_editor_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['editor_name'] ) )
		update_post_meta( $post_id, 'editor_name', esc_attr( $_POST['editor_name'] ) );
	if ( isset( $_POST['editor_excerpt'] ) )
		update_post_meta( $post_id, 'editor_excerpt', esc_attr( $_POST['editor_excerpt'] ) );
	if ( isset( $_POST['editor_excerpt'] ) )
		update_post_meta( $post_id, 'review_link', esc_attr( $_POST['review_link'] ) );
    if(isset($_POST["star_rating"])){
        update_post_meta($post_id, 'star_rating', $_POST['star_rating']);
    }
}
add_action( 'save_post', 'google_reviews_save' );
?>