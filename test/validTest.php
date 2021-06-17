<?php
require_once dirname(__FILE__) . '/bootstrap.php';
require_once dirname(__FILE__,2) . '../app/models/model_users.php';

class validTest extends PHPUnit\Framework\TestCase
{
    public function testFirst() {
        //задали существующего тестового пользователя вручную
        $user = array('name'=>'uncorrect_user','psw'=>'123456');

        //проверка находит ли пользователя в базе данных
        $this->assertNotEmpty($find_user_id = (new model_users())->get_id_by_name($user['name'])->id);

        //проверка находит ли пароль пользователя в базе данных
        $this->assertNotEmpty($find_pass = (new model_users())->get_pass_by_id($find_user_id)->psw);

        //проверка на совпадения пароля
        $this->assertSame(md5($user['psw']),$find_pass);
    }
}