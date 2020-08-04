
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <link rel="stylesheet" type="text/css" href="../css/common.css<?=$time?>">
    <link rel="stylesheet" type="text/css" href="../css/main.css<?=$time?>">
    <link rel="stylesheet" type="text/css" href="../css/slick.css<?=$time?>">
    <title>심쿵할인</title>
</head>
<body>
<div class="wrapper">

    <!-- header -->
    <header class="header main">
        <div class="left">
            <!-- main -->
            <button type="button" class="btn-nav"><i class="blind">메뉴열기</i></button>
            <a href="/" class="header-logo"><i class="blind">심쿵할인</i></a>
            <!-- //main -->
            <a href="#none" class="btn-home "><span class="blind">홈</span></a>
            <a href="#none" class="btn-back "><span class="blind">뒤로가기</span></a>
        </div>
        <h1 class="title"></h1>
        <div class="right">
            <!-- main -->
            <ul class="quick-menu">
                <li>
                    <button type="button" class="menu-search"><i class="blind">검색</i></button>
                    <div class="search-area">
                        <form name="search1" action="/search/result" method="get">
                            <input type="hidden" id="force" name="force" value="0">
                            <input type="hidden" id="type" name="type" value="test">
                            <div class="search-type-01">
                                <label for="search-01" class="blind">검색</label>
                                <input type="search" autocomplete="off" name="keyword" id="search-01" rel="auto-complete-popup" placeholder="검색어를 입력해 주세요.">
                                <button type="reset" class="btn-delete"  onclick="keyword_reset('search-01')"><i class="blind">지우기</i></button>
                                <button type="submit" class="btn-search"><i class="blind">검색</i></button>
                            </div>
                        </form>

                        <!--자동완성 팝업-->
                        <div id="auto-complete-popup" class="auto-complete-popup" style="display:none;">
                            <ul>
                                <li><a href="#none"><span>방역용마스크</span></a></li>
                                <li><a href="#none"><span>마스크x2P</span></a></li>
                                <li><a href="#none"><span>샤인마스크</span></a></li>
                                <li><a href="#none"><span>엔자임마스크</span></a></li>
                                <li><a href="#none"><span>아이마스크</span></a></li>
                                <li><a href="#none"><span>kF94황사방역마스크</span></a></li>
                                <li><a href="#none"><span>영양마스크</span></a></li>
                                <li><a href="#none"><span>베지톡스마스크팩증정</span></a></li>
                                <li><a href="#none"><span>마스크10매입</span></a></li>
                                <li><a href="#none"><span>패션마스크</span></a></li>
                            </ul>
                            <button type="button" class="btn-close"><span class="blind">닫기</span></button>
                        </div>
                        <!--//자동완성 팝업-->

                    </div>
                </li>
                <li><a href="#none" class="menu-my"><i class="blind">마이페이지</i></a></li>
                <li><a href="#none" class="menu-cart"><i class="blind">장바구니</i><span class="count">5</span></a></li>
            </ul>
            <!-- //main -->
            <a href="#none" class="btn-heart "><span class="blind">찜하기</span></a>
            <a href="#none" class="btn-cart "><span class="blind">장바구니</span></a>
            <a href="#none" class="btn-close "><span class="blind">닫기</span></a>
        </div>
    </header>
    <!-- //header -->

    <div class="gnb">
        <button type="button" class="btn-gnb-close"><i class="blind">닫기</i></button>
        <div class="gnb-header">
            <div class="gnb-top">
                <!-- 로그인 시 -->
                <div class="name">홍길동님</div>
                <!-- 비로그인 시 -->
                <!--<div class="login"><a href="#none">로그인하기</a></div>-->
            </div>
            <div class="gnb-header-menu">
                <ul>
                    <li><a href="#none" class="my">MY페이지</a></li>
                    <li><a href="#none" class="order">주문/배송</a></li>
                    <li><a href="#none" class="cart">장바구니</a></li>
                </ul>
            </div>
        </div>

        <div class="gnb-menu-list">
            <div class="menu-link category">
                <div class="menu-title">카테고리</div>
                <ul class="menu-list">
                    <li>
                        <a href="#none" class="tab-menu best" data-id="category1">베스트</a>
                        <div class="sub-menu">
                            <ul>
                                <li><a href="#none" data-id="nocontent" class="tab-menu active">오늘의베스트</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">주간베스트</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">월간베스트</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#none" class="tab-menu living" data-id="category1">살림</a>
                        <div class="sub-menu">
                            <ul>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">전체</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">가구/수납</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">패브릭/인테리어</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">생활/욕실</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">주방용품</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">디지털/가전</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">헬스케어</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">여행/레저</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">자동차/공구</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">완구/취미</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">반려동물</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#none" class="tab-menu fashion" data-id="category1">패션</a>
                        <div class="sub-menu">
                            <ul>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">전체</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">여성패션</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">남성패션</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">언더웨어/잠옷</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">스포츠/아웃도어</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">신발</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">가방/소품</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">시계/쥬얼리</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">패션잡화</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">브랜드패션</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">유아패션</a></li>
                            </ul>
                        </div>
                    </li>
                    <!--                <li class="clone-menu1"></li>-->
                    <li>
                        <a href="#none" class="tab-menu beauty" data-id="category2">뷰티</a>
                        <div class="sub-menu">
                            <ul>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">전체</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">메이크업</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">스킨케어</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">바디</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">헤어</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">구강케어</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">여성용픔</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">헤어/바디도구</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">이미용기기</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">향수</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">남성</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#none" class="tab-menu food" data-id="category2">푸드</a>
                        <div class="sub-menu">
                            <ul>
                                <li><a href="#none" data-id="nocontent" class="tab-menu active">전체</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">건강실품</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">다이어트식품</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">가공식품</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">음료/간식</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">김치/반찬</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">채소/과일</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">견과/쌀</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">수산/건어물</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">축산</a></li>
                                <li><a href="#none" data-id="nocontent" class="tab-menu">선물세트</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="#none" class="tab-menu event">기획전</a></li>
                    <!--                <li class="clone-menu2"></li>-->
                </ul>
            </div>
            <div class="menu-title customer"><a href="#none">고객센터</a></div>
            <div class="menu-title setting"><a href="#none">환경설정</a></div>
        </div>

        <div class="gnb-banner">
            <a href="#none"><img src="../img/contents/banner_1.png" alt="빠르게 무료배송 상품보기 지금! 무료배송 상품을 만나보세요."></a>
        </div>

        <div class="gnb-footer">
            <ul class="copyright">
                <li><span class="company">(주)제이슨그룹</span><span>대표:정진영</span></li>
                <li><span>사업자등록번호 : 220-87-01996</span> <a href="#none" class="copyright-link">사업자정보확인</a></li>
                <li><span>통신판매업신고 : 제2014-서울용산-01149호</span></li>
                <li><span>서울특별시 용산구 한강대로 252 1F, 2F, 3F (남영동 우리빌딩)</span></li>
                <li><span>고객센터 : 1544-3530 (평일 09시 30분-18시, 점심시간 11시 45분-13시, 주말/공휴일 휴무) </span></li>
            </ul>

            <ul class="gnb-footer-menu">
                <li><a href="#none">이용약관</a></li>
                <li><a href="#none">개인정보처리방침</a></li>
                <li><a href="#none">청소년보호정책</a></li>
                <li><a href="#none">입점제휴문의</a></li>
                <li><a href="#none">대량구매문의</a></li>
            </ul>

            <div class="gnb-footer-info">
                (주)제이슨그룹은 상품/판매자정보/쇼핑정보/콘텐츠/UI 등에 대한 무단복제, 전송, 배포,
                스크래핑 등의 행위는 저작권법, 콘텐츠 산업 진흥법 등 관련법령에 의하여 엄격히 금지
                됩니다.
            </div>
        </div>
    </div>


    <div class="container main">

        <!-- category-area-->
        <div class="category-area">
            <div class="category-tab tab-wrap" id="tabs">
                <ul>
                    <li><a href="#home" class="tab-menu active">홈</a></li>
                    <li><a href="#best" class="tab-menu">베스트</a></li>
                    <li><a href="#living" data-id="category" class="tab-menu" >살림</a></li>
                    <li><a href="#fashion" data-id="category" class="tab-menu">패션</a></li>
                    <li><a href="#beauty" data-id="category" class="tab-menu">뷰티</a></li>
                    <li><a href="#food" data-id="category" class="tab-menu">푸드</a></li>
                    <li><a href="#event" class="tab-menu">오늘출발</a></li>
                </ul>
                <i class="active-line"></i>
            </div>
        </div>
        <!-- // category-area-->

        <!-- main : 홈 -->
        <div id="home" class="tab-content">
            <div class="slider">
                <div><img src="../img/contents/img_banner.png" alt="득템 특가 마지막 기회! 요즘 뜨는 인테리어 모음"></div>
                <div><img src="../img/contents/img_banner.png" alt="득템 특가 마지막 기회! 요즘 뜨는 인테리어 모음"></div>
                <div><img src="../img/contents/img_banner.png" alt="득템 특가 마지막 기회! 요즘 뜨는 인테리어 모음"></div>
            </div>

            <!-- 상품리스트 : 1단형 -->
            <div class="product-list type-col-01">
                <ul>
                    <li>
                        <a href="#none" class="product-link">
                            <div class="product-img">
                                <div class="img-area">
                                    <span class="today"><i class="blind">오늘출발</i></span>
                                    <!--                            <img src="../img/contents/img-sample.jpg" alt="">-->
                                </div>
                                <div class="badge">
                                    <div class="badge-icon coupon"><i class="blind">쿠폰할인</i></div>
                                    <div class="badge-icon shipping"><i class="blind">무료배송</i></div>
                                    <div class="badge-icon new"><i class="blind">New</i></div>
                                    <div class="badge-icon free"><i class="blind">무이자</i></div>
                                </div>
                            </div>
                            <div class="product-name">
                                <p class="product-subject">[대용량] 오르템 24K 골드 로얄 콜라겐 앰플 100ml [대용량] 오르템 24K 골드 로얄 콜라겐 앰플 100ml</p>
                                <p class="product-text">
                                    바르는 명품 99.9% 럭셔리 골드로 피부를 밝히고 피부의 황금기 바로 그 시절의 피부 모습으로 돌아가는 바르는 명품 99.9% 럭셔리 골드로 피부를 밝히고 피부의 황금기 바로 그 시절의 피부 모습으로 돌아가는
                                    <a href="#none" class="more">더보기</a>
                                </p>
                            </div>
                            <div class="product-info">
                                <div class="competitor">
                                    <span class="text">경쟁사최저가</span>
                                    <span class="price">139,000<span class="won">원</span></span>
                                    <button type="button" class="tool-tip"><i class="blind">툴팁</i>
                                        <span class="tool-tip-content">
                                2019.12.17 기준<br>
                                11번가, G마켓, 옥션, 인터파크, GS SHOP, 롯데닷컴, SSG, CJ Mall, 쿠팡, 티몬, 위메프<br>(위 11개 쇼핑몰 중 최저가)
                            </span>
                                    </button>
                                </div>
                                <div class="product-price">
                                    <button type="button" class="tool-tip"><i class="blind">최저가보장</i>
                                        <span class="tool-tip-content">
                                동종업체에서 판매되는 가격보다 비쌀 경우 차액을 보상하는 제도<br>* 상세내용 공지사항 참조
                            </span>
                                    </button>
                                    <span class="price">34,000<span class="won">원</span></span>
                                    <span class="discount">75<span class="per">%</span></span>
                                </div>
                                <div class="btn-pay">
                                    <span class="text"><span class="bold">348,802</span>개 구매</span>
                                    <a href="#none" class="btn-sm-01">구매하기</a>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#none" class="product-link">
                            <div class="product-img">
                                <div class="img-area">
                                    <span class="today"><i class="blind">오늘출발</i></span>
                                    <!--<img src="../img/contents/img-sample.jpg" alt="">-->
                                </div>
                                <div class="badge">
                                    <div class="badge-icon coupon"><i class="blind">쿠폰할인</i></div>
                                    <div class="badge-icon shipping"><i class="blind">무료배송</i></div>
                                    <div class="badge-icon new"><i class="blind">New</i></div>
                                    <div class="badge-icon free"><i class="blind">무이자</i></div>
                                </div>
                            </div>
                            <div class="product-name">
                                <p class="product-subject">[대용량] 오르템 24K 골드 로얄 콜라겐 앰플 100ml [대용량] 오르템 24K 골드 로얄 콜라겐 앰플 100ml</p>
                                <p class="product-text">
                                    바르는 명품 99.9% 럭셔리 골드로 피부를 밝히고 피부의 황금기 바로 그 시절의 피부 모습으로 돌아가는 바르는 명품 99.9% 럭셔리 골드로 피부를 밝히고 피부의 황금기 바로 그 시절의 피부 모습으로 돌아가는
                                    <a href="#none" class="more">더보기</a>
                                </p>
                            </div>
                            <div class="product-info">
                                <div class="competitor">
                                    <span class="text">경쟁사최저가</span>
                                    <span class="price">139,000<span class="won">원</span></span>
                                    <button type="button" class="tool-tip"><i class="blind">툴팁</i>
                                        <span class="tool-tip-content">
                                2019.12.17 기준<br>
                                11번가, G마켓, 옥션, 인터파크, GS SHOP, 롯데닷컴, SSG, CJ Mall, 쿠팡, 티몬, 위메프<br>(위 11개 쇼핑몰 중 최저가)
                            </span>
                                    </button>
                                </div>
                                <div class="product-price">
                                    <button type="button" class="tool-tip"><i class="blind">최저가보장</i>
                                        <span class="tool-tip-content">
                                동종업체에서 판매되는 가격보다 비쌀 경우 차액을 보상하는 제도<br>* 상세내용 공지사항 참조
                            </span>
                                    </button>
                                    <span class="price">34,000<span class="won">원</span></span>
                                    <span class="discount">75<span class="per">%</span></span>
                                </div>
                                <div class="btn-pay">
                                    <span class="text"><span class="bold">348,802</span>개 구매</span>
                                    <a href="#none" class="btn-sm-01">구매하기</a>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#none" class="product-link">
                            <div class="product-img">
                                <div class="img-area">
                                    <span class="today"><i class="blind">오늘출발</i></span>
                                    <!--<img src="../img/contents/img-sample.jpg" alt="">-->
                                </div>
                                <div class="badge">
                                    <div class="badge-icon coupon"><i class="blind">쿠폰할인</i></div>
                                    <div class="badge-icon shipping"><i class="blind">무료배송</i></div>
                                    <div class="badge-icon new"><i class="blind">New</i></div>
                                    <div class="badge-icon free"><i class="blind">무이자</i></div>
                                </div>
                            </div>
                            <div class="product-name">
                                <p class="product-subject">[대용량] 오르템 24K 골드 로얄 콜라겐 앰플 100ml [대용량] 오르템 24K 골드 로얄 콜라겐 앰플 100ml</p>
                                <p class="product-text">
                                    바르는 명품 99.9% 럭셔리 골드로 피부를 밝히고 피부의 황금기 바로 그 시절의 피부 모습으로 돌아가는 바르는 명품 99.9% 럭셔리 골드로 피부를 밝히고 피부의 황금기 바로 그 시절의 피부 모습으로 돌아가는
                                    <a href="#none" class="more">더보기</a>
                                </p>
                            </div>
                            <div class="product-info">
                                <div class="competitor">
                                    <span class="text">경쟁사최저가</span>
                                    <span class="price">139,000<span class="won">원</span></span>
                                    <button type="button" class="tool-tip"><i class="blind">툴팁</i>
                                        <span class="tool-tip-content">
                                2019.12.17 기준<br>
                                11번가, G마켓, 옥션, 인터파크, GS SHOP, 롯데닷컴, SSG, CJ Mall, 쿠팡, 티몬, 위메프<br>(위 11개 쇼핑몰 중 최저가)
                            </span>
                                    </button>
                                </div>
                                <div class="product-price">
                                    <button type="button" class="tool-tip"><i class="blind">최저가보장</i>
                                        <span class="tool-tip-content">
                                동종업체에서 판매되는 가격보다 비쌀 경우 차액을 보상하는 제도<br>* 상세내용 공지사항 참조
                            </span>
                                    </button>
                                    <span class="price">34,000<span class="won">원</span></span>
                                    <span class="discount">75<span class="per">%</span></span>
                                </div>
                                <div class="btn-pay">
                                    <span class="text"><span class="bold">348,802</span>개 구매</span>
                                    <a href="#none" class="btn-sm-01">구매하기</a>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- //상품리스트 : 1단형 -->

            <h2 class="list-title">심쿵추천상품</h2>
            <!-- 상품리스트 : 리스트형 -->
            <div class="product-list type-list">
                <ul>
                    <li>
                        <a href="#none" class="product-link">
                            <div class="product-img">
                                <div class="img-area">
                                    <span class="today"><i class="blind">오늘출발</i></span>
                                    <!--<img src="../img/contents/img-sample.jpg" alt="">-->
                                </div>
                                <div class="badge">
                                    <div class="badge-icon coupon"><i class="blind">쿠폰할인</i></div>
                                    <div class="badge-icon shipping"><i class="blind">무료배송</i></div>
                                    <div class="badge-icon new"><i class="blind">New</i></div>
                                    <div class="badge-icon free"><i class="blind">무이자</i></div>
                                </div>
                            </div>
                            <div class="product-name">
                                <p class="product-subject">[대용량] 오르템 24K 골드 로얄 콜라겐 앰플 100ml [대용량] 오르템 24K 골드 로얄 콜라겐 앰플 100ml</p>
                                <p class="product-text">
                                    바르는 명품 99.9% 럭셔리 골드로 피부를 밝히고 피부의 황금기 바로 그 시절의 피부 모습으로 돌아가는 바르는 명품 99.9% 럭셔리 골드로 피부를 밝히고 피부의 황금기 바로 그 시절의 피부 모습으로 돌아가는
                                    <a href="#none" class="more">더보기</a>
                                </p>
                            </div>
                            <div class="product-info">
                                <div class="competitor">
                                    <span class="text">경쟁사최저가</span>
                                    <span class="price">139,000<span class="won">원</span></span>
                                    <button type="button" class="tool-tip"><i class="blind">툴팁</i>
                                        <span class="tool-tip-content">
                                2019.12.17 기준<br>
                                11번가, G마켓, 옥션, 인터파크, GS SHOP, 롯데닷컴, SSG, CJ Mall, 쿠팡, 티몬, 위메프<br>(위 11개 쇼핑몰 중 최저가)
                            </span>
                                    </button>
                                </div>
                                <div class="product-price">
                                    <button type="button" class="tool-tip"><i class="blind">최저가보장</i>
                                        <span class="tool-tip-content">
                                동종업체에서 판매되는 가격보다 비쌀 경우 차액을 보상하는 제도<br>* 상세내용 공지사항 참조
                            </span>
                                    </button>
                                    <span class="price">34,000<span class="won">원</span></span>
                                    <span class="discount">75<span class="per">%</span></span>
                                </div>
                                <div class="btn-pay">
                                    <span class="text"><span class="bold">348,802</span>개 구매</span>
                                    <a href="#none" class="btn-sm-01">구매하기</a>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#none" class="product-link">
                            <div class="product-img">
                                <div class="img-area">
                                    <span class="today"><i class="blind">오늘출발</i></span>
                                    <!--<img src="../img/contents/img-sample.jpg" alt="">-->
                                </div>
                                <div class="badge">
                                    <div class="badge-icon coupon"><i class="blind">쿠폰할인</i></div>
                                    <div class="badge-icon shipping"><i class="blind">무료배송</i></div>
                                    <div class="badge-icon new"><i class="blind">New</i></div>
                                    <div class="badge-icon free"><i class="blind">무이자</i></div>
                                </div>
                            </div>
                            <div class="product-name">
                                <p class="product-subject">[대용량] 오르템 24K 골드 로얄 콜라겐 앰플 100ml [대용량] 오르템 24K 골드 로얄 콜라겐 앰플 100ml</p>
                                <p class="product-text">
                                    바르는 명품 99.9% 럭셔리 골드로 피부를 밝히고 피부의 황금기 바로 그 시절의 피부 모습으로 돌아가는 바르는 명품 99.9% 럭셔리 골드로 피부를 밝히고 피부의 황금기 바로 그 시절의 피부 모습으로 돌아가는
                                    <a href="#none" class="more">더보기</a>
                                </p>
                            </div>
                            <div class="product-info">
                                <div class="competitor">
                                    <span class="text">경쟁사최저가</span>
                                    <span class="price">139,000<span class="won">원</span></span>
                                    <button type="button" class="tool-tip"><i class="blind">툴팁</i>
                                        <span class="tool-tip-content">
                                2019.12.17 기준<br>
                                11번가, G마켓, 옥션, 인터파크, GS SHOP, 롯데닷컴, SSG, CJ Mall, 쿠팡, 티몬, 위메프<br>(위 11개 쇼핑몰 중 최저가)
                            </span>
                                    </button>
                                </div>
                                <div class="product-price">
                                    <button type="button" class="tool-tip"><i class="blind">최저가보장</i>
                                        <span class="tool-tip-content">
                                동종업체에서 판매되는 가격보다 비쌀 경우 차액을 보상하는 제도<br>* 상세내용 공지사항 참조
                            </span>
                                    </button>
                                    <span class="price">34,000<span class="won">원</span></span>
                                    <span class="discount">75<span class="per">%</span></span>
                                </div>
                                <div class="btn-pay">
                                    <span class="text"><span class="bold">348,802</span>개 구매</span>
                                    <a href="#none" class="btn-sm-01">구매하기</a>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#none" class="product-link">
                            <div class="product-img">
                                <div class="img-area">
                                    <span class="today"><i class="blind">오늘출발</i></span>
                                    <!--<img src="../img/contents/img-sample.jpg" alt="">-->
                                </div>
                                <div class="badge">
                                    <div class="badge-icon coupon"><i class="blind">쿠폰할인</i></div>
                                    <div class="badge-icon shipping"><i class="blind">무료배송</i></div>
                                    <div class="badge-icon new"><i class="blind">New</i></div>
                                    <div class="badge-icon free"><i class="blind">무이자</i></div>
                                </div>
                            </div>
                            <div class="product-name">
                                <p class="product-subject">[대용량] 오르템 24K 골드 로얄 콜라겐 앰플 100ml [대용량] 오르템 24K 골드 로얄 콜라겐 앰플 100ml</p>
                                <p class="product-text">
                                    바르는 명품 99.9% 럭셔리 골드로 피부를 밝히고 피부의 황금기 바로 그 시절의 피부 모습으로 돌아가는 바르는 명품 99.9% 럭셔리 골드로 피부를 밝히고 피부의 황금기 바로 그 시절의 피부 모습으로 돌아가는
                                    <a href="#none" class="more">더보기</a>
                                </p>
                            </div>
                            <div class="product-info">
                                <div class="competitor">
                                    <span class="text">경쟁사최저가</span>
                                    <span class="price">139,000<span class="won">원</span></span>
                                    <button type="button" class="tool-tip"><i class="blind">툴팁</i>
                                        <span class="tool-tip-content">
                                2019.12.17 기준<br>
                                11번가, G마켓, 옥션, 인터파크, GS SHOP, 롯데닷컴, SSG, CJ Mall, 쿠팡, 티몬, 위메프<br>(위 11개 쇼핑몰 중 최저가)
                            </span>
                                    </button>
                                </div>
                                <div class="product-price">
                                    <button type="button" class="tool-tip"><i class="blind">최저가보장</i>
                                        <span class="tool-tip-content">
                                동종업체에서 판매되는 가격보다 비쌀 경우 차액을 보상하는 제도<br>* 상세내용 공지사항 참조
                            </span>
                                    </button>
                                    <span class="price">34,000<span class="won">원</span></span>
                                    <span class="discount">75<span class="per">%</span></span>
                                </div>
                                <div class="btn-pay">
                                    <span class="text"><span class="bold">348,802</span>개 구매</span>
                                    <a href="#none" class="btn-sm-01">구매하기</a>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- //상품리스트 : 리스트형 -->

            <!-- 상품리스트 : 2단형 -->
            <div class="product-list type-col-02">
                <ul>
                    <li>
                        <a href="#none" class="product-link">
                            <div class="product-img">
                                <div class="img-area">
                                    <span class="today"><i class="blind">오늘출발</i></span>
                                    <!--<img src="../img/contents/img-sample.jpg" alt="">-->
                                </div>
                                <div class="badge">
                                    <div class="badge-icon coupon"><i class="blind">쿠폰할인</i></div>
                                    <div class="badge-icon shipping"><i class="blind">무료배송</i></div>
                                    <div class="badge-icon new"><i class="blind">New</i></div>
                                    <div class="badge-icon free"><i class="blind">무이자</i></div>
                                </div>
                            </div>
                            <div class="product-name">
                                <p class="product-subject">[대용량] 오르템 24K 골드 로얄 콜라겐 앰플 100ml [대용량] 오르템 24K 골드 로얄 콜라겐 앰플 100ml</p>
                                <p class="product-text">
                                    바르는 명품 99.9% 럭셔리 골드로 피부를 밝히고 피부의 황금기 바로 그 시절의 피부 모습으로 돌아가는 바르는 명품 99.9% 럭셔리 골드로 피부를 밝히고 피부의 황금기 바로 그 시절의 피부 모습으로 돌아가는
                                    <a href="#none" class="more">더보기</a>
                                </p>
                            </div>
                            <div class="product-info">
                                <div class="competitor">
                                    <span class="text">경쟁사최저가</span>
                                    <span class="price">139,000<span class="won">원</span></span>
                                    <button type="button" class="tool-tip"><i class="blind">툴팁</i>
                                        <span class="tool-tip-content">
                                2019.12.17 기준<br>
                                11번가, G마켓, 옥션, 인터파크, GS SHOP, 롯데닷컴, SSG, CJ Mall, 쿠팡, 티몬, 위메프<br>(위 11개 쇼핑몰 중 최저가)
                            </span>
                                    </button>
                                </div>
                                <div class="product-price">
                                    <button type="button" class="tool-tip"><i class="blind">최저가보장</i>
                                        <span class="tool-tip-content">
                                동종업체에서 판매되는 가격보다 비쌀 경우 차액을 보상하는 제도<br>* 상세내용 공지사항 참조
                            </span>
                                    </button>
                                    <span class="price">34,000<span class="won">원</span></span>
                                    <span class="discount">75<span class="per">%</span></span>
                                </div>
                                <div class="btn-pay">
                                    <span class="text"><span class="bold">348,802</span>개 구매</span>
                                    <a href="#none" class="btn-sm-01">구매하기</a>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#none" class="product-link">
                            <div class="product-img">
                                <div class="img-area">
                                    <span class="today"><i class="blind">오늘출발</i></span>
                                    <!--<img src="../img/contents/img-sample.jpg" alt="">-->
                                </div>
                                <div class="badge">
                                    <div class="badge-icon coupon"><i class="blind">쿠폰할인</i></div>
                                    <div class="badge-icon shipping"><i class="blind">무료배송</i></div>
                                    <div class="badge-icon new"><i class="blind">New</i></div>
                                    <div class="badge-icon free"><i class="blind">무이자</i></div>
                                </div>
                            </div>
                            <div class="product-name">
                                <p class="product-subject">[대용량] 오르템 24K 골드 로얄 콜라겐 앰플 100ml [대용량] 오르템 24K 골드 로얄 콜라겐 앰플 100ml</p>
                                <p class="product-text">
                                    바르는 명품 99.9% 럭셔리 골드로 피부를 밝히고 피부의 황금기 바로 그 시절의 피부 모습으로 돌아가는 바르는 명품 99.9% 럭셔리 골드로 피부를 밝히고 피부의 황금기 바로 그 시절의 피부 모습으로 돌아가는
                                    <a href="#none" class="more">더보기</a>
                                </p>
                            </div>
                            <div class="product-info">
                                <div class="competitor">
                                    <span class="text">경쟁사최저가</span>
                                    <span class="price">139,000<span class="won">원</span></span>
                                    <button type="button" class="tool-tip"><i class="blind">툴팁</i>
                                        <span class="tool-tip-content">
                                2019.12.17 기준<br>
                                11번가, G마켓, 옥션, 인터파크, GS SHOP, 롯데닷컴, SSG, CJ Mall, 쿠팡, 티몬, 위메프<br>(위 11개 쇼핑몰 중 최저가)
                            </span>
                                    </button>
                                </div>
                                <div class="product-price">
                                    <button type="button" class="tool-tip"><i class="blind">최저가보장</i>
                                        <span class="tool-tip-content">
                                동종업체에서 판매되는 가격보다 비쌀 경우 차액을 보상하는 제도<br>* 상세내용 공지사항 참조
                            </span>
                                    </button>
                                    <span class="price">34,000<span class="won">원</span></span>
                                    <span class="discount">75<span class="per">%</span></span>
                                </div>
                                <div class="btn-pay">
                                    <span class="text"><span class="bold">348,802</span>개 구매</span>
                                    <a href="#none" class="btn-sm-01">구매하기</a>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#none" class="product-link">
                            <div class="product-img">
                                <div class="img-area">
                                    <span class="today"><i class="blind">오늘출발</i></span>
                                    <!--<img src="../img/contents/img-sample.jpg" alt="">-->
                                </div>
                                <div class="badge">
                                    <div class="badge-icon coupon"><i class="blind">쿠폰할인</i></div>
                                    <div class="badge-icon shipping"><i class="blind">무료배송</i></div>
                                    <div class="badge-icon new"><i class="blind">New</i></div>
                                    <div class="badge-icon free"><i class="blind">무이자</i></div>
                                </div>
                            </div>
                            <div class="product-name">
                                <p class="product-subject">[대용량] 오르템 24K 골드 로얄 콜라겐 앰플 100ml [대용량] 오르템 24K 골드 로얄 콜라겐 앰플 100ml</p>
                                <p class="product-text">
                                    바르는 명품 99.9% 럭셔리 골드로 피부를 밝히고 피부의 황금기 바로 그 시절의 피부 모습으로 돌아가는 바르는 명품 99.9% 럭셔리 골드로 피부를 밝히고 피부의 황금기 바로 그 시절의 피부 모습으로 돌아가는
                                    <a href="#none" class="more">더보기</a>
                                </p>
                            </div>
                            <div class="product-info">
                                <div class="competitor">
                                    <span class="text">경쟁사최저가</span>
                                    <span class="price">139,000<span class="won">원</span></span>
                                    <button type="button" class="tool-tip"><i class="blind">툴팁</i>
                                        <span class="tool-tip-content">
                                2019.12.17 기준<br>
                                11번가, G마켓, 옥션, 인터파크, GS SHOP, 롯데닷컴, SSG, CJ Mall, 쿠팡, 티몬, 위메프<br>(위 11개 쇼핑몰 중 최저가)
                            </span>
                                    </button>
                                </div>
                                <div class="product-price">
                                    <button type="button" class="tool-tip"><i class="blind">최저가보장</i>
                                        <span class="tool-tip-content">
                                동종업체에서 판매되는 가격보다 비쌀 경우 차액을 보상하는 제도<br>* 상세내용 공지사항 참조
                            </span>
                                    </button>
                                    <span class="price">34,000<span class="won">원</span></span>
                                    <span class="discount">75<span class="per">%</span></span>
                                </div>
                                <div class="btn-pay">
                                    <span class="text"><span class="bold">348,802</span>개 구매</span>
                                    <a href="#none" class="btn-sm-01">구매하기</a>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- //상품리스트 : 2단형 -->
        </div>
        <!-- //main : 홈 -->


    </div>

    <div class="go-top">
        <button type="button" class="btn-top"><i class="blind">TOP</i></button>
    </div>

</div>
<!-- js -->
<script src="../lib/jquery-2.2.0.min.js<?=$time?>" type="text/javascript"></script>
<script src="../lib/jquery-ui.min.js<?=$time?>" type="text/javascript"></script>
<script src="../lib/slick.min.js<?=$time?>"></script>
<script src="../js/common.js<?=$time?>"></script>
<script src="../js/main.js<?=$time?>"></script>
<!-- //js -->
</body>
</html>
