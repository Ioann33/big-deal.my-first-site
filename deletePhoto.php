<?php
include_once 'includes'.DIRECTORY_SEPARATOR.'bootstrap.php';
$index = $_POST['delPhoto'];

$directoryPath = 'gallery'.DIRECTORY_SEPARATOR.'images'.$index;

function deletePhoto($directoryPath){
    $allPhoto = getPhoto($directoryPath);
    $lastElement = array_pop($allPhoto);
    $filePass = $directoryPath.DIRECTORY_SEPARATOR.$lastElement;
    unlink($filePass);
}
if (isset($_POST['deletePh'])){
    deletePhoto($directoryPath);
}
show($index);