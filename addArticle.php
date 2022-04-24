<?php
include_once 'includes'.DIRECTORY_SEPARATOR.'bootstrap.php';


$index = $_POST['numberArticle'];

$filePass = 'store'.DIRECTORY_SEPARATOR.'article'.$index.'.json';
$directoryPath = 'gallery'.DIRECTORY_SEPARATOR.'images'.$index;

if (!empty($_POST['text'])){
    $text = $_POST['text'];
    createNote($text, $filePass);
}

function createNote($note,$filePass){
    $notes = getNotes($filePass);
    $notes[] = $note;
    saveNotes($notes, $filePass);
}

function getNotes($filePass){
    if (file_exists($filePass)){
        $notesJSON = file_get_contents($filePass);
        if (!empty($notesJSON)){
            $notes = json_decode($notesJSON, true);
            if ($notes){
                return $notes;
            }
        }
    }
    return[];
}

function saveNotes($notes, $filePass){
    $notesJSON = json_encode($notes);
    file_put_contents($filePass, $notesJSON);
}


function deleteNotes($filePass){
    $notes = [];
    saveNotes($notes, $filePass);
}


if (isset($_POST['delete'])){
    deleteNotes($filePass);

}
$text = getNotes($filePass);
show($index, $text);

