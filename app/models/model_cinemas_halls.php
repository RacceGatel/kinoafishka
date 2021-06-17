<?php


class model_cinemas_halls extends Model
{
    public function insert($data)
    {
        $qr = $this->conn->prepare('INSERT INTO cinemas_halls(idcinema,idhall) VALUES (?,?)');
        $qr->bindValue(1, $data[0]);
        $qr->bindValue(2, $data[1]);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
    }

    public function delete_by_id($id)
    {
        $qr = $this->conn->prepare('DELETE FROM cinemas_halls WHERE idcinema = ? AND idhall = ?');
        $qr->bindValue(1, $id[0]);
        $qr->bindValue(2, $id[1]);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            echo json_encode($qr->errorInfo());
            exit;
        }
    }

    public function get_all(){
        $qr = $this->conn->query('SELECT * FROM cinemas_halls');
        return $qr->fetchAll();
    }
}