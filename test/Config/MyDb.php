<?php

namespace Config;

use Interfaces\DbInterface;
use mysqli;

class MyDb implements DbInterface
{
    private $host = null;
    private $dbName = null;
    private $user = null;
    private $pass = null;
    private $port = null;
    /** @var mysqli  */
    private $conn = null;

    public function __construct($option)
    {
        if (isset($option['host'])) $this->host = $option['host']; else throw new \Exception('Invalid host');
        if (isset($option['db_name'])) $this->dbName = $option['db_name']; else throw new \Exception('Invalid db name');
        if (isset($option['user'])) $this->user = $option['user']; else throw new \Exception('Invalid user');
        if (isset($option['pass'])) $this->pass = $option['pass']; else throw new \Exception('Invalid pass');
        if (isset($option['port'])) $this->port = $option['port'];
    }

    public function getConnect()
    {
        if(empty($this->conn))
        {
            $mysqli = new mysqli($this->host, $this->user,$this->pass,$this->dbName, $this->port);

            if ($mysqli->connect_error)
            {
                throw new \Exception('Error connection (' . $mysqli->connect_errno . ') '
                    . $mysqli->connect_error);
            }
            $this->conn = $mysqli;
        }

        return $this->conn;
    }

    public function getInsertId()
    {
        return $this->conn->insert_id;
    }

    public function query($query)
    {
        $conn = $this->getConnect();
        $res = $conn->query($query);
        if ($conn->errno)
        {
            throw new \Exception('Error query (' . $conn->errno . ') '
                . $conn->error .' | query: '. $query);
        }
        return $res;
    }

    public function escape($val) : string
    {

        return is_null($val) ? 'null' : '"'.$this->getConnect()->real_escape_string($val).'"';
    }

    public function close()
    {
        if($this->getConnect())
        {
            $this->getConnect()->close();
        }
    }

}