<?php

	namespace Controllers;

	use Flight;

	class IndexController extends Controller
	{
		public function index()
		{
			Flight::render('welcome');
		}
	}