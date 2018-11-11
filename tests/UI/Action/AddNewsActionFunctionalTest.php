<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

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

        $client->followRedirects();

        $session = $client->getContainer()->get('session');

        $firewallName = 'main';
        $firewallContext = 'main';

        $token = new UsernamePasswordToken('admin', null, $firewallName, array('ROLE_ADMIN'));
        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $client->getCookieJar()->set($cookie);

        $crawler = $client->request('GET','/addnews');

        $form = $crawler->selectButton('Créer')->form();

        $form['add_news[title]'] = 'nouveaux-nés';
        $form['add_news[image]'] = null ;
        $form['add_news[content]'] = 'les oeufs ont éclos' ;

        $client->submit($form);

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }
}