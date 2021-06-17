<?php


class model_users extends model
{
    public function insert($data)
    {
        $qr = $this->conn->prepare('INSERT INTO users(name, email,phone,psw) VALUES (?, ?, ?, ?)');
        $qr->bindParam(1, $data[0], PDO::PARAM_STR);
        $qr->bindParam(2, $data[1], PDO::PARAM_STR);
        $qr->bindParam(3, $data[2], PDO::PARAM_STR);
        $qr->bindParam(4, $data[3], PDO::PARAM_STR);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
    }

    public function get_id_by_name($data)
    {
        $qr = $this->conn->prepare('SELECT id FROM ' . $this->table . ' WHERE name=?');
        $qr->bindValue(1, $data);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
        return $qr->fetchObject();
    }

    public function get_id_by_email($data)
    {
        $qr = $this->conn->prepare('SELECT id FROM ' . $this->table . ' WHERE email=?');
        $qr->bindValue(1, $data);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
        return $qr->fetchObject();
    }

    public function get_id_by_phone($data)
    {
        $qr = $this->conn->prepare('SELECT id FROM ' . $this->table . ' WHERE phone=?');
        $qr->bindValue(1, $data);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
        return $qr->fetchObject();
    }

    public function get_all()
    {
        $qr = $this->conn->prepare('SELECT id,name,perm FROM ' . $this->table );
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
        return $qr->fetchAll();
    }

    public function get_user_by_params($data)
    {
        $qr = $this->conn->prepare('SELECT * FROM ' . $this->table.' WHERE name = ? OR email = ? OR phone = ? ');
        $qr->bindValue(1, $data[0]);
        $qr->bindValue(2, $data[1]);
        $qr->bindValue(3, $data[2]);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
        return $qr->fetchAll();
    }
    
    
    public function get_perm_by_id($name)
    {
        $qr = $this->conn->prepare('SELECT perm FROM ' . $this->table . ' WHERE id=?');
        $qr->bindValue(1, $name);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
        return $qr->fetchObject();
    }

    public function get_perm_by_name($name)
    {
        $qr = $this->conn->prepare('SELECT perm FROM ' . $this->table . ' WHERE name=?');
        $qr->bindValue(1, $name);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
        return $qr->fetchObject();
    }

    public function get_pass_by_id($name)
    {
        $qr = $this->conn->prepare('SELECT psw FROM ' . $this->table . ' WHERE id=?');
        $qr->bindValue(1, $name);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
        return $qr->fetchObject();
    }

    public function update_name($id, $data)
    {
        $qr = $this->conn->prepare('UPDATE users SET name = ? WHERE id= ?');
        $qr->bindParam(1, $data);
        $qr->bindParam(2, $id);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
    }

    public function update_email($id, $data)
    {
        $qr = $this->conn->prepare('UPDATE users SET email = ? WHERE id= ?');
        $qr->bindParam(1, $data);
        $qr->bindParam(2, $id);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
    }

    public function update_phone($id, $data)
    {
        $qr = $this->conn->prepare('UPDATE users SET phone = ? WHERE id= ?');
        $qr->bindParam(1, $data);
        $qr->bindParam(2, $id);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
    }

    public function update_psw($id, $data)
    {
        $qr = $this->conn->prepare('UPDATE users SET psw = ? WHERE id= ?');
        $qr->bindParam(1, $data);
        $qr->bindParam(2, $id);
        if ($qr->execute()) {
            http_response_code(200);
        } else {
            http_response_code(400);
            exit;
        }
    }
}