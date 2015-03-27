<?php

namespace OpenOrchestra\UserBundle\Tests\Form\Type;

use OpenOrchestra\UserBundle\Form\Type\ApiClientType;
use Phake;
use OpenOrchestra\UserBundle\Form\Type\UserType;

/**
 * Class UserTypeTest
 */
class ApiClientTypeTest extends \PHPUnit_Framework_TestCase
{
    protected $builder;
    protected $resolver;

    /**
     * @var UserType
     */
    protected $form;

    protected $class = 'OpenOrchestra\UserBundle\Document\ApiClient';

    /**
     * Set up the test
     */
    public function setUp()
    {
        $this->builder = Phake::mock('Symfony\Component\Form\FormBuilder');
        Phake::when($this->builder)->add(Phake::anyParameters())->thenReturn($this->builder);
        Phake::when($this->builder)->addEventSubscriber(Phake::anyParameters())->thenReturn($this->builder);

        $this->resolver = Phake::mock('Symfony\Component\OptionsResolver\OptionsResolverInterface');
        $this->form = new ApiClientType($this->class);
    }

    /**
     * Test name
     */
    public function testName()
    {
        $this->assertSame('api_client', $this->form->getName());
    }

    /**
     * Test builder
     */
    public function testBuilder()
    {
        $this->form->buildForm($this->builder, array());

        Phake::verify($this->builder, Phake::times(4))->add(Phake::anyParameters());
        Phake::verify($this->builder)->addEventSubscriber(Phake::anyParameters());
    }

    /**
     * Test setDefaultOptions
     */
    public function testResolver()
    {
        $this->form->setDefaultOptions($this->resolver);

        Phake::verify($this->resolver)->setDefaults(Phake::anyParameters());
    }
}
