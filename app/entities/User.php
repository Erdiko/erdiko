<?php
namespace app\entities;

/**
 * @Entity @Table(name="users")
 */
class User
{
    /**
     * @Id @GeneratedValue @Column(type="integer")
     * @var integer
     */
    protected $id;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $email;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $password;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $role;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $name;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $created_at;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $updated_at;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    // @todo add security hashing here
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getCreatedAt()
    { 
      return $this->created_at;
    }
    
    public function setCreatedAt($created)
    {
      $this->created_at = $created;
    }

    public function getUpdatedAt()
    { 
      return $this->updated_at;
    }
    
    public function setUpdatedAt($updated)
    {
      $this->updated_at = $updated;
    }

    /** 
     *  @ORM\PrePersist 
     */
    public function doStuffOnPrePersist()
    {
        $this->created = date('Y-m-d H:i:s');
    }

    /** 
     *  @ORM\PreMerge
     */
    public function doStuffOnPreMerge()
    {
        $this->updated = date('Y-m-d H:i:s');
    }
}
