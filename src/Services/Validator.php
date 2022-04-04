<?php

namespace App\Services;

class Validator
{
    public function validate($text): bool {
        return preg_match('#(viagra|buy)#i', $text) == 0;
    }
}