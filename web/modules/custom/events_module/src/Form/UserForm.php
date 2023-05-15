<?php

namespace Drupal\events_module\Form;

use Drupal\events_module\Event\UserLoginEvent;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;


class UserForm extends FormBase{

    /**
     * {@inheritdoc}
     */
    public function getFormId(){
        return 'create_user_form';
    }


    /**
     * {@inheritdoc}
     */
    public function buildForm($form, FormStateInterface $form_state){
        
        $form['info'] = [
            '#markup' => '<h4>Fill Form</h4>',
        ];

        $form['name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Your Name'),
        ];

        $form['age'] = [
            '#type' => 'number',
            '#title' => $this->t('Your Age'),
        ];

        $form['actions']['#type'] = 'actions';

        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('submit'),
        ];

        return $form;

    }


    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state){

        if($form_state->getValue('name') == ''){
            $form_state->setErrorByName('name', 'name error');
        }

        if($form_state->getValue('age') == ''){
            $form_state->setErrorByName('age', 'age error');
        }

    }


    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {

        // load the Symfony event dispatcher object through services
        $dispatcher = \Drupal::service('event_dispatcher');

        // creating our event class object.
        $event = new UserLoginEvent($form_state->getValue('name'));

        // dispatching the event through the ‘dispatch’  method,
        // passing event name and event object ‘$event’ as parameters.
        $dispatcher->dispatch(UserLoginEvent::SUBMIT, $event);

    }




}