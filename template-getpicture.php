<?php
/**
 * Template Name: Get Picture
 */
    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    require_once( ABSPATH . 'wp-admin/includes/media.php' );
    require_once( ABSPATH . 'wp-content/themes/nelson-made/PHPImageWorkshop/ImageWorkshop.php' );
    require_once( ABSPATH . 'wp-content/themes/nelson-made/PHPImageWorkshop/Core/ImageWorkshopLayer.php' );
    require_once( ABSPATH . 'wp-content/themes/nelson-made/PHPImageWorkshop/Core/ImageWorkshopLib.php' );
    require_once( ABSPATH . 'wp-content/themes/nelson-made/PHPImageWorkshop/Exception/ImageWorkshopBaseException.php' );
    require_once( ABSPATH . 'wp-content/themes/nelson-made/PHPImageWorkshop/Exception/ImageWorkshopException.php' );
    require_once( ABSPATH . 'wp-content/themes/nelson-made/PHPImageWorkshop/Core/Exception/ImageWorkshopLayerException.php' );
    require_once( ABSPATH . 'wp-content/themes/nelson-made/PHPImageWorkshop/Core/Exception/ImageWorkshopLibException.php' );
    use PHPImageWorkshop\ImageWorkshop;

    // header('Content-Type: image/jpeg');
    // echo json_encode($obj);

    echo 123;
    if ( 
      isset( $_POST['FBID'] ) &&
      isset( $_POST['username'] ) &&
      isset( $_POST['email'] ) &&
      isset( $_POST['aid'] ) &&
      isset( $_POST['ticket'] ) 
    ) {
    }
	exit;
?>