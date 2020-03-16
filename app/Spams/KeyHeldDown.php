<?php


namespace App\Spams;


class KeyHeldDown
{

    public function detect($body)
    {
        if (preg_match('/(.)\\1{10,}/', $body)) {
            throw new \Exception('Your reply contains duplicate word.');
        }
    }

}
