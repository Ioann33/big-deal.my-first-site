<h2><?=$article?></h2>
<div class="showContent">
<?php if (!empty($files)):?>
    <div class="grille">
        <?php foreach ($files as $file):?>
            <div class="elements"><img src="/gallery/images<?=$index?>/<?=$file?>" alt="error"></div>
        <?php endforeach;?>
    </div>
<?php endif;?>
    <?php if (!empty($articleText)):?>
        <div class="text">
                <div>
                    <?php foreach ($articleText as $value):?>
                        <pre><?=$value?></pre>
                    <?php endforeach;?>
                </div>
                <form action="/addArticle.php" method="post" class="deleteButton">
                    <input type="hidden" name="delete" value="true">
                    <input type="hidden" name="numberArticle" value="<?=$index?>">
                    <input type="submit" value="delete">
                </form>
        </div>
    <?php endif;?>
<form method="post" action="/addArticle.php" class="createText">
    <label>Article Text:
        <textarea name="text"></textarea>
    </label>
    <input type="hidden" name="numberArticle" value="<?=$index?>">
    <div><input type="submit" value="create article"></div>

</form>
    <div class="photoExpiration">

        <form action="/upload.php" method="post" enctype="multipart/form-data" class="uploadPhoto">
            <label>Добавить фото</label>
            <label>Photo:
                <input type="file" name="photo" accept="image/*">
            </label>
            <input type="hidden" name="num" value="<?=$index?>">
            <div>
                <input type="submit" value="upload">
            </div>
        </form>
        <?php if (!empty($files)):?>
            <form action="/deletePhoto.php" method="post" class="deletePhoto">
                <label>Удалить фото</label>
                <input type="hidden" name="deletePh" value="true">
                <input type="hidden" name="delPhoto" value="<?=$index?>">
                <input type="submit" value="delete">
            </form>
        <?php endif;?>
    </div>
</div>
























