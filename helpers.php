<?php

    function config()
    {
        $config = include("env.php");
        return $config;
    }

    $config = config();

    function database()
    {
        global $config;
        $database = include("config/" . $config['APP_MODE'] . "/db.php");
        return $database;
    }

    $database = database();

    function env($string)
    {
        global $config;
        return $config[$string];
    }

    function db($string)
    {
        global $database;
        return $database[$string];
    }

    function asset($string)
    {
        global $config;
        $string = $config['APP_PATH']."public/" . $string;
        return $string;
    }

    function url($string = "")
    {
        global $config;
        if(!empty($string))
        {
            $url = $config['APP_PATH']."/".$string;
        }
        else {
            $url = $config['APP_PATH'];
        }

        return $url;
    }