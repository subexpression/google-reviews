<?php
/**
 * The remote host file to process update requests
 *
 */
if ( !isset( $_POST['action'] ) ) {
	echo '0';
	exit;
}

//set up the properties common to both requests 
$obj = new stdClass();
$obj->slug = 'ff-google-reviews.php';  
$obj->name = 'Google Reviews by Fusionfarm';
$obj->plugin_name = 'ff-google-reviews.php';
$obj->new_version = '1.0.1';
// the url for the plugin homepage
$obj->url = 'http://www.fusionfarm.com';
//the download location for the plugin zip file (can be any internet host)
$obj->package = 'http://iplusplus.dev.fusionfarm.com/plugins/ff-google-reviews.zip';

switch ( $_POST['action'] ) {

case 'version':  
	echo serialize( $obj );
	break;  
case 'info':   
	$obj->requires = '4.4';  
	$obj->tested = '4.4.2';  
	$obj->downloaded = 1;  
	$obj->last_updated = '2016-04-07';  
	$obj->sections = array(  
		'description' => 'Updated Google Reviews by Fusionfarm plugin',  
		'another_section' => 'Contact Fusionfarm for plugin updates.',  
		'changelog' => 'Added plugin update support'
	);
	$obj->download_link = $obj->package;  
	echo serialize($obj);  
case 'license':  
	echo serialize( $obj );  
	break;  
}
?>