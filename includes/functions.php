<?php


/**
 * get data about user from request form
 * @return array|null
 */
function getUserFromRequest(){
    $login = $_POST['login'] ?? null;
    $pass = $_POST['pass'] ?? null;

    if (empty($login) && empty($pass)){
        return null;
    }
    return [
        'login' => strtolower(trim($login)),
        'pass' => $pass,
    ];
}

/**
 * check user on validation
 * @param $user
 * @return array
 */
function validateUser($user){
    $errors = [];
    if ($user['login']===''){
        $errors[] = 'login mast not be empty';
    }
    if ($user['pass']===''){
        $errors[] = 'pass mast not be empty';
    }
    return $errors;
}

/**
 * get users from storage
 * @return string[][]
 */
function getUsers(){

    return DEFAULT_USERS;
}

/**
 * search user by login in storage array
 * @param $login
 * @return boolean
 */
function getUserByLogin($login){
    $users = getUsers();
    $filteredUser = array_filter($users, function ($user) use ($login){
        return $user['login']===$login;
    });
    $filteredUser = array_values($filteredUser);
    if (count($filteredUser)>0){
        return $filteredUser[0];
    }else{
        return null;
    }
}



/**
 * check input user on the match with default user
 * @param $user // input user
 * @return boolean
 */
function authUser($user){
    $userFromStorage = getUserByLogin($user['login']);
    if (!$userFromStorage){
        return false;
    }else{
        $passHash = md5($user['pass']);
        if ($passHash === $userFromStorage['pass']){
            return true;
        }else{
            return false;
        }
    }
}

function getErrors(){
    session_start();
    $errors = [];
    if (!empty($_SESSION['errors'])){
        $errors = $_SESSION['errors'];
        unset($_SESSION['errors']);
    }
    return $errors;
}

function getUserName(){
    session_start();
    $userName = '';
    if (!empty($_SESSION['message'])){
        $userName = $_SESSION['message'];
    }
    return $userName;
}

/**
 * get data from session and delete this session
 * @param $key
 * @return mixed|string
 */
function old($key){
    session_start();
    static $old;
    if (!empty($_SESSION['old'])){
        $old = $_SESSION['old'];
        unset($_SESSION['old']);
    }
    if (isset($old[$key])){
        return $old[$key];
    }else{
        return '';
    }
}

/**
 *displays the interface
 * @param $page
 * @param array $params
 * @param string $template
 */
function render($page,$params=[], $template = 'default')
{
    extract($params);
    include_once 'includes' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $template . '.php';
}

//=========================Action whit article

/**
 * Add new article to the articles storage
 * @param string $article
 */
function createArticle(string $article){
    $articles = getArticles();
    $articles[] = $article;
    saveArticles($articles);
}

/**
 * Read json from file and convert to array
 * @return array|mixed
 */
function getArticles($path = STORAGE_FILE){
    if (file_exists($path)){
        $articlesJSON = file_get_contents($path);
        if (!empty($articlesJSON)){
            $articles = json_decode($articlesJSON, true);
            if ($articles){
                return $articles;
            }
        }
    }
    return [];
}

/**
 * search and return photo in point directory
 * @param $dir
 * @return array
 */
function getPhoto($dir){
    $displayPhoto = [];
        $files = scandir($dir);
        foreach ($files as $file){
            $mime = mime_content_type($dir.DIRECTORY_SEPARATOR.$file);
            if ($mime == 'image/jpeg'){
                $displayPhoto[]=$file;
            }
        }
    return$displayPhoto;
}

/**
 * convert array to json and write to the file
 * @param array $articles
 * @return bool
 */
function saveArticles(array $articles){
    $articlesJSON = json_encode($articles);
    return (bool) file_put_contents(STORAGE_FILE, $articlesJSON);
}

/**
 * Find article name by index in storage
 * @param int $index
 * @return mixed|null
 */
function getArticleByIndex(int $index){
    $articles = getArticles();
    if(isset($articles[$index])){
        return $articles[$index];
    }
    return null;
}

/**
 * Update article name in storage
 * @param array $params
 * @return bool
 */
function updateArticle(array $params){
    extract($params);
    if (!isset($index)||!isset($article)){
        return false;
    }
    $articles = getArticles();
    $articles[$index] = $article;
    return saveArticles($articles);
}

/**
 * this function get all articles text from storage
 * @param string $dir
 * @return array
 */
function getFiles(string $dir){
    $filesJSON = [];
    $files = scandir($dir);
    foreach ($files as $file){
        $mime = mime_content_type("store/$file");
        if ($mime === 'application/json'){
            $filesJSON[] = $file;
        }
    }

    return $filesJSON;
}

/**
 * reindex file system
 * @param $allDirectory
 */
function reIndex($allDirectory){
    $count = 0;
    foreach ($allDirectory as $directory){
        $finishPass = 'gallery'.DIRECTORY_SEPARATOR.'images'.$count;
        $startPass = 'gallery'.DIRECTORY_SEPARATOR.$directory;
        rename($startPass,$finishPass);
        $count++;
    }
}
/**
 * Delete name article by index from storage
 * @param int $index
 */
