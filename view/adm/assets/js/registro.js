$("#selectTipoCandidatura").change(function (e) { 
    var seletor = '#identificador' + $(this).val();
    // Vai sumir com todos ctrl-candidatura, depois pegar o identificador e mostra-lo
    $('.ctrl-candidatura').removeClass('mostra-candidatura');
    $(seletor).addClass('mostra-candidatura');
});

function readURL(input) {

    if (input.files && input.files[0]) {
      var reader = new FileReader();
  
      reader.onload = function(e) {
        $('#previewFotoUsuario').attr('src', e.target.result);
      }
  
      reader.readAsDataURL(input.files[0]);
    }
  }
  
  $("#inputFotoUsuario").change(function() {
    readURL(this);
  });