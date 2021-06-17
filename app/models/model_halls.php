<?php


class model_halls extends Model
{
    public function insert($data)
    {
        $qr = $this->conn->prepare('INSERT INTO halls(num,size,`rows`,`spots`) VALUES (?,?,?,?)');
        $qr->bindValue(1, $data[0]);
        $qr->bindValue(2, $data[1]);
        $qr->bindValue(3, $data[2]);
        $qr->bindValue(4, $data[3]);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
    }

    public function get_row_by_num($num)
    {
        $qr = $this->conn->prepare('SELECT * FROM ' . $this->table . ' WHERE num=?');
        $qr->bindParam(1, $num);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
        return $qr->fetchObject();
    }


}