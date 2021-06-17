<?php


class model_comments extends Model
{
    public function get_all_by_idfilm($idfilm) {
        $qr = $this->conn->prepare('SELECT * FROM ' . $this->table . ' WHERE idfilm=?');
        $qr->bindValue(1, $idfilm);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
        return $qr->fetchAll();
    }

    public function insert($data)
    {
        $qr = $this->conn->prepare('INSERT INTO comments(idfilm, iduser,date,comment,rate) VALUES (?, ?, ?, ?, ?)');
        $qr->bindParam(1, $data[0]);
        $qr->bindParam(2, $data[1]);
        $qr->bindParam(3, $data[2]);
        $qr->bindParam(4, $data[3], PDO::PARAM_STR);
        $qr->bindParam(5, $data[4]);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
    }

    public function get_exist_by_iduser_idfilm($iduser,$idfilm) {
        $qr = $this->conn->prepare('SELECT Count(id) FROM ' . $this->table . ' WHERE iduser=? AND idfilm = ?');
        $qr->bindValue(1, $iduser);
        $qr->bindValue(2, $idfilm);
        if ($qr->execute()) {
            return $qr->fetch()[0];
        }
    }
}