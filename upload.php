<?php
include_once 'includes'.DIRECTORY_SEPARATOR.'bootstrap.php';
$index = $_POST['num'];

$photo = $_FILES['photo'];

//TODO photo validation
$directoryPath = 'gallery'.DIRECTORY_SEPARATOR.'images'.$index;
if (!is_dir($directoryPath)){
    mkdir($directoryPath);
}
$filePath = $directoryPath.DIRECTORY_SEPARATOR.$photo['name'];
//TODO photo validation
move_uploaded_file($photo['tmp_name'], $filePath);
show($index);
