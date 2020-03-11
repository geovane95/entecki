<form action="" method="post" id="client_form" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    @php
        $users = \DB::table('users')->where('access_profile',2)->pluck('name','id');
    @endphp
    <div class="form-group">
        <input type="hidden" name="constructionId" id="constructionId" value="">
        <label for="client">Cliente</label>
        <select class="form-control" name="client" id="clientS">
            @foreach ($users as $key => $item)
        <option id="{{$key}}" value="{{$key}}">{{$item}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group" align="center">
        <input type="hidden" name="action" id="action" value="Add" />
        <input type="hidden" name="hidden_id" id="hidden_id" />
        <input type="submit" name="action_clients_to_construction_button" id="action_clients_to_construction_button" class="btn btn-warning" value="Add" />
    </div>
</form>
