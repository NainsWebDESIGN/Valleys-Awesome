<?php
header('Content-Type: application/json; charset=UTF-8'); //設定資料類型為 json，編碼 utf-8
if ($_SERVER['REQUEST_METHOD'] == "POST") { //如果是 POST 請求
    $data = array();
        $DB_server = "localhost"; # 你的網域IP
        $DB_user = "Nains"; # 你的帳號
        $DB_pass = "a7912212"; # 你的密碼
        $DB_name = "Nains_DB"; # 你的資料庫

    $connection = new mysqli($DB_server, $DB_user, $DB_pass, $DB_name);

    $contact = "contact"; #資料表名稱
    $sqlContact = "SELECT * FROM $contact;"; #查詢資料表

    if($connection -> connect_error){
        $data = array( 'failed' => $connection -> connect_error );
    }else{
        // $data = array( 'succes' => "成功連線到資料庫" );
        if($result = $connection->query($sqlContact)){
            while($row = $result->fetch_row()){
                array_push($data, array('media' => $row[0], 'href' => $row[1], 'style' => $row[2]));
            }
        }else{
            $data = array( 'selectFailed' => $connection->error );
        }
        $result->close();
    }
    $connection->close();
    echo json_encode($data);
} else {
    //回傳 errorMsg json 資料
        $data = array( 'errorMsg' => '請求無效，只允許 POST 方式訪問！' );
    echo json_encode($data);
}
?>