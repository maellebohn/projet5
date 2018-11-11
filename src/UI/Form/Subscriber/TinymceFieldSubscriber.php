<?php

declare(strict_types=1);

namespace App\UI\Form\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class TinymceFieldSubscriber implements EventSubscriberInterface
{
    /**
     * @var string
     */
    private $content;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * TinymceFieldSubscriber constructor.
     *
     * @param ValidatorInterface $validator
     */
    public function __construct (ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }


    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::SUBMIT => 'onSubmit',
        );
    }

    public function onSubmit(FormEvent $event)
    {
        $this->content = $event->getForm()->getData()->content;
        $content = htmlspecialchars(strip_tags($this->content));
        $errors = $this->validator->validate($content, [
            new Length(['min' => 10, 'max' => 1000]),
            new NotBlank(),
        ]);

        if ( \count($errors) > 0) {
            $event->getForm()
                ->get('content')
                ->addError(new FormError('Ce champ est invalide, veuillez recommencer votre saisie.'));
        }
    }
}