<?php

namespace App\Tests\Helper;

use App\Helper\FileUploaderHelper;
use App\Helper\Interfaces\FileUploaderHelperInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploaderHelperTest extends WebTestCase
{
    /**
     * @var string|null
     */
    private $imageFolder = null;

    /**
     *{@inheritdoc}
     */
    protected function setUp ()
    {
        $this->imageFolder = 'public/images/';
    }

    public function testFileUpload()
    {
        $uploader = new FileUploaderHelper($this->imageFolder);
        static::assertInstanceOf(FileUploaderHelperInterface::class, $uploader);

        $imageMock = $this->createMock(UploadedFile::class);
        static::assertNotNull(
            $uploader->upload($imageMock)
        );
    }

}