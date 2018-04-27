<?php

declare(strict_types=1);

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\ContactResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Twig\Environment;

class ContactResponder implements ContactResponderInterface
{
    /**
    * @var Environment
    */
    private $twig;

    /**
    *ContactResponder constructor.
    *
    * @param Environment $twig
    */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke($redirect = false, FormInterface $contactType = null)
    {
        $redirect
        ? $response = new RedirectResponse('/contact')
        : $response = new Response(
            $this->twig->render('contact.html.twig', [
                'form' => $contactType->createView()
            ])
        );

        return $response;
    }
}
