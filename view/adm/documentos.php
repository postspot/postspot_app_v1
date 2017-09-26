<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once 'includes/header_padrao.php';
?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php'; ?>
        <title>Post Stadium</title>
        <?php require_once './includes/header_imports.php'; ?>
    </head>

    <body>
        <div class="wrapper">

            <!--Side Bar-->
            <?php require_once './includes/side_bar.php'; ?>

            <div class="main-panel">

                <!--Menu Topo-->
                <?php require_once './includes/menu_topo.php'; ?>

                <div class="content">
                    <div class="container-fluid">
                        <h4 class="title"><i class="ti-files"></i> Documentos</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-content">
                                        <table id="bootstrap-table" class="table">
                                            <thead>
                                            <th data-sortable="true">Nome Documento</th>
                                            <th data-sortable="true">Referência</th>
                                            <th data-sortable="true">Responsável</th>
                                            <th></th>
                                            </thead>
                                            <tbody>

                                                <?php for ($i = 0; $i < 9; $i++): ?>
                                                    <tr>
                                                        <td>Mapa de conteúdo</td>
                                                        <td><strong>Agosto de 2017</strong><br>Criado 11/10/2016 às 16:18</td>
                                                        <td>São benedito</td>
                                                        <td class="td-actions">
                                                            <a href="#" rel="tooltip" title="Abrir" class="btn btn-info btn-simple btn-xs">
                                                                <i class="ti-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endfor; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!--  end card  -->
                            </div> <!-- end col-md-12 -->
                        </div>
                    </div>
                </div>
                <a href="#" class="btn btn-icon btn-fixed" onclick="funcoes.showSwal('anexo')">
                    <i class="ti-plus"></i>
                </a>
            </div>
        </div>
    </body>

    <?php require_once './includes/footer_imports.php'; ?>
    <script type="text/javascript">

        var $table = $('#bootstrap-table');

        function operateFormatter(value, row, index) {
            return [
                '<div class="table-icons">',
                '<a rel="tooltip" title="View" class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">',
                '<i class="ti-image"></i>',
                '</a>',
                '<a rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon table-action edit" href="javascript:void(0)">',
                '<i class="ti-pencil-alt"></i>',
                '</a>',
                '<a rel="tooltip" title="Remove" class="btn btn-simple btn-danger btn-icon table-action remove" href="javascript:void(0)">',
                '<i class="ti-close"></i>',
                '</a>',
                '</div>',
            ].join('');
        }

        $().ready(function () {

            $table.bootstrapTable({
                toolbar: ".toolbar",
                clickToSelect: true,
                showRefresh: false,
                search: true,
                showToggle: false,
                showColumns: false,
                pagination: true,
                searchAlign: 'left',
                pageSize: 8,
                clickToSelect: false,
                        pageList: [8, 10, 25, 50, 100],
                formatShowingRows: function (pageFrom, pageTo, totalRows) {
                    //do nothing here, we don't want to show the text "showing x of y from..."
                },
                formatRecordsPerPage: function (pageNumber) {
                    return pageNumber + " rows visible";
                },
                icons: {
                    refresh: 'fa fa-refresh',
                    toggle: 'fa fa-th-list',
                    columns: 'fa fa-columns',
                    detailOpen: 'fa fa-plus-circle',
                    detailClose: 'ti-close'
                }
            });

            //activate the tooltips after the data table is initialized
            $('[rel="tooltip"]').tooltip();

            $(window).resize(function () {
                $table.bootstrapTable('resetView');
            });
        });

    </script>
</html>