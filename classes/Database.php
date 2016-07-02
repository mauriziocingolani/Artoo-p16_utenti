<?php

class Database extends mysqli {

    private $_host;
    private $_utente;
    private $_password;

    public function __construct($host, $utente, $password) {
        @parent::__construct($host, $utente, $password);
        $this->_host = $host;
        $this->_utente = $utente;
        $this->_password = $password;
        if ($this->connect_errno > 0)
            throw new Exception($this->connect_error
            , $this->connect_errno);
    }

    public function getDatabases() {
        return $this->executeQuery("SHOW DATABASES");
    }

    public function useDatabase($database) {
        return $this->executeQuery("USE $database");
    }

    public function getTables() {
        return $this->executeQuery("SHOW TABLES");
    }

    public function getAllRecords($table) {
        return $this->executeQuery(
                        "SELECT * FROM $table"
        );
    }

    public function executeQuery($query) {
        $result = $this->query($query);
        if ($this->errno > 0) :
            throw new Exception($this->error, $this->errno);
        else :
            if ($result instanceof mysqli_result) :
                $data = array();
                while (($r = $result->fetch_object()) != null) :
                    $data[] = $r;
                endwhile;
                return $data;
//                return $result->fetch_all();
            else :
                return true;
            endif;
        endif;
    }

}
