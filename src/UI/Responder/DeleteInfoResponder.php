<?php

declare(strict_types=1);

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\DeleteInfoResponderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

final class DeleteInfoResponder implements DeleteInfoResponderInterface
{
    /**
    * @var Environment
    */
    private $twig;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
    *HomeResponder constructor.
    *
    * @param Environment $twig
    * @param UrlGeneratorInterface $router
    */
    public function __construct(
        Environment $twig,
        UrlGeneratorInterface $router
    ) {
        $this->twig = $twig;
        $this->router = $router;
    }

    /**
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function __invoke()
    {
        return new RedirectResponse(
            $this->router->generate('admin')
        );
    }
}
