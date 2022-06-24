<?php

include 'connection.php';

if($_POST){

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $response = []; //tempat untuk data

    //cek username didalam database
    $userQuery = $connection->prepare("SELECT * FROM user where username = ?");
    $userQuery->execute(array($username));
    $query = $userQuery->fetch();

    if($userQuery->rowCount() == 0){
        $response['status'] = false;
        $response['message'] = "Username Tidak Terdaftar";
    }else {
        //ambil password
        $passwordDB = $query['password'];


        if(strcmp(md5($password),$passwordDB) === 0){
            $response['status'] = true;
            $response['message'] = "Login Berhasil";
            $response['data'] = [
                'user_id' => $query['id'],
                'username' => $query['username'],
                'nama' => $query['nama']
            ];
        } else {
            $response['status'] = false;
            $response['message'] = "Password salah";
        }
    }

    //jadikan data json
    $json = json_encode($response, JSON_PRETTY_PRINT);

    echo $json;



}
