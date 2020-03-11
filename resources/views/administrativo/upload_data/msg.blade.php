@if(session('success'))
    <div class="alert-default-success">
        <p class="text-center">{{session('success')}}</p>
    </div>

@endif

@if(session('errors'))
    <div class="alert-default-danger">
        <p class="text-center">{{session('errors')}}</p>
    </div>

@endif
