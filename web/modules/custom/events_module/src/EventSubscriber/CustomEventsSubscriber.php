<?php

namespace Drupal\events_module\EventSubscriber;

use Drupal\Core\Config\ConfigCrudEvent;
use Drupal\Core\Config\ConfigEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\events_module\Event\UserLoginEvent;


/**
 * Class CustomEventsSubscriber.
 *
 * @package Drupal\events_module\EventSubscriber
 */
class CustomEventsSubscriber implements EventSubscriberInterface
{

  /**
   * {@inheritdoc}
   *
   * @return array
   *   The event names to listen for, and the methods that should be executed.
   */
  public static function getSubscribedEvents()
  {
    return [
      ConfigEvents::SAVE => 'configSave',
      ConfigEvents::DELETE => 'configDelete',
      UserLoginEvent::SUBMIT => 'configSubmit'

    ];
  }

  /**
   * React to a config object being saved.
   *
   * @param \Drupal\Core\Config\ConfigCrudEvent $event
   *   Config crud event.
   */
  public function configSave(ConfigCrudEvent $event)
  {
    $config = $event->getConfig();
    \Drupal::messenger()->addStatus('abccccccccccccccccccccccccc');
  }

  /**
   * React to a config object being deleted.
   *
   * @param \Drupal\Core\Config\ConfigCrudEvent $event
   *   Config crud event.
   */
  public function configDelete(ConfigCrudEvent $event)
  {
    $config = $event->getConfig();
    \Drupal::messenger()->addStatus('deleteeeeeeeeeeeeeeeeeeeeeeeeeee');
  }

  public function configSubmit(UserLoginEvent $event)
  {
    $msg = $event->getMessage();
    \Drupal::messenger()->addStatus($msg);
  }

}