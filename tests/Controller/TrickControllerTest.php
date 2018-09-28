<?php

// Tests/Controller/TrickControllerTest.php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class TrickControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = self::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function testShow()
    {
        $client = self::createClient();
        $client->request('GET', '/trick/mute');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function testAdd()
    {
        $client = self::createClient(array(), array(
            'PHP_AUTH_USER' => getEnv('A_USERNAME'),
            'PHP_AUTH_PW'   => getEnv('A_PASSWORD')
        ));
        $crawler = $client->request('GET', '/add');
        $this->assertTrue($client->getResponse()->isSuccessful());

        if ($client->getResponse()->isSuccessful()) {
            $form = $crawler->selectButton('Save')->form();
            $form['trick[name]'] = 'test trick add' . rand();
            $form['trick[description]'] = 'test trick add test trick add test trick add test trick add test trick add';
            $form['trick[categories][0]']->tick();

            /* adding image - 1 méthode
            $image = new UploadedFile(
                '../../public/images/indy_1.jpg',
                'indy_1.jpg',
                'image/jpeg',
                null
            );
            $client->xmlHttpRequest('POST', '/file/upload', array('image' => $image));
            $values = $form->getPhpValues();
            // valueur de retour à assigner à name ??
            $values['trick']['images'][0]['name'] = 'valeur de retour';
            
            
            // adding image - 2 méthode
            $addImageButton = $crawler->selectButton('addImageButton')->link();
            $crawler = $client->click($addImageButton);
            $input = $crawler->filter('uploadImg')->last();
            $input->upload('../../images/indy_1.jpg');
            */
            
            // adding video
            $values = $form->getPhpValues();
            $values['trick']['videos'][0]['url'] = 'https://www.youtube.com/watch?v=UGdif-dwu-8';
            

            // submits the form with the existing and new values
            $crawler = $client->request($form->getMethod(), $form->getUri(), $values,
                $form->getPhpFiles());

            $this->assertTrue($client->getResponse()->isRedirection());

            $crawler = $client->followRedirect();
            $this->assertContains(
                'The new trick has been successfully added !',
                $client->getResponse()->getContent()
            );
        }
    }
    
    public function testUpdate()
    {
        $client = self::createClient(array(), array(
            'PHP_AUTH_USER' => getEnv('A_USERNAME'),
            'PHP_AUTH_PW'   => getEnv('A_PASSWORD')
        ));
        $crawler = $client->request('GET', '/update/indy');
        $this->assertTrue($client->getResponse()->isSuccessful());

        if ($client->getResponse()->isSuccessful()) {
            $form = $crawler->selectButton('Save')->form();
            $form['trick[name]'] = 'test trick update' . rand();
            $form['trick[description]'] = 'test trick update test trick update test trick update';
            $form['trick[categories][1]']->tick();
            $client->submit($form);
            $this->assertTrue($client->getResponse()->isRedirection());
            $crawler = $client->followRedirect();
            
            $this->assertContains(
                'The trick has been successfully updated !',
                $client->getResponse()->getContent()
            );
        }
    }

    public function testDelete()
    {
        $client = self::createClient(array(), array(
            'PHP_AUTH_USER' => getEnv('A_USERNAME'),
            'PHP_AUTH_PW'   => getEnv('A_PASSWORD')
        ));
        $client->request('GET', '/delete/360');
        $this->assertTrue($client->getResponse()->isRedirection());
        
        $crawler = $client->followRedirect();
        $this->assertContains(
            'The trick has been successfully deleted !',
            $client->getResponse()->getContent()
        );
	}

}