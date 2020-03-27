<form action="" method="post" id="construction_form" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Nome</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
        <span id="nameError" class="text-danger"></span>
    </div>
    <div class="form-group">
        <label for="company">Construtora</label>
        <input type="text" class="form-control" name="company" id="company" value="{{ old('company') }}">
        <span id="companyError" class="text-danger"></span>
    </div>
    <div class="form-group">
        <label for="thumbnail">Foto do Empreendimento</label>
        <input type="file" name="thumbnail" id="thumbnail" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="responsible">Responsável</label>
        {{Form::select('responsible',$responsible,null,['class'=>'form-control','placeholder'=>'Escolha um Responsável'])}}
    </div>
    <div class="form-group">
        <label for="regional">Regional</label>
        {{Form::select('regional',$regional,null,['class'=>'form-control','placeholder'=>'Escolha um Regional'])}}
    </div>
    <div class="form-group row">
        <div class="col-10">
            <label for="street">Logradouro</label>
            <input type="text" class="form-control" name="street" id="street" value="{{ old('street') }}">
            <span id="streetError" class="text-danger"></span>
        </div>
        <div class="col-2">
            <label for="number">Numero</label>
            <input type="text" class="form-control" name="number" id="number" value="{{ old('number') }}">
            <span id="numberError" class="text-danger"></span>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-9">
            <label for="neighborhood">Local/Região</label>
            <input type="text" class="form-control" name="neighborhood" id="neighborhood" value="{{ old('neighborhood') }}">
            <span id="neighborhoodError" class="text-danger"></span>
        </div>
        <div class="col-3">
            <label for="zipCode">CEP</label>
            <input type="text" class="form-control" name="zipCode" id="zipCode" value="{{ old('zipCode') }}" maxlength="9" minlength="8"  onkeypress='mascaraMutuarioCep(this)' onblur='clearTimeout()' >
            <span id="zipCodeError" class="text-danger"></span>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-6">
            <label for="state">Estado</label>
            {{-- {{Form::select('state',$state,null,['class'=>'form-control','placeholder'=>'Escolha um Estado','state','id'=>'state'])}} --}}
           <select class="form-control" name="state" id="state">
                @foreach ($state as $key =>  $item)
                    <option id="{{$key}}" value="{{$key}}">{{$item}}</option>
                @endforeach
           </select>
        </div>
        <div class="col-6">
            <label for="city">Cidade</label>
            {{-- {{Form::select('city',$city,null,['class'=>'form-control','placeholder'=>'Escolha uma Cidade','id'=>'city'])}} --}}
            <select name="city" id="city" class="form-control">
                <option value="">Selecione</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-6">
            <label for="contract_regime">Regime de Contrado</label>
            <input type="text" class="form-control" name="contract_regime" id="contract_regime" value="{{ old('contract_regime') }}">
            <span id="contract_regimeError" class="text-danger"></span>
        </div>
        <div class="col-6">
            <label for="reporting_regime">Regime Relatório</label>
            <input type="text" class="form-control" name="reporting_regime" id="reporting_regime" value="{{ old('reporting_regime') }}">
            <span id="reporting_regimeError" class="text-danger"></span>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-6">
            <label for="work_number">Nº Obra</label>
            <input type="text" class="form-control" name="work_number" id="work_number" value="{{ old('work_number') }}">
            <span id="work_numberError" class="text-danger"></span>
        </div>
        <div class="col-6">
            <label for="issuance_date">Data de Emissão</label>
            <input type="text" class="form-control" name="issuance_date" id="issuance_date" value="{{ old('issuance_date') }}">
            <span id="issuance_dateError" class="text-danger"></span>
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
        <input type="hidden" name="action" id="action" value="Add" />
        <input type="hidden" name="hidden_id" id="hidden_id" />
        <input type="submit" name="action_construction_button" id="action_construction_button" class="btn btn-warning" value="Add" />
    </div>
</form>
