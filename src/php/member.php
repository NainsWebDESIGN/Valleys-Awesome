<?php
header('Content-Type: application/json; charset=UTF-8'); //設定資料類型為 json，編碼 utf-8
if ($_SERVER['REQUEST_METHOD'] == "POST") { //如果是 POST 請求
    require 'function.php';

    @$username = $_POST['username']; //取得 username POST 值
    @$password = $_POST['password']; //取得 password POST 值

    $sqlTable = "SELECT * FROM `member` WHERE username = '" . $username . "' AND password = '" . $password . "';"; #查詢資料表

    if ($conn->connect_error) {
        $data = array('ret' => $conn->connect_error);
    } else {
        if ($result = $conn->query($sqlTable)) {
            while ($row = $result->fetch_row()) {
                $db_username = $row[0];
                $db_password = $row[1];
            }
            $Check = $db_username == $username && $db_password == $password;
            if ($Check) {
                $data = array('login' => true);
            } else {
                $data = array('login' => false);
            }
            $result->close();
        } else {
            $data = array('ret' => $conn->error);
        }
    }
    $conn->close();
    echo json_encode($data);
} else {
    //回傳 errorMsg json 資料
    $data = array('ret' => '請求無效，只允許 POST 方式訪問！');
    echo json_encode($data);
}
