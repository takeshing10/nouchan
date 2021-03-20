/* ------------------------------------------------------------
*
*
    home.js
*
*
------------------------------------------------------------ */

(function($){
$(function(){


//--------------------------------------------------
//
//  SliderFunction
//
//--------------------------------------------------
GL.val.homeSliderTimer = false;

var SliderFunction = (function(){
    
    var current = 0;
    var $slideContainer = $('.slider-container');
    var $slideWrap = $('.slider-wrapper');
    var $slideInner = $slideWrap.find('.inner');
    var $slide = $slideWrap.find('.slide');

    var slideCloneNum = 1;
    var speed = 15;
    var accelMax = (!GL.val.isSP)? 28: 14;
    var accel = 0;
    
    var slideH = $slideInner.height();
    var slideLength = $slide.length;
    var currentPos = ($(window).width() > 750)? 0: -GL.val.winSize.h * .85;

    var isUp = false;
    var touchPosY = 0;
    var touchMoveY = 0;
    
    var isTouchTop = false;
    
    var touchTimer = 0;
    var touchTimerInterval = false;
    
    var isInit = false;

    return{
        Init: function(){
            if(!isInit){
                isInit = true;
                var _this = this;
                var _pos = 0;
                
                $slide.each(function(i){
                    if(i < slideLength/2){
                    var _direction = 1;
                    if(_pos > 0) _direction *= -1;
                    _pos = _this.GetRandVal() * _direction;
                    
                    $slide.eq(i).css({left: _pos + '%'});
                    $slide.eq(i + slideLength/2).css({left: _pos + '%'});
                    }
                });
                
                var _slide = $slideInner.html();
                for(var i = 0; i < slideCloneNum; i ++){
                    $slideInner.append(_slide);
                }
                
                setTimeout(function(){
                    _this.Update();
                    _this.SetTimer();
                    _this.AddEvent();
                }, ($(window).width() > 750)? 2000: 100);
            }
        },
        
        SetTimer: function(){
            GL.val.homeSliderTimer = setTimeout(function(){
                currentPos += ($(window).width() > 750)? .5 + accel: .4 + accel;
                $slideWrap.css({transform: 'translateY(' + -currentPos + 'px)'});
                
                if(!isTouchTop){
                    if(currentPos > 0) isTouchTop = true;
                }
                
                if(isTouchTop){
                    if(currentPos > slideH) currentPos = 0;
                }
                
                SliderFunction.SetTimer();
                
                accel = (accel <= 0)? 0: accel -= (!GL.val.isSP)?.23: .23;
            }, speed - accel);
        },
        
        GetRandVal: function(){
    	    var val = Math.round(Math.random() * 5) + 20;
            return val;
        },
        
        Update: function(){
            slideH = $slideInner.height() / (slideCloneNum + 1);
        },
        
        AddEvent: function(){
            var _this = this;
            var isTouch = false;
            
            var mousewheelevent = 'onwheel' in document ? 'wheel' : 'onmousewheel' in document ? 'mousewheel' : 'DOMMouseScroll';
            $(document).off(mousewheelevent);
            $(document).on(mousewheelevent, function(e){
                e.preventDefault();
                var delta = e.originalEvent.deltaY ? -(e.originalEvent.deltaY) : e.originalEvent.wheelDelta ? e.originalEvent.wheelDelta : -(e.originalEvent.detail);
                if (delta < 0){
                    // down
                    _this.ScrollDown();
                }else{
                    // up
                    _this.ScrollUp();
                }
            });
            
            
            $(window).off('touchstart.onHomeSlider');
            $(window).off('touchend.onHomeSlider');
            $(window).off('touchmove.onHomeSlider');
            
            $(window).on('touchstart.onHomeSlider', function(e){
                touchPosY = e.changedTouches[0].pageY;
                
                touchTimerInterval = setInterval(function(){
                    touchTimer += 1;
                }, 10);
                
            });
            $(window).on('touchend.onHomeSlider', function(e){
                if(touchPosY + GL.val.winSize.h*.25 < touchMoveY){
                    _this.ScrollUp();
                }
                touchPosY = 0;
                
                clearInterval(touchTimerInterval);
                touchTimerInterval = false;
                touchTimer = 0;
            });
            $(window).on('touchmove.onHomeSlider', function(e){
                touchMoveY = e.changedTouches[0].pageY;
                
                if(touchPosY > touchMoveY){
                    if(touchTimer < 15){
                        _this.ScrollDown();
                    }
                }
            });
        },
        
        ScrollUp: function(){
            if(!isUp){
                var backVal = GL.val.winSize.h * .4;
                
                if(isTouchTop){
                    if(currentPos - backVal < 0) currentPos = slideH/2 + currentPos;
                }
                $slideWrap.css({transform: 'translateY(' + -currentPos + 'px)'});
                
                setTimeout(function(){
                    currentPos -= backVal;
                    $slideContainer.addClass('up');
                    $slideWrap.css({transform: 'translateY(' + -currentPos + 'px)'});
                    clearTimeout(GL.val.homeSliderTimer);
                    GL.val.homeSliderTimer = false;
                    accel = 0;
                }, 50);
                
                setTimeout(function(){
                    isUp = false;
                    $slideContainer.removeClass('up');
                    SliderFunction.SetTimer();
                }, 600);
            }
            isUp = true;
        },
        
        ScrollDown: function(){
            if(!GL.val.isSP){ accel += 3.5; }
            if(GL.val.isSP){
                var _a = (touchPosY - touchMoveY)*.015;
                accel += _a;
            }
            if(accel > accelMax) accel = accelMax;
        }
    }
})();


GL.func.SliderFunction = SliderFunction;

//--------------------------------------------------
//
//  HomeGlobanNavigation
//
//--------------------------------------------------
var HomeGlobanNavigation = (function(){
    
    var $page_home = $('#page_home');
    var $nav = $page_home.find('nav');
    var $sub = $nav.find('.sub');
    var $collection = $nav.find('.n_collection ul');
    var $leave = $nav.find('.n_home, .n_about, .n_stockist, .n_contact, .ex_nav');
    
    return{
        Init: function(){
            $sub.on('mouseenter', function(){
                $sub.addClass('on');
            });
            
            $leave.on('mouseenter', function(){
                $sub.removeClass('on');
            });
            
            $nav.on('mouseleave', function(){
                $sub.removeClass('on');
            });
        }
    }
})();



//--------------------------------------------------
//
//  SetCollectionColor
//
//--------------------------------------------------
var SetCollectionColor = (function(){
    
    return{
        Init: function(){
            var $body = $('body');
            var $col = $('.c_r');
            var $bg = $('.bg_c');
            var $col_r = $col.find('a');
            var $layer = $col.find('.layer');
            var color = $col.data('color');
            $bg.css({backgroundColor: color});
            $layer.css({backgroundColor: color});

            $col_r.off('mouseenter.onPageEv touchstart.onPageEv');
            $col_r.on('mouseenter.onPageEv touchstart.onPageEv', function(){
                $bg.addClass('h');
                $body.addClass('h_d');
            });
            
            $col_r.off('mouseleave.onPageEv touchend.onPageEv');
            $col_r.on('mouseleave.onPageEv touchend.onPageEv', function(){
                $bg.removeClass('h');
                $body.removeClass('h_d');
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
    SliderFunction.Update();
}

function Run(){
    GL.func.SetBackground.Init();
    HomeGlobanNavigation.Init();
    SetCollectionColor.Init();
    
    if(CookieFunc.GetCookie('rito_official_site')){
        GL.func.SliderFunction.Init();
        $('body').addClass('enter');
    }
    
    Update();
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

$(window).on('resizeend.onPageEv', function(){
    Update();
});

$(window).on('orientationchange.onPageEv', function(){
    Update();
});

$(window).on('scroll.onPageEv touchmove.onPageEv', function(){
});

});
})(jQuery);