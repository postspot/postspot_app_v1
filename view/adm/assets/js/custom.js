var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
icones = ['','info','success','warning','danger'];
type = ['','info','success','warning','danger'];
var camposHtml = '<div class="row">';
for(i=1 ; i < 60 ; i++){
    camposHtml +=  '<div class="col-md-3">' +
                        '<div class="foto-persona-radio">' +
                            '<img src="assets/img/faces/'+i+'-avatar-postspot.png">' +
                            '<input type="radio" name="foto_persona" value="'+i+'-avatar-postspot.png">' +
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
            viewRender: function (view, element) {
                // We make sure that we activate the perfect scrollbar when the view isn't on Month
                if (view.name != 'month') {
                    $(element).find('.fc-scroller').perfectScrollbar();
                }
            },
            header: {
                left: 'title',
                center: 'month,agendaWeek,agendaDay',
                right: 'prev,next,today'
            },
            defaultDate: today,
            selectable: true,
            selectHelper: true,
            views: {
                month: {// name of view
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
            select: function (start, end) {

                // on select we show the Sweet Alert modal with an input
                swal({
                    title: 'Create an Event',
                    html: '<div class="form-group">' +
                            '<input class="form-control" placeholder="Event Title" id="input-field">' +
                            '</div>',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false
                }).then(function (result) {

                    var eventData;
                    event_title = $('#input-field').val();

                    if (event_title) {
                        eventData = {
                            title: event_title,
                            start: start,
                            end: end
                        };
                        $calendar.fullCalendar('renderEvent', eventData, true); // stick? = true
                    }

                    $calendar.fullCalendar('unselect');

                });
            },
            editable: true,
            eventLimit: true, // allow "more" link when too many events


            // color classes: [ event-blue | event-azure | event-green | event-orange | event-red ]
            events: [
                {
                    title: 'All Day Event',
                    start: new Date(y, m, 1),
                    className: 'event-default'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d - 4, 6, 0),
                    allDay: false,
                    className: 'event-rose'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d + 3, 6, 0),
                    allDay: false,
                    className: 'event-rose'
                },
                {
                    title: 'Meeting',
                    start: new Date(y, m, d - 1, 10, 30),
                    allDay: false,
                    className: 'event-green'
                },
                {
                    title: 'Lunch',
                    start: new Date(y, m, d + 7, 12, 0),
                    end: new Date(y, m, d + 7, 14, 0),
                    allDay: false,
                    className: 'event-red'
                },
                {
                    title: 'Md-pro Launch',
                    start: new Date(y, m, d - 2, 12, 0),
                    allDay: true,
                    className: 'event-azure'
                },
                {
                    title: 'Birthday Party',
                    start: new Date(y, m, d + 1, 19, 0),
                    end: new Date(y, m, d + 1, 22, 30),
                    allDay: false,
                    className: 'event-azure'
                },
                {
                    title: 'Click for Creative Tim',
                    start: new Date(y, m, 21),
                    end: new Date(y, m, 22),
                    url: 'http://www.creative-tim.com/',
                    className: 'event-orange'
                },
                {
                    title: 'Click for Google',
                    start: new Date(y, m, 21),
                    end: new Date(y, m, 22),
                    url: 'http://www.creative-tim.com/',
                    className: 'event-orange'
                }
            ]
        });
    },
    showSwal: function (modal) {
        switch (modal) {
            case 'projeto':
                swal({
                    title: 'Escolha o Projeto',
                    text: 'Escolha o projeto no qual você deseja gerenciar',
                    showConfirmButton: false,
                    html:
                            '<ul class="modal-projetos">' +
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
                }).then(function() {
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
                    html:
                            '<div class="row">' +
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
                                            '<select class="form-control border-input" name="responsavel_projeto">'+ optionResponsaveis + '</select>'+
                                        '</div>' +
                                    '</div>'+
                                '</form>' +
                            '</div>'
                }).then(function() {
                    $('#formCriaProjeto').trigger('submit');
                });
                break;
            case 'trocarSenha':
                swal({
                    title: 'Trocar Senha',
                    showConfirmButton: true,
                    confirmButtonText: 'Trocar',
                    html:
                            '<div class="row">' +
                                    '<div class="col-md-12">' +
                                         '<div class="form-group">' +
                                            '<label>Nova Senha</label>' +
                                            '<input type="text" class="form-control border-input">' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="col-md-12">' +
                                        '<label>Confirmar Nova Senha</label>' +
                                        '<div class="form-group">' +
                                            '<input type="text" class="form-control"/>' +
                                        '</div>' +
	                            '</div>'+
                                '</div>'
                }).then(function() {
                    alert('Vamos trocar a senha');
                });
                break;
            case 'tipoConteudo':
                swal({
                    title: 'Criar Tipo de Conteúdo',
                    showConfirmButton: true,
                    confirmButtonText: 'Criar',
                    html:
                            '<div class="row">' +
                                '<form id="formCriaTipoTarefa" action="../../controller/tipo_tarefa/cria_tipo.php" method="post">' +                                                        
                                    '<div class="col-md-12">' +
                                        '<div class="form-group">' +
                                            '<label>Nome</label>' +
                                            '<input type="text" class="form-control border-input" name="nome_tarefa">' +
                                        '</div>' +
                                    '</div>' +
                                '</form>'+
                            '</div>'
                }).then(function() {
                    $('#formCriaTipoTarefa').trigger('submit');
                });
                break;
            case 'habilidade':
                swal({
                    title: 'Criar Habilidade',
                    showConfirmButton: true,
                    confirmButtonText: 'Criar',
                    html:
                            '<div class="row">' +
                                '<form id="formCriaProjeto" action="../../controller/habilidades/cria_habilidade.php" method="post">' +                            
                                    '<div class="col-md-12">' +
                                         '<div class="form-group">' +
                                            '<label>Nome</label>' +
                                            '<input type="text" class="form-control border-input" name="nome_habilidade">' +
                                        '</div>' +
                                    '</div>' +
                                '</form>'+
                            '</div>'
                }).then(function() {
                    $('#formCriaProjeto').trigger('submit');
                });
                break;
            case 'idioma':
                swal({
                    title: 'Criar Idioma',
                    showConfirmButton: true,
                    confirmButtonText: 'Criar',
                    html:
                            '<div class="row">' +
                                '<form id="formCriaIdioma" action="../../controller/idiomas/cria_idioma.php" method="post">' +                            
                                    '<div class="col-md-12">' +
                                         '<div class="form-group">' +
                                            '<label>Idioma</label>' +
                                            '<input type="text" class="form-control border-input" name="nome_idioma">' +
                                        '</div>' +
                                    '</div>' +
                                '</form>'+
                            '</div>'
                }).then(function() {
                    $('#formCriaIdioma').trigger('submit');
                });
                break;
            case 'categoria':
                swal({
                    title: 'Criar Categoria',
                    showConfirmButton: true,
                    confirmButtonText: 'Criar',
                    html:
                            '<div class="row">' +
                                '<form id="formCriaCategoria" action="../../controller/categorias/cria_categoria.php" method="post">' +                            
                                    '<div class="col-md-12">' +
                                         '<div class="form-group">' +
                                            '<label>Categoria</label>' +
                                            '<input type="text" class="form-control border-input" name="nome_categoria">' +
                                        '</div>' +
                                    '</div>' +
                                '</form>'+
                            '</div>'
                }).then(function() {
                    $('#formCriaCategoria').trigger('submit');
                });
                break;
            case 'anexo':
                    swal({
                        title: 'Subir Arquivo',
                        showConfirmButton: true,
                        confirmButtonText: 'Subir',
                        html:
                                '<div class="row">' +
                                    '<form id="formSubirAnexo" action="../../controller/anexos/cria_anexos.php" method="post"enctype="multipart/form-data">' +                            
                                        '<div class="col-md-12">' +
                                             '<div class="form-group">' +
                                                '<label>Arquivo(s)</label>' +
                                                '<input type="file" class="form-control border-input" name="anexos[]" multiple>' +
                                            '</div>' +
                                        '</div>' +
                                    '</form>'+
                                '</div>'
                    }).then(function() {
                        $('#formSubirAnexo').trigger('submit');
                    });
                    break;
            case 'deletaProjeto':
                swal({
                    title: 'Deseja deletar?',
                    text: "Depois de confirmar, este projeto não poderá ser recuperado!",
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonClass: 'btn btn-danger btn-fill',
                    confirmButtonClass: 'btn btn-success btn-fill',
                    confirmButtonText: 'Sim, deletar!',
                    buttonsStyling: false
                }).then(function() {
                    dados = {id_projeto: codDeletado}
                    $.ajax({
                        url: "../../controller/projeto/deleta_projeto.php",
                        type: "POST",
                        dataType: "json",
                        async: true,
                        data: dados,
                        timeout: 15000,
                        success: function (data) {
                            if(data == 'true'){
                                $(elem).remove();
                                swal({
                                  title: 'Sucesso!',
                                  text: 'O projeto foi deletado.',
                                  type: 'success',
                                  confirmButtonClass: "btn btn-success btn-fill",
                                  buttonsStyling: false
                                  })
                            }else{
                                swal({
                                  title: 'Erro!',
                                  text: 'O projeto não foi deletado.',
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
                    title: 'Deseja deletar a habilidade?',
                    text: "Depois de confirmar a habilidade não poderá ser recuperada!",
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonClass: 'btn btn-danger btn-fill',
                    confirmButtonClass: 'btn btn-success btn-fill',
                    confirmButtonText: 'Sim, deletar!',
                    buttonsStyling: false
                }).then(function() {
                    dados = {id_habilidade: codDeletado}
                    $.ajax({
                        url: "../../controller/habilidades/deleta_habilidade.php",
                        type: "POST",
                        dataType: "json",
                        async: true,
                        data: dados,
                        timeout: 15000,
                        success: function (data) {
                            if(data == 'true'){
                                $(elem).remove();
                                swal({
                                  title: 'Sucesso!',
                                  text: 'A habilidade foi deletada.',
                                  type: 'success',
                                  confirmButtonClass: "btn btn-success btn-fill",
                                  buttonsStyling: false
                                  })
                            }else{
                                swal({
                                  title: 'Erro!',
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
                    title: 'Deseja deletar?',
                    text: "Depois de confirmar, este tipo de tarefa não poderá ser recuperado!",
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonClass: 'btn btn-danger btn-fill',
                    confirmButtonClass: 'btn btn-success btn-fill',
                    confirmButtonText: 'Sim, deletar!',
                    buttonsStyling: false
                }).then(function() {
                    dados = {id_tipo: codDeletado}
                    $.ajax({
                        url: "../../controller/tipo_tarefa/deleta_tipo.php",
                        type: "POST",
                        dataType: "json",
                        async: true,
                        data: dados,
                        timeout: 15000,
                        success: function (data) {
                            if(data == 'true'){
                                $(elem).remove();
                                swal({
                                  title: 'Sucesso!',
                                  text: 'O tipo de tarefa foi deletado.',
                                  type: 'success',
                                  confirmButtonClass: "btn btn-success btn-fill",
                                  buttonsStyling: false
                                  })
                            }else{
                                swal({
                                  title: 'Erro!',
                                  text: 'O tipo de tarefa não foi deletado.',
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
                    title: 'Deseja deletar?',
                    text: "Depois de confirmar, este idioma não poderá ser recuperado!",
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonClass: 'btn btn-danger btn-fill',
                    confirmButtonClass: 'btn btn-success btn-fill',
                    confirmButtonText: 'Sim, deletar!',
                    buttonsStyling: false
                }).then(function() {
                    dados = {id_idioma: codDeletado}
                    $.ajax({
                        url: "../../controller/idiomas/deleta_idioma.php",
                        type: "POST",
                        dataType: "json",
                        async: true,
                        data: dados,
                        timeout: 15000,
                        success: function (data) {
                            if(data == 'true'){
                                $(elem).remove();
                                swal({
                                  title: 'Sucesso!',
                                  text: 'O idioma foi deletado.',
                                  type: 'success',
                                  confirmButtonClass: "btn btn-success btn-fill",
                                  buttonsStyling: false
                                  })
                            }else{
                                swal({
                                  title: 'Erro!',
                                  text: 'O idioma não foi deletado.',
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
                    title: 'Deseja deletar?',
                    text: "Depois de confirmar, esta categoria não poderá ser recuperada!",
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonClass: 'btn btn-danger btn-fill',
                    confirmButtonClass: 'btn btn-success btn-fill',
                    confirmButtonText: 'Sim, deletar!',
                    buttonsStyling: false
                }).then(function() {
                    dados = {id_categoria: codDeletado}
                    $.ajax({
                        url: "../../controller/categorias/deleta_categoria.php",
                        type: "POST",
                        dataType: "json",
                        async: true,
                        data: dados,
                        timeout: 15000,
                        success: function (data) {
                            if(data == 'true'){
                                $(elem).remove();
                                swal({
                                  title: 'Sucesso!',
                                  text: 'A categoria foi deletada.',
                                  type: 'success',
                                  confirmButtonClass: "btn btn-success btn-fill",
                                  buttonsStyling: false
                                  })
                            }else{
                                swal({
                                  title: 'Erro!',
                                  text: 'A categoria não foi deletada.',
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
    
    initFormExtendedDatetimepickers: function(){

         $('.datepicker').datetimepicker({
            format: 'DD/MM/YYYY',    //use this format if you want the 12hours timpiecker with AM/PM toggle
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
    
    showNotification: function(icon,cor, text){
        
        $.notify({
            icon: icones[icon],
            message: text

        },{
            type: type[cor],
            timer: 3000,
            placement: {
                from: 'top',
                align: 'right'
            }
        });
    },
}