function deleteArticle(int $index){
    $articles = getArticles();
    unset($articles[$index]);

    $filePass = 'store'.DIRECTORY_SEPARATOR.'article'.$index.'.json';
    unlink($filePass);
    $allFiles = getFiles('store');
    if (count($allFiles)>0){
        $count = 0;
        foreach ($allFiles as $file){
            $finishPass = 'store'.DIRECTORY_SEPARATOR.'article'.$count.'.json';
            $startPass = 'store'.DIRECTORY_SEPARATOR.$file;
            rename($startPass,$finishPass);
            $count++;
        }
    }

    $directoryPath = 'gallery'.DIRECTORY_SEPARATOR.'images'.$index;
    $photos = getPhoto($directoryPath);
    foreach ($photos as $photo){
        $fileFullPath = $directoryPath.DIRECTORY_SEPARATOR.$photo;
        unlink($fileFullPath);
    }
    rmdir($directoryPath);
    $allDirectory = scandir('gallery');

    for ($i=0;$i<=1;$i++){
        array_shift($allDirectory);
    }

    if (count($allDirectory)>0){
        reIndex($allDirectory);
    }

    $articles = array_values($articles);
    saveArticles($articles);


}

/**
 * this function check receive params about action and called relevant function
 */
function init(){
    if (isset($_GET['action'])){
        $action = $_GET['action'];
    }else{
        $action = 'userauth';
    }

    if (function_exists($action)){
        $action();
    }else{
        pageNotFound();
    }
}

function redirect(string $action){
    header('Location: '. url($action));
    exit();
}

/**
 * this function make url address for each action
 * @param string $action
 * @param array $params
 * @return string
 */
function url(string $action, array $params = []){
    $paramsString = '';
    if (count($params)>0){
        foreach ($params as $key => $value){
            $paramsString.= "&$key=$value";
        }
    }
    return '/userauth.php?action='.$action. $paramsString;
}

function pageNotFound(){
    http_response_code(404);
    render('not_found', [], 'formtmp');
}

//ACTIONS============================================
/**
 * show all articles names
 */
function index(){
    $articles = getArticles();
    render('index', ['articles'=>$articles]);
}

function userAuth(){
    $articles = getArticles();
    $userName = getUserName();
    render('userauth', ['articles'=>$articles, 'userName'=>$userName],'userauth');
}

/**
 * called crete form
 */
function create(){
    render('create', [], 'formtmp');
}

/**
 * create and save article name
 */
function store(){
    $article = $_POST['article'];
    //TODO validation
    createArticle($article);
    redirect('userauth');
}

/**
 * show one article for auth user
 */
function show($index = null, $text = []){
    if (isset($_GET['index'])){
        $index = $_GET['index'];
    }
    $dir = 'gallery'.DIRECTORY_SEPARATOR.'images'.$index;

    if (!is_dir($dir)){
        mkdir($dir);
    }
    $displayPhoto = getPhoto($dir);
    if ($text === []){
        $filePass = 'store'.DIRECTORY_SEPARATOR.'article'.$index.'.json';
        $text = getArticles($filePass);
    }

    $article = getArticleByIndex($index);
        if ($article === null){
            pageNotFound();
        }
    render('show', ['article'=>$article,'articleText'=>$text,'index'=>$index, 'files'=>$displayPhoto],'formtmp');
}

/**
 * show one article for not auth user
 */
function showNotAuth(){
    $index = $_GET['index'];
    $dir = 'gallery'.DIRECTORY_SEPARATOR.'images'.$index;
    if (!is_dir($dir)){
        mkdir($dir);
    }
    $displayPhoto = getPhoto($dir);
    $filePass = 'store'.DIRECTORY_SEPARATOR.'article'.$index.'.json';
    $text = getArticles($filePass);
    $article = getArticleByIndex($index);
    if ($article === null){
        pageNotFound();
    }
    render('showNotAuth', ['article'=>$article,'articleText'=>$text, 'files'=>$displayPhoto,'index'=>$index],'formlogin');
}

/**
 * show edit form with current value of article name
 */
function edit(){
    $index = $_POST['index'];
    $article = getArticleByIndex($index);
    render('edit', ['article'=>$article], 'formtmp');
}

/**
 * processing edit form
 */
function update(){
    $articles = getArticles();
    $value = $_POST['previous'];
    $change = $_POST['edit'];
    foreach ($articles as $key => $article){
        if ($article === $value){
            $articles[$key] = $change;
        }
    }
    saveArticles($articles);
    redirect('userauth');
}

/**
 * delete Article label by index
 */
function destroy(){
    $index = $_POST['index'];
    //TODO validate exist this index

    deleteArticle($index);
    redirect('userauth');
}

/**
 * show convertor page
 */
function convert(){
    render('convert',[],'convertTmp');
}






