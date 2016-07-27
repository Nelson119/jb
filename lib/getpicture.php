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
    try {
ob_start();
      $metal = isset($_GET['metal']) ? $_GET['metal'] : 'assistant';
      $name = isset($_GET['name']) ? $_GET['name'] : '';
      $picture = isset($_GET['fbid']) ? 'https://graph.facebook.com/'.$_GET['fbid'].'/picture?width=148&height=148' : 'https://graph.facebook.com/UniversalTaiwan/picture';


      $imageFile = ABSPATH.str_replace(home_url().'/', '',
      get_template_directory_uri().'/assets/tmp/'.$_GET['fbid'].'.jpg');
      $filename = ABSPATH.str_replace(home_url().'/', '', 
        get_template_directory_uri().'/assets/images/share/' . $metal . '.png');
      $fontface = ABSPATH.str_replace(home_url().'/', '', 
        get_template_directory_uri().'/assets/fonts/NotoSansCJKtc-Black.ttf');

      $background = ImageWorkshop::initFromPath($filename);
      $textLayer = ImageWorkshop::initTextLayer('Super ' . $name, $fontface, 15, '0f2349', 0);

      $background->addLayer(2, $textLayer, 275, 35, "LT");

      $resp = file_get_contents($picture);
      file_put_contents($imageFile, $resp);

      $stamp = imagecreatefromjpeg($imageFile);
      $image = $background->getResult();

      // Set the margins for the stamp and get the height/width of the stamp image
      $marge_left = 36;
      $marge_top = 34;
      $sx = imagesx($stamp);
      $sy = imagesy($stamp);

      // Copy the stamp image onto our photo using the margin offsets and the photo 
      // width to calculate positioning of the stamp. 
      imagealphablending($image, false); 
      $bg_color = imagecolorallocate($image, 228, 228, 228);
      imagecolortransparent($image, $bg_color);
      imagesavealpha($image,true);
      imagecolortransparent($image, $bg_color);
      imagecopy($image, $stamp, $marge_left, $marge_top, 0, 0, imagesx($stamp), imagesy($stamp));

      // Output and free memory
      header('Content-type: image/png');
      imagepng($image);
      imagedestroy($image);


      // $filename = ABSPATH.str_replace(home_url().'/', '', 
      //   get_template_directory_uri().'/assets/images/share/' . $metal . '.png');

      // $fontface = ABSPATH.str_replace(home_url().'/', '', 
      //   get_template_directory_uri().'/assets/fonts/NotoSansCJKtc-Black.ttf');

      // // $document = ImageWorkshop::initVirginLayer(486, 460); 
      // $background = ImageWorkshop::initFromPath($filename);
      // // $background->resizeInPixel(486, 255, true);
      // $textLayer = ImageWorkshop::initTextLayer('Super ' . $name, $fontface, 15, '0f2349', 0);

      // $pic = ImageWorkshop::initFromPath($imageFile);      
      // $pic->resizeInPixel(152, 152, true);

      // // $document->addLayer(1, $background, 0, 0, 'LT');
      // $background->addLayer(2, $textLayer, 275, 35, "LT");
      // $background->addLayer(3, $pic, 34, 32, "LT");
      // $image = $background->getResult();

      // send the right headers
      imagejpeg($image, 'php://memory/temp.png'); 

      $size = filesize('php://memory/temp.png');
      header("Content-Type: image/png");
      header("Content-Length: " . $size);

      // dump the picture and stop the script
      // echo  $image;

      imagepng($image);  

      imagedestroy($image);  

      imagedestroy($stamp);  

    }catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
    exit;
  }






function DownloadImage($url, $dest){
    $curl = curl_init($url);
    $fp = fopen($dest, 'wb');
    curl_setopt($curl, CURLOPT_FILE, $fp);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_exec($curl);   
    curl_close($curl);
    fclose($fp);    
}
