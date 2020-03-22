<div id="formModalUsersToConstruction" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="modal-clients-to-construction-title" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <span id="clients_to_construction_form_result"></span>
                @include('administrativo.user_to_construction._form')
            </div>
            <div class="modal-body">
                @include('administrativo.user_to_construction.index')
            </div>
        </div>
    </div>
</div>
