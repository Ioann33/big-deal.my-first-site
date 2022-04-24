<h2><?=$article?></h2>
<div class="showContent">
    <?php if (!empty($files)):?>
        <div class="grille">
            <?php foreach ($files as $file):?>
                <div class="elements"><img src="/gallery/images<?=$index?>/<?=$file?>" alt="error"></div>
            <?php endforeach;?>
        </div>
    <?php endif;?>
<div class="textE">
    <?php if (!empty($articleText)):?>
        <?php foreach ($articleText as $value):?>
            <pre><?=$value?></pre>
        <?php endforeach;?>
    <?php endif;?>
</div>
