<?php


namespace Drupal\events_module\Event;

use Symfony\Component\EventDispatcher\Event;


 
class UserLoginEvent extends Event {
 
 const SUBMIT = 'event.submit';
 protected $customMsg;
 
 public function __construct($msg)
 {
   $this->customMsg = $msg;
 }
 
 public function getMessage()
 {
   return $this->customMsg;
 }
 
 public function myEventDescription() {
   return "This is as an example event";
 }
 
}