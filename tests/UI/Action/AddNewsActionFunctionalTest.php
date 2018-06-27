<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;

class AddNewsActionFunctionalTest extends WebTestCase
{
    public function testAddNewsPageStatusCode()
    {
        $client = static::createClient();

        $client->request('GET','/addnews');

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }

    public function testAddNewsPageFormSubmission()
    {
        $client = static::createClient();

        $crawler = $client->request('GET','/addnews');

        $form = $crawler->selectButton('Créer')->form();

        $form['add_news[title]'] = 'nouveaux-nés';
        $form['add_news[author]'] = 'admin';
        $form['add_news[image]'] = new UploadedFile('public/images/accueil1.jpg', 'photo.jpg', 'image/jpeg') ;
        $form['add_news[content]'] = 'les oeufs ont éclos' ;

        $crawler = $client->submit($form);
        //dump($client->getResponse()->getContent()); author doit prendre valeur App\Domain\Models\Users, comment faire?

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }
}