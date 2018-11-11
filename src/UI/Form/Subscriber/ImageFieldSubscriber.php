<?php

declare(strict_types=1);

namespace App\UI\Form\Subscriber;

use App\Helper\Interfaces\FileUploaderHelperInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ImageFieldSubscriber implements EventSubscriberInterface
{
    /**
     * @var \SplFileInfo|null
     */
    private $file;

    /**
     * @var FileUploaderHelperInterface
     */
    private $fileUploaderHelper;

    public function __construct (FileUploaderHelperInterface $fileUploaderHelper)
    {
        $this->fileUploaderHelper = $fileUploaderHelper;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::POST_SET_DATA => 'onPostSetData',
            FormEvents::SUBMIT => 'onSubmit',
        );
    }

    public function onPostSetData(FormEvent $event)
    {
        $this->file = $event->getForm()->get('image')->getData();
    }

    public function onSubmit(FormEvent $event)
    {
        if (\is_null($event->getForm()->get('image')->getData())) {
            $event->getForm()->getData()->image = $this->file;
        }
    }
}