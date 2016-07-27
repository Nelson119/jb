<?php

namespace Roots\Sage\Page;

use Roots\Sage\Assets;

function theme_asset($file){
  echo Assets\asset_path($file);
}

?>
<!-- <?php the_content(); ?> -->

<section class="pattern col-lg-12 fontsize-reset">
	<aside class="range">
		<section id="index">
			<figure class="kv"><img src="<?php theme_asset('images/index/kv.png')?>" alt="神鬼認證,傑森包恩"></figure>
			<h2>
				<img src="<?php theme_asset('images/index/text.png')?>" alt="麥特戴蒙 神鬼認證 傑森包恩 7月28日">
			</h2>
			<hr class="bottom">
		</section>
		<section id="start">
			<aside class="text-content">
				<h3 class="fontsize-p-48 fontsize-xs-25 text-right text-left-xs">任務說明</h3>
				<p class="fontsize-p-25 fontsize-xs-18">
					<span class="visible-lg visible-md visible-sm visible-xs">現在就加入菁英特務的募集!!</span>
					<span class="visible-lg visible-md visible-sm visible-xs">在眾多人群中，精準搜尋傑森包恩，</span>
					<span class="visible-lg visible-md visible-sm visible-xs">任務完成者，可得到參加電影特映抽獎機會!</span>
				</p>
				<button class="fontsize-p-25 fontsize-xs-25" data-ga-title="開始搜尋" data-ga-group="首頁說明" data-ga-title="開始搜尋">開始搜尋</button>
			</aside>

		</section>
		<section id="gallery" class="text-center">
			<h3 class="fontsize-p-32 fontsize-xs-20">精彩劇照</h3>
			<ul class="slick">
				<li>
					<figure style="background-image: url(<?php theme_asset('images/gallery/slick-1.png')?>)"></figure>
				</li>
				<li>
					<figure style="background-image: url(<?php theme_asset('images/gallery/slick-2.jpg')?>)"></figure>
				</li>
				<li>
					<figure style="background-image: url(<?php theme_asset('images/gallery/slick-3.jpg')?>)"></figure>
				</li>
				<li>
					<figure style="background-image: url(<?php theme_asset('images/gallery/slick-4.jpg')?>)"></figure>
				</li>
				<li>
					<figure style="background-image: url(<?php theme_asset('images/gallery/slick-5.jpg')?>)"></figure>
				</li>
				<li>
					<figure style="background-image: url(<?php theme_asset('images/gallery/slick-6.jpg')?>)"></figure>
				</li>
			</ul>
		</section>
		<section id="trailer" class="text-center">
			<h3 class="fontsize-p-32 fontsize-xs-20">官方預告</h3>
			<iframe width="880" height="430" src="https://www.youtube.com/embed/EUA2xj1cCLo" frameborder="0" allowfullscreen></iframe>
		</section>
		<section id="award" class="text-center">
			<h3 class="fontsize-p-32 fontsize-xs-20">名單公佈</h3>
			<aside class="list vertical-middle">
				<p class="coming fontsize-p-36 fontsize-xs-20 hide">
					<span class="visible-lg visible-md visible-sm visible-xs">目前活動尚未結束</span>
					<span class="visible-lg visible-md visible-sm visible-xs">coming soon....</span>
				</p>
				<span class="congrats fontsize-p-20">恭喜獲得電影包場入場票2張!!</span>
				<aside class="fontsize-p-20">
					<?php the_content();?>
				</aside>
			</aside>
		</section>
	</aside>


	

	<section id="game" class="vertical-middle text-center">

		<aside class="step1 fontsize-p-25 fontsize-xsl-18">
			<h4>此次限時20秒的任務中，將關係到這次的特務評鑑!</h4>

			<p>
				<span class="visible-lg visible-md visible-sm visible-xs">
					任務!!
				</span>
				<span class="visible-lg visible-md visible-sm visible-xs">
					在眾多人群中，精準搜尋 傑森包恩!
				</span>
				<span class="visible-lg visible-md visible-sm visible-xs">
					在3秒內精準找到目標，將晉升為<label class="red">超級特務</label>
				</span>
				<span class="visible-lg visible-md visible-sm visible-xs">
					5秒內精準偵測到目標，將晉升為<label class="orange">黃金特務</label>
				</span>
				<span class="visible-lg visible-md visible-sm visible-xs">
					10秒~20秒間找到目標，即為<label class="green">一般特務</label>
				</span>
			</p>

			<p>
				任務完成者，可得到參加電影特映抽獎機會!
			</p>

			<p>
				<button class="go" data-ga-group="活動說明" data-ga-title="開始搜尋2">開始搜尋</button>
			</p>
		</aside>


		<aside class="step2">
			<span class="countdown3">3</span>
			<span class="countdown2">2</span>
			<span class="countdown1">1</span>
			<span class="countdown0">0</span>
		</aside>


		<aside class="step3">
			<figure class="snipper">
				<section class="target">
					<img data-snipper="right" src="<?php theme_asset('images/game/target-1.png')?>">
					<img src="<?php theme_asset('images/game/target-2.png')?>">
					<img data-snipper="right" src="<?php theme_asset('images/game/target-3.png')?>">
				</section>
				<aside class="overlay"></aside>
				<i class="seconds"></i>
			</figure>
		</aside>


		<aside class="success">
			<h3 class="fontsize-p-48 fontsize-xsl-22">任務成功</h3>
			<figure class="card">
				<i class="picture"></i>
				<span class="name fontsize-p-28 fontsize-xsl-34">Super</span>
			</figure>
			<aside class="text-center btn">
				<a class="restart vertical-middle fontsize-p-25 fontsize-xsl-18" data-ga-group="任務成功" data-ga-title="再玩一次2">
					<img src="<?php theme_asset('images/game/restart.png')?>">
					再玩一次
				</a>
				<button id="apply" class="vertical-middle fontsize-p-25 fontsize-xsl-18" data-ga-group="任務成功" data-ga-title="拿票去">
					拿票去
					<img src="<?php theme_asset('images/game/tri.png')?>">
					<img src="<?php theme_asset('images/game/tri.png')?>">
				</button>
			</aside>
		</aside>

		<aside class="failed">
			<h3 class="fontsize-p-48 fontsize-xsl-22">任務失敗</h3>
			<figure class="card">
				<i class="picture"></i>
				<span class="name fontsize-p-28 fontsize-xsl-34">Super</span>
			</figure>
			<aside class="text-center btn">
				<button id="replay" class="vertical-middle fontsize-p-25 fontsize-xsl-18" data-ga-group="任務失敗" data-ga-title="再玩一次">
					再玩一次
					<img src="<?php theme_asset('images/game/tri.png')?>">
					<img src="<?php theme_asset('images/game/tri.png')?>">
				</button>
			</aside>
		</aside>


	</section>


	<form id="form" method="async" action="?api=form">
		<section class="container">
			<h3 class="fontsize-p-30 fontsize-xsl-22 text-center">現在就加入菁英特務的募集!</h3>
			<p class="fontsize-p-18">
				填寫神鬼認證資料，就有機會抽中7/30特務包場活動！本活動時間截止日期：7/21中午12:00結束
			</p>
			<input class="form-control fontsize-p-21" required type="text" placeholder="姓名：" name="name">
			<span class="fontsize-p-21 fade">*請輸入姓名</span>
			<input class="form-control fontsize-p-21" required type="text" placeholder="電話：" name="tel">
			<span class="fontsize-p-21 fade">*請輸入電話</span>
			<input class="form-control fontsize-p-21" required type="text" placeholder="地址：" name="addr">
			<span class="fontsize-p-21 fade">*請輸入地址</span>
			<input class="form-control fontsize-p-21" required type="email" placeholder="E-mail：" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" name="email">
			<span class="fontsize-p-21 fade">*請輸入信箱</span>
			<span class="fontsize-p-21 fade">*請輸入正確的信箱</span>
			<input type="hidden" name="link">
			<input type="hidden" name="fbid">
			<input type="hidden" name="fbname">
			<input type="hidden" name="fbemail">
			<input type="hidden" name="utm">

			<p class="fontsize-p-15">
				<span class="title">參加資格</span>
				<span>挑戰成功並完整輸入資料成功送出，就有機會獲得電影入場資格。一人限一次 (重複玩將不列入計算)</span>
			</p>

			<p class="fontsize-p-15">
				<span class="title">獎品獎項：</span>
				<span>7/30(六)14:00神鬼認證：傑森包恩電影入場資格(一人中獎兩人同行)，得獎名單將於7/22(五)中午12:00公佈於此活動頁下方『名單公佈』連結。</span>
			</p>
			<aside class="text-center">
				<button data-ga-group="填寫神鬼認證資料" data-ga-title="確定報名" id="submit" disabled="disabled" class="vertical-middle fontsize-p-25 fontsize-xsl-18">
					確定報名
				</button>
			</aside>

		</section>
	</form>


</section>

