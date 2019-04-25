<?php

    function asset($str)
    {
        if(isset($str) && $str !== "")
        {
            $url = constant("APP_URL") . "assets/" . $str; 
        }
        else {
            $url = constant("APP_URL");
        }

        return $url;
    }

    function url($str)
    {
        if(isset($str) && $str !== "")
        {
            $url = constant("APP_URL") . "" . $str; 
        }
        else {
            $url = constant("APP_URL");
        }

        return $url;
    }

    function storage_path($str)
    {
        if(isset($str) && $str !== "")
        {
            $url = constant("APP_URL") . "Storage/" . $str; 
        }
        else {
            $url = "";
        }

        return $url;
    }

    function base_path($str)
    {
        if(isset($str) && $str !== "")
        {
            $url = constant("APP_URL") . "" . $str; 
        }
        else {
            $url = constant("APP_URL");
        }

        return $url;
    }

    function mail_path($str)
    {
        if(isset($str) && $str !== "")
        {
            $url = constant("APP_URL") . "/views/mails/" . $str; 
        }
        else {
            $url = "";
        }

        return $url;
    }