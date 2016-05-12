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
        $("#valor").maskMoney({prefix: 'R$ ', allowNegative: true, thousands: '.', decimal: ',', affixesStay: false});
        $('.moneyvalue').maskMoney({prefix: 'R$ ', allowNegative: true, thousands: '.', decimal: ',', affixesStay: false});
    };
    INDEX.inputDate = function () {
        $('#created,.created').keydown(function (e) {
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


    INDEX.postdAddItem = function (element) {
        $('.load').removeClass('hidden');
        var datainputs = "";
        var valor = String($('#valor').val().replace('R$', '').replace(' ', '').replace('.', '').replace(',', '.'));
        var pass = $('#created').val().split('/');
        var created = pass[2] + "/" + pass[1] + "/" + pass[0] + " 00:00:00";
        datainputs += 'funcao=AddItem';
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
                console.log(retornar);
                if (!retornar.status == 1) {                    
                    alert('Erro ao incluir dados');
                } else {
                    window.location.reload();
                }
            },
            error: function (x, t, m) {
                $('.load').addClass('hidden');
                if (t === "timeout") {
                    console.log("Erro: ", "Tempo de requisiÃ§Ã£o esgotado :( ", "error");
                } else {
                    console.log("Erro: ", "Erro ao requisitar servidor ", t, x, m, ":(", "error");
                }
                alert("sua conexão falhou!");
            }
        });
    };

    INDEX.postdEditItem = function (element) {
        if ($(element).length) {
            $('.load').removeClass('hidden');
            var id = $(element).closest('tr').find('.id').eq(0).html();
            var financa_tipo_id = $(element).closest('tr').find('.descricao option:selected').eq(0).val();
            var valor = String($(element).closest('tr').find('.moneyvalue').eq(0).val());
            valor = valor.replace('.', '').replace(',', '.');
            //valor = valor.replace('R$','').replace(' ','').replace('.','').replace(',','.'); 
            var local = $(element).closest('tr').find('.local').eq(0).val();
            var created = $(element).closest('tr').find('.created').eq(0).val();
            var pass = created;
            var created = pass[2] + "/" + pass[1] + "/" + pass[0] + " 00:00:00";

            var datainputs = "";
            datainputs += 'funcao=EditItem';
            datainputs += '&id=' + id;
            datainputs += '&financa_tipo_id=' + financa_tipo_id;
            datainputs += '&valor=' + valor;
            datainputs += '&local=' + local;
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

                },
                error: function (x, t, m) {
                    $('.load').addClass('hidden');
                    if (t === "timeout") {
                        console.log("Erro: ", "Tempo de requisiÃ§Ã£o esgotado :( ", "error");
                    } else {
                        console.log("Erro: ", "Erro ao requisitar servidor ", t, x, m, ":(", "error");
                    }
                    alert("sua conexão falhou!");                    
                }
            });
        }
    };

    INDEX.postdDeleteItem = function (element) {
        if ($(element).length) {
            $('.load').removeClass('hidden');
            var id = $(element).closest('tr').find('.id').eq(0).html();
            var datainputs = "";
            datainputs += 'funcao=DeleteIitem';
            datainputs += '&id=' + id;
            $.ajax({
                type: 'post',
                url: "include/helpers/resources.php",
                data: datainputs,
                timeout: 17000,
                dataType: 'json',
                success: function (retornar) {
                    console.log(retornar);
                    if (retornar.status == 1) {
                        window.location.reload();
                    }

                },
                error: function (x, t, m) {
                    $('.load').addClass('hidden');
                    if (t === "timeout") {
                        console.log("Erro: ", "Tempo de requisiÃ§Ã£o esgotado :( ", "error");
                    } else {
                        console.log("Erro: ", "Erro ao requisitar servidor ", t, x, m, ":(", "error");
                    }
                    alert("sua conexão falhou!");                    
                }
            });
        }
    };

    INDEX.validEdit = function (element) {
        var valid = true;
        $(element).closest('tr').find('input').each(function () {
            if ($(this).val().trim() == '') {
                $(this).closest('td').addClass('error');
                valid = false;
            }
        });
        return valid;
    };
    INDEX.submitEdit = function () {
        $('.fa-check').click(function (e) {
            if (INDEX.validEdit($(this))) {
                var conf = confirm("Conluir Edição?");
                if (conf == true) {
                    INDEX.postdEditItem($(this));
                }

            }
        });
    };

    INDEX.submitDelete = function () {
        $('.fa-times').click(function (e) {
            var conf = confirm("Este item deve ser excluido permanentemente?");
            if (conf == true) {
                INDEX.postdDeleteItem($(this));
            }
        });
    };

    INDEX.submitLogout = function () {
        $('.square-btn-adjust').click(function (e) {
            $('.load').removeClass('hidden');
            var datainputs = '';
            datainputs += 'funcao=Logout';
            $.ajax({
                type: 'post',
                url: "include/helpers/resources.php",
                data: datainputs,
                timeout: 17000,
                dataType: 'json',
                success: function (retornar) {
                    console.log(retornar);
                    if (retornar.status == 1) {
                        window.location.reload();
                    }

                },
                error: function (x, t, m) {
                    $('.load').addClass('hidden');
                    if (t === "timeout") {
                        console.log("Erro: ", "Tempo de requisiÃ§Ã£o esgotado :( ", "error");
                    } else {
                        console.log("Erro: ", "Erro ao requisitar servidor ", t, x, m, ":(", "error");
                    }
                    alert("sua conexão falhou!");                    
                }
            });
        });
    };
    INDEX.uploadImage = function () {
        $('#uploadimag').change(function (e) {
            $('.load').removeClass('hidden');
            var form_data = new FormData();
            var datainputs = '';

            var file_data = $('#uploadimag').prop('files')[0];
            var tkey = 'foto';
            form_data.append(tkey, file_data);
            form_data.append("funcao", "fileUpload");
            form_data.append("usuario_id", $('#session-user-id').val());
            $.ajax({
                url: 'include/helpers/resources.php',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (retornar) {
                    console.log(retornar);
                    if (retornar.status == 1) {
                        $('.user-image').attr('src', retornar.values).load(function () {
                            $('.load').addClass('hidden');
                        });
                    }
                },
                error: function (x, t, m) {
                    $('.load').addClass('hidden');
                    if (t === "timeout") {
                        console.log("Erro: ", "Tempo de requisiÃ§Ã£o esgotado :( ", "error");
                    } else {
                        console.log("Erro: ", "Erro ao requisitar servidor ", t, x, m, ":(", "error");
                    }
                    alert("sua conexão falhou!");                    
                }
            });

            e.preventDefault();
        });
    };
    INDEX.maskcep = function (v, e) {
        if (v.length < 9) {
            v = v.replace(/\D/g, "");
            v = v.replace(/^(\d{5})(\d)/, "$1-$2");
        } else {
            e.preventDefault();
        }
        return v;
    };
    INDEX.validCep = function () {
        $('#cep').keypress(function (e) {
            this.value = INDEX.maskcep(this.value, e);
        }).blur(function (e) {
            this.value = INDEX.maskcep(this.value, e);
        }).focusout(function (e) {
            this.value = INDEX.maskcep(this.value, e);
        });
    };

    INDEX.searchAdress = function () {
        $('#cep').change(function (e) {
            var cep = $('#cep').val();
            cep = cep.replace(/\D/g, "");
            $('.load').removeClass('hidden');
            $.ajax({
                type: 'get',
                url: 'http://api.postmon.com.br/v1/cep/' + cep,
                timeout: 17000,
                dataType: 'json',
                success: function (retornar) {
                    $('.load').addClass('hidden');
                    $('#logradouro').val(retornar.logradouro);
                    $('#bairo').val(retornar.bairro);
                    $('#cidade').val(retornar.cidade);
                    $('#uf_estado').val(retornar.estado);
                },
                error: function (x, t, m) {
                    $('.load').addClass('hidden');
                    if (t === "timeout") {
                        console.log("Erro: ", "Tempo de requisiÃ§Ã£o esgotado :( ", "error");
                    } else {
                        console.log("Erro: ", "Erro ao requisitar servidor ", t, x, m, ":(", "error");
                    }
                    alert("sua conexão falhou!");                    
                }
            });
            e.preventDefault();
        });
    };
    INDEX.editAdress = function () {
        $('.load').removeClass('hidden');
        var datainputs = '';
        var cep = $('#cep').val();
        cep = cep.replace(/\D/g, "");
        datainputs += 'funcao=editAddress';        
        datainputs += '&usuario_id=' + $('#session-user-id').val();
        datainputs += '&cep=' + cep;
        datainputs += '&logradouro= '+$('#logradouro').val();
        datainputs += '&numero='+$('#numero').val();
        datainputs += '&complemento='+$('#complemento').val();        
        datainputs += '&bairo='+$('#bairo').val();
        datainputs += '&cidade='+$('#cidade').val();
        datainputs += '&uf_estado='+$('#uf_estado').val();        
        $.ajax({
            type: 'post',
            url: "include/helpers/resources.php",
            data: datainputs,
            timeout: 17000,
            dataType: 'json',
            success: function (retornar) {
                console.log(retornar);
                $('.load').addClass('hidden');
            },
            error: function (x, t, m) {
                $('.load').addClass('hidden');
                if (t === "timeout") {
                    console.log("Erro: ", "Tempo de requisiÃ§Ã£o esgotado :( ", "error");
                } else {
                    console.log("Erro: ", "Erro ao requisitar servidor ", t, x, m, ":(", "error");
                }
                alert("sua conexão falhou!");                
            }
        });

    };
    INDEX.submitEditAdress = function(){
        $('.update-adress').click(function (e) {
            var conf = confirm("Seu endereço será alterado?");
            if (conf == true) {
                INDEX.editAdress();
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
        INDEX.submitEdit();
        INDEX.submitDelete();
        INDEX.submitLogout();
        INDEX.uploadImage();
        INDEX.searchAdress();
        INDEX.validCep();
        INDEX.submitEditAdress();
    };
    INDEX.init();


})(jQuery);
