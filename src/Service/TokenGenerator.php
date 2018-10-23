<?php

namespace App\Service;

class TokenGenerator
{
    public function generate()
    {
		$token = bin2hex(random_bytes(32));
        return $token;
    }
}