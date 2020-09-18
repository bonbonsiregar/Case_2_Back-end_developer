<?php
class Product{
 
    // database connection and table name
    private $conn;
    private $table_name = "categories";
 
    // object properties
    public $id;
    public $nama;
    public $email;
    public $no_hp;
    public $pekerjaan;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

function read(){
 
    // select all query
    $query = "SELECT
                *
            FROM
                " . $this->table_name . " 
                ";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}

function create(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                id=:id, nama=:nama, email=:email, no_hp=:no_hp, pekerjaan=:pekerjaan";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
    $this->nama=htmlspecialchars(strip_tags($this->nama));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->no_hp=htmlspecialchars(strip_tags($this->no_hp));
    $this->pekerjaan=htmlspecialchars(strip_tags($this->pekerjaan));
 
    // bind values
    $stmt->bindParam(":id", $this->id);
    $stmt->bindParam(":nama", $this->nama);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":no_hp", $this->no_hp);
    $stmt->bindParam(":pekerjaan", $this->pekerjaan);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}

function readOne(){
 
    // query to read single record
    $query = "SELECT
                *
            FROM
                " . $this->table_name . "
            WHERE
                p.id = ?";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 

    $stmt->bindParam(1, $this->id);
 
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->id = $row['id'];
    $this->nama = $row['nama'];
    $this->email = $row['email'];
    $this->no_hp = $row['no_hp'];
    $this->pekerjaan = $row['pekerjaan'];
}

}
?>