<form action="" method="post" id="responsible_form" class="form-horizontal">
    @csrf
    <div class="form-group">
        <label for="company_name">Razão Social</label>
        <input type="text" class="form-control" name="company_name" id="company_name" value="{{ old('company_name') }}">
        <span id="company_nameError" class="text-danger"></span>
    </div>
    <div class="form-group">
        <label for="cnpj">CNPJ</label>
        <input type="text" class="form-control" name="cnpj" id="cnpj" value="{{ old('cnpj') }}"  onkeypress='mascaraMutuario(this)' onblur='clearTimeout()' maxlength="18" minlength="18">
        <span id="cnpjError" class="text-danger"></span>
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
        <input type="submit" name="action_responsible_button" id="action_responsible_button" class="btn btn-warning" value="Add" />
    </div>
</form>
