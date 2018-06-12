<?php

declare(strict_types=1);

namespace App\UI\Action\Interfaces;

use App\Repository\Interfaces\BIrdsRepositoryInterface;
use App\UI\Responder\Interfaces\DeleteBirdResponderInterface;
use Symfony\Component\HttpFoundation\Request;

interface DeleteBirdActionInterface
{
    /**
     * DeleteBirdAction constructor.
     *
     * @param BirdsRepositoryInterface $birdsRepository
     */
    public function __construct (BirdsRepositoryInterface $birdsRepository);

    /**
     * @param Request $request
     * @param DeleteBirdResponderInterface $responder
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function __invoke(
        Request $request,
        DeleteBirdResponderInterface $responder
    );
}
