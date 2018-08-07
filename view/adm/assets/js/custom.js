var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1; //January is 0!
icones = ['', 'info', 'success', 'warning', 'danger'];
type = ['', 'info', 'success', 'warning', 'danger'];
var camposHtml = '<div class="row">';
for (i = 1; i < 60; i++) {
    camposHtml += '<div class="col-md-3">' +
        '<div class="foto-persona-radio">' +
        '<img src="assets/img/faces/' + i + '-avatar-postspot.png">' +
        '<input type="radio" name="foto_persona" value="' + i + '-avatar-postspot.png">' +
        '</div>' +
        '</div>';
}
camposHtml += '</div>';

funcoes = {
    initFullCalendar: function () {
        $calendar = $('#fullCalendar');

        today = new Date();
        y = today.getFullYear();
        m = today.getMonth();
        d = today.getDate();

        $calendar.fullCalendar({
            locale: 'pt-br',
            viewRender: function (view, element) {
                // We make sure that we activate the perfect scrollbar when the view isn't on Month
                if (view.name != 'month') {
                    $(element).find('.fc-scroller').perfectScrollbar();
                }
            },
            header: {
                left: 'title',
                right: 'prev,next,today'
            },
            defaultDate: today,
            selectable: true,
            selectHelper: true,
            views: {
                month: { // name of view
                    titleFormat: 'MMMM YYYY'
                    // other view-specific options here
                },
                week: {
                    titleFormat: " MMMM D YYYY"
                },
                day: {
                    titleFormat: 'D MMM, YYYY'
                }
            },
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            eventSources: [

                {
                    url: siteBase + 'controller/calendario/datas.php',
                    error: function () {
                        alert('there was an error while fetching events!');
                    }
                }

                // any other sources...

            ],
            eventClick: function(event) {
                if (event.url) {
                    window.open(event.url);
                    return false;
                }
            }
        });
    },
    showSwal: function (modal) {
        switch (modal) {
            case 'projeto':
                swal({
                    title: 'Escolha o Projeto',
                    text: 'Escolha o projeto no qual você deseja gerenciar',
                    showConfirmButton: false,
                    html: '<ul class="modal-projetos">' +
                        '<li>Projeto Fabiola</li>' +
                        '<li>Camisaria Italiana</li>' +
                        '<li>Melhor Compra</li>' +
                        '</ul>'
                });
                break;
            case 'personas':
                swal({
                    title: 'Escolha a Persona',
                    showConfirmButton: true,
                    confirmButtonText: 'Salvar',
                    html: camposHtml
                }).then(function () {
                    var fotoPersona = 'assets/img/faces/' + ($('input[name=foto_persona]:checked').val());
                    $('#fotoPersona').attr('src', fotoPersona);
                    $('#hiddenFotoPersona').val($('input[name=foto_persona]:checked').val());
                });
                break;
            case 'criaProjeto':
                swal({
                    title: 'Criar Projeto',
                    showConfirmButton: true,
                    confirmButtonText: 'Criar Projeto',
                    html: '<div class="row">' +
                        '<form id="formCriaProjeto" action="../../controller/projeto/cria_projeto.php" method="post">' +
                        '<div class="col-md-12">' +
                        '<div class="form-group">' +
                        '<label>Nome do Projeto</label>' +
                        '<input type="text" class="form-control border-input" name="nome_projeto">' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-md-12">' +
                        '<div class="form-group">' +
                        '<label>Site do Projeto</label>' +
                        '<input type="text" class="form-control border-input" name="site_projeto">' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-md-12">' +
                        '<label>Responsável</label>' +
                        '<div class="form-group">' +
                        '<select class="form-control border-input" name="responsavel_projeto">' + optionResponsaveis + '</select>' +
                        '</div>' +
                        '</div>' +
                        '</form>' +
                        '</div>'
                }).then(function () {
                    $('#formCriaProjeto').trigger('submit');
                });
                break;
            case 'trocarSenha':
                swal({
                    title: 'Trocar Senha',
                    showConfirmButton: true,
                    confirmButtonText: 'Trocar',
                    html: '<div class="row">' +
                        '<form id="formTrocarSenha" action="../../controller/usuario/trocar_senha.php" method="post"enctype="multipart/form-data">' +
                        '<div class="col-md-12">' +
                        '<div class="form-group">' +
                        '<label>Nova Senha</label>' +
                        '<input type="password" class="form-control border-input" name="senha_usuario">' +
                        '</div>' +
                        '</div>' +
                        '</form>' +
                        '</div>'
                }).then(function () {
                    $('#formTrocarSenha').trigger('submit');
                });
                break;
            case 'tipoConteudo':
                swal({
                    title: 'Incluir tipo de conteúdo',
                    showConfirmButton: true,
                    confirmButtonText: 'Criar',
                    html: '<div class="row">' +
                        '<form id="formCriaTipoTarefa" action="../../controller/tipo_tarefa/cria_tipo.php" method="post">' +
                        '<div class="col-md-12">' +
                        '<div class="form-group">' +
                        '<label>Nome</label>' +
                        '<input type="text" class="form-control border-input" name="nome_tarefa" required>' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-md-12">' +
                        '<div class="form-group">' +
                        '<label>Valor pauta</label>' +
                        '<input type="text" class="form-control border-input mask-real" name="valor_pauta_tipo_tarefa" required>' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-md-12">' +
                        '<div class="form-group">' +
                        '<label>Valor conteúdo</label>' +
                        '<input type="text" class="form-control border-input mask-real" name="valor_conteudo_tipo_tarefa" required>' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-md-12">' +
                        '<div class="form-group">' +
                        '<label>Cor do Evento</label>' +
                        '<p id="inputColor"></p>' +
                        '</div>' +
                        '</div>' +
                        '</form>' +
                        '</div>'
                }).then(function () {
                    $('#formCriaTipoTarefa').trigger('submit');
                });
                var input = document.createElement('INPUT');
                input.type = "text";
                input.name = 'cor_tarefa';
                input.className = "form-control border-input";
                var picker = new jscolor(input);
                picker.fromHSV(360 / 100 * i, 100, 100)
                document.getElementById('inputColor').appendChild(input);
                $('.mask-real').mask('000.000.000.000.000,00', {
                    reverse: true
                });
                break;
            case 'habilidade':
                swal({
                    title: 'Incluir habilidade',
                    showConfirmButton: true,
                    confirmButtonText: 'Criar',
                    html: '<div class="row">' +
                        '<form id="formCriaHabilidade" action="../../controller/habilidades/cria_habilidade.php" method="post">' +
                        '<div class="col-md-12">' +
                        '<div class="form-group">' +
                        '<label>Nome</label>' +
                        '<input type="text" class="form-control border-input" name="nome_habilidade">' +
                        '</div>' +
                        '</div>' +
                        '</form>' +
                        '</div>'
                }).then(function () {
                    $('#formCriaHabilidade').trigger('submit');
                });
                break;
            case 'idioma':
                swal({
                    title: 'Criar Idioma',
                    showConfirmButton: true,
                    confirmButtonText: 'Criar',
                    html: '<div class="row">' +
                        '<form id="formCriaIdioma" action="../../controller/idiomas/cria_idioma.php" method="post">' +
                        '<div class="col-md-12">' +
                        '<div class="form-group">' +
                        '<label>Idioma</label>' +
                        '<input type="text" class="form-control border-input" name="nome_idioma">' +
                        '</div>' +
                        '</div>' +
                        '</form>' +
                        '</div>'
                }).then(function () {
                    $('#formCriaIdioma').trigger('submit');
                });
                break;
            case 'categoria':
                swal({
                    title: 'Incluir categoria',
                    showConfirmButton: true,
                    confirmButtonText: 'Criar',
                    html: '<div class="row">' +
                        '<form id="formCriaCategoria" action="../../controller/categorias/cria_categoria.php" method="post">' +
                        '<div class="col-md-12">' +
                        '<div class="form-group">' +
                        '<label>Categoria</label>' +
                        '<input type="text" class="form-control border-input" name="nome_categoria">' +
                        '</div>' +
                        '</div>' +
                        '</form>' +
                        '</div>'
                }).then(function () {
                    $('#formCriaCategoria').trigger('submit');
                });
                break;
            case 'anexo':
                swal({
                    title: 'Subir Arquivo',
                    showConfirmButton: true,
                    confirmButtonText: 'Subir',
                    html: '<div class="row">' +
                        '<form id="formSubirAnexo" action="../../controller/anexos/cria_anexos.php" method="post"enctype="multipart/form-data">' +
                        '<div class="col-md-12">' +
                        '<div class="form-group">' +
                        '<label>Arquivo(s)</label>' +
                        '<input type="file" class="form-control border-input" name="anexos[]" multiple>' +
                        '</div>' +
                        '</div>' +
                        '</form>' +
                        '</div>'
                }).then(function () {
                    $('#formSubirAnexo').trigger('submit');
                });
                break;
            case 'deletaProjeto':
                swal({
                    title: 'Deseja deletar?',
                    text: "Após a exclusão o projeto não poderá ser recuperado",
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    cancelButtonClass: 'btn btn-danger btn-fill',
                    confirmButtonClass: 'btn btn-success btn-fill',
                    confirmButtonText: 'Sim, deletar',
                    buttonsStyling: false
                }).then(function () {
                    dados = {
                        id_projeto: codDeletado
                    }
                    $.ajax({
                        url: "../../controller/projeto/deleta_projeto.php",
                        type: "POST",
                        dataType: "json",
                        async: true,
                        data: dados,
                        timeout: 15000,
                        success: function (data) {
                            if (data == 'true') {
                                $(elem).remove();
                                swal({
                                    title: 'Sucesso',
                                    text: 'O projeto foi excluído da plataforma',
                                    type: 'success',
                                    confirmButtonClass: "btn btn-success btn-fill",
                                    buttonsStyling: false
                                })
                            } else {
                                swal({
                                    title: 'Erro',
                                    text: 'O projeto não foi excluído.',
                                    type: 'error',
                                    confirmButtonClass: "btn btn-info btn-fill",
                                    buttonsStyling: false
                                })
                            }
                        },
                        error: function (x, t, m) {
                            alert('Tempo esgotado');
                            console.log(JSON.stringify(x));
                        }
                    });
                });
                break;
            case 'deletaHabilidade':
                swal({
                    title: 'Deseja mesmo deletar?',
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonClass: 'btn btn-danger btn-fill',
                    confirmButtonClass: 'btn btn-success btn-fill',
                    confirmButtonText: 'Sim, deletar',
                    cancelButtonText: 'Cancelar',
                    buttonsStyling: false
                }).then(function () {
                    dados = {
                        id_habilidade: codDeletado
                    }
                    $.ajax({
                        url: "../../controller/habilidades/deleta_habilidade.php",
                        type: "POST",
                        dataType: "json",
                        async: true,
                        data: dados,
                        timeout: 15000,
                        success: function (data) {
                            if (data == 'true') {
                                $(elem).remove();
                                swal({
                                    title: 'Sucesso',
                                    text: 'A habilidade foi excluída',
                                    type: 'success',
                                    confirmButtonClass: "btn btn-success btn-fill",
                                    buttonsStyling: false
                                })
                            } else {
                                swal({
                                    title: 'Erro',
                                    text: 'A habilidade não foi deletada.',
                                    type: 'error',
                                    confirmButtonClass: "btn btn-info btn-fill",
                                    buttonsStyling: false
                                })
                            }
                        },
                        error: function (x, t, m) {
                            alert('Tempo esgotado');
                            console.log(JSON.stringify(x));
                        }
                    });
                });
                break;
            case 'deletaTipoTarefa':
                swal({
                    title: 'Deseja mesmo deletar?',
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonClass: 'btn btn-danger btn-fill',
                    confirmButtonClass: 'btn btn-success btn-fill',
                    confirmButtonText: 'Sim, deletar',
                    cancelButtonText: 'Cancelar',
                    buttonsStyling: false
                }).then(function () {
                    dados = {
                        id_tipo: codDeletado
                    }
                    $.ajax({
                        url: "../../controller/tipo_tarefa/deleta_tipo.php",
                        type: "POST",
                        dataType: "json",
                        async: true,
                        data: dados,
                        timeout: 15000,
                        success: function (data) {
                            if (data == 'true') {
                                $(elem).remove();
                                swal({
                                    title: 'Sucesso',
                                    text: 'Tipo de conteúdo excluído',
                                    type: 'success',
                                    confirmButtonClass: "btn btn-success btn-fill",
                                    buttonsStyling: false
                                })
                            } else {
                                swal({
                                    title: 'Erro',
                                    text: 'Tipo de conteúdo não excluído.',
                                    type: 'error',
                                    confirmButtonClass: "btn btn-info btn-fill",
                                    buttonsStyling: false
                                })
                            }
                        },
                        error: function (x, t, m) {
                            alert('Tempo esgotado');
                            console.log(JSON.stringify(x));
                        }
                    });
                });
                break;
            case 'deletaIdioma':
                swal({
                    title: 'Deseja mesmo deletar?',
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonClass: 'btn btn-danger btn-fill',
                    confirmButtonClass: 'btn btn-success btn-fill',
                    confirmButtonText: 'Sim, deletar',
                    cancelButtonText: 'Cancelar',
                    buttonsStyling: false
                }).then(function () {
                    dados = {
                        id_idioma: codDeletado
                    }
                    $.ajax({
                        url: "../../controller/idiomas/deleta_idioma.php",
                        type: "POST",
                        dataType: "json",
                        async: true,
                        data: dados,
                        timeout: 15000,
                        success: function (data) {
                            if (data == 'true') {
                                $(elem).remove();
                                swal({
                                    title: 'Sucesso',
                                    text: 'Idioma excluído.',
                                    type: 'success',
                                    confirmButtonClass: "btn btn-success btn-fill",
                                    buttonsStyling: false
                                })
                            } else {
                                swal({
                                    title: 'Erro',
                                    text: 'Idioma não excluído.',
                                    type: 'error',
                                    confirmButtonClass: "btn btn-info btn-fill",
                                    buttonsStyling: false
                                })
                            }
                        },
                        error: function (x, t, m) {
                            alert('Tempo esgotado');
                            console.log(JSON.stringify(x));
                        }
                    });
                });
                break;
            case 'deletaCategoria':
                swal({
                    title: 'Deseja mesmo deletar?',
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonClass: 'btn btn-danger btn-fill',
                    confirmButtonClass: 'btn btn-success btn-fill',
                    confirmButtonText: 'Sim, deletar',
                    cancelButtonText: 'Cancelar',
                    buttonsStyling: false
                }).then(function () {
                    dados = {
                        id_categoria: codDeletado
                    }
                    $.ajax({
                        url: "../../controller/categorias/deleta_categoria.php",
                        type: "POST",
                        dataType: "json",
                        async: true,
                        data: dados,
                        timeout: 15000,
                        success: function (data) {
                            if (data == 'true') {
                                $(elem).remove();
                                swal({
                                    title: 'Sucesso',
                                    text: 'A Categoria foi excluída.',
                                    type: 'success',
                                    confirmButtonClass: "btn btn-success btn-fill",
                                    buttonsStyling: false
                                })
                            } else {
                                swal({
                                    title: 'Erro',
                                    text: 'A Categoria não foi excluída.',
                                    type: 'error',
                                    confirmButtonClass: "btn btn-info btn-fill",
                                    buttonsStyling: false
                                })
                            }
                        },
                        error: function (x, t, m) {
                            alert('Tempo esgotado');
                            console.log(JSON.stringify(x));
                        }
                    });
                });
                break;
            case 'deletaMembro':
                swal({
                    title: 'Deseja deletar?',
                    text: "Após a exclusão, esse membro não terá mais acesso ao projeto",
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonClass: 'btn btn-danger btn-fill',
                    confirmButtonClass: 'btn btn-success btn-fill',
                    confirmButtonText: 'Sim, deletar',
                    cancelButtonText: 'Cancelar',
                    buttonsStyling: false
                }).then(function () {
                    dados = {
                        id_membros: codDeletado
                    }
                    $.ajax({
                        url: "../../controller/membros_equipe/deleta_membro.php",
                        type: "POST",
                        dataType: "json",
                        async: true,
                        data: dados,
                        timeout: 15000,
                        success: function (data) {
                            if (data == 'true') {
                                $(elem).remove();
                                swal({
                                    title: 'Sucesso',
                                    text: 'Membro excluído.',
                                    type: 'success',
                                    confirmButtonClass: "btn btn-success btn-fill",
                                    buttonsStyling: false
                                })
                            } else {
                                swal({
                                    title: 'Erro',
                                    text: 'Membro não excluído.',
                                    type: 'error',
                                    confirmButtonClass: "btn btn-info btn-fill",
                                    buttonsStyling: false
                                })
                            }
                        },
                        error: function (x, t, m) {
                            alert('Tempo esgotado');
                            console.log(JSON.stringify(x));
                        }
                    });
                });
                break;
            case 'deletaPersona':
                swal({
                    title: 'Deseja deletar?',
                    text: "Após a exclusão não será possível recuperá-lo",
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonClass: 'btn btn-danger btn-fill',
                    confirmButtonClass: 'btn btn-success btn-fill',
                    confirmButtonText: 'Sim, deletar',
                    cancelButtonText: 'Cancelar',
                    buttonsStyling: false
                }).then(function () {
                    dados = {
                        id_persona: codDeletado
                    }
                    $.ajax({
                        url: "../../controller/persona/deleta_persona.php",
                        type: "POST",
                        dataType: "json",
                        async: true,
                        data: dados,
                        timeout: 15000,
                        success: function (data) {
                            if (data == 'true') {
                                $(elem).remove();
                                swal({
                                    title: 'Sucesso',
                                    text: 'Persona excluída.',
                                    type: 'success',
                                    confirmButtonClass: "btn btn-success btn-fill",
                                    buttonsStyling: false
                                })
                            } else {
                                swal({
                                    title: 'Erro',
                                    text: 'Persona não foi deletada.',
                                    type: 'error',
                                    confirmButtonClass: "btn btn-info btn-fill",
                                    buttonsStyling: false
                                })
                            }
                        },
                        error: function (x, t, m) {
                            alert('Tempo esgotado');
                            console.log(JSON.stringify(x));
                        }
                    });
                });
                break;
        }
    },

    initFormExtendedDatetimepickers: function () {

        $('.datepicker').datetimepicker({
            format: 'DD/MM/YYYY', //use this format if you want the 12hours timpiecker with AM/PM toggle
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
        });
    },

    showNotification: function (icon, cor, text) {

        $.notify({
            icon: icones[icon],
            message: text

        }, {
            type: type[cor],
            timer: 3000,
            placement: {
                from: 'top',
                align: 'right'
            }
        });
    },

    initWizard: function(){
        $(document).ready(function(){

            var $validator = $("#wizardForm").validate({
    		  rules: {
    		    email: {
                    required: true,
                    email: true,
                    minlength: 5
    		    }
    		  }
    		});

			// you can also use the nav-pills-[blue | azure | green | orange | red] for a different color of wizard
            $('#wizardCard').bootstrapWizard({
            	tabClass: 'nav nav-pills',
            	nextSelector: '.btn-next',
                previousSelector: '.btn-back',
            	onNext: function(tab, navigation, index) {
            		var $valid = $('#wizardForm').valid();

            		if(!$valid) {
            			$validator.focusInvalid();
            			return false;
            		}
            	},
                onInit : function(tab, navigation, index){

                    //check number of tabs and fill the entire row
                    var $total = navigation.find('li').length;
                    $width = 100/$total;

                    $display_width = $(document).width();

                    if($display_width < 600 && $total > 3){
                       $width = 50;
                    }

                    navigation.find('li').css('width',$width + '%');
                },
                onTabClick : function(tab, navigation, index){
                    // Disable the posibility to click on tabs
                    return false;
                },
                onTabShow: function(tab, navigation, index) {
                    var $total = navigation.find('li').length;
                    var $current = index+1;

                    var wizard = navigation.closest('.card-wizard');

                    // If it's the last tab then hide the last button and show the finish instead
                    if($current >= $total) {
                        $(wizard).find('.btn-next').hide();
                        $(wizard).find('.btn-finish').show();
                    } else if($current == 1){
                        $(wizard).find('.btn-back').hide();
                    } else {
                        $(wizard).find('.btn-back').show();
                        $(wizard).find('.btn-next').show();
                        $(wizard).find('.btn-finish').hide();
                    }
                }
            });
        });
    },
}


