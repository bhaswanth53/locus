<?php

	if (defined('STDIN')) {
	  $type = $argv[1];
	$name = $argv[2];
	$age = $argv[3];
	  echo $type . ", " . $name . ", " . $age;
	}