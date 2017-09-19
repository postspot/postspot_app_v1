var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!

var yyyy = today.getFullYear();
if(dd<10){
    dd='0'+dd;
} 
if(mm<10){
    mm='0'+mm;
} 
var today = dd+'/'+mm+'/'+yyyy;

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
                    html:
                            '<div class="row">' +
                                    '<div class="col-md-3">' +
                                         '<div class="foto-persona-radio">' +
                                            '<img src="assets/img/faces/face-0.jpg">' +
                                            '<input type="radio" name="foto_persona" value="face-0.jpg">' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="col-md-3">' +
                                         '<div class="foto-persona-radio">' +
                                            '<img src="assets/img/faces/face-1.jpg">' +
                                            '<input type="radio" name="foto_persona" value="face-1.jpg">' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="col-md-3">' +
                                         '<div class="foto-persona-radio">' +
                                            '<img src="assets/img/faces/face-2.jpg">' +
                                            '<input type="radio" name="foto_persona" value="face-2.jpg">' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="col-md-3">' +
                                         '<div class="foto-persona-radio">' +
                                            '<img src="assets/img/faces/face-3.jpg">' +
                                            '<input type="radio" name="foto_persona" value="face-3.jpg">' +
                                        '</div>' +
                                    '</div>' +
                                '</div>'
                }).then(function() {
                    var fotoPersona = 'assets/img/faces/' + ($('input[name=foto_persona]:checked').val());
                  $('#fotoPersona').attr('src', fotoPersona);
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
                                            '<input type="text" class="form-control border-input" name="nomeProduto">' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="col-md-12">' +
                                        '<label>Data de Criação</label>' +
                                        '<div class="form-group">' +
                                            '<input type="text" class="form-control datepicker" value="'+today+'" name="daraCriacao"/>' +
                                        '</div>' +
                                    '</div>'+
                                '</form>' +
                            '</div>'
                }).then(function() {
                    $('#formCriaProjeto').trigger('submit');
                    /*var nomeProduto = $('$nomeProduto').val();
                    var daraCriacao = $('$daraCriacao').val();
                    var dados = {nome_usuario: nome, email_usuario: email};
                    $.ajax({
                        url: "http://www.melhorcomprabrasil.com/controller//cadastro_usuario.php",
                        type: "POST",
                        dataType: "json",
                        data: dados,
                        async: true,
                        timeout: 15000,
                        success: function (data) {
                            mainView.router.load({pageName: 'index'});
                            limpaCamposCadastro();
                            if (data == 'true') {
                                mensagemAlerta('Sucesso!','Verifique sua caixa de email (spam e outros filtros de email) para confirmar seu cadastro.');
                            }
                        },
                        error: function (x, t, m) {
                            mensagemErro(t, x.responseText);
                        }
                    });*/
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
                                    '<div class="col-md-12">' +
                                         '<div class="form-group">' +
                                            '<label>Nome</label>' +
                                            '<input type="text" class="form-control border-input">' +
                                        '</div>' +
                                    '</div>' +
                                '</div>'
                }).then(function() {
                    alert('Vamos Criar');
                });
                break;
            case 'habilidades':
                swal({
                    title: 'Criar Habilidade',
                    showConfirmButton: true,
                    confirmButtonText: 'criar',
                    html:
                            '<div class="row">' +
                                    '<div class="col-md-12">' +
                                         '<div class="form-group">' +
                                            '<label>Nome</label>' +
                                            '<input type="text" class="form-control border-input">' +
                                        '</div>' +
                                    '</div>' +
                                '</div>'
                }).then(function() {
                    alert('Vamos trocar a senha');
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
}
