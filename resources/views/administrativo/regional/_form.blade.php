<form action="" method="post" id="regional_form" class="form-horizontal">
    @csrf
    <div class="form-group">
        <label for="name">Nome</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
        <span id="regionalNameError" class="text-danger"></span>
    </div>
    <div class="form-group">
        <label for="status">Status</label><br/>
        <div class="form-check-inline">
            <input class="form-check-input" type="radio" name="status" id="statusativo" value="1" checked>
            <label class="form-check-label" for="statusativo">
                Ativo
            </label>
        </div>
        <div class="form-check-inline">
            <input class="form-check-input" type="radio" name="status" id="statusinativo" value="0">
            <label class="form-check-label" for="statusinativo">
                Inativo
            </label>
        </div>
    </div>

    <div class="form-group" align="center">
        <input type="hidden" name="action" id="action" value="Add" />
        <input type="hidden" name="hidden_id" id="hidden_id" />
        <input type="submit" name="action_regional_button" id="action_regional_button" class="btn btn-warning" value="Add" />
    </div>
</form>
