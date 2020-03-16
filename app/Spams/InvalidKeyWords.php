<?php


namespace App\Spams;


class InvalidKeyWords
{

    protected $keyWords = ['yahoo', 'customer', 'support'];

    public function detect($body)
    {

        foreach ($this->keyWords as $keyWord) {
            if (stripos($body, $keyWord) !== false) {
                throw new \Exception('Your reply contains spam.');
            }
        }
    }

}
