<?php

// Session
session_start();

// Config
define('BASE_PATH', __DIR__);
define('CURRENT_DOMAIN', currentDomain() . '/php-news');
define('DISPLAY_ERROR', true);
define('DB_HOST', 'localhost');
define('DB_NAME', 'php_news');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');


require_once 'database/DataBase.php';
require_once 'activities/Admin/Category.php';




// Helpers
// Routing System //////////////////////////////////////////////////////////////
function uri($reservedUrl, $class, $method, $requestMethod='GET')
{
    // Current Url Array
    $currentUrl = explode('?', currentUrl())[0];
    $currentUrl = str_replace(CURRENT_DOMAIN, '', $currentUrl);
    $currentUrl = trim($currentUrl, '/');
    $currentUrlArray = explode('/', $currentUrl);
    $currentUrlArray = array_filter($currentUrlArray); // Resolve empty space

    // Reserved Url Array
    $reservedUrl = trim($reservedUrl, '/');
    $reservedUrlArray = explode('/', $reservedUrl);
    $reservedUrlArray = array_filter($reservedUrlArray); // Resolve empty space

    if(sizeof($currentUrlArray) != sizeof($reservedUrlArray) || methodField() != $requestMethod){
        return false;
    }

    $parameters = [];

    for ($key = 0; $key<sizeof($currentUrlArray); $key++){
        if($reservedUrlArray[$key][0] == "{" && $reservedUrlArray[$key][sizeof($reservedUrlArray[$key])-1] == "}"){
            array_push($parameters, $reservedUrlArray[$key]);
        }
        elseif ($reservedUrlArray[$key] !== $currentUrlArray[$key]){
            return  false;
        }
    }

    if(methodField() == 'POST'){
        $request = isset($_FILES) ? array_merge($_POST, $_FILES) : $_POST;
        $parameters = array_merge([$request], $parameters);
    }

    $object = new $class;
    call_user_func_array(array($object, $method), $parameters);
    exit();
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Protocol
function protocol(){
    return (stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://');
}

// Current Domain
function currentDomain()
{
    return protocol() . $_SERVER['HTTP_HOST'];
}

// Assets
function assets($src)
{
    return trim(CURRENT_DOMAIN, '/ ') . '/' . trim($src, '/ ');
}

// Url
function url($url)
{
    return trim(CURRENT_DOMAIN, '/ ') . '/' . trim($url, '/ ');
}

// Current Url
function currentUrl()
{
    return currentDomain() . $_SERVER['REQUEST_URI'];
}

// Type Of Methods
function methodField()
{
    return $_SERVER['REQUEST_METHOD'];
}

// Show Error
function displayError()
{
    if (DISPLAY_ERROR ){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

    }else{
        ini_set('display_errors', 0);
        ini_set('display_startup_errors', 0);
        error_reporting(E_ALL);
    }
}

// Flash Message Error
global $flashMessage;
if (isset($_SESSION['flash_message'])) {
    $flashMessage = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
}

// Get and set flash message
function flash($name, $value = null)
{
    if($value === null){
        global $flashMessage;
        $message = isset($flashMessage[$name]) ? $flashMessage[$name] : '';
        return $message;
    }
    else{
        $_SESSION['flash_message'][$name] = $value;
    }
}

// Dump & Die
function dd($var)
{
    echo '<pre>';
    var_dump($var);
    exit();
}


// Category
uri('admin/category', 'Admin\Category', 'index');
uri('admin/category/create', 'Admin\Category', 'create');
uri('admin/category/store', 'Admin\Category', 'store', 'POST');
uri('admin/category/edit/{id}', 'Admin\Category', 'edit');
uri('admin/category/update/{id}', 'Admin\Category', 'update', 'POST');
uri('admin/category/delete/{id}', 'Admin\Category', 'delete');


echo '404';

























