<?php


class model_genrefilms extends model
{
    public function get_genre_by_idfilm($id)
    {
        $qr = $this->conn->prepare('SELECT idgenre FROM ' . $this->table . ' WHERE idfilm=?');
        $qr->bindValue(1, $id);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
        return $qr->fetchAll();
    }

    public function get_film_by_idgenre($id)
    {
        $qr = $this->conn->prepare('SELECT idfilm FROM ' . $this->table . ' WHERE idgenre=?');
        $qr->bindValue(1, $id);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
        return $qr->fetchAll();
    }
}