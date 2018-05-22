<?php

declare(strict_types=1);

namespace App\Domain\Builder;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Domain\Models\Infos;
use App\Domain\Builder\Interfaces\InfoBuilderInterface;


class InfoBuilder implements InfoBuilderInterface
{
    /**
     * @var Infos
     */
    private $info;

    /**
     * @param string       $title
     * @param string       $author
     * @param UploadedFile $image
     * @param string       $content
     *
     * @return InfoBuilder
     */
    public function create(string $title, string $author, UploadedFile $image, string $content): self
    {
        //$this->info = new Infos($form->getData()->title, $author, $image, $content);

        return $this;
    }

    public function getInfo(): Infos
    {
        return $this->info;
    }
}