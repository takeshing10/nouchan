/* ------------------------------------------------------------
*
*
    about.js
*
*
------------------------------------------------------------ */

(function($){
$(function(){

//--------------------------------------------------
//
//  SetContentHeight
//
//--------------------------------------------------
var SetContentHeight = (function(){
    
    var $body = $('body');
    var $about = $('#page_about');
    var $article = $about.find('article');
    var $articleInner = $article.find('.article_inner');
    var $title = $about.find('.title');

    return{
        SetHeight: function(){
            if(!GL.val.isWinSizeSmallW750){
                var _h = $title.outerHeight(true);
                var _titlePadding  = parseInt($title.css('padding-bottom'));
                var _btmOffset = 0;
                
                $article.each(function(){
                    $(this).css({paddingTop: _h, paddingBottom: _h});
                    
                    var _desc = $(this).find('.desc');
                    var _offset = _desc.offset().top + _desc.height();
                    
                    if(_btmOffset < _offset) _btmOffset = _offset;
                });
                
    
                var _setSize = _btmOffset + _titlePadding;
                if(GL.val.winSize.h < _setSize){
                    $about.css({height: _setSize});
                }else{
                    $about.css({height: '100vh'});
                }
            }
        }
    }
})();


//--------------------------------------------------
//
//  SwitchLanguage
//
//--------------------------------------------------
var SwitchLanguage = (function(){
    
    var $about = $('#page_about');
    var $nav = $about.find('.about_nav');
    var $switchContainer = $('.about_nav, #about_wrap .inner');
    var $aboutInner = $about.find('.inner');

    return{
        Init: function(){
            
            $nav.find('li').on('click.onPageEv', function(){

                if(!$(this).hasClass('on')){
                    $nav.find('li').removeClass('on');
                    $(this).addClass('on');
                    
                    var isJa = $nav.hasClass('j');
                    
                    if(isJa){
                        $switchContainer.removeClass('j').addClass('e');
                    }
                    if(!isJa){
                        $switchContainer.removeClass('e').addClass('j');
                    }
                }
            });
        }
    }
})();


//--------------------------------------------------
//
//  Common Function
//
//--------------------------------------------------
function Update(){
    SetContentHeight.SetHeight();
}

function Run(){
    SwitchLanguage.Init();
    SetContentHeight.SetHeight();
    
    if(CookieFunc.GetCookie('rito_official_site')) $('body').addClass('enter');
}

Run();

//--------------------------------------------------
//
//  Add Event
//
//--------------------------------------------------
$(window).on('resize.onPageEv', function(){
    Update();
});

$(window).on('orientationchange.onPageEv', function(){
    Update();
});

$(window).on('scroll.onPageEv touchmove.onPageEv', function(){
});

});
})(jQuery);