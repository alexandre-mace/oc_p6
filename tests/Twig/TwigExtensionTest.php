<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 02/12/18
 * Time: 17:30
 */

use PHPUnit\Framework\TestCase;

class TwigExtensionTest extends TestCase
{
    public function testGenerate()
    {
        $extension = new \App\Twig\AppExtension();
        $this->assertNotNull($extension->getFunctions());
    }
}