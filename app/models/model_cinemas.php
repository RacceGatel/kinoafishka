<?php


class model_cinemas extends model
{
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
        return $qr->fetchObject();
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

    public function insert($name)
    {
        $qr = $this->conn->prepare('INSERT INTO cinemas(name) VALUES (?)');
        $qr->bindValue(1, $name, PDO::PARAM_STR);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
    }
}