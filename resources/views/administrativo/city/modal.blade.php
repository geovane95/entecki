<div id="formModalCity" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-12 row">
                    <div class="col-8">
                        <h4 id="modal-city-title" class="modal-title"></h4>
                    </div>
                    <div class="col-3">
                        <button type="button" id="list_cities" class="btn btn-info btn-sm">Ver lista de Cidades</button>
                    </div>
                    <div class="col-1">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <span id="city_form_result"></span>
                @include('administrativo.city._form')
            </div>
        </div>
    </div>
</div>
