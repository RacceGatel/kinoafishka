<?php


class model_orders extends Model
{
    public function insert($data)
    {
        $qr = $this->conn->prepare('INSERT INTO orders(idclient,idseance,idhall,idplace) VALUES (?,?,?,?)');
        $qr->bindValue(1, $data[0]);
        $qr->bindValue(2, $data[1]);
        $qr->bindValue(3, $data[2]);
        $qr->bindValue(4, $data[3]);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            echo json_encode($qr->errorInfo());
            exit;
        }
    }

    public function exist_id_by_idclient($id, $idclient)
    {
        $qr = $this->conn->prepare('SELECT * FROM orders WHERE id = ? AND idclient = ?');
        $qr->bindValue(1, $id);
        $qr->bindValue(2, $idclient);
        if ($qr->execute()) {
            http_response_code(200);
            return $qr->fetchAll();
        } else {
            http_response_code(400);
            echo json_encode($qr->errorInfo());
            exit;
        }
    }

    public function delete_by_id($id)
    {
        $qr = $this->conn->prepare('DELETE FROM orders WHERE id = ?');
        $qr->bindValue(1, $id);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            echo json_encode($qr->errorInfo());
            exit;
        }
    }
}