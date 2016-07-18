<?php
/**
 * Template Name: Post
 */
 $share_id = wp_insert_post(array(
    'post_title'=>$fbid . '的 分享', 
    'post_type'=>'shares', 
    'post_status'=>'publish',
    'post_content'=>'')
    , $wp_error 
  );
  $result = $cfs->save(
    array(
      'fbid' => $fbid,
      'target_work' => $work_id
    ),
    array( 'ID' => $share_id )
  );
  $status = 1;
  $wp_error = '上傳成功';

  $result = $cfs->save(
    array(
      'share_count' => $count
    ),
    array( 'ID' => $work_id )
  );
?>
