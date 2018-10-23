<?php

// Tests/Controller/SecurityControllerTest.php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLogin()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $this->assertTrue($client->getResponse()->isSuccessful());

        if ($client->getResponse()->isSuccessful()) {
            $form = $crawler->selectButton('Login')->form();
            $form['_username'] = 'a';
            $form['_password'] = 'alexandre';
            $client->submit($form);
            $this->assertTrue($client->getResponse()->isRedirection());
            
            $crawler = $client->followRedirect();
            $this->assertContains('- Hi',$client->getResponse()->getContent());
        }
    }
}