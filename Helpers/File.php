<?php

    namespace Helpers;

    class File
    {
        public $file;
        public $path;
        public $name;

        public function __construct($file)
        {
            $this->file = $file;
        }
        
        public function upload()
        {
            $file_name = $this->file['name'];
            $file_size = $this->file['size'];
            $file_tmp = $this->file['tmp_name'];
            $file_type = $this->file['type'];
            $tmp = explode('.', $file_name);
            $file_ext = end($tmp);

            if(isset($this->name) && $this->name !== '')
            {
                $file_new_name = $this->name . "." . $file_ext;
            }
            else {
                $file_new_name = $file_name;
            }

            $file_path = "./Storage/" . $this->path . "/" . $file_new_name;

            if(!file_exists("./Storage/" . $this->path . "/"))
            {
                mkdir("./Storage/" . $this->path . "/");
            }

            if(move_uploaded_file($file_tmp, $file_path))
            {
                return true;
            }
            else {
                return false;
            }
        }
    }