<?php
    $servername = "192.168.56.104";
    $username = "user1";
    $password = "123321";
    $db_name = "lab2";
    $bd = new mysqli($servername, $username, $password, $db_name);
    mysqli_set_charset ($bd, "utf8");

    function get_film($id) {
        global $bd;
        $qr = $bd -> query("SELECT * FROM films WHERE id LIKE $id");
        return $qr;
    }

    function get_film_name($id) {
        global $bd;
        $qr = $bd -> query("SELECT * FROM films WHERE id LIKE $id");
        foreach($qr as $cat) {
            return $cat["name"];
        }
    }

    function get_film_trailer($id) {
        global $bd;
        $qr = $bd -> query("SELECT * FROM films WHERE id LIKE $id");
        foreach($qr as $cat) {
            return $cat["lnk_trailer"];
        }
    }

    function get_film_describe($id) {
        global $bd;
        $qr = $bd -> query("SELECT * FROM films WHERE id LIKE $id");
        foreach($qr as $cat) {
            return $cat["describe"];
        }
    }

    function get_film_rate($id) {
        global $bd;
        $qr = $bd -> query("SELECT * FROM films WHERE id LIKE $id");
        foreach($qr as $cat) {
            return $cat["rate"];
        }
    }


    function get_film_count() {
        global $bd;
        $qr = $bd -> query("SELECT COUNT(*) FROM films");
        $row=mysqli_fetch_array($qr);
        return $row[0];
    }

    function get_genre_name($id) {
        global $bd;
        $qr = $bd -> query("SELECT * FROM genres WHERE id LIKE $id");
        foreach($qr as $cat) {
            return $cat["name"];
        }
    }

    function get_film_genre($id) {
        global $bd;
        $qr = $bd -> query("SELECT idgenre FROM genrefilms WHERE idfilm LIKE $id");
        $row=mysqli_fetch_array($qr);
        return $row[0];
    }

    function get_genre_count() {
        global $bd;
        $qr = $bd -> query("SELECT COUNT(*) FROM genres");
        $row=mysqli_fetch_array($qr);
        return $row[0];
    }

    function searchFilm($str)
    {
        global $bd;

        if (!empty($str)) {
            if (strlen($str) > 0 || strlen($str) < 50) {

                $q = $bd -> query("SELECT id FROM films WHERE name LIKE '$str'");
                if(empty($q))
                {
                    return 0;
                }
                $row=mysqli_fetch_array($q);
                return $row[0];
            }
        }
    }

    function searchGenre ($str)
    {
        global $bd;

        if (!empty($str)) {
            if (strlen($str) > 0 || strlen($str) < 50) {

                $q = $bd -> query("SELECT id FROM genres WHERE name LIKE '$str'");
                if(empty($q))
                {
                    return 0;
                }
                $row=mysqli_fetch_array($q);
                return $row[0];
            }
        }
    }

    function get_film_age($id) {
        global $bd;
        $q= $bd->query("SELECT age FROM films WHERE id LIKE $id");
        $row = mysqli_fetch_array($q);
        return $row[0];
    }
?>