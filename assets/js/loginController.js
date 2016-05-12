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
    var LOGIN = window.LOGIN || {};
    LOGIN.preLoad = function () {
        $('.load').removeClass('hidden');
        $(document).ready(function () {
            setTimeout(function () {
                $('.load').addClass('hidden');
            }, 1000);
        });
    };
    LOGIN.removeError = function () {
        $('input').change(function (e) {
            $(this).removeClass('error');
        });
    };
    LOGIN.validAddUser = function () {
        var valid = true;
        $('.registration-form .form-control').each(function () {
            if ($(this).val().trim() == '') {
                $(this).addClass('error');
                valid = false;
            }            
        });
        if( !LOGIN.isEmail( $('#form-email').val() ) ){
            valid = false;
            $('#form-email').addClass('error');
        }
        
        if( $('#form-add-psw').val()!= $('#form-add-psw-conf').val() ){
            valid = false;
            $('#form-add-psw').addClass('error');
            $('#form-add-psw-conf').addClass('error');
        }
        return valid;
    };
    LOGIN.addUsers = function () {
        $('.load').removeClass('hidden');
        var datainputs = "";
        datainputs +='funcao=AddUsers';
        datainputs += '&nome=' + $('#form-first-name').val();
        datainputs += '&email=' + $('#form-email').val();
        datainputs += '&senha=' + $('#form-add-psw').val();              
        $.ajax({
            type: 'post',
            url: "include/helpers/resources.php",
            data: datainputs,
            timeout: 17000,
            dataType: 'json',
            success: function (retornar) {
                $('.load').addClass('hidden');
                console.log(retornar);                
                if (retornar.status == 1) {
                    swal("Sucesso", retornar.message, "success");
                }else{
                    sweetAlert("Algo Errado",retornar.message, "error");
                }

            },
            error: function (x, t, m) {
                $('.load').addClass('hidden');
                if (t === "timeout") {
                    console.log("Erro: ", "Tempo de requisiÃ§Ã£o esgotado :( ", "error");
                } else {
                    console.log("Erro: ", "Erro ao requisitar servidor ", t, x, m, ":(", "error");
                }
                sweetAlert("Algo Errado","sua conexão falhou!", "error");
            }
        });
    };
    LOGIN.isEmail = function (email) {
        var ret = true;
        var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        if (!filter.test(email)) {
            ret = false;
        }
        return ret;
    };

    LOGIN.submitAddUsers = function () {
        $('.btn-adduser').click(function (e) {            
            if (LOGIN.validAddUser()) {
                LOGIN.addUsers();
            }
        });
    };
    
    /*Login*/
    LOGIN.validUser = function () {
        var valid = true;
        $('.login-form .form-control').each(function () {
            if ($(this).val().trim() == '') {
                $(this).addClass('error');
                valid = false;
            }            
        });
        if( !LOGIN.isEmail( $('#form-username').val() ) ){
            valid = false;
            $('#form-username').addClass('error');
        }        
        return valid;
    };
    LOGIN.checkUsers = function () {
        $('.load').removeClass('hidden');
        var datainputs = "";
        datainputs +='funcao=CheckUsers';        
        datainputs += '&email=' + $('#form-username').val();
        datainputs += '&senha=' + $('#form-password').val();           
        $.ajax({
            type: 'post',
            url: "include/helpers/resources.php",
            data: datainputs + "&productid=" + $("#productid-mail").val(),
            timeout: 17000,
            dataType: 'json',
            success: function (retornar) {
                $('.load').addClass('hidden');
                console.log(retornar);                
                if (retornar.status == 1) {
                    window.location.href="index";
                }else{
                    sweetAlert("Algo Errado",retornar.message, "error");
                }

            },
            error: function (x, t, m) {
                $('.load').addClass('hidden');
                if (t === "timeout") {
                    console.log("Erro: ", "Tempo de requisiÃ§Ã£o esgotado :( ", "error");
                } else {
                    console.log("Erro: ", "Erro ao requisitar servidor ", t, x, m, ":(", "error");
                }
                sweetAlert("Algo Errado","sua conexão falhou!", "error");
            }
        });
    };
    
    LOGIN.submitUser = function () {
        $('.btn-login').click(function (e) {            
            if (LOGIN.validUser()) { 
                LOGIN.checkUsers();
            }
        });
    };
    
    /*Inicia funções*/
    LOGIN.init = function () {
        LOGIN.preLoad();
        LOGIN.removeError();
        LOGIN.submitAddUsers();
        LOGIN.submitUser();
        
    };
    LOGIN.init();
})(jQuery);
