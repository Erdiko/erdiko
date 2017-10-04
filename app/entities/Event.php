<?php
namespace app\entities;

/**
 * @Entity @Table(name="event")
 */
class Event
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
    protected $users_id;


    /**
     * @Column(type="string")
     * @var string
     */
    protected $description;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $template;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $value_unit;

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

    /**
     * @Column(type="string")
     * @var string
     */
    protected $event_table_name;


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
    public function getDescription($description)
    {
        return $this->description;
    }

    /**
     *
     *
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     *
     *
     */
    public function getTemplate($template)
    {
        return $this->template;
    }

    /**
     *
     *
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }

    /**
     *
     *
     */
    public function getValueUnit($value_unit)
    {
        return $this->value_unit;
    }

    /**
     *
     *
     */
    public function setValueUnit($value_unit)
    {
        $this->value_unit = $value_unit;
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

    /**
     *
     *
     */
    public function getUpdatedAt($updated_at)
    {
        return $this->updated_at;
    }

    
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     *
     *
     */
    public function getEventTableName($event_table_name)
    {
        return $this->event_table_name;
    }

    /**
     *
     *
     */
    public function setEventTableName($event_table_name)
    {
        $this->event_table_name = $event_table_name;
    }

}