<?php

namespace OpenOrchestra\UserBundle\Test\Form\Type;

use Phake;

/**
 * Class AbstractUserTypeTest
 */
abstract class AbstractUserTypeTest extends \PHPUnit_Framework_TestCase
{
    protected $builder;
    protected $resolver;
    protected $translator;
    protected $string = 'string';

    /**
     * Set up common test part
     */
    public function setUp()
    {
        $this->translator = Phake::mock('Symfony\Component\Translation\TranslatorInterface');
        Phake::when($this->translator)->trans(Phake::anyParameters())->thenReturn($this->string);

        $this->builder = Phake::mock('Symfony\Component\Form\FormBuilder');
        Phake::when($this->builder)->add(Phake::anyParameters())->thenReturn($this->builder);
        Phake::when($this->builder)->addEventSubscriber(Phake::anyParameters())->thenReturn($this->builder);

        $this->resolver = Phake::mock('Symfony\Component\OptionsResolver\OptionsResolverInterface');
    }
}
