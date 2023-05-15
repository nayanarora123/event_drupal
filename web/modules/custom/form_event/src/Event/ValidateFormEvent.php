<?php

namespace Drupal\form_event\Event;

use Symfony\Component\EventDispatcher\Event;

class ValidateFormEvent extends Event{

    const VALIDATE = 'event.validate';

    protected $field;

    public function __construct($field){
        $this->field = $field;
    }

    public function setValidateMessage(){
        return $this->field. ' is required';
    }

}