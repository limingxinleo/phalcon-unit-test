<?php

namespace App\Models;

class Seeds extends Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="id", type="integer", length=11, nullable=false)
     */
    public $id;

    /**
     *
     * @var integer
     * @Column(column="uid", type="integer", length=10, nullable=false)
     */
    public $uid;

    /**
     *
     * @var string
     * @Column(column="name", type="string", length=32, nullable=false)
     */
    public $name;

    /**
     *
     * @var string
     * @Column(column="created_at", type="string", nullable=true)
     */
    public $created_at;

    /**
     *
     * @var string
     * @Column(column="updated_at", type="string", nullable=true)
     */
    public $updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("phalcon");
        $this->setSource("seeds");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        throw new \Exception('You must rewrite getSource');
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Seeds[]|Seeds|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Seeds|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public static function getInstance($uid)
    {
        if ($uid % 2 === 0) {
            $schema_id = 2;
        } else {
            $schema_id = 1;
        }
        $className = 'Model' . $schema_id;
        $class = sprintf("%s\\%s", get_called_class(), $className);
        return new $class;
    }
}
