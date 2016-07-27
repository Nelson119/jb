<?php

namespace Roots\Sage\Header;

use Roots\Sage\Assets;

function theme_asset($file){
  echo Assets\asset_path($file);
}

?>
<header>
  <div class="container fontsize-reset">
    <h1 class="float-left vertical-middle">
      <img src="<?php theme_asset('images/common/logo.png')?>" alt="Universal Pictures">
    </h1>
    <nav class="float-right fontsize-p-18 vertical-middle">
      <a data-ga-group="首頁bar按鈕" data-ga-title="首頁" class="active" href="#index">首頁</a>
      <a data-ga-group="首頁bar按鈕" data-ga-title="劇情簡介" target="_blank" href="http://movie.ck101.com/movie/176/">劇情簡介</a>
      <a data-ga-group="首頁bar按鈕" data-ga-title="精彩劇照" href="#gallery">精彩劇照</a>
      <a data-ga-group="首頁bar按鈕" data-ga-title="官方預告" href="#trailer">官方預告</a>
      <a data-ga-group="首頁bar按鈕" data-ga-title="官方粉絲團" target="_blank" href="https://www.facebook.com/UniversalTaiwan/?ref=event.ck101">官方粉絲團</a>
      <a data-ga-group="首頁bar按鈕" data-ga-title="名單公佈" href="#award">名單公佈</a>
      <a data-ga-group="首頁bar按鈕" data-ga-title="參加活動" class="game-start" href="javascript:">參加活動</a>
    </nav>
    <a class="burger visible-sm visible-xs"><img src="<?php theme_asset('images/common/burger.png')?>"></a>
  </div>
</header>
