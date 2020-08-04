var start_time;
var end_time;

var force=0;
var target="";
    $(document).ready(function () {
    searchToggle();
    //categoryTab();
    subCategoryTab();
    toolTip();
    viewChange();
    sortList();
        console.log("start");
    $(".slider").slick({
        dots: false,
        arrows: false,
        infinite: true,
        centerMode: true,
        centerPadding: '11px',
        slidesToShow: 1,
        slidesToScroll: 1
    });

    $("#search-01").keyup(function (){ //자동완성
        console.log("auto complete ");
        var keyword = $(this).val();
        var rel = $(this).attr("rel");
        console.log("keyword : "+keyword+", rel : "+rel);
        target = $.trim(rel);
        if(keyword != '') ajax_search(keyword);
        else  $("#contents").html('');
    });
        $("#search-02").keyup(function (){ //자동완성
            console.log("search-02 > auto complete ");
            var keyword = $(this).val();
            var rel = $(this).attr("rel");
            console.log("keyword : "+keyword+", rel : "+rel);
            target = rel;
            if(keyword != '') ajax_search(keyword);
            else  $("#contents").html('');
        });

    $(".btn-close").on("click","button",function (){console.log("닫기"); reset(); });
});

$(window).resize(function () {
    categoryTab();
});

function searchToggle(){
    $('.menu-search').on('click', function(){
        $('.search-area').closest('li').addClass('show');
        $('.header-logo').hide();
    });
}

function categoryTab(){
    var offsetFirst = $('.category-tab li:first-child').offset();
    $('.category-tab .active-line').css({left: offsetFirst.left + 'px'});
    $('.category-tab .tab-menu').on('click', function (e){
        var offset = $(this).offset();
        var tabW = $(this).width();
        $('.active-line').stop().animate({
            left: offset.left + 'px',
            width: tabW + 'px'
        }, 100);
        e.preventDefault();
    });
}

function subCategoryTab() {
    $('.sub-category-tab').each(function(){
        $('.btn-open').on('click', function(){
            $(this).parent('.sub-category-tab').addClass('active');
            $('body').addClass('dim');
            var tH = $(this).parent('.sub-category-tab').find('.category-list').outerHeight();
            $('.btn-close').css('top', tH + 'px');
            $(this).prev('.tab-inner').css('height', tH + 'px');
        });

        $('.btn-close').on('click', function(){
            $(this).parent('.sub-category-tab').removeClass('active');
            $('body').removeClass('dim');
            $('.tab-inner').css('height', 50 + 'px');
        });
    });
}

function viewChange() {
    $('.tab-content').each(function(){
        var tabCont = $(this);
        $('.view-change').on('click', function(){
            $(this).toggleClass('active');
            $(tabCont).find('.type-col-01').not( '#home .type-col-01' ).toggleClass('type-col-02');
        });
    });
}

function sortList(){
    $('.sort').each(function(){
        $('.sort-value').on('click', function(){
            $('.list-content').hide();
            $(this).next('.list-content').toggle();
        });
        $(this).find('label').on('click', function(){
            if ($(this).find('input').is(":checked")) {
                var sortVal = $(this).find('input').val();
                var sortArea = $(this).closest('.sort-list');
                $(sortArea).find('.sort-text').text(sortVal);
                $(sortArea).find('label').removeClass('active');
                $(this).addClass('active');
                $('.list-content').hide();
            }
        });
    });
}

function toolTip(){
    $('.tool-tip').each(function(){
        $(this).on('click', function () {
            $('.tool-tip-content').removeClass('active');
            $(this).find('.tool-tip-content').addClass('active');
        });
        $('body').on('click', function(e){
            var $tgPoint = $(e.target);
            var $popCallBtn = $tgPoint.hasClass('tool-tip');
            var $popArea = $tgPoint.hasClass('tool-tip-content');

            if ( !$popCallBtn && !$popArea ) {
                $('.tool-tip-content').removeClass('active');
            }
        });
    });
}

function ajax_search(key) {
    $('#contents').html('');
    $('#contents').show();

//if(key.length<=1) return;
    start_time = getTime();
//console.time("ajax");
    $.ajax({
        type: 'get',
        url: 'http://127.0.0.1/api/auto_complete?keyword='+key+'&type=json',
        datatype: 'text',
        success: function (e) {
       //  console.timeEnd("ajax");
  //          console.log('key ajax : ' + key);
    //        console.log("delay time: "+Math.round(end_time-start_time,5)+"sec");
            prt_result(e);
            return;
            $("#contents").html(e);
            $("#contents").html('');
        }
    });
}

function getTime()
{
    var st = new Date();
    var time = (st.getMinutes()*60)+st.getSeconds()+(st.getMilliseconds()/100);
    return time
}
function autocomplete(o_target, obj)
{
    var target_id = $("input[name='keyword'][rel='"+o_target+"']").attr("id");
    target = o_target;
    console.log("id:"+target_id);
    var keyword = obj.attr("value");
    console.log(keyword);
    $("#"+target_id).val(keyword);
    product_search(keyword);
   // reset();
}
function prt_result(data)
{
    var html='<ul>';
    var obj = JSON.parse(data);
    console.log(obj);
    $("#"+target).html('');
    console.log("return_code:"+obj.return_code+",target: "+target);

    if(obj.return_code =="200") { //성공일때
        var  key_obj = obj.data;
console.log(key_obj)
        for (var val in key_obj) {
            var keyword = key_obj[val].text;
            html += "<li><a href='#'><span  value='"+keyword +"' onclick='autocomplete( target, $(this));'>" + keyword + "</span></a></li>";
        }
        html+="</ul><button type='button' class='btn-close' onclick='reset(\""+target+"\");'><span class='blind'>닫기</span></button>";
        $("#"+target).html(html);
        $("#"+target).show();
    }else{ //검색 실패
        console.log("결과 없음");
        $("#"+target).hide();
    }
}
function reset(id){
    target = (target=="") ? (id==""? "" : target) : target;
    if(target!='') {
        $('#' + target).hide();
        $('#'+target).html('');
    }else {
        $('.auto-complete-popup').hide();
        $('.auto-complete-popup').html('');
    }
}
//연관검색어
function related(obj)
{
    keyword = obj.text();
    console.log(" related  >> "+keyword);
    //$("#keyword").val();
    target='auto-complete-popup2';
    product_search(keyword);
}
//연관검색어,자동완성 검색
function product_search(keyword)
{

    $("#search-02").val(keyword)
    if(target == 'auto-complete-popup2') {
        document.search2.submit();
    }else{
        document.search1.submit();
    }
}
function keyword_reset(target) {
    force = 0;
    document.search2.force.value=force;
    $("#"+target).attr("placeholder","");
}
//강제검색어 조회
function force_search() {
    target = 'auto-complete-popup2';
    var keyword = $(".force_search").attr("ref");
    console.log("강제 검색어 : "+keyword);
    force=1;
    document.search2.force.value=force;
    product_search(keyword);
}
