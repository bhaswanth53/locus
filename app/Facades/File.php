<?php

    namespace Facades;

    class File
    {
        public $files;

        public function __construct($files)
        {
            $this->files = $files;
        }

        public function get($file)
        {
            return $this->files[$file];
        }

        public function upload($file, $path="", $name="")
        {
            $file_name = $file['name'];
            $file_size = $file['size'];
            $file_tmp = $file['tmp_name'];
            $file_type = $file['type'];
            $tmp = explode('.', $file_name);
            $file_ext = end($tmp);

            if(isset($name) && $name !== '')
            {
                $file_new_name = $name . "." . $file_ext;
            }
            else {
                $file_new_name = $file_name;
            }

            if(isset($path) && $path !== "")
            {
                $file_path = "../public/storage/".$path;
                if(!file_exists($file_path))
                {
                    mkdir($file_path, 0777);
                }
            }
            else {
                $file_path = "../public/storage";
            }

            if(move_uploaded_file($file_tmp, $file_path."/".$file_new_name))
            {
                return $file_new_name;
            }
            else {
                return false;
            }
        }
    }