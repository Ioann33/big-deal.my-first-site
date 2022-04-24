<?php if (!empty($errors)):?>
    <div class="errors">
        <ul>
            <?php foreach ($errors as $error):?>
                <li><?= $error?></li>
            <?php endforeach;?>
        </ul>
    </div>
<?php endif;?>
