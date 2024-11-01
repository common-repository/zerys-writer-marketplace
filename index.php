<?php

/*
  Plugin Name: ZERYS Plugin
  Plugin URI: 
  Description: ZERYS Plugin
  Version: 1.1.0
  Author: Interact Media
  Author URI: http://www.interactmedia.com
*/

ob_start(); 
global $wp_version;

//include('zeyers-config.php');

 
if( version_compare( $wp_version, "2.9", "<" ) )
    exit( 'This plugin requires WordPress 2.9 or newer. <a href="http://codex.wordpress.org/Upgrading_WordPress">Please update!</a>' );

add_action('admin_menu', 'create_zeyers_menu');
register_activation_hook( __FILE__, 'getAPiKey');

function getAPiKey()
{
global $wpdb;
include('zeyers-config.php');
$url =$basePath."json/Register";
$server=$_SERVER['SERVER_NAME'];
$admin_email = get_option('admin_email'); 
$user_info = get_userdata(1);
$username=$user_info->user_login;
$fname=$user_info->first_name;
$lname=$user_info->last_name; 
if($fname=='')
{
$fname='Wordpress';
}

if($lname=='')
{
$lname='Wordpress';
}

  
$createquery= "CREATE TABLE zerys (                                   
          id bigint(10) NOT NULL AUTO_INCREMENT,               
          apikay varchar(100) DEFAULT NULL,                    
          PRIMARY KEY (id)                                     
        )";
		$wpdb->query($createquery);
	
  
$data = '{ 

   "Domainname":"'.$server.'",

   "Email":"'.$admin_email.'",

   "Firstname":"'.$fname.'",

   "Lastname":"'.$lname.'",

   "WpUsername":"'.$username.'"       

        }';

$headers = array(

'Accept: application/json',

'Content-Type: application/json',

);

$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,$url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

curl_setopt($ch, CURLOPT_POST, true);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  //for updating we have to use PUT method.

curl_setopt($ch,CURLOPT_POSTFIELDS,$data);

$result = curl_exec($ch);

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

$json = str_replace(array("\n","\r"),"",$result);
$json = preg_replace('/([{,])(\s*)([^"]+?)\s*:/','$1"$3":',$result);
$arr=json_decode($json,false);

$empty="truncate zerys";
$wpdb->query($empty);

$query="Insert into zerys (apikay) VALUES ('".$arr->Apikey."')";

$wpdb->query($query);
}

// Callback to add menu items
function create_zeyers_menu() {
	add_menu_page("Zerys Content Marketplace", "Zerys Content Marketplace", "administrator", "wp-zerys" , "wp_zerys_dashboard");
	//add_submenu_page('wp-zerys', 'one time order', 'One time order', 'administrator' ,'one-time-order', 'wp_zerys_dashboard' );
	//remove_submenu_page('wp-zerys','wp-zerys');

}







add_shortcode('login', 'loginText');  
function wp_zerys_login()
{
session_start();
unset ($_SESSION['cidd']);
unset ($_SESSION['cUserId']);
unset ($_SESSION['user']);
include('login-file.php');   
}
function wp_long_document()
{
	include('longdocument.php');
}
function wp_zerys_dashboard()
{
	include('onetimeorder.php');
}
function wp_place_order()
{
	include('place-order.php');
}
function loginText() 
{  
		include('login-file.php');
}  
function create_project() 
{  
        include('newproject.php');
}  
function smart_post() 
{  
        include('smartpost.php');
}  