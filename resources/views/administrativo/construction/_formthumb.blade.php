<form action="" method="post" id="construction_thumbnail_form" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="thumbnail">Foto do Empreendimento</label>
        <input type="file" name="thumbnail" id="thumbnail" class="form-control"/>
    </div>
    <div class="form-group" align="center">
        <input type="hidden" name="action" id="action" value="Add" />
        <input type="submit" name="action_constructionthumbnail_button" id="action_constructionthumbnail_button" class="btn btn-warning" value="Add" />
    </div>
</form>
