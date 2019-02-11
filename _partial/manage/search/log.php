<div class='form-group form-group-sm'>
    <label class='control-label col-md-1'>IP</label>
    <div class='col-md-2'>
        <input class='form-control' name='ip'>
    </div>
    <label class='control-label col-md-1'>User</label>
    <div class='col-md-2'>
        <input class='form-control' name='user'>
    </div>
    <label class='control-label col-md-1'>Action</label>
    <div class='col-md-2'>
        <select class='form-control' name='action'>
            <option value=''>不限</option>
            <option value='1'>Create</option>
            <option value='2'>Read</option>
            <option value='3'>Update</option>
            <option value='4'>Delete</option>
        </select>
    </div>
    <label class='control-label col-md-1'>Table</label>
    <div class='col-md-2'>
        <select class='form-control' name='table_name'>
            <option value=''>不限</option>
            <?php foreach ($enum['table'] as $key => $value) : ?>
                <option value='<?=$key?>'><?=$value?></option>
            <?php endforeach ?>
        </select>
    </div>
</div>
<div class='form-group form-group-sm text-right'>
    <div class='col-md-12'>
        <button class='btn btn-sm btn-default'>搜尋</button>
    </div>
</div>