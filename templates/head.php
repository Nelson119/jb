<?php

use Roots\Sage\Assets;

function theme_asset($file){
  echo Assets\asset_path($file);
}

?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:title" content="【神鬼認證:傑森包恩】傑森包恩邀請你一起當特務!挑戰成功免費看電影!"/> 

	<meta property="og:description" content="【神鬼認證:傑森包恩】傑森包恩邀請你一起當特務!挑戰成功免費看電影!
敘述:更多神鬼認證:傑森包恩電影資訊 活動說明 電影劇照請見→ "/> 

	<meta property="og:url" content="http://event.ck101.com/JasonBourne/" />
	<meta property="og:type" content='website'/>
	<?php if(isset($_GET['picture'])):?>
	<meta property="og:image" content="<?php echo $_GET['picture']?>" />
	<meta property="og:image:width" content="485" />
	<meta property="og:image:height" content="249" />
	<?php endif;?>
	<meta property="og:image" content="http:<?php theme_asset('images/share.jpg')?>" />
	<meta property="og:image:width" content="485" />
	<meta property="og:image:height" content="249" />

	<title>電影【神鬼認證:傑森包恩】尋找傑森包恩｜電影包場活動</title>

    <meta name="description" content="挑戰尋找傑森包恩任務,成功就有機會抽中神鬼認證電影包場票!1人中獎2人同行喔!快來挑戰成為超級特務!拯救傑森包恩!">
    <meta name="keywords" content="神鬼認證,傑森包恩,電影, JASONBOURNE,麥特戴蒙,最後通牒,保羅葛林葛瑞斯,神鬼疑雲,艾莉西亞薇坎德,文森卡索,湯米李瓊斯,神鬼認證預告">
  <?php wp_head(); ?>
</head>
