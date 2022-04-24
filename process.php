<?php


include_once 'includes'. DIRECTORY_SEPARATOR. 'bootstrap.php';

$user = getUserFromRequest();
$login = $user['login'];
$userAuth = getUserByLogin($login);
$userName = $userAuth['name'];

if (!$user){
    $errors = ['No user data in request'];
}else{
    $errors = validateUser($user);
}

if (count($errors) == 0){
    if (!authUser($user)){
        $errors = ['invalid login or password'];
    }else{
        $message = $userName;
    }
}

if (count($errors)>0){
    session_start();
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $_POST;
    header('Location: /auth.php');
}else{
    session_start();
    $_SESSION['message'] = $message;
    header('Location: /userauth.php');
}
