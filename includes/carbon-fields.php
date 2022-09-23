<?php

use Carbon_Fields\Block;
use Carbon_Fields\Carbon_Fields;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'pj_attach_theme_options' );

function pj_attach_theme_options() {

	$hasPlan = [
		[
			'field'   => 'pj_plan',
			'value'   => '',
			'compare' => '!=',
		]
	];

	$isPremium = [
		[
			'field'   => 'pj_plan',
			'value'   => 'premium',
			'compare' => '=',
		]
	];

	Container::make( 'post_meta', __( 'Plan' ) )
	         ->where( 'post_type', '=', 'pj-listing' )
	         ->add_fields( [
		         Field::make( 'select', 'pj_plan', __( 'Options' ) )
		              ->set_options( [
			              ''         => __( 'Select A Plan' ),
			              'basic'    => __( 'Basic' ),
			              'enhanced' => __( 'Enhanced' ),
			              'premium'  => __( 'Premium' ),
		              ] ),

		         Field::make( 'image', 'pj_image', 'Company Logo' )
		              ->set_conditional_logic( $isPremium ),

		         Field::make( 'text', 'pj_street', 'Street Address' )
		              ->set_context( 'normal' )
		              ->set_conditional_logic( $hasPlan ),

		         Field::make( 'text', 'pj_city', 'City' )
		              ->set_conditional_logic( $hasPlan ),

		         Field::make( 'text', 'pj_state', 'State' )
		              ->set_conditional_logic( $hasPlan ),

		         Field::make( 'text', 'pj_zip', 'Zip' )
		              ->set_conditional_logic( $hasPlan ),

		         Field::make( 'text', 'pj_phone', 'Phone' )
		              ->set_attribute( 'type', 'tel' )
		              ->set_attribute( 'pattern', '[0-9]{3}-[0-9]{3}-[0-9]{4}' )
		              ->set_attribute( 'placeholder', '(888) 888-8888' )
		              ->set_conditional_logic( $hasPlan ),

		         Field::make( 'text', 'pj_email', 'Email' )
		              ->set_attribute( 'type', 'email' )
		              ->set_conditional_logic( $isPremium ),

		         Field::make( 'text', 'pj_website', 'Website' )
		              ->set_conditional_logic( $isPremium ),

		         Field::make( 'text', 'pj_facebook', 'Facebook' )
		              ->set_attribute( 'type', 'url' )
		              ->set_conditional_logic( $isPremium ),

		         Field::make( 'text', 'pj_instagram', 'Instagram' )
		              ->set_attribute( 'type', 'url' )
		              ->set_conditional_logic( $isPremium ),

		         Field::make( 'text', 'pj_linkedin', 'Linked In' )
		              ->set_attribute( 'type', 'url' )
		              ->set_conditional_logic( $isPremium ),

		         Field::make( 'text', 'pj_pinterest', 'Pinterest' )
		              ->set_attribute( 'type', 'url' )
		              ->set_conditional_logic( $isPremium ),

		         Field::make( 'text', 'pj_twitter', 'Twitter' )
		              ->set_attribute( 'type', 'url' )
		              ->set_conditional_logic( $isPremium ),

		         Field::make( 'text', 'pj_youtube', 'Youtube' )
		              ->set_attribute( 'type', 'url' )
		              ->set_conditional_logic( $isPremium ),

	         ] );

	function pj_load_archive() {
		ob_start();
		require PJ_PLUGIN_DIR . '/templates/listing-archive.php';

		return ob_get_clean();
	}

	;  //Show at Top Option
	Container::make( 'term_meta', __( 'Term Options' ) )
	         ->where( 'term_taxonomy', '=', 'pj-listing-category' )
	         ->add_fields( array(
		         Field::make( 'checkbox', 'pj-show-at-top', __( 'Show at Top' ) ),
	         ) );


	//Gutenberg Config
	Block::make( __( 'Listings' ) )
	     ->add_fields( [
		     Field::make( 'html', 'pj-listing' )
		          ->set_html( '[Listings Placeholder]' ),
	     ] )
	     ->set_render_callback( function () {
		     echo pj_load_archive();
	     } )
	     ->set_icon( 'id' );

}

add_action( 'after_setup_theme', 'pj_load' );

function pj_load() {
	Carbon_Fields::boot();
}
