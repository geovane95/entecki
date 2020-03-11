<div id="formModalResponsible" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-12 row">
                    <div class="col-8">
                        <h4 id="modal-responsible-title" class="modal-title"></h4>
                    </div>
                    <div class="col-3">
                        <button type="button" id="list_responsibles" class="btn btn-info btn-sm">Ver lista de Responsáveis</button>
                    </div>
                    <div class="col-1">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <span id="responsible_form_result"></span>
                @include('administrativo.responsible._form')
            </div>
        </div>
    </div>
</div>
