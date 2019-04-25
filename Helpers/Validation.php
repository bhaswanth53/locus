<?php

    namespace Helpers;
    use Rakit\Validation\Validator;
    use Flight;

    class Validation {
        public function make($request, $rules)
        {
            $validator = new Validator;
            $validation = $validator->make($request->data->getData() + $request->files, $rules);
            $validation->validate();

            if ($validation->fails()) {
                $errors = $validation->errors();
                return $errors->firstOfAll();
            } else {
                return true;
            }
        }
    }