<table class="table table-striped">
    <thead>
        <tr>
            <th>Article</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($articles)>0):?>
            <?php foreach($articles as $index => $article):?>
                <tr>
                    <td><a href="<?=url('show',['index'=>$index])?>"><?=$article?></a></td>
                    <td>
                        <form action="<?= url('destroy')?>" method="post" class="button">
                            <input type="hidden" name="index" value="<?=$index?>">
                            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                        <form action="<?=url('edit')?>" method="post" class="button">
                            <input type="hidden" name="index" value="<?=$index?>">
                            <button class="btn btn-warning"><i class="fa fa-paste"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach;?>
        <?php endif;?>
    </tbody>
</table>
<a href="/userauth.php?action=create" class="btn btn-success"><i class="fa fa-plus"></i>Create note</a>