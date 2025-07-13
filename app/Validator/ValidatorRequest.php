<?php

namespace App\Validator;

use Illuminate\Support\Facades\Validator;

class ValidatorRequest {
    public static function validate(array $data, array $rules): bool {
        $validator = Validator::make($data, $rules);

        return !$validator->fails();
    }
}
