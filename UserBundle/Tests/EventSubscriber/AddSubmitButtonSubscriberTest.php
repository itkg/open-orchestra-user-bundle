<?php

namespace OpenOrchestra\UserBundle\Tests\EventSubscriber;

use Phake;
use OpenOrchestra\UserBundle\EventSubscriber\AddSubmitButtonSubscriber;
use Symfony\Component\Form\FormEvents;

/**
 * Class AddSubmitButtonSubscriberTest
 */
class AddSubmitButtonSubscriberTest extends \PHPUnit_Framework_TestCase
{
    protected $subscriber;

    protected $data;
    protected $status;
    protected $event;
    protected $form;

    /**
     * Set up the test
     */
    public function setUp()
    {
        $this->form = Phake::mock('Symfony\Component\Form\FormBuilder');
        Phake::when($this->form)->add(Phake::anyParameters())->thenReturn($this->form);

        $this->event = Phake::mock('Symfony\Component\Form\FormEvent');
        Phake::when($this->event)->getForm()->thenReturn($this->form);

        $this->subscriber = new AddSubmitButtonSubscriber();
    }

    /**
     * Test instance
     */
    public function testInstance()
    {
        $this->assertInstanceOf('Symfony\Component\EventDispatcher\EventSubscriberInterface', $this->subscriber);
    }

    /**
     * Test subscribed events
     */
    public function testEventSubscribed()
    {
        $this->assertArrayHasKey(FormEvents::POST_SET_DATA, $this->subscriber->getSubscribedEvents());
    }

    /**
     * Test add a submit button
     */
    public function testPostSetData()
    {
        $this->subscriber->postSetData($this->event);

        Phake::verify($this->form)->add('submit', 'submit', array('label' => 'open_orchestra_base.form.submit', 'attr' => array('class' => 'submit_form')));
    }
}
