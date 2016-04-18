/* * *********************************************************
 * @ Package Conta Page and Conta
 * @ Date 20016/04/18
 * @GTM Selo Dermoclube
 * @Last update 2016/04/18
 * @ Developer Elder Xavier
 * @ Email eldersxavier@gmail.com / contato@elderxavier.com
 * @Description: This script define functions for Conta page in Cadin project;
 * ********************************************************* */
(function ($) {
    var CONTA = window.CONTA || {};
        
    CONTA.menu = function(){
        $('.item-menu').removeClass('active-menu');
        $('.menu-conta').addClass('active-menu');        
    };    
    /*INICIA FUNCOES*/
    CONTA.menu();    
    
})(jQuery);
