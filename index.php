<?php
	require "./vendor/autoload.php";
	require "./Config/Variables.php";
	require "./Config/Utilities.php";
	
	use flight\Engine;
	Flight::set('flight.log_errors', true);

	$app = new Engine();
	
	/* Define your Routes here */ 
	$app->route('GET /', 'Controllers\\IndexController::index');

	$app->map('notFound', function() use($app) {
		$app->render("errors/404.php");
	});

	$app->start();