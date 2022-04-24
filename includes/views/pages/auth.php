

<?php include_once 'includes'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'parts'.DIRECTORY_SEPARATOR.'errors.php'?>

<form method="post" action="/process.php">
    <div>Аутентификация пользователя</div>
    <label>Login:
        <input type="text" name="login" value="<?=old('login')?>">
    </label>
    <label>Password:
        <input type="password" name="pass">
    </label>
    <input type="submit" value="Log in">
</form>
