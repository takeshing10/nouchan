/* ------------------------------------------------------------
*
*
    common.js
*
*
------------------------------------------------------------ */


var GL = {};
GL.val = {};
GL.func = {};

(function($){
$(function(){
var winSize = {w: $(window).width(), h: $(window).height() }
var scrollPos = {top: $(window).scrollTop(), left: $(window).scrollLeft() }

GL.val.winSize = winSize;
GL.val.scrollPos = scrollPos;
GL.val.popState = false;
GL.val.isPageNav = false;
GL.val.isPageTopClick = false;
GL.val.isPageMove = false;
GL.val.currentPos = 0;
GL.val.currentPostID = 0;

GL.func.GetQuery;
GL.func.PjaxSettings;
GL.func.requireJs;
GL.func.CookieFunc;

var isWinSizeSmallW750 = false;

var isSP = false;
var isTablet = false;
var isIE = false;
var isEdge = false;
var isFireFox = false;
var isSafari = false;
var isSPChrome = false;
// --------------------------------------------------
//
//  msie / Device Type
//
// --------------------------------------------------
var ua = window.navigator.userAgent.toLowerCase();
var msie=navigator.appVersion.toLowerCase();
var os = (msie.indexOf("Win", 0) != -1)? 'win' : 'mac';
if( msie.match(/(msie|MSIE)/) || msie.match(/(T|t)rident/) ) {
    isIE = true;
    var ieVersion = msie.match(/((msie|MSIE)\s|rv:)([\d\.]+)/)[3];
    ieVersion = parseInt(ieVersion);
    $('body').addClass('isIE');
}else{
    ieVersion = 99;
}

if(ua.indexOf('edge') != -1){ $('body').addClass('isEdge'); isEdge = true;}
if(ua.indexOf('safari') != -1 && ua.indexOf('chrome') == -1){ isSafari = true; $('body').addClass('isSafari'); }
if(ua.indexOf('crios') != -1){ isSPChrome = true; $('body').addClass('sp_chrome'); }
if(ua.indexOf('firefox') != -1){ isFireFox = true; $('body').addClass('isFirefox'); }

function getDeviceType(){
var ua=navigator.userAgent;
var r=new Array(3);
if(ua.search(/iphone/i)>-1){ r=['smart','iphone','ios'];}
    else if(ua.search(/ipod/i)>-1){r=['smart','ipod','ios']; }
    else if(ua.search(/ipad/i)>-1){r=['tablet','ipad','ios'];}
    else if(ua.search(/android/i)>-1&&ua.search(/webkit/i)>-1){if(ua.search(/mobile/i)>-1){r=['smart','androidmobile','android'];}
    else{r=['tablet','androidtablet','android'];}
}
    else if(ua.search(/blackberry/i)>-1&&ua.search(/webkit/i)>-1&&ua.search(/mobile/i)>-1){r=['smart','blackberry','ohter'];}
    else if(ua.search(/windows phone/i)>-1&&ua.search(/msie/i)>-1){r=['other','windowsphone','other'];}
    else if(ua.search(/^docomo/i)>-1){r=['mobile','imode','other'];}
    else if(ua.search(/^kddi/i)>-1||ua.search(/^up\.browser/i)>-1){r=['mobile','ezweb','other'];}
    else if(ua.search(/^softbank/i)>-1||ua.search(/^vodafone/i)>-1||ua.search(/^mot/i)>-1){r=['mobile','sb','other'];}
    else{r=['other','other','other'];   }
    return r;
}

var tabView = 'width=750px';
if(getDeviceType()[0] == 'smart' || getDeviceType()[0] == 'tablet'){ $('body').addClass('is_sp');}
else{ $('body').addClass('is_pc'); }

if(getDeviceType()[0] == 'smart'){ $('body').addClass('only_sp'); isSP = true; }
if(getDeviceType()[0] == 'tablet'){
    $('body').addClass('only_tablet');

    isSP = true; isTablet = true;
    $('head').prepend('<meta name="viewport" content="' + tabView + '" id="viewport">');
}


GL.val.isSP = isSP;
GL.val.isTablet = isTablet;
GL.val.isSPChrome = isSPChrome;
GL.val.isIE = isIE;
GL.val.isEdge = isEdge;
GL.val.isFirefox = isFireFox;
GL.val.isSafari = isSafari;


// GetQueryString
GL.func.GetQuery = function() {
    if (1 < document.location.search.length) {
        var query = document.location.search.substring(1);
        var parameters = query.split('&');
        var result = new Object();
        for (var i = 0; i < parameters.length; i++) {
            var element = parameters[i].split('=');
            var paramName = decodeURIComponent(element[0]);
            var paramValue = decodeURIComponent(element[1]);
            result[paramName] = decodeURIComponent(paramValue);
        }
        return result;
    }
    return null;
}

//--------------------------------------------------
//
//  SwitchContentSize
//
//--------------------------------------------------
var SwitchContentSize = (function(){
    return{
        Init: function(){
            var _hasClass = $('body').hasClass('w750');
            if(($('body').css('position')) == 'static' && !_hasClass){
                isWinSizeSmallW750 =  true;
            }else if($('body').css('position') != 'static' && _hasClass){
                isWinSizeSmallW750 = false;
            }
        },
        
        SetBreakpoint: function(){
            var _hasClass = $('body').hasClass('w750');
            if(($('body').css('z-index')) == 10 && !_hasClass){
                $('body').addClass('w750');
                $('body').removeClass('w750p');
                PcGlobalNavigation.Close();
                
                isWinSizeSmallW750 =  true;
                
            }else if($('body').css('z-index') != 10 && _hasClass){
                $('body').removeClass('w750');
                $('body').addClass('w750p');
                PcGlobalNavigation.Close();
                
                isWinSizeSmallW750 = false;
            }
            
            GL.val.isWinSizeSmallW750 = isWinSizeSmallW750;
        }
    }
})();




//--------------------------------------------------
//
//  PcGlobalNavigation();
//
//--------------------------------------------------
var PcGlobalNavigation = (function(){
    
    var $body = $('body');
    var $header = $('header');
    var $h1 = $('h1.l');
    var $gnav = $('#gnav');
    var $gnavIco = $('.gnav_ico');
    var $navWrap = $gnav.find('.nav_wrap');
    var $sub = $gnav.find('.sub');
    
    var isInit = false;
    
    return{
        Init: function(){
            var _this = this;
            
            if(!isInit){
                isInit = true;
                
                $gnavIco.off('click.onPcGlobalNav');
                $gnavIco.on('click.onPcGlobalNav', function(){
                    var _hasOn = $body.hasClass('gnav');
                    if(!_hasOn){
                        $body.addClass('gnav');
                        $gnav.addClass('on');
                    }else{
                        $body.removeClass('gnav');
                        $gnav.removeClass('on');
                        $sub.removeClass('on');
                    }
                });
                
                $gnav.find('li').off('click.onPcGlobalNav');
                $gnav.find('li').on('click.onPcGlobalNav', function(){
                    if(!$(this).hasClass('ig') && !$(this).hasClass('contact')){
                        $gnav.find('li').removeClass('on');
                        $(this).addClass('on');
                    }
                });
                
                $h1.off('click.onPcGlobalNav');
                $h1.on('click.onPcGlobalNav', function(){
                    $gnav.find('li').removeClass('on');
                });
            }
        },
        
        Close: function(){
            $body.removeClass('gnav');
            $gnav.removeClass('on');
            $sub.removeClass('on');
        }
    }
    
})();



//--------------------------------------------------
//
//  ContentsAnimation();
//
//--------------------------------------------------
var ContentsAnimation = (function(){
    
    var $obj = $('.c_anim');
    
    var delayTime = 120;
    var tempLength = 0;
    var onloadTempLength = 0;
    var maxDelayLength = 6;
    
    return{
        Init: function(){
            $obj = $('.c_anim');
            
            delayTime = 120;
            tempLength = 0;
            onloadTempLength = 0;
            maxDelayLength = 6;
            
            this.Animation();
        },
        
        Animation: function(){
            $obj.each(function(){
                if($(this).hasClass('c_anim')){
                    var _elm = $(this);
                    var _class = _elm.attr('class');
                    
                    if(!isSP) var _pos = $(this).offset().top - scrollPos.top + winSize.h * .1;
                    if(isSP) var _pos = $(this).offset().top + winSize.h * .1;
                    
                    var _transOn = $(this).hasClass('c_on');

                    if(_transOn){
                        if(scrollPos.top + winSize.h > _pos){
                            _elm.removeClass('c_anim');
                            tempLength += 1;
                            if(tempLength > maxDelayLength) tempLength = maxDelayLength;
                            setTimeout(function(){
                                tempLength -= 1;
                                _elm.addClass('on');
                            }, tempLength * delayTime);
                        }
                    }
                    
                }
            });
        }
    }
})();



//--------------------------------------------------
//
//  SpTouchOver
//
//--------------------------------------------------
var SpTouchOver = (function(){
    
    var $elm = $('h1, h2, h3, h4, h5, a, p, li, div, dt, dd, img, span, article, section, input, select, textarea');
    var waitTime = 150;
    var isTouch = false;
    
    return{
        Init: function(){
            $elm = $('h1, h2, h3, h4, h5, a, p, li, div, dt, dd, img, span, article, section, input, select, textarea');
            $elm.off('touchstart.spTouchOver');
            $elm.off('touchend.spTouchOver');
            $elm.on('touchstart.spTouchOver', function(){ $(this).addClass('touch');});
            $elm.on('touchend.spTouchOver', function(){ $(this).removeClass('touch');});
        }
    }
})();



//--------------------------------------------------
//
//  BarbaSettings
//
//--------------------------------------------------
var BarbaFunction = (function(){
    
    var $body = $('body');
    var $currentPage;
    var $nextPage;
    var timeoutDuration = 5000;
    var defWaitTime = 600;
    var moveTime = defWaitTime;
    var waitTime = defWaitTime;
    var waitTimeout = false;
    var enterTimeout = false;
    
    var is_s_to_detail = false;
    var current_name;
    var next_name;
    
    return{
        Init: function(){
            
            barba.init({
                prefetchIgnore: false,
                transitions: [{
                    sync: true,
                    timeout: timeoutDuration,
                    
                    async leave(data){
                        
                        BarbaFunction.InitClass();
                        const done = this.async();
                        
                        $(data.current.container).addClass('_current');
                        $(data.next.container).addClass('_next');
                        
                        $(data.next.container).find('img').each(function(i){
                            var _img = new Image();
                            var _src = $(this).attr('src');
                            _img.src = _src;
                            _img.onload = function(){
                            }
                        });
                        
                        current_name = data.current.namespace;
                        next_name = data.next.namespace;
                        
                        // move
                        PcGlobalNavigation.Close();
                        $('.pj_container, h1').find('a').off('click.onPageEv');
                        $(window).off('mouseenter.onPageEv');
                        $(window).off('mouseleave.onPageEv');
                        $(window).off('mousemove.onPageEv');
                        $(window).off('touchstart.onPageEv');
                        $(window).off('touchend.onPageEv');
                        $(window).off('touchmove.onPageEv');
                        $(window).off('resize.onPageEv');
                        $(window).off('resizeend.onPageEv');
                        $(window).off('orientationchange.onPageEv');
                        $(window).off('scroll.onPageEv');
                        $(window).off('scrollstop.onPageEv');
                        $(window).off('wheel.onPageEv');
                        
                        var mousewheelevent = 'onwheel' in document ? 'wheel' : 'onmousewheel' in document ? 'mousewheel' : 'DOMMouseScroll';
                        $(document).off(mousewheelevent);
                        $(window).off('touchstart.onHomeSlider');
                        $(window).off('touchend.onHomeSlider');
                        $(window).off('touchmove.onHomeSlider');
                        
                        $body.removeClass('enter');
                        $body.addClass('leave');
                        $body.addClass('lock');
                        
                        waitTime = defWaitTime;
                        moveTime = defWaitTime;
                        
                        clearTimeout(waitTimeout);
                        waitTimeout = false;
                        waitTimeout = setTimeout(function(){
                            done();
                        }, moveTime);
                    },
                    
                    enter(data){
                        PageInit();
                    },

                    afterEnter(data){
                        $('body, html').stop().animate({scrollTop: 0}, 10);
                        var loadImgLength = 0;
                        var loadImgNum = 0;
                        
                        $body.removeClass('leave');
                        $body.removeClass('ready');

                        $nextPage = $('#page_' + data.next.namespace);
                        $body.attr('id', data.next.namespace);
                        $body.css({height: 'auto'});
                        
                        var _script = $nextPage.find('#page_script').find('script').attr('src');
                        requireJs(_script);
                        
                        clearTimeout(enterTimeout);
                        enterTimeout = false;
                        enterTimeout = setTimeout(function(){
                            $body.addClass('enter');
                            BarbaFunction.InitClass();
                            setTimeout(function(){
                                $body.removeClass('lock');
                                $(window).off('scroll.onScrollLock');
                            }, waitTime/4);
                        }, waitTime);
                    }
                }]
            });
        },
        
        InitClass: function(){
            is_s_to_detail = false;
            $('.b_container').removeClass('_current');
            $('.b_container').removeClass('_next');
        }
    }
})();


$(window).on('popstate.onCommonEv', function(){
    GL.val.popState = true;
    $('body').addClass('popstate');
    setTimeout(function(){
        $('body').removeClass('popstate');
    }, 5);
});



//--------------------------------------------------
//
//  PrefetchFunction
//
//--------------------------------------------------
var PrefetchFunction = (function(){
    
    var $elm = $('.prefetch');
    var $preload = $('.preload');
    
    return{
        Init: function(){
            var _this = this;
            
            $elm = $('.prefetch');
            $preload = $('.preload');
            
            $elm.off('mouseenter.onCommonEv touchstart.onCommonEv');
            $elm.on('mouseenter.onCommonEv touchstart.onCommonEv', function(){
                _this.LoadImg($(this));
            });
            
            $preload.each(function(){
                _this.LoadImg($(this));
            });
        },
        
        LoadImg: function(_elm){
            var _src = _elm.data('pre');
            var img = new Image();
            img.src = _src;
            img.onload = function(){}
        }
    }
})();



//--------------------------------------------------
//
//  SetBackground
//
//--------------------------------------------------
var SetBackground = (function(){
    
    var $bg = $('.set_bg');
    var $lazy = $('.set_bg.lazy');
    
    return{
        Init: function(){
            $bg = $('.set_bg');
            $lazy = $('.set_bg.lazy');
            
            $bg.each(function(){
                if($(this).find('.bg_inner').length == 0){
                    var _src = $(this).find('img').data('src');
                    $(this).append('<span class="bg_inner"></span><span class="layer"></span>');
                    var _bgInner = $(this).find('.bg_inner');
                    
                    if(!$(this).hasClass('lazy')){
                        _bgInner.css('background-image', 'url(' + _src + ')');
                    }
                }
            });
            
            this.LazyLoad();
        },
        LazyLoad: function(){
            $lazy.each(function(){
                var _elm = $(this);
                _elm.find('img').lazy({
                    threshold: GL.val.winSize.h,
                    afterLoad: function(e){
                        _elm.addClass('on');
                        var _src = _elm.find('img').data('src');
                        var _bgInner = _elm.find('.bg_inner');
                        _bgInner.css('background-image', 'url(' + _src + ')');
                        Update();
                    }
                });
            });
        }
    }
})();



//--------------------------------------------------
//
//  Common Function
//
//--------------------------------------------------
var isLoad = false;

// On Reisze
function Update(){
    winSize = {w: $(window).width(), h: $(window).height() }
    GL.val.winSize = winSize;
    SwitchContentSize.SetBreakpoint();
}

// On Scroll
function ScrollEv(){
//    ContentsAnimation.Animation();
}

function PageInit(){
    scrollPos = {top: $(window).scrollTop(), left: $(window).scrollLeft() }
    GL.val.scrollPos = scrollPos;
    SetBackground.Init();
    SpTouchOver.Init();
    PcGlobalNavigation.Init();
    PrefetchFunction.Init();
    
    if(!isLoad){
        isLoad = true;
    }
    
    Update();
}



function AddEmail(){
    var emailriddlerarray_main =[109,117,115,117,98,105,104,105,114,97,107,117,64,103,109,97,105,108,46,99,111,109];
    var email_main='';
    for (var i = 0; i < emailriddlerarray_main.length; i++){ email_main += String.fromCharCode(emailriddlerarray_main[i]); }
    
    $('.email').attr('href', 'mailto:' + email_main);
}



//--------------------------------------------------
//
//  Add Event
//
//--------------------------------------------------
$(window).on('resize.onCommonEv', function(){
    Update();
    $('body').addClass('onResize');
});

$(window).on('orientationchange.onCommonEv', function(){
    Update();
});


var tempTimeStamp = 0;
var scrollEventInterval = 10;
$(window).on('scroll.onCommonEv touchmove.onCommonEv', function(e){
    scrollPos = {top: $(window).scrollTop(), left: $(window).scrollLeft() }
    GL.val.scrollPos = scrollPos;
    ScrollEv();
    
    $('body').addClass('isScroll');
});

$(window).on('scrollstop.onCommonEv', function(e){
    scrollPos = {top: $(window).scrollTop(), left: $(window).scrollLeft() }
    GL.val.scrollPos = scrollPos;
    ScrollEv();
    
    $('body').removeClass('isScroll');
});


$(window).on('resizeend.onCommonEv', function(e){
    Update();
    $('body').removeClass('onResize');
});

$('body').addClass('enter');
$('body').addClass('load');
BarbaFunction.Init();
AddEmail();
PageInit();

});
})(jQuery);


/*
*
* GLOBAL FUNCTION
*
*/
requireJs= function(src, _callback){
    if(src){
        var $wrap = document.getElementById('page_script');
        var script = document.createElement('script');
        script.src = src;
        $wrap.appendChild(script);
    }
    
    if(_callback){ _callback();}
}


CookieFunc = (function(){
    return{
        SetCookie: function(cookie_name, val){
        	dat = val;
        	cstr = cookie_name + '=' + escape(dat) + ';';
        	document.cookie = cstr;
        },
        
        GetCookie: function(key){
            var c_name = document.cookie;
            var cookieKeys = c_name.split(';');
            for (var i=0; i<cookieKeys.length; i++) {
                var targetCookie = cookieKeys[i];
                targetCookie = targetCookie.replace(/^\s+|\s+$/g, '');
                var valueIndex = targetCookie.indexOf('=');
                if (targetCookie.substring(0, valueIndex) == key) {
                    return unescape(targetCookie.slice(valueIndex + 1));
                }
            }
            return ''
        }
    }
})();
