/* * *********************************************************
 * @ Package Cadin Page and Index
 * @ Date 20016/04/18 
 * @Created update 2016/04/18
 * @Last update 2016/04/18
 * @ Developer Elder Xavier
 * @ Email eldersxavier@gmail.com / contato@elderxavier.com
 * @Description: This script define functions  Index page Cadin;
 * ********************************************************* */
(function ($) {    
    var INDEX = window.INDEX || {};

    INDEX.preLoad = function () {
        $('.load').removeClass('hidden');
        $(document).ready(function () {
            setTimeout(function () {
                $('.load').addClass('hidden');
            }, 500);
        });
    };

    INDEX.menu = function () {
        $('.item-menu').click(function () {
            $('.item-menu').removeClass('active-menu');
            $(this).addClass('active-menu');
            $('.page-inner').addClass('hidden');
            var hd = $(this).attr('data-target');
            $('#' + hd).removeClass('hidden');
        });
        INDEX.initDataTables = function () {
            $(document).ready(function () {
                var table = $('#example').DataTable();

                $('button').click(function () {
                    var data = table.$('input, select').serialize();
                    alert(
                            "The following data would have been submitted to the server: \n\n" +
                            data.substr(0, 120) + '...'
                            );
                    return false;
                });
            });
        };
    };
    /*financas*/
    INDEX.validAdd = function () {
        var valid = true;
        $('.additem-form .form-control').each(function () {
            if ($(this).val().trim() == '') {
                $(this).addClass('error');
                valid = false;
            }
        });
        return valid;
    };    
    INDEX.inputMoney = function () {        
        $("#valor").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});        
    };
    INDEX.inputDate = function () {        
        $('#created').keydown(function (e) {
            e.preventDefault();
        });
    };

    INDEX.submitAdd = function () {
        $('.btn-financas').click(function (e) {
            if (INDEX.validAdd()) {
                INDEX.postdAddItem();
            }
        });
    };
    
    
    INDEX.postdAddItem = function () {
        $('.load').removeClass('hidden');
        var datainputs = "";
        var valor = String($('#valor').val().replace('R$','').replace(' ','').replace('.','').replace(',','.'));        
        var pass = $('#created').val().split('/');
        var created =pass[2]+"/"+pass[1]+"/"+pass[0] + " 00:00:00" ;        
        datainputs +='funcao=AddItem';        
        datainputs += '&usuario_id=' + $('#session-user-id').val();
        datainputs += '&financa_tipo_id=' + $('#tipo :selected').val();           
        datainputs += '&valor=' + valor;
        datainputs += '&local=' + $('#local').val();           
        datainputs += '&created=' + created;
        $.ajax({
            type: 'post',
            url: "include/helpers/resources.php",
            data: datainputs,
            timeout: 17000,
            dataType: 'json',
            success: function (retornar) {
                $('.load').addClass('hidden');
                console.log(retornar);                
                if (!retornar.status == 1) {
                    sweetAlert("Algo Errado",'Erro ao incluir dados', "error");
                }else{
                    $('.additem-form .form-control').val('');
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

    INDEX.init = function () {
        INDEX.preLoad();
        INDEX.menu();
        INDEX.initDataTables();        
        INDEX.submitAdd();
        INDEX.inputMoney();
        INDEX.inputDate();
    };
    INDEX.init();


})(jQuery);
