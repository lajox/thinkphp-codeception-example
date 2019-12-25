<?php
class User {

    private $_id;
    private $name;

    private static $_nameList = [
        '1' => 'Davert',
        '2' => 'John',
        '3' => 'Lajox',
    ];

    public function __construct($id = '')
    {
        $this->_id = $id;
    }

    public function getName()
    {
        $name = $this->name ? $this->name : (isset(self::$_nameList[$this->_id]) ? self::$_nameList[$this->_id] : null);
        return $name;
    }

    public function add()
    {
    }

    public function save()
    {
    }

    public function sum()
    {
    }

    public function someMethod()
    {
        $this->debugSection('CurrentMethod', __METHOD__);
    }

    /**
     * debug
     */
    public function debugSection($title, $message)
    {
        if (is_object($message)) {
            try {
                $message = var_export($message, true);
            } catch (\Exception $exception) {
                $message = print_r($message, true);
            }
        } else if(is_array($message)) {
            $message = stripslashes(json_encode($message));
        } else if(is_bool($message) || is_null($message)) {
            $message = json_encode($message);
        }
        \codecept_debug("[$title] $message");
    }
}

interface UserRepository {
    function find($id): User;
    function findAll(): array;
}