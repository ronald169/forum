<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Zttp\Zttp;

class Recaptcha implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        $response = Zttp::asFormParams()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret'),
            'response' => $value,
            'remoteip' => request()->ip(),
        ]);

        return $response->json()['success'];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Recaptcha verification failed. Try again.';
    }
}
