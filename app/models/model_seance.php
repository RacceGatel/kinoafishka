<?php


class model_seance extends model
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

    public function get_by_idfilm_order_by_date_time($id)
    {
        $qr = $this->conn->prepare('SELECT * FROM ' . $this->table . ' WHERE idfilm=? ORDER BY date,time');
        $qr->bindValue(1, $id);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
        return $qr->fetchAll();
    }

    public function get_by_idseance($id)
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

    public function insert($data)
    {
        $qr = $this->conn->prepare('INSERT INTO seance(idfilm,idhall,idcinema,date,time) VALUES (?,?,?,?,?)');
        $qr->bindValue(1, $data[0]);
        $qr->bindValue(2, $data[1]);
        $qr->bindValue(3, $data[2]);
        $qr->bindValue(4, $data[3],PDO::PARAM_STR);
        $qr->bindValue(5, $data[4],PDO::PARAM_STR);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
    }

    public function get_row_by_params($data)
    {
        $qr = $this->conn->prepare('SELECT * FROM ' . $this->table . ' WHERE idfilm=? AND idcinema=? AND date = ? AND time = ?');
        $qr->bindParam(1, $data[0]);
        $qr->bindParam(2, $data[1]);
        $qr->bindParam(3, $data[2]);
        $qr->bindParam(4, $data[3]);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
        return $qr->fetchObject();
    }
}