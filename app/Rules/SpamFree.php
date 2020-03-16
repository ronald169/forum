<?php

namespace App\Rules;

use App\Spams\Spam;
use Illuminate\Contracts\Validation\Rule;

class SpamFree implements Rule
{

    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        try {

            return ! (new Spam())->detect($value);


        }   catch (\Exception $e) {

            return false;

        }

    }

    public function message()
    {
        return 'The validation error message.';
    }
}
