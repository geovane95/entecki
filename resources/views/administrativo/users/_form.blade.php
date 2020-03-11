<form method="post" id="user_form" class="form">

    <div class="form-group">
        <label for="name" class="control-label col-md-4"> Nome : </label>
        <div class="col-md-12">
            <input type="text" name="name" id="name" class="form-control"/>
            <span id="nameError" class="text-danger"></span>
        </div>
    </div>

    <div class="form-group">
        <label for="company" class="control-label col-md-4"> Empresa : </label>
        <div class="col-md-12">
            <input type="text" name="company" id="company" class="form-control"/>
            <span id="companyError" class="text-danger"></span>
        </div>
    </div>

    <div class="form-group my-2">
        <div class="col-md-12">
            <label for="email" class="control-label col-md-4">Email : </label>
            <input type="email" name="email" id="email" class="form-control"/>
            <span id="emailError" class="text-danger"></span>
        </div>

        <div id="pass" class="form-group my-2">
            <div class="col-md-12">
                <label for="password" class="control-label col-md-4">Senha : </label>
                <input type="password" name="password" id="password" class="form-control"/>
                <span id="passwordError" class="text-danger"></span>
            </div>

        </div>

        <div id="select" class="form-group my-2">
            <div class="col-md-12">
                <label for="access_profile" class="control-label col-md-4">Perfil de Acesso </label>
                {{Form::select('access_profile',$access_profile,null,['class'=>'form-control','placeholder'=>'Escolha um Perfil', 'id'=>'access_profile'])}}
                <span id="access_profileError" class="text-danger"></span>
            </div>

        </div>

        <br/>
        <div class="form-group" align="center">
            <input type="hidden" name="action" id="action" value="Add"/>
            <input type="hidden" name="hidden_id" id="hidden_id"/>
            <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add"/>
        </div>
    </div>
</form>
