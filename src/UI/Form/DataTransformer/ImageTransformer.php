<?php

declare(strict_types=1);

namespace App\UI\Form\DataTransformer;

use App\Helper\Interfaces\FileUploaderHelperInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\HttpFoundation\File\File;

class ImageTransformer implements DataTransformerInterface
{
    private $defaultImage;

    /**
     * @var FileUploaderHelperInterface
     */
    private $fileUploaderHelper;

    public function __construct (FileUploaderHelperInterface $fileUploaderHelper)
    {
        $this->fileUploaderHelper = $fileUploaderHelper;
    }

    public function transform ($value)
    {
        if(!\is_null($value)) {
            $this->defaultImage = $value;
            return new File($this->fileUploaderHelper->getImageFolder().'/'.$value);
        }
    }

    public function reverseTransform ($value)
    {
        if (\is_null($value) || $this->defaultImage === $value) {
            return;
        }

        $image = $this->fileUploaderHelper->upload($value);

        return $image;
    }
}