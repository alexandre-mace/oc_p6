<?php

// Tests/Controller/CommentControllerTest.php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class CommentControllerTest extends WebTestCase
{
    public function testAdd()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => getenv('A_USERNAME'),
            'PHP_AUTH_PW' => getenv('A_PASSWORD'),
        ]);
        $crawler = $client->request('GET', '/trick/mute');
        $this->assertTrue($client->getResponse()->isSuccessful());

        if ($client->getResponse()->isSuccessful()) {
            $form = $crawler->selectButton('Save')->form();
            $form['comment[content]'] = 'test comment add';
            $client->submit($form);
            $this->assertTrue($client->getResponse()->isRedirection());
            
            $crawler = $client->followRedirect();
            $this->assertContains(
                'The new comment has been successfully added !',
                $client->getResponse()->getContent()
            );
        }
	}
	public function testAddFail()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => getenv('A_USERNAME'),
            'PHP_AUTH_PW' => getenv('A_PASSWORD'),
        ]);
        $client->request('POST', '/trick/mute/add', array('comment[content]' => ''));
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

}