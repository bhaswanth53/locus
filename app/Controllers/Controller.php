<?php

    namespace Controllers;

    class Controller {
        public function render($path, $args=array())
        {
            $path = "../views/" . $path . ".php";
            ob_start();
			include($path);
			$var=ob_get_contents(); 
			ob_end_clean();
			return $var;
        }

        public function redirect($url)
        {
            ob_start();
            header("Location: ".$url);
        }
    }