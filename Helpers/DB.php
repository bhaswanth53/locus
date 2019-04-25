<?php

    namespace Helpers;

    use Medoo\Medoo;

    class DB
    {
        public function connect()
        {
            $database = new Medoo([
                'database_type' => 'mysql',
                'database_name' => constant("DB_NAME"),
                'server' => constant("DB_HOST"),
                'username' => constant("DB_USERNAME"),
                'password' => constant("DB_PASSWORD")
            ]);

            return $database;
        }
    }