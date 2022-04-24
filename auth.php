<?php



include_once 'includes'.DIRECTORY_SEPARATOR.'bootstrap.php';

$errors = getErrors();
render('auth', ['errors'=>$errors],'formlogin');
