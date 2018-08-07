var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
spOptions = {
    clearIfNotMatch: true,
    onKeyPress: function (val, e, field, options) {
        field.mask(SPMaskBehavior.apply({}, arguments), options);
    }
};

var CPFMaskBehavior = function (val) {
    return '000.000.000-00';
},
cpfOptions = {
    clearIfNotMatch: true,
    onKeyPress: function (val, e, field, options) {
        field.mask(CPFMaskBehavior.apply({}, arguments), options);
    },
    onComplete: function (cep) {
        var strValor = cep;
        var strTemp;
        strTemp = strValor.replace(".", "");
        strTemp = strTemp.replace(".", "");
        strTemp = strTemp.replace("-", "");
        if (!TestaCPF(strTemp)) {
            $('.mask-cpf').val('');
            mensagemAlerta('CPF Inválido', 'CPF: ' + strValor + ' incorreto, digite novamente');

        } else {
            $('#numContato').focus();
        }
    }
};

var optionsMaskCep = {
onComplete: function (cep) {
    buscaCep(cep);
}
};

var optionsMaskCpf = {
clearIfNotMatch: true,
reverse: true,
onComplete: function (cep) {
    var strValor = cep;
    var strTemp;
    strTemp = strValor.replace(".", "");
    strTemp = strTemp.replace(".", "");
    strTemp = strTemp.replace("-", "");
    if (!TestaCPF(strTemp)) {
        $('.mask-cpf').val('');
        mensagemAlerta('CPF Inválido', 'CPF: ' + strValor + ' incorreto, digite novamente');

    } else {
        $('#numContato').focus();
    }
}
};

var cpfCnpjOptions = {
onKeyPress: function (cep, e, field, options) {
    //console.log(cep.length);
    var masks = ['000.000.000-00', '00.000.000/0000-00'];
    var mask = (cep.length > 13) ? masks[1] : masks[0];
    $('.mask-cpf-cnpj').mask(mask, cpfCnpjOptions);
}
};

$('.mask-nascimento').mask('00/00/0000', {
clearIfNotMatch: true
});
$('.mask-cpf').mask(CPFMaskBehavior, cpfOptions);
$('.mask-cpf-cnpj').mask('000.000.000-00', cpfCnpjOptions);
$('.mask-cnpj').mask('00.000.000/0000-00');
$('.mask-real').mask('000.000.000.000.000,00', {
reverse: true
});
$('.mask-cep').mask('00000-000', optionsMaskCep);
$('.mask-telefone').mask(SPMaskBehavior, spOptions);
$(document).on('blur', '.mask-cpf-cnpj', function () {
var cep = $(this).val();
//console.log(cep.length);
if(cep.length < 14){
    $(this).val('');
}else if(cep.length > 14){
    if(!validarCNPJ(cep)){
        $(this).val('');
        mensagemAlerta('CNPJ Inválido', 'CNPJ: ' + cep + ' incorreto, digite novamente');
    } else {
        $('#numContato').focus();
    }
}else{
    var strValor = cep;
    var strTemp;
    strTemp = strValor.replace(".", "");
    strTemp = strTemp.replace(".", "");
    strTemp = strTemp.replace("-", "");
    if (!TestaCPF(strTemp)) {
        $(this).val('');
        mensagemAlerta('CPF Inválido', 'CPF: ' + strValor + ' incorreto, digite novamente');

    } else {
        $('.mask-cpf-cnpj').mask('000.000.000-00', cpfCnpjOptions);
        $('#numContato').focus();
    }
}
});

$(document).on('blur', '.mask-cnpj', function () {
    var cep = $(this).val();
    if(!validarCNPJ(cep)){
        $(this).val('');
    }
});

function validarCNPJ(cnpj) {
 
    cnpj = cnpj.replace(/[^\d]+/g,'');
 
    if(cnpj == '') return false;
     
    if (cnpj.length != 14)
        return false;
 
    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" || 
        cnpj == "11111111111111" || 
        cnpj == "22222222222222" || 
        cnpj == "33333333333333" || 
        cnpj == "44444444444444" || 
        cnpj == "55555555555555" || 
        cnpj == "66666666666666" || 
        cnpj == "77777777777777" || 
        cnpj == "88888888888888" || 
        cnpj == "99999999999999")
        return false;
         
    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;
         
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
          return false;
           
    return true;
    
}

function TestaCPF(strCPF) {
    strCPF = strCPF.replace(/[^\d]+/g,'');
    var Soma;
    var Resto;
    Soma = 0;
    if (strCPF == "00000000000" || strCPF == "11111111111" || strCPF == "22222222222" || strCPF == "333333333333" ||
        strCPF == "44444444444" || strCPF == "55555555555" || strCPF == "66666666666" || strCPF == "77777777777" ||
        strCPF == "88888888888" || strCPF == "99999999999") return false;

    for (i = 1; i <= 9; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11)) Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10))) return false;

    Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11)) Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11))) return false;
    return true;
}