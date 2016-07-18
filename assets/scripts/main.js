'use strict';
/* jshint devel:true, latedef:false,unused: false  */
/*eslint-disable new-cap, no-unused-vars,
  no-use-before-define, no-trailing-spaces, space-infix-ops, comma-spacing,
  no-mixed-spaces-and-tabs, no-multi-spaces, camelcase, no-loop-func,no-empty,
  key-spacing ,curly, no-shadow, no-return-assign, no-redeclare, no-unused-vars,
  eqeqeq, no-extend-native, quotes , no-inner-declarations*/
/*global  $, TweenMax */
var app = {};

app.global = {};

var debug = app.global.debug = /localhost[:]8080|localhost[:]3000/.test(location.href);

var loginStatus;

var authResponse;

var scrollTop = 0;

var activeSection = '';

var range = {};

var tlShuffle;

var tlTick;

// var dayOfMonth = app.global.dayOfMonth = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

// var method = app.global.method = debug ? 'get' : 'post';

//停用錨點自動跳換位置
if (location.hash) {
  setTimeout(function() {

    window.scrollTo(0, 0);
  }, 1);
}



window.fbAsyncInit = function() {
  FB.init({
    appId      : '1809323572634015',
    xfbml      : true,
    version    : 'v2.6'
  });

  $(function(){

    // 檢查facebook登入狀態
    FB.getLoginStatus(function(r){
      loginStatus = r.status
      authResponse = r.authResponse
      if(r.status === 'connected'){
        getMe(function(){});
      }
    });

    //表單
    $('form[method=async]').on('submit', function(e){
      var form = this;

      var redirect = $(form).attr('data-redirect');

      // if(!valid(form)){
      //   return false;
      // }

      var postObject = {};
      $($(form).serializeArray()).each(function(index, field){
        postObject[field.name] = field.value;
      });

      $.ajax({
        url: '/?api=form',
        method: 'post',
        data: postObject,
        success: function(r){
          if(r.status){
            alert(r.msg);
            $('header nav a:eq(0)').trigger('click');

          }else{
            alert(r.msg);
          }
        }
      });

      e.stopPropagation();

      e.preventDefault();

      return false;
      
    });

    // 定義每個section
    $.each(app, function(name, init){
      if(name === 'global'){
        return;
      }
      if($('main #' + name).length) {
        init(app.global);
      }
      range[name] = {};
      range[name].top = function(){
        return $('main #' + name).offset().top;
      };
      range[name].butt = function(){
        return $('main #' + name).offset().top + $('main #' + name).outerHeight();
      };
    });


    // 捲動至錨點時網址轉換
    $(window).on('scroll', function(){
      var currentTop = $(window).scrollTop();
      var currentButt = $(window).scrollTop() + $(window).height();
      $.each(app, function(name, init){
        if(name === 'global' || name === 'game' || name === 'form'){
          return;
        }
        if(scrollTop < currentTop){
          if(range[name].top() < currentButt && range[name].butt() > currentButt){
            activeSection = name;
          } 
        }else{
          if(range[name].top() < currentTop && range[name].butt() > currentTop){
            activeSection = name;
          } 
        }
      });
      $('header nav a[href*='+activeSection.replace(/[#]/ig, '')+']').addClass('active').siblings().removeClass('active');
      history.pushState('#' + activeSection, document.title, '#' + activeSection);
      scrollTop = currentTop;
    });

    

    //捲動至錨點
    if(location.hash){

      activeSection = location.hash;

      TweenMax.to('html, body', 0.5, {
        scrollTop: $(location.hash).offset().top,
        delay: 1
      });
    }

    $('header nav a').on('click', function(){  

      if($(this).hasClass('game-start')){
        loginStatus = $('input[name=fbid]').hasAttr('value') ? 'connected' : 'unknown';
        switch(loginStatus){
          case 'connected':
            getMe();
            goToStep('step1');
            break;
          default:

            FB.login(function(r){
              if(r.status === 'connected'){
                getMe();
                goToStep('step1');
              }
            }, {scope: 'email'});
            break;
        }
        $('html').removeClass('form');
        $('header nav').removeClass('on');
        return false;
      }

      var tg = $(this).attr('href');
      $('html').removeClass('game');
      $('html').removeClass('form');
      $('header nav').removeClass('on');
      TweenMax.to('html, body', 0.5, {
        scrollTop: $(tg).offset().top - 70,
        delay: 0.5
      });
      return false;
    });

    $('.burger').on('click', function(){
      $('header nav').toggleClass('on');
    });

    //觸發第一次調整頁面尺寸
    $(window).trigger('resize');

    var utmSource = /^[?&]utm_source=([^&]+)[&].*$/ig.test(location.search) ?
      location.search.replace(/^[?&]utm_source=([^&]+)[&].*$/ig,'$1') : null;

      $('input[name=utm]').val(utmSource);


    $('html').removeClass('loading');


    $('a button').filter(function(){
      return $(this).hasAttr('data-ga-title');
    }).on('click', function(){
      ga('send', 'event', {
        eventCategory: 'event',
        eventAction: 'click',
        eventLabel: $(this).attr('data-ga-title') + ($('html.mobile').length? '-mobile' : '-desktop')
      });

    });


    $('input').on('input change', function(){
      var result = true;
      try{
        $('form input').each(function(index, input){
          var field = {};
          input = $(input);
          field.name = input.attr('data-name') || input.attr('name');
          field.required = input.hasAttr('required');
          field.pattern = input.attr('pattern');
          field.value = input.val();
          if(field.required && ! field.value){
            input.next().addClass('in');
            result = false;
            if(field.pattern){
              input.next().next().removeClass('in');
            }
          }else{
            input.next().removeClass('in');
            if(field.pattern){
              if(!(new RegExp(field.pattern)).test(field.value)){
                input.next().next().addClass('in');
                result = false;
              }else{
                input.next().next().removeClass('in');
              }
            }
          }
          
        });
      }catch(e){
        console.log(e);
      }
      console.log(result);
      if(result === true){
        $('#submit').removeAttr('disabled');
      }else{
        $('#submit').attr('disabled', 'disabled');
      }
    });

    $('#replay,.success .restart').on('click', function(){
      loginStatus = $('input[name=fbid]').hasAttr('value') ? 'connected' : 'unknown';
      switch(loginStatus){
        case 'connected':
          getMe();
          goToStep('step1');
          break;
        default:

          FB.login(function(r){
            if(r.status === 'connected'){
              getMe();
              goToStep('step1');
            }
          }, {scope: 'email'});
          break;
      }
    });
  });
};



//表單驗證
function valid(form){
  var result = true;
  // console.log($('input, select, textarea', form))
  try{
    $('input, select, textarea', form).each(function(index, input){
      var field = {};
      input = $(input);
      field.name = input.attr('data-name') || input.attr('name');
      field.required = input.hasAttr('required');
      field.patern = input.attr('pattern');
      field.value = input.val();
      if(field.required && ! field.value){
        alert('請填寫' + field.name);
        result = false;
      }
      if(!(new RegExp(field.pattern)).test(field.value)){
        alert(field.name +' 格式錯誤');
        result = false;
      }
      
    });
  }catch(e){
    console.log(e);
  }

  return result;
}

$.fn.hasAttr = function(attributeName){
  var attr = $(this).attr(attributeName);
  if (typeof attr !== typeof undefined && attr !== false) {
    return true;
  }else{
    return false;
  }
};


function countdown(tl){

  var count = $('#game .step2 span');
  var count3 = $('#game .step2 span.countdown3');
  var count2 = $('#game .step2 span.countdown2');
  var count1 = $('#game .step2 span.countdown1');
  var count0 = $('#game .step2 span.countdown0');
  TweenMax.set(count, {
    opacity: 0
  });
  tl.add(TweenMax.to(count3, 0.5 ,{
    delay: 0.5,
    opacity: 1
  }));
  tl.add(TweenMax.to(count3, 0.001,{
    opacity: 0
  }));
  tl.add(TweenMax.to(count2, 0.5 ,{
    delay: 0.5,
    opacity: 1
  }));
  tl.add(TweenMax.to(count2, 0.001,{
    opacity: 0
  }));
  tl.add(TweenMax.to(count1, 0.5 ,{
    delay: 0.5,
    opacity: 1
  }));
  tl.add(TweenMax.to(count1, 0.001,{
    opacity: 0
  }));
  tl.add(TweenMax.to(count0, 0.5 ,{
    delay: 0.5,
    opacity: 1
  }));

  tl.add(function(){
    goToStep('step3');
  });
}

function ticking(tl){
  var num =20;
  for(var i=0;i<=20;i++){
    tl.add(function(){
      $('#game .seconds')
        .attr('class', 'seconds c' + num)
        .attr('data-second', 20 - num);
        num--;
    }, i + 4);
  }
}

function success(){

  goToStep('success');

  var results = {
    super : {
      metal: 'super',
      name: 'Super'
    },
    gold : {
      metal: 'gold',
      name: 'Super'
    },
    general : {
      metal: 'general',
      name: 'Super'
    }
  }

  var seconds = $('#game .seconds')
    .attr('data-second');

  var final;

  if(seconds <= 3){
    final = results.super;
  }else if(seconds > 3 && seconds <=5){
    final = results.gold;
  }else{
    final = results.general;
  }

  var picture = '?api=getpicture&picture=' + encodeURIComponent(me.picture) + '&name=' + encodeURIComponent(me.first_name) + '&metal=' + final.metal;

  var container = $('#game .success figure').css('background-image', 'url('+picture+')');
  // $('.name', container).html( final.name + ' ' + me.first_name);

  // console.log(me);

  FB.ui({
    display: $('html').hasClass('mobile') ? 'touch' : 'iframe', 
    method: 'share',
    href: 'http://event.ck101.com/JasonBourne/?utm_source=facebook&utm_medium=fbshare&utm_campaign=jasonbourne&picture=' + encodeURIComponent('http://event.ck101.com/JasonBourne/' + picture),
    caption: '電影【神鬼認證:傑森包恩】尋找傑森包恩｜電影包場活動'
  });
  // FB.ui({
  //   display: $('html').hasClass('mobile') ? 'touch' : 'iframe', 
  //   method: 'feed',
  //   link: 'http://event.ck101.com/JasonBourne/?utm_source=facebook&utm_medium=fbshare&utm_campaign=jasonbourne',
  //   caption: '電影【神鬼認證:傑森包恩】尋找傑森包恩｜電影包場活動',
  //   picture: 'http://event.ck101.com/JasonBourne/' + picture
  // }, function(response){
  //   console.log(response);
  //   if(response.post_id){
  //     $('[name=link]').val('https://www.facebook.com/' + response.post_id);
  //   }
  // });

  $('#apply').one('click', function(){
    goToForm();
  });

}

function failed(){

  goToStep('failed');
  // var container = $('#game .failed');
  // $('.name', container).html( 'Super ' + me.first_name);

  var picture = '?api=getpicture&picture=' + encodeURIComponent(me.picture) + '&name=' + encodeURIComponent(me.first_name);

  var container = $('#game .failed figure').css('background-image', 'url('+picture+')');

  FB.ui({
    display: $('html').hasClass('mobile') ? 'touch' : 'iframe', 
    method: 'share',
    href: 'http://event.ck101.com/JasonBourne/?utm_source=facebook&utm_medium=fbshare&utm_campaign=jasonbourne&picture=' + encodeURIComponent('http://event.ck101.com/JasonBourne/' + picture),
    caption: '電影【神鬼認證:傑森包恩】尋找傑森包恩｜電影包場活動'
  });
  // FB.ui({
  //   display: $('html').hasClass('mobile') ? 'touch' : 'iframe',
  //   method: 'feed',
  //   link: 'http://event.ck101.com/JasonBourne/',
  //   caption: '電影【神鬼認證:傑森包恩】尋找傑森包恩｜電影包場活動',
  //   picture: 'http://event.ck101.com/JasonBourne/' + picture
  // }, function(response){
  //   console.log(response);
  //   if(response.post_id){
  //     $('[name=link]').val('https://www.facebook.com/' + response.post_id);
  //   }
  // });
}

function shuffle(tick){
  var tl = new TimelineMax({
    paused: true,
    onComplete: function(){
      tl.seek(0);
      tl.play();
    }
  });
  function next(){
    var active = $('#game .target img.active').next().length ? 
      $('#game .target img.active').next() : 
      $('#game .target img').first();
    active.addClass('active');
    active.siblings().removeClass('active');
  }
  tl.addPause(0.025, next);
  var num = 1;
  tl.play();

  $('#game .snipper').on('click', function(){
    tl.pause();
    tick.pause();
    var index = $('#game .target img.active').index();
    var result = $('#game .target img').eq(index).attr('data-snipper');
    if(result === 'right'){
      success();
    }else{
      failed();
    }
  });

  tlShuffle = tl;
}

function goToStep(step){
  $('html').addClass('game');
  $('html')
    .removeClass('step1')
    .removeClass('step2')
    .removeClass('step3')
    .removeClass('success')
    .removeClass('failed');
  $('html').addClass(step);
}

function goToForm(){
  $('html').addClass('form');
  $('html')
    .removeClass('step1')
    .removeClass('step2')
    .removeClass('step3')
    .removeClass('success')
    .removeClass('failed')
    .removeClass('game');
}

function getMe(){
  FB.api('/me?fields=email,name,first_name,id', function(me){
    window.me = me;
    $('input[name=fbid]').val(me.id);
    $('input[name=fbname]').val(me.name);
    $('input[name=fbemail]').val(me.email);
    FB.api('/me/picture?width=152&height=152', function(pic){
      $('.success .picture,.failed .picture').css('background-image','url('+pic.data.url+')');
      me.picture = pic.data.url;
    });
  });
}

app.index = function(global){
  // console.log('index initialized');


  // (function(){
  //   var src = $('header h1 a img').attr('src');
  //   $.get(src, function(response){
  //     $('header h1 a').html($('svg', response));
  //   });
  // }());
};

app.gallery = function(global){
  // console.log('gallery initialized');
  $('#gallery .slick').slick({
    dots: true,
    fade: true
  });
};

app.start = function(global){
  // console.log('start initialized');

  $('#start button').on('click', function(){
    loginStatus = $('input[name=fbid]').hasAttr('value') ? 'connected' : 'unknown';
    switch(loginStatus){
      case 'connected':
        getMe();
        goToStep('step1');
        break;
      default:

        FB.login(function(r){
          if(r.status === 'connected'){
            getMe();
            goToStep('step1');
          }
        }, {scope: 'email'});
        break;
    }
  });
};

app.trailer = function(global){
};

app.award = function(global){
};

app.game = function(global){
  $('#game .step1 button').on('click', function(){
    goToStep('step2');
    var tl = new TimelineMax({paused: true, onComplete: function(){
      //時間到
      failed();
    }});
    countdown(tl);
    ticking(tl);
    shuffle(tl);
    tlShuffle.play();
    tl.play();
  });
};


(function(d, s, id){
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement(s); js.id = id;
   js.src = "//connect.facebook.net/en_US/sdk.js";
   fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));