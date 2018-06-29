<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;

class AddInfoActionFunctionalTest extends WebTestCase
{
    public function testAddInfoPageStatusCode()
    {
        $client = static::createClient();

        $client->request('GET','/addinfo');

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }

    public function testAddInfoPageFormSubmission()
    {
        $client = static::createClient();

        $crawler = $client->request('GET','/addinfo');

        $form = $crawler->selectButton('Créer')->form();

        $form['add_info[title]'] = 'alimentation';
        $form['add_info[author]'] = 'toto';//
        $form['add_info[image]'] = new File('public/images/accueil1.jpg', 'photo.jpg', 'image/jpeg') ;
        $form['add_info[category]'] = 'education' ;
        $form['add_info[content]'] = 'bien nourrir ses perroquets' ;

        $crawler = $client->submit($form);
        //dump($client->getResponse()->getContent()); author doit prendre valeur App\Domain\Models\Users, comment faire?

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }
}