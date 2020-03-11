<form action="" method="post" id="competence_form" class="form-horizontal">
    @csrf
    <div class="form-group row">
        <div class="col-md-6">
            <label for="month">Mês</label>
            <select class="form-control" name="month" id="month">
                <option value="1">Janeiro</option>
                <option value="2">Fevereiro</option>
                <option value="3">Março</option>
                <option value="4">Abril</option>
                <option value="5">Maio</option>
                <option value="6">Junho</option>
                <option value="7">Julho</option>
                <option value="8">Agosto</option>
                <option value="9">Setembro</option>
                <option value="10">Outubro</option>
                <option value="11">Novembro</option>
                <option value="12">Dezembro</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="year">Ano</label>
            <input type="number" name="year" id="year" step="1" min="1900" max="2100" class="form-control">
        </div>
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
        <input type="hidden" name="action_competence" id="action_competence" value="Add"/>
        <input type="hidden" name="hidden_id_competence" id="hidden_id_competence"/>
        <input type="submit" name="action_competence_button" id="action_competence_button" class="btn btn-warning"
               value="Add"/>
    </div>
</form>
