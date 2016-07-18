<?php

  error_reporting(E_ALL); // or E_STRICT
  ini_set("display_errors",1);
  ini_set("memory_limit","1024M");

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

  if(isset($_GET['api']) &&
    $_GET['api'] == 'getpicture'){
    // echo isset($_GET['pagename']) ;
    // echo $_GET['pagename'] == 'getpicture';
    $metal = isset($_GET['metal']) ? $_GET['metal'] : 'assistant';
    $name = isset($_GET['name']) ? $_GET['name'] : '';
    $picture = isset($_GET['picture']) ? $_GET['picture'] : 'https://graph.facebook.com/picture/UniversalTaiwan';


    $filename = ABSPATH.str_replace(home_url().'/', '', 
      get_template_directory_uri().'/assets/images/share/' . $metal . '.png');

    $fontface = ABSPATH.str_replace(home_url().'/', '', 
      get_template_directory_uri().'/assets/fonts/NotoSansCJKtc-Black.ttf');

    // $document = ImageWorkshop::initVirginLayer(486, 460); 
    $background = ImageWorkshop::initFromPath($filename);
    // $background->resizeInPixel(486, 255, true);
    $textLayer = ImageWorkshop::initTextLayer('Super ' . $name, $fontface, 15, '0f2349', 0);

    $pic = ImageWorkshop::initFromPath($picture);
    $pic->resizeInPixel(152, 152, true);

    // $document->addLayer(1, $background, 0, 0, 'LT');
    $background->addLayer(2, $textLayer, 275, 35, "LT");
    $background->addLayer(3, $pic, 34, 32, "LT");
    $image = $background->getResult();

    // send the right headers
    header("Content-Type: image/png");
    // header("Content-Length: " . filesize($name));

    // dump the picture and stop the script
    // echo  $image;
    imagepng($image);
    exit;
  }