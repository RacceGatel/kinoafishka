<?php


class model_genres extends model
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

    public function get_by_name($id)
    {
        $qr = $this->conn->prepare('SELECT * FROM ' . $this->table . ' WHERE name=?');
        $qr->bindValue(1, $id);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
        return $qr->fetchObject();
    }
}