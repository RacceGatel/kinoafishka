<?php


class model_employed_place extends Model
{
    public function insert($data)
    {
        $qr = $this->conn->prepare('INSERT INTO employed_place(idhalls,idplace) VALUES (?,?)');
        $qr->bindValue(1, $data[0]);
        $qr->bindValue(2, $data[1]);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
    }

    public function delete_by_idhalls($id)
    {
        $qr = $this->conn->prepare('DELETE FROM employed_place WHERE idhalls = ?');
        $qr->bindValue(1, $id);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            echo json_encode($qr->errorInfo());
            exit;
        }
    }

    public function get_by_idhall($id){
        $qr = $this->conn->prepare('SELECT * FROM employed_place WHERE idhalls = ?');
        $qr->bindValue(1, $id);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);

        }
        return $qr->fetchAll();
    }
}