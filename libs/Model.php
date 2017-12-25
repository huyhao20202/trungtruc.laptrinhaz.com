<?php

class Model
{
    protected $conn;
    protected $database = DB_NAME;
    protected $table = DB_TABLE;
    protected $resultQuery;

    public function __construct()
    {
        try {
            $this->conn = new PDO ("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connected failed: " . $e->getMessage();
            die();
        }

    }

    public function __destruct()
    {
        $this->conn = null;
    }

    // SET TABLE
    public function setTable($table)
    {
        $this->table = $table;
    }

    // UPDATE
    public function update($table, $data, $where)
    {
        $newSet = $this->createUpdateSQL($data);
        $newWhere = $this->createUpdateSQL($where);
        $query = "UPDATE `$table` SET " . $newSet . " WHERE $newWhere";
        $this->execute($query);
    }

    // CREATE UPDATE SQL
    public function createUpdateSQL($data)
    {
        $newQuery = "";
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $newQuery .= ", `$key` = '$value'";
            }
        }
        $newQuery = substr($newQuery, 2);
        return $newQuery;
    }

    // CREATE WHERE UPDATE
    public function createWhereUpdateSQL($data)
    {
        $newWhere = '';
        if (!empty($data)) {
            foreach ($data as $value) {
                $newWhere[] = "`$value[0]` = '$value[1]'";
                $newWhere[] = $value[2];
            }
            $newWhere = implode(" ", $newWhere);
        }
        return $newWhere;
    }

    // SHOW ALL
    public function showAll($table)
    {
        $stmt = $this->conn->prepare("SELECT * FROM `$table` ORDER BY `name`");
        $stmt->execute();
        return $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // SHOW
    public function show($table, $id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM `$table` WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $data = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // SELECT
    public function select($table, $id = null, $return = false)
    {
        $query = "SELECT * FROM `$table` AS `t1`";
        $query .= " WHERE `id` > 0";
        if ($id)
            $query .= " AND id=:id";
        $stmt = $this->conn->prepare($query);
        if ($id)
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        if ($return)
            return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // EXECUTE QUERY
    public function execute($sql, $return = false)
    {

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        if ($return == true)
            return $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // IS EXIST
    public function isExist($query)
    {
        if ($query != null) {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $this->resultQuery = $stmt->rowCount();
        }
        if ($this->resultQuery < 1) {
            return false;
        }
        return true;
    }

    // CREATE INSERT
    public function createInsertSQL($data)
    {
        $newQuery = array();
        $cols = '';
        $vals = '';
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $cols .= ", `$key`";
                $vals .= ", '$value'";
            }
        }
        $newQuery['cols'] = substr($cols, 2);
        $newQuery['vals'] = substr($vals, 2);
        return $newQuery;
    }

    // INSERT
    public function insert($table, $data, $type = 'single')
    {
        if ($type == 'single') {
            $newQuery = $this->createInsertSQL($data);
            $query = "INSERT INTO `$table`(" . $newQuery['cols'] . ") VALUES (" . $newQuery['vals'] . ")";
            $this->execute($query);
        } else {
            foreach ($data as $value) {
                $newQuery = $this->createInsertSQL($value);
                $query = "INSERT INTO `$table`(" . $newQuery['cols'] . ") VALUES (" . $newQuery['vals'] . ")";
                $this->execute($query);
            }
        }
    }

    // DELETE
    public function delete($table, $where)
    {
        $newWhere = $this->createWhereDeleteSQL($where);
        $query = "DELETE FROM `$table` WHERE `id` IN ($newWhere)";
        $this->execute($query);
    }

    // CREATE WHERE DELETE
    public function createWhereDeleteSQL($data)
    {
        $newWhere = '';
        if (!empty($data)) {
            foreach ($data as $id) {
                $newWhere .= "'" . $id . "', ";
            }
            $newWhere .= "'0'";
        }
        return $newWhere;
    }
}

?>
