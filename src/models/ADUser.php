<?php

namespace abilioj\ToolToDev\models;

/**
 * Description of ADUser
 *
 * @author Abílio José
 */
class ADUser {
    /**
     * The user's full name (complete name)
     * @var string
     */
    private string $fullName;
    
    /**
     * The user's name
     * @var string
     */
    private string $name;
    
    /**
     * The user's last name
     * @var string
     */
    private string $lastName;
    
    /**
     * The user's initials
     * @var string
     */
    private string $initials;
    
    /**
     * The name used for authentication
     * @var string
     */
    private string $authName; 
     
    /*
     * The distinguished name of the user
     * @var string
    */ 
    private $dn;
    
    /*
    * The groups the user belongs to
    * @var array
    */
    private $groups;
    
    /**
     * The user's mail address
     * @var string
     */
    private $mail; 
    
    public function __construct() {        
    }

    
    /**
     * Gets the user's full name
     * @return string
     */
    public function getFullName(): string {
        return $this->fullName;
    }
    
    /**
     * Sets the user's full name
     * @param string $fullName
     * @return self
     */
    public function setFullName(string $fullName): self {
        $this->fullName = $fullName;
        return $this;
    }
    
    /**
     * Gets the user's name
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }
    
    /**
     * Sets the user's name
     * @param string $name
     * @return self
     */
    public function setName(string $name): self {
        $this->name = $name;
        return $this;
    }
    
    /**
     * Gets the user's last name
     * @return string
     */
    public function getLastName(): string {
        return $this->lastName;
    }
    
    /**
     * Sets the user's last name
     * @param string $lastName
     * @return self
     */
    public function setLastName(string $lastName): self {
        $this->lastName = $lastName;
        return $this;
    }
    
    /**
     * Gets the user's initials
     * @return string
     */
    public function getInitials(): string {
        return $this->initials;
    }
    
    /**
     * Sets the user's initials
     * @param string $initials
     * @return self
     */
    public function setInitials(string $initials): self {
        $this->initials = $initials;
        return $this;
    }
    
    /**
     * Gets the name used for authentication
     * @return string
     */
    public function getAuthName(): string {
        return $this->authName;
    }
    
    /**
     * Sets the name used for authentication
     * @param string $authName
     * @return self
     */
    public function setAuthName(string $authName): self {
        $this->authName = $authName;
        return $this;
    }
    
    /**
     * Gets the DN of the user
     * @return string
     */
    public function getDn(): string {
        return $this->dn;
    }
    
    /**
     * Sets the DN of the user
     * @param string $dn
     * @return self
     */
    public function setDn(string $dn): self {
        $this->dn = $dn;
        return $this;
    }
    
    /**
     * Gets the groups the user belongs to
     * @return array
     */
    public function getGroups(): array {
        return $this->groups;
    }
    
    /**
     * Sets the groups the user belongs to
     * @param array $groups
     * @return self
     */
    public function setGroups(array $groups): self {
        $this->groups = $groups;
        return $this;
    }
    
    /**
     * Gets the user's mail address
     * @return string
     */
    public function getMail(): string {
        return $this->mail;
    }
    
    /**
     * Sets the user's mail address
     * @param string $mail
     * @return self
     */
    public function setMail(string $mail): self {
        $this->mail = $mail;
        return $this;
    }
    
}
