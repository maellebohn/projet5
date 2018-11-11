<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

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

        $client->followRedirects();

        $session = $client->getContainer()->get('session');

        $firewallName = 'main';
        $firewallContext = 'main';

        $token = new UsernamePasswordToken('admin', null, $firewallName, array('ROLE_ADMIN'));
        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $client->getCookieJar()->set($cookie);

        $crawler = $client->request('GET','/addinfo');

        $form = $crawler->selectButton('Créer')->form();

        $form['add_info[title]'] = 'alimentation';
        $form['add_info[image]'] = null ;
        $form['add_info[category]'] = 'education' ;
        $form['add_info[content]'] = 'bien nourrir ses perroquets' ;

        $client->submit($form);

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }
}