<form action="<?=url('update')?>" method="post">

    <label>Edit article label:
        <input type="text" name="edit" value="<?=$article?>">
        <input type="hidden" name="previous" value="<?=$article?>">
    </label>
    <input type="submit" value="Update">
</form>
