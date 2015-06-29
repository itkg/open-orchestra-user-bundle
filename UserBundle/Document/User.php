<?php

namespace OpenOrchestra\UserBundle\Document;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique;

/**
 * Document User
 *
 * @ODM\Document(
 *  collection="user",
 *  repositoryClass="OpenOrchestra\UserBundle\Repository\UserRepository"
 * )
 *
 * @Unique(
 *   fields={"email"},
 *   message="open_orchestra_user.form.registration_user.unique_user_name"
 * )
 */
class User extends BaseUser
{
    /**
     * @ODM\Id()
     */
    protected $id;

    /**
     * @var string $lastName
     *
     * @Assert\NotBlank()
     * @ODM\Field(type="string")
     */
    protected $lastName;

    /**
     * @var string $firstName
     *
     * @Assert\NotBlank()
     * @ODM\Field(type="string")
     */
    protected $firstName;

    /**
     * @var string $language
     *
     * @ODM\Field(type="string")
     */
    protected $language;

    /**
     * @ODM\ReferenceMany(targetDocument="FOS\UserBundle\Model\GroupInterface")
     */
    protected $groups;

    /**
     * Class constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->setEnabled(true);
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }
}
