<?php

declare(strict_types=1);

namespace App\Helper;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploaderHelper
{
    /**
     * @var string
     */
    private $imageFolder;

    /**
     * FileUploaderHelper constructor.
     *
     * @param string $imageFolder
     */
    public function __construct(string $imageFolder)
    {
        $this->imageFolder = $imageFolder;
    }
    /**
     * @return string
     */
    public function getImageFolder(): string
    {
        return $this->imageFolder;
    }

    public function upload(UploadedFile $image)
   {
       $imageName = md5(uniqid()).'.'.$image->guessExtension();

       $image->move($this->getImageFolder(), $imageName);

       return $imageName;
   }
}