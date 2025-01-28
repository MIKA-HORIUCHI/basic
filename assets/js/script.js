//全ページ共通---------------------------------
var win = $(window),
    doc = $(document),
    html = $("html"),
    wWidth = win.width();
    
//ローディング
window.addEventListener('load', function () {
  setTimeout(function () {
    $('.loading').fadeOut(1500);
  }, 2000);
});

//各要素アニメーション
$(function () {
  var fadeIn = $('.fadeInTrigger');
  fadeIn.on('inview', function(event, isInView) {
    if (isInView) {
      $(this).addClass('start');
    }
  });
});

//スムーススクロール
$(function () {
  $('a[href*="#"]').click(function () {
    const speed = 500;
    const target = $(this.hash === '#' || '' ? 'html' : this.hash)
    if (!target.length) return;
    const targetPos = target.offset().top;
    $('html, body').animate({ scrollTop: targetPos }, speed, 'swing');
    return false;
  });
});

//ユーザーエージェント
var ua, chrome, firefox, opera, safari;
ua = navigator.userAgent;
const IPad = /iPad|Macintosh/i.test(ua) && 'ontouchend' in document
//iOS
if (ua.indexOf('iPhone') > 0) { html.addClass("iOS");}
if (IPad) { html.addClass("iPad");}
//ブラウザ
if (ua.match(/chrome/i)) {html.addClass('chrome');}
else if(ua.match(/firefox/i)) {html.addClass('firefox');}
else if(ua.match(/opera/i)) {html.addClass('opera');}
else if(ua.match(/safari/i)) {html.addClass('safari');}

//ハンバーガーメニューアイコン
$(function () {
  var menuIcon = $('.menu-icon'),
      header = $('.header');
  if(wWidth <= 1200) {
    
    menuIcon.on('click',function() {
      $(this).toggleClass('active');
      header.toggleClass('active');
    });
    $('.nav__main a').on('click',function() {
      $(this).removeClass('active');
      header.removeClass('active');
    });
  }
});

//footer手前で固定ボタンを消す
$(function() {
  var footerHeight = $('.footer').innerHeight();
	win.scroll(function () {
			var scrollPosition = win.scrollTop();
			var documentHeight = doc.height();
			var windowHeight = win.height();
			// スクロール位置がフッターの手前に達したかどうかを確認
			if(scrollPosition > documentHeight - windowHeight - footerHeight){
				$('.btn').addClass('is-hidden');
			} else {
				$('.btn').removeClass('is-hidden');
			}
	});
});

//footer手前で固定
$(function () {
  if(width <= 896) {
    win.scroll(function() {
      var scroll = win.scrollTop();
      var $btn = $('.fixed');
      var wH = window.innerHeight; //画面の高さを取得
      var footerPos =  $('.footer').offset().top; //footerの位置を取得
      if(scroll+wH >= (footerPos+10)) {
        var pos = (scroll+wH) - footerPos+20
        $btn.css('bottom',pos); 
      } else {
        $btn.css('bottom',"10px"); 
      }
    });
  }
});

//エリア検知 メニューにクラスを付与
$(function () {
  win.on("load scroll resize", function () {
    var st = win.scrollTop();
    var wh = win.height();
    $('section').each(function (i) {
      var tg = $(this).offset().top;
      var id = $(this).attr('id');
      if (st > tg  - wh + (wh / 2)) {
        var link = $(".menu__item--" + id);
        $("[class^='menu__item']").removeClass("on");
        $(link).addClass("on");
      }
    });
  });
});

// NEW!timer
$(function(){
  $('time.new-timer').each(function(){
    var current = new Date(); // 現在日時
    var range_ms = current.getTime() + (5 * 24 * 60 * 60 * 1000);// 5日後のミリ秒
    var modified = new Date($(this).attr('datetime')); // 更新日時
    var modified_ms = modified.getTime(); // 更新日時のミリ秒
    if (range_ms < modified_ms ){
      $(this).css('display', 'none'); // 5日後を過ぎた場合、要素を非表示にする
    }
  });
});

//カウントダウン
$(function () {
  var countDownDate = new Date("Oct 27, 2023 00:00:00").getTime();
  var id = "countTimer";
  function updateCountdown() {
    var now = new Date().getTime();
    var distance = countDownDate - now;
    if (distance < 0) {
      document.getElementById(id).innerHTML = '';
      return;
    }
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    // 分と秒が一桁のとき0を追加
    function addZero(num) {
      return ('0' + num).slice(-2);
    }
    // 出力する内容
    document.getElementById(id).innerHTML = '<div class="countdown__num"><span class="set">' + addZero(days) + '<span class="set">days</span></span><small>：</small><span class="set">' + addZero(hours) + '<span class="set">hours</span></span><small>：</small><span class="set">' + addZero(minutes) + '<span class="set">minutes</span></span><small>：</small><span class="set">' + addZero(seconds) + '<span class="set">seconds</span></span></div>';
    requestAnimationFrame(updateCountdown);
  }
  // 初回の実行
  updateCountdown();
});