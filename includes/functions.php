<?php


/**
 * return view product embed
 *
 * @param  mixed $atts
 * @param  mixed $content
 * @param  mixed $shortcodename
 *
 * @return void
 */

function product_embed($atts, $content = "", $shortcodename = ""){
return 
'<div class="embed-product-body">
	<div class="shadow">
		<div class="embed-product-card">
			<img src="'.$atts['images'].'" title="'.$atts['title'].'" />
		</div>
		<div class="embed-product-card">
			<div class="embed-container">
				<span class="embed-product_name">'.$atts['product'].'</span>
				<p class="embed-descriptions">'.$atts['description'].'</p>
				<ul class="embed-footer">
					<li class="embed-price">'.$atts['price'].'</li>
				</ul>
				<div>
					<a class="block" href="'.$atts['url'].'" title="'.$atts['button'].'" target="_blank" style="text-decoration: none; color:#000">'.$atts['button'].'</a>
				</div>
			</div>
		</div>
	</div>
</div>';
}

add_shortcode('product','product_embed');

// Register style sheet.
add_action( 'wp_enqueue_scripts', 'register_plugin_styles' );

/**
 * register_plugin_styles
 *
 * @return void
 */
function register_plugin_styles() {
    wp_register_style('product-embed', plugins_url( '/css/style.css',__FILE__ ));
    wp_enqueue_style('product-embed' );
}

// buttons

add_action( 'after_setup_theme', 'product_embed_theme_setup' );
 
if ( ! function_exists( 'product_embed_theme_setup' ) ) {
	/**
	 * product_embed_theme_setup
	 *
	 * @return void
	 */
	function product_embed_theme_setup(){
		/********* TinyMCE Buttons ***********/
		add_action( 'init', 'product_embed_buttons' );
	}
}

/********* TinyMCE Buttons ***********/
if ( ! function_exists( 'product_embed_buttons' ) ) {
	/**
	 * product_embed_buttons
	 *
	 * @return void
	 */
	function product_embed_buttons() {
		if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
	        return;
	    }
 
	    if ( get_user_option( 'rich_editing' ) !== 'true' ) {
	        return;
	    }
 
	    add_filter( 'mce_external_plugins', 'product_embed_add_buttons' );
	    add_filter( 'mce_buttons', 'product_embed_register_buttons' );
	}
}
 
if ( ! function_exists( 'product_embed_add_buttons' ) ) {
	/**
	 * product_embed_add_buttons
	 *
	 * @param  mixed $plugin_array
	 *
	 * @return void
	 */
	function product_embed_add_buttons( $plugin_array ) {
	    $plugin_array['product'] = plugins_url( '/js/tinymce_buttons.js',__FILE__ );
	    return $plugin_array;
	}
}
 
if ( ! function_exists( 'product_embed_register_buttons' ) ) {
	/**
	 * product_embed_register_buttons
	 *
	 * @param  mixed $buttons
	 *
	 * @return void
	 */
	function product_embed_register_buttons( $buttons ) {
	    array_push( $buttons, 'product' );
	    return $buttons;
	}
}