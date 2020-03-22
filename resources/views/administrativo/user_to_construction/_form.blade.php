<form action="" method="post" id="user_form" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <input type="hidden" name="constructionId" id="constructionId" value="">
        <label for="client">Cliente</label>
        <select class="form-control" name="user" id="user">

        </select>
    </div>
    <div class="form-group" align="center">
        <input type="hidden" name="action" id="action" value="Add" />
        <input type="hidden" name="hidden_id" id="hidden_id" />
        <input type="submit" name="action_clients_to_construction_button" id="action_clients_to_construction_button" class="btn btn-warning" value="Add" />
    </div>
</form>
