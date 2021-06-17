<?php
class Model_Film extends Model {

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->Connect();
        $this->table = "films";
    }

    public function insert($data)
    {
        $qr = $this->conn->prepare('INSERT INTO films(name, `describe`, `lnk_trailer`, age) VALUES (?, ?, ?, ?)');
        $qr->bindParam(1, $data[0], PDO::PARAM_STR);
        $qr->bindParam(2, $data[1], PDO::PARAM_STR);
        $qr->bindParam(3, $data[2], PDO::PARAM_STR);
        $qr->bindParam(4, $data[3], PDO::PARAM_INT);

        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            echo json_encode($qr->errorInfo());
            exit;
        }
    }

    public function update_rate_by_id($data)
    {
        $qr = $this->conn->prepare('UPDATE films SET rate = ? WHERE id = ?');
        $qr->bindValue(1, $data[0]);
        $qr->bindValue(2, $data[1]);

        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            echo json_encode($qr->errorInfo());
            exit;
        }
    }

    public function get_by_name($name){
        $qr = $this->conn->prepare('SELECT * FROM ' . $this->table . ' WHERE name LIKE "%'.$name.'%"');
        //$qr->bindValue(1, $name, PDO::PARAM_STR);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            
        }
        return $qr->fetchAll();
    }

    public function get_by_id($id)
    {
        $qr = $this->conn->prepare('SELECT * FROM ' . $this->table . ' WHERE id=?');
        $qr->bindValue(1, $id);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
        return $qr->fetch();
    }

    public function get_id_by_name($name)
    {
        $qr = $this->conn->prepare('SELECT id FROM ' . $this->table . ' WHERE name=?');
        $qr->bindValue(1, $name);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
        return $qr->fetchObject();
    }
}