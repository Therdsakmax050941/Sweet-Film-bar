<?php 
class Database {
    private $host;
    private $username;
    private $password;
    private $database;
    private $connection ; 

    public function __construct($host, $username, $password, $database) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        
        try {
            $dsn = "mysql:host=$host;dbname=$database;charset=utf8";
            $this->connection = new PDO($dsn, $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("เชื่อมต่อฐานข้อมูลไม่สำเร็จ: " . $e->getMessage());
        }
    }

    public function query($sql, $params = array()) {
        $statement = $this->connection->prepare($sql);
        $statement->execute($params);
        return $statement;
    }

    public function insert($table, $data) {
        $columns = implode(", ", array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        
        try {
            $this->connection->exec($sql);
            return "บันทึกข้อมูลเรียบร้อยแล้ว";
        } catch (PDOException $e) {
            return "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $e->getMessage();
        }
    }

    public function close() {
        $this->connection = null;
    }
}
?>
