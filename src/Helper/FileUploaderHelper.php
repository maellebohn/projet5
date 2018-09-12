<?php

declare(strict_types=1);

namespace App\Helper;

use App\Helper\Interfaces\FileUploaderHelperInterface;

class FileUploaderHelper implements FileUploaderHelperInterface
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

    /**
     * @param \SplFileInfo $image
     *
     * @return string
     */
    public function upload(\SplFileInfo $image)
   {
       $imageName = md5(uniqid()).'.'.$image->guessExtension();
       $image->move($this->getImageFolder(), $imageName);

       return $imageName;
   }
}