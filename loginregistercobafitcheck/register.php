<?php
include 'connection.php';

if($_POST){

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);

    $response = [];

    $userQuery = $connection->prepare("SELECT * FROM user where username = ?");
    $userQuery->execute(array($username));

    if($userQuery->rowCount() != 0){
        $response['status'] = false;
        $response['message'] = "Akun sudah terdaftar";

    }else{
        $insertAcc = 'INSERT INTO user (username, password, nama) values (:username, :password, :nama)';
        $statement = $connection->prepare($insertAcc);

        try{
            $statement->execute([
                ':username' => $username,
                ':password' => md5($password),
                ':nama' => $nama

            ]);

            $response['status'] = true;
            $response['message'] = 'Selamat! Akun sudah terdaftar';
            $response['data'] = [
                'username' => $username,
                'nama' => $nama
            ];
        }catch (Exception $e){
            die($e->getMessage());
        }

    }
    //jadikan data json
    $json = json_encode($response, JSON_PRETTY_PRINT);

    echo $json;
    
}