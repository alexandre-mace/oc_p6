<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 02/12/18
 * Time: 17:24
 */

namespace App\Tests\Service;

use App\Service\TokenGenerator;
use PHPUnit\Framework\TestCase;

class TokenGeneratorTest extends TestCase
{
    public function testGenerate()
    {
        $tokenGenerator = new TokenGenerator();
        $this->assertNotNull($tokenGenerator->generate());
    }
}