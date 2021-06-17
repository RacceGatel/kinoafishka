<?php
require_once _app . "/models/model_film_cinemas.php";

class model_film_cinemas extends Model
{
    public function get_seance_places($idhall, $idseance)
    {
        $qr = $this->conn->prepare('SELECT place.id, place.row, place.spot, place.price, place.vip, place.free, orders.idclient as free
                                            FROM place
                                            INNER JOIN employed_place on employed_place.idhalls= ? AND employed_place.idplace = place.id
                                            LEFT JOIN orders on orders.idseance = ? AND orders.idplace = place.id;
                                    ');
        $qr->bindValue(1, $idhall);
        $qr->bindValue(2, $idseance);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
        return $qr->fetchAll();
    }

    public function get_cinemas_by_film($idfilm)
    {
        $qr = $this->conn->prepare('SELECT cinemas.id, cinemas.name FROM cinemas 
                                    INNER JOIN seance ON seance.idcinema = cinemas.id && seance.idfilm = ?');
        $qr->bindValue(1, $idfilm);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
        return $qr->fetchAll();
    }

    public function get_film_about_seances($idfilm)
    {
        $qr = $this->conn->prepare('SELECT seance.id, seance.idcinema,
                                    seance.idfilm, seance.idhall, cinemas.name, halls.num, halls.rows,
                                     halls.spots, seance.date, seance.time
                                    FROM seance 
                                    INNER JOIN halls ON halls.id = seance.idhall
                                    INNER JOIN cinemas ON cinemas.id = seance.idcinema
                                    WHERE seance.idfilm=?');
        $qr->bindValue(1, $idfilm);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            echo json_encode($qr->errorInfo());
            exit;
        }
        return $qr->fetchAll();
    }

    public function get_orders_by_id($id)
    {
        $qr = $this->conn->prepare('SELECT orders.id, place.id as idplace, films.name as film, cinemas.name, seance.date, seance.time, halls.num,
                                                place.price, place.vip, place.row,place.spot
                                    FROM orders 
                                    INNER JOIN halls ON halls.id = orders.idhall
                                    INNER JOIN seance ON seance.id = orders.idseance
                                    INNER JOIN cinemas ON cinemas.id = seance.idcinema
                                    INNER JOIN place ON place.id = orders.idplace
                                    INNER JOIN films ON films.id = seance.idfilm
                                    WHERE orders.idclient = ?');
        $qr->bindValue(1, $id);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            echo json_encode($qr->errorInfo());
            exit;
        }
        return $qr->fetchAll();
    }
}