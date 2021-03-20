/* ------------------------------------------------------------
*
*
    admin.js
*
*
------------------------------------------------------------ */
(function($){
$(function(){

//--------------------------------------------------
//
//  GetQuery
//
//--------------------------------------------------
var GetQuery = function(params){
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
        
        var _res = result[params];
        return _res;
    }
}


//--------------------------------------------------
//
//  FormSelectToRadio
//
//--------------------------------------------------
var FormSelectToRadio = (function(){
    return{
        Init: function(){
            if(pagenow == 'stockist' || pagenow == 'collection'){
                if(pagenow == 'stockist') var $cat = $('#tax_stockist_areachecklist');
                if(pagenow == 'collection') var $cat = $('#tax_seasonchecklist');
                var $input = $cat.find('input');
                
                var _isChecked = false;
                $input.on('click', function(){
                    $input.each(function(){
                        var _checked = $(this).prop('checked', false);
                    });
                    $(this).prop('checked', true);
                });
                
                var _isCheckReq = false;
                $input.each(function(){
                    var _checked = $(this).attr('checked');
                    if(_checked) _isCheckReq = true;
                });
                if(!_isCheckReq){
                    $input.eq(0).prop('checked', true);
                }
                
                var _isCheckBlank = false;
                $input.on('change', function(){
                    _isCheckBlank = false;
                    $input.each(function(){
                        var _checked = $(this).attr('checked');
                        if(_checked) _isCheckBlank = true;
                    });
                    if(!_isCheckBlank){
                        $(this).prop('checked', true);
                    }
                });
            }
        }
    }
})();


//--------------------------------------------------
//
//  StockistHideArea
//
//--------------------------------------------------
var StockistHideArea = (function(){
    
    var $area = $('#tax_stockist_areadiv');
    
    return{
        Init: function(){
            if(pagenow == 'stockist'){
                $('.acf-field-radio').find('input').each(function(){
                    StockistHideArea.Check($(this));
                });
                
                $('.acf-field-radio').find('input').on('change', function(){
                    StockistHideArea.Check($(this));
                });
            }
        },
        
        Check: function(_this){
            var isChecked = _this.attr('checked');
            if(isChecked == 'checked'){
                var _val = _this.val();
                if(_val == 'japan'){
                    $area.show();
                }else{
                    $area.hide();
                }
            }
        }
    }
})();



//--------------------------------------------------
//
//  CollectionSubMenuOrder
//
//--------------------------------------------------
var CollectionSubMenuOrder = (function(){

    var $collection = $('#menu-posts-collection');
    
    return{
        Init: function(){
            var _menu = [];
            $collection.find('.wp-submenu').find('li').each(function(){
                var _html = $(this).html();
                var _class = $(this).attr('class');
                var _val = $(this).find('a').html();
                if(_val == 'Season') _menu[0] = $(this).clone();
                if(_val == 'アイテム新規追加') _menu[1] = $(this).clone();
                if(_val == 'Allアイテム') _menu[2] = $(this).clone();
            });
            
            $collection.find('.wp-submenu').html('');
            
            for(var i = 0; i < _menu.length; i ++){
                $collection.find('.wp-submenu').append(_menu[i]);
            }
        }
    }

})();


//--------------------------------------------------
//
//  Common Function
//
//--------------------------------------------------
function Update(){

}

function Run(){
    StockistHideArea.Init();
    FormSelectToRadio.Init();
    CollectionSubMenuOrder.Init();
}

Run();


});
})(jQuery);