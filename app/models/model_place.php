<?php


class model_place extends Model
{
    public function insert($data)
    {
        $qr = $this->conn->prepare('INSERT INTO place(id,row,spot) VALUES (?,?,?)');
        $qr->bindValue(1, $data[0]);
        $qr->bindValue(2, $data[1]);
        $qr->bindValue(3, $data[2]);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
    }

    public function get_by_id_range($data)
    {
        $qr = $this->conn->prepare('SELECT * FROM ' . $this->table . ' WHERE id BETWEEN ? AND ? GROUP BY row');
        $qr->bindValue(1, $data[0]);
        $qr->bindValue(2, $data[1]);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
        return $qr->fetchAll();
    }

    public function update_by_id_free($data)
    {
        $qr = $this->conn->prepare('UPDATE ' . $this->table . ' SET free = ? WHERE id = ?');
        $qr->bindValue(1, $data[0]);
        $qr->bindValue(2, $data[1]);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
        return $qr->fetchAll();
    }


}