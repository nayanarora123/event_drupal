<?php


namespace Drupal\form_event\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\form_event\Event\ValidateFormEvent;


/**
 * Class ValidateEventSubscriber.
 *
 * @package Drupal\form_event\EventSubscriber
 */
class ValidateEventSubscriber implements EventSubscriberInterface{

    /**
     * {@inheritdoc}
     * 
     * @return array
     * array of event names to listen for
     */
    public static function getSubscribedEvents(){
        return [
            ValidateFormEvent::VALIDATE => 'configValidate'
        ];
    }


    public function configValidate(ValidateFormEvent $event){
        $msg = $event->setValidateMessage();
        return \Drupal::messenger()->addError($msg);
    }

}