<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\UI\Action\Interfaces\ShowLegalNoticeActionInterface;
use App\UI\Responder\Interfaces\ShowLegalNoticeResponderInterface;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route(
 *     path="/mentionslegales",
 *     name="mentions_legales"
 * )
 */

final class ShowLegalNoticeAction implements ShowLegalNoticeActionInterface
{
    /**
     * @param ShowLegalNoticeResponderInterface $responder
     *
     * @return mixed
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(ShowLegalNoticeResponderInterface $responder)
    {
        return $responder();
    }
}
