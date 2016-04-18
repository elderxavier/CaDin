/* * *********************************************************
 * @ Package Grafico Page and Grafico
 * @ Date 20016/04/18
 * @GTM Selo Dermoclube
 * @Last update 2016/04/18
 * @ Developer Elder Xavier
 * @ Email eldersxavier@gmail.com / contato@elderxavier.com
 * @Description: This script define functions for Grafico page in Cadin project;
 * ********************************************************* */
(function ($) {
    var GRAFICO = window.GRAFICO || {};
        
    GRAFICO.menu = function(){
        $('.item-menu').removeClass('active-menu');
        $('.menu-grafico').addClass('active-menu');        
    };    
    /*INICIA FUNCOES*/
    GRAFICO.menu();    
    
})(jQuery);
