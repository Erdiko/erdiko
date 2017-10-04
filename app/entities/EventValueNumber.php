<?php
namespace app\entities;

/**
 * @Entity @Table(name="event_value_number")
 */
 class EventValueNumber
 {
    /**
     * @Id @GeneratedValue @Column(type="integer")
     * @var integer
     */
    protected $id;

    /**
     * @Column(type="integer")
     * @var integer
     */
    protected $event_id;

    /**
     * @Column(type="integer")
     * @var integer
     */
    protected $users_id;

    /**
     * @Column(type="integer")
     * @var integer
     */
    protected $value; //Float

    /**
     * @Column(type="string")
     * @var string
     */
    protected $created_at;

    /**
     *
     *
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     *
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     *
     *
     */
    public function getEventId($event_id)
    {
        return $this->event_id;
    }

    /**
     *
     *
     */
    public function setEventId($event_id)
    {
        $this->event_id = $event_id;
    }

    /**
     *
     *
     */
    public function getUsersId($users_id)
    {
        return $this->users_id;
    }

    /**
     *
     *
     */
    public function setUsersId($users_id)
    {
        $this->users_id = $users_id;
    }

    /**
     *
     *
     */
    public function getValue($value)
    {
        return $this->value;
    }

    /**
     *
     *
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     *
     *
     */
    public function getCreatedAt($created_at)
    {
        return $this->created_at;
    }

    /**
     *
     *
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

 }