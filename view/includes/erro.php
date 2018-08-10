<?php if (isset($_GET['retorno']) && $_GET['retorno'] == 'erro') { ?>
    <div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <b>Erro!</b> Não foi possível proceder com sua solicitação.
    </div>
<?php }else if (isset($_GET['retorno']) && ($_GET['retorno'] == 'empty' || $_GET['retorno'] == 'unset')) { ?>
    <div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <b>Erro!</b> Campo obrigatório não informado.
    </div>
<?php }else if (isset($_GET['erro']) && ($_GET['erro'] == 'sessao')) { ?>
    <div class="alert alert-danger alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <p class="mb-0"><b>Ops!</b> Sessão inválida.</p>
    </div>
<?php }else if (isset($_GET['retorno']) && ($_GET['retorno'] == 'Dok' || $_GET['retorno'] == 'unset')) { ?>
    <div class="alert alert-success alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <p class="mb-0"><b>Sucesso!</b> Registro removido.</p>
    </div>
<?php }else if (isset($_GET['retorno']) && ($_GET['retorno'] == 'exi')) { ?>
    <div class="alert alert-warning alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <p class="mb-0"><p class="mb-0"><b>Ops!</b> Este e-mail ja está em uso.</p>
    </div>
<?php }else if (isset($_GET['retorno']) && ($_GET['retorno'] == 'cadInc')) { ?>
    <div class="alert alert-warning alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <p class="mb-0"><p class="mb-0"><b>Ops!</b> Inscrição em andamento, aguarde que entraremos em contato.</p>
    </div>
<?php } ?>