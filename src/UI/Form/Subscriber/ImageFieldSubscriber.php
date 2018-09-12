<?php

declare(strict_types=1);

namespace App\UI\Form\Subscriber;

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
     * ImageFieldSubscriber constructor.
     *
     * @param \SplFileInfo|null $file
     */
    public function __construct (\SplFileInfo $file = null)
    {
        $this->file = $file;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'onPreSetData',
            FormEvents::SUBMIT => 'onSubmit',
        );
    }

    public function onPreSetData(FormEvent $event)
    {
        $this->file = $event->getForm()->get('image')->getData();
    }

    public function onSubmit(FormEvent $event)
    {
        $submittedImage = $event->getForm()->get('image')->getData();

        if ($this->file !== $submittedImage) {

            return $submittedImage;
        }
        return $this->file;
    }
}