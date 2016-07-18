<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>
<?php

  error_reporting(0); // E_ALL or E_STRICT
  // error_reporting(E_ALL );
  // ini_set("display_errors",1);
  ini_set("memory_limit","1024M");

  $wp_error;
  $status = 0;
  $cfs = CFS();
  $participant =  array(
    'name' => isset($_POST['name']) ? $_POST['name'] : '',
    'tel' => isset($_POST['tel']) ? $_POST['tel'] : '',
    'email' => isset($_POST['email']) ? $_POST['email'] : '',
    'addr' => isset($_POST['addr']) ? $_POST['addr'] : '',
    'link' => isset($_POST['link']) ? $_POST['link'] : '',
    'fbid' => isset($_POST['fbid']) ? $_POST['fbid'] : '',
    'fbname' => isset($_POST['fbname']) ? $_POST['fbname'] : '',
    'fbemail' => isset($_POST['fbemail']) ? $_POST['fbemail'] : '',
    'utm' =>  isset($_POST['utm']) ? $_POST['utm'] : ''
  );

  if(isset($_GET['api']) &&
    $_GET['api'] == 'form'){
    if(!isset($_POST['name']))
      $obj = array('status' => 0, 'msg' => '請填寫name');
    else if(!isset($_POST['tel']))
      $obj = array('status' => 0, 'msg' => '請填寫tel');
    else if(!isset($_POST['email']))
      $obj = array('status' => 0, 'msg' => '請填寫email');
    else if(!isset($_POST['addr']))
      $obj = array('status' => 0, 'msg' => '請填寫addr');
    else if(!isset($_POST['fbid']))
      $obj = array('status' => 0, 'msg' => '請填寫fbid');
    else{

      $post_id = wp_insert_post(array(
        'post_title'=> $participant['name'] . ' 貼文：' . $participant['link'] , 
        'post_type'=>'post', 
        'post_status'=>'publish',
        'post_content'=>'')
        , $wp_error 
      );
      $wp_query = new WP_Query( array(
          'post_type' => 'post',
          'ID' => $post_id
        )
      );
      $result = $cfs->save(
        $participant,
        array( 'ID' => $post_id )
      );
      $status = 1;
      $wp_error = '你已報名成功';



      $obj = array('status' => $status, 'msg' => $wp_error, 'debug' => $participant);

    }

    status_header( 200 );
    nocache_headers();
    header('Content-Type: application/json');
    echo json_encode($obj);

    exit;
  }
?>

<!doctype html>
<html <?php language_attributes(); ?> class="loading">
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>
    <div class="wrap container" role="document">
      <div class="content row">
        <main class="main">
          <?php include Wrapper\template_path(); ?>
        </main><!-- /.main -->
        <?php if (Setup\display_sidebar()) : ?>
          <aside class="sidebar">
            <?php include Wrapper\sidebar_path(); ?>
          </aside><!-- /.sidebar -->
        <?php endif; ?>
      </div><!-- /.content -->
    </div><!-- /.wrap -->
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-622529-30', 'auto');
      ga('send', 'pageview');

    </script>
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
