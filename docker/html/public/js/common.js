$(document).ready(function () {
    'use strict';

    scrollEvent();
    layerPopup();
    //tabEvent(); // 카테고리 선택 무력화
    countNum();
    goTop();
    gnb();
    gnbMenu();

    //select box
    //$('.chosen-select').chosen({disable_search_threshold: 100});
});

//스크롤 발생시
function scrollEvent() {
    var $bodyOffset = $('body').offset();
    $(window).scroll(function() {
        if ($(document).scrollTop() > $bodyOffset.top) {
            $('header').addClass('scroll');
        } else {
            $('header').removeClass('scroll');
        }
    });
}

//레이어팝업
function layerPopup(){
    var layerOpen = $('a[data-js="layer-popup"]');
    $(layerOpen).on('click', function (e) {
        var layerId = $(this).attr('href');
        if($(layerId).length > 0){
            $(layerId).show();
            $('body').css('overflow', 'hidden');
        }
        e.preventDefault();
    });

    $('.layer-close').on('click', function(e){
        $('.layer-popup').hide();
        $('body').css('overflow', 'auto');
        e.preventDefault();
    });
}


//탭
function tabEvent(){
    $('.tab-wrap').each(function(){
        var $tabMenu = $(this).find('.tab-menu');
        $tabMenu.on('click', function (e){
            var activeTab = $(this).attr("href");
            var activeTabId = $(this).data("id");

            if(activeTabId == 'nocontent'){
                $tabMenu.closest('.tab-menu').removeClass('active');
                $(this).addClass('active');

                // var tabLeft = $('.category-list li').position();
                // console.log(tabLeft);
                // $('.tab-inner').animate({
                //     scrollLeft : tabLeft.left
                // }, 400);

            }else{
                $tabMenu.closest('.tab-menu').removeClass('active');
                $(this).addClass('active');
                $(".tab-content").hide();
                $(activeTab).show();
                $('html, body').animate({
                    scrollTop : 0
                }, 200);

                $('.sub-category-tab').removeClass('active');
                $('body').removeClass('dim');

                if(activeTabId == 'category'){
                    $(activeTab).each(function(){
                        $(this).find('.category-list').each(function(){
                            var t = $(this),
                                tW = 0;
                            $('li', t).each(function(){
                                tW += $(this).outerWidth();
                                //console.log(tW);
                            });
                            t.css('width', tW + (t.outerWidth() + 10) - t.width());
                        });
                    });
                }
            }
            e.preventDefault();
        });
    });
}

//장바구니 Quantity
function countNum(){
    $('.btn-amount').on('click', function (e){
        var type = $(this).attr('data-range');
        var $count = $(this).parents().find('input.amount-val');
        var $min = $count.data('min');
        var $max = $count.data('max');
        var countVal = $count.val();
        if(type == 'count-down'){
            if(countVal <= $min){
                return;
            }
            $count.val(parseInt(countVal)-1);
        }else if(type == 'count-up'){
            if(countVal >= $max){
                return;
            }
            $count.val(parseInt(countVal)+1);
        }
        e.preventDefault();
    });
}

//top button
function goTop() {
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            $('.btn-top').fadeIn();
        } else {
            $('.btn-top').fadeOut();
        }
    });

    $(".btn-top").on('click', function() {
        $('html, body').animate({
            scrollTop : 0
        }, 400);
        return false;
    });
}

//GNB
function gnb(){
    $('.btn-nav').on('click', function(){
        gnbOpen();
    });

    $('.btn-gnb-close').on('click', function(){
        gnbClose();
    });
}

function gnbOpen(){
    $('.gnb').animate({
        left : 0
    }, 100);
    $('html, body').css('overflow', 'hidden');
}
function gnbClose(){
    $('.gnb').animate({
        left : '-200%'
    }, 100);
    $('html, body').css('overflow', 'visible');
}

//GNB 안에 메뉴
function gnbMenu(){
    $('.menu-list').children().eq(2).after('<li class="clone-menu1"></li>');
    $('.menu-list').children().eq(6).after('<li class="clone-menu2"></li>');
    $('.gnb .tab-menu').on('click', function () {
        var categoryId = $(this).data('id');
        var menu = $(this).next('.sub-menu');
        var cloneMenu = $(this).next('.sub-menu').clone();
        // console.log(categoryId);
        $(this).closest('.menu-list').find('.tab-menu').removeClass('active');
        $(this).addClass('active');
        if(categoryId == 'category1'){
            $('.clone-menu1').addClass('active').html(cloneMenu);
            $('.clone-menu2').removeClass('active').html('');
        }else if(categoryId == 'category2'){
            $('.clone-menu2').addClass('active').html(cloneMenu);
            $('.clone-menu1').removeClass('active').html('');
        }else{
            $('.clone-menu1, .clone-menu2').removeClass('active').html('');
        }
    });
}
