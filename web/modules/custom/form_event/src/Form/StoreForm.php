<?php

namespace Drupal\form_event\Form;

use Drupal\form_event\Event\ValidateFormEvent;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;


class StoreForm extends FormBase
{

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'store_form';
    }


    /**
     * {@inheritdoc}
     */
    public function buildForm($form, FormStateInterface $form_state)
    {

        $form['info'] = [
            '#markup' => '<h4>Fill Form</h4>',
        ];

        $form['name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Your Name'),
        ];

        $form['address'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Your Address'),
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
    public function validateForm(array &$form, FormStateInterface $form_state)
    {

        $dispatcher = \Drupal::service('event_dispatcher');

        if ($form_state->getValue('name') == '') {
            $event = new ValidateFormEvent('name');
            $dispatcher->dispatch(ValidateFormEvent::VALIDATE, $event);
        }

        if ($form_state->getValue('address') == '') {
            $event = new ValidateFormEvent('address');
            $dispatcher->dispatch(ValidateFormEvent::VALIDATE, $event);
        }

        return;

    }


    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        if (
            $form_state->getValue('name') != '' &&
            $form_state->getValue('address') != ''
        ) {
            return \Drupal::messenger()->addMessage('SUBMITTED SUCCESSFULLY!!');
        }

        return;
    }




}