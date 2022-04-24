<table class="table table-striped">
    <thead>
        <tr>
            <th>Article</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($articles)>0):?>
            <?php foreach($articles as $index => $article):?>
                <tr>
                    <td><a href="<?=url('showNotAuth',['index'=>$index])?>"><?=$article?></a></td>
                </tr>
            <?php endforeach;?>
        <?php endif;?>
    </tbody>
</table>
