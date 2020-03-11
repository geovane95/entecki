<div id="formModalState" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-12 row">
                    <div class="col-8">
                        <h4 id="modal-state-title" class="modal-title"></h4>
                    </div>
                    <div class="col-3">
                        <button type="button" id="list_states" class="btn btn-info btn-sm">Ver lista de Estados</button>
                    </div>
                    <div class="col-1">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <span id="state_form_result"></span>
                @include('administrativo.state._form')
            </div>
        </div>
    </div>
</div>