function onFinishWizard(){
    var $valid = $('#wizardForm').valid();
    if(!$valid) {
        $validator.focusInvalid();
    }else{
        $("#wizardForm").submit();
    }
}

$.fn.formatFormToJson = function (options) {

    options = $.extend({}, options);

    var self = this,
        json = {},
        push_counters = {},
        patterns = {
            "validate": /^[a-zA-Z][a-zA-Z0-9_]*(?:\[(?:\d*|[a-zA-Z0-9_]+)\])*$/,
            "key": /[a-zA-Z0-9_]+|(?=\[\])/g,
            "push": /^$/,
            "fixed": /^\d+$/,
            "named": /^[a-zA-Z0-9_]+$/
        };


    this.build = function (base, key, value) {
        base[key] = value;
        return base;
    };

    this.push_counter = function (key) {
        if (push_counters[key] === undefined) {
            push_counters[key] = 0;
        }
        return push_counters[key]++;
    };

    $.each($(this).serializeArray(), function () {

        // skip invalid keys
        if (!patterns.validate.test(this.name)) {
            return;
        }

        var k,
            keys = this.name.match(patterns.key),
            merge = this.value,
            reverse_key = this.name;

        while ((k = keys.pop()) !== undefined) {

            // adjust reverse_key
            reverse_key = reverse_key.replace(new RegExp("\\[" + k + "\\]$"), '');

            // push
            if (k.match(patterns.push)) {
                merge = self.build([], self.push_counter(reverse_key), merge);
            }

            // fixed
            else if (k.match(patterns.fixed)) {
                merge = self.build([], k, merge);
            }

            // named
            else if (k.match(patterns.named)) {
                merge = self.build({}, k, merge);
            }
        }

        json = $.extend(true, json, merge);
    });


    return json;
}