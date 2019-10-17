<?php
    require '../vendor/autoload.php';
    require "../helpers.php";

    $router = new AltoRouter();

    $path = env("APP_PATH");

    $router->setBasePath($path);

    include("../web.php");

    $match = $router->match();

    list( $controller, $action ) = explode( '@', $match['target'] );

    if(is_callable(array($controller, $action)) ) {
        $obj = new $controller();
        echo call_user_func_array(array($obj, $action), array($match['params']));
    }
    elseif($match['target']=='')
    {
        echo 'Error: no route was matched'; 
    }
    else {
        header("HTTP/1.0 404 Not Found");
        require '../views/errors/404.html';
    }
