/* * *********************************************************
 * @ Package Index Page and Index
 * @ Date 20016/04/18
 * @GTM Selo Dermoclube
 * @Last update 2016/04/18
 * @ Developer Elder Xavier
 * @ Email eldersxavier@gmail.com / contato@elderxavier.com
 * @Description: This script define functions  Index page Cadin;
 * ********************************************************* */
(function ($) {
    var INDEX = window.INDEX || {};
    
    INDEX.menu = function(){
        $('.item-menu').removeClass('active-menu');
        $('.menu-index').addClass('active-menu');        
    };
    INDEX.menu();
    
})(jQuery);
