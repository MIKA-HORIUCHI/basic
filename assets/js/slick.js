var win = $(window),
    doc = $(document),
    html = $("html"),
    header = $('.header'),
    wWidth = win.width();
    
doc.ready(function(){
    //movie
    if ( window.document.body.id === 'top' ) {
      var $slide01 = $('#slick-movie'),$slideContnet = $('.js-modal-video');
      $slide01.on('init',function(){
        $slideContnet.addClass('animation');
      }); 
      $slide01.slick({
        dots: true,
        dotsClass: 'slide-dots',
        arrows: true,
        centerMode: true,
        centerPadding: "0",
        slidesToScroll: 1,
        autoplaySpeed: 3000, 
        speed: 500,
        fade: true,
        prevArrow: '<p class="slide-arrow prev-arrow"><img src="./assets/img/arrow.svg"></span>',
        nextArrow: '<p class="slide-arrow next-arrow"><img src="./assets/img/arrow.svg"></span>',
        responsive: [{
          breakpoint: 1024,
          settings: {
            centerPadding: '3%',
            fade: false,
            arrows: true,
            centerMode: true,
          }
        }]
      });
      $slide01.on('beforeChange',function(){
        $slideContnet.removeClass('animation');
      }); 
      $slide01.on('afterChange',function(){
        $slideContnet.addClass('animation');
      });
    }
    //discography
    if($('section').hasClass('discography')){
      //スライド数カウント
      $('#slick-disco').on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
        var i = (currentSlide ? currentSlide : 0) + 1;
        $('.slide-num .nowcnt').text(i);
        $('.slide-num .allcnt').text(slick.slideCount);
      });
      $('#slick-disco').slick({
        arrows: true,
        variableWidth: true,
        infinite: true,
        prevArrow: '<p class="slide-arrow prev-arrow"><img src="../assets/img/arrow.svg"></span>',
        nextArrow: '<p class="slide-arrow next-arrow"><img src="../assets/img/arrow.svg"></span>',
        swipeToSlide: true,
        touchMove: true,
        lazyLoad: 'progressive',
        responsive: [
          {
            breakpoint: 897,
            settings: {
              centerMode: true,
            },
          },
        ],
      });
    }
    //store
    if($('body').hasClass('store')){
      //store item 
      $('#slick-item').slick({
        fade: true,
        arrows: false,
        asNavFor: '#slick-item-btn', 
      });
      //選択画像の設定
      $('#slick-item-btn').slick({
        slidesToShow: 99,
        focusOnSelect: true,
        asNavFor: '#slick-item',
      });
      //下の選択画像をスライドさせずに連動して変更させる設定。
      $('#slick-item').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
        var index = nextSlide; //次のスライド番号
        //サムネイルのslick-currentを削除し次のスライド要素にslick-currentを追加
        $("#slick-item-btn .slick-slide").removeClass("slick-current").eq(index).addClass("slick-current");
      });
    }
  });
  