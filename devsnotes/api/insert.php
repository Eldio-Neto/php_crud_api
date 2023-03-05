<?php
require '../config.php';
$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method === 'post') {
    $title = $_REQUEST['title'] ? $_REQUEST['title'] : '#';
    $body = $_REQUEST['body'] ? $_REQUEST['body'] : '#';
    if ( $title != '#' && $body != '#') {
        
        $sql= $pdo->prepare("Insert into notes (title, body) values (:title, :body)");
        $sql->bindValue(":title", $title);
        $sql->bindValue(":body", $body);
        $sql->execute();
       
        $id= $pdo->lastInsertId();
        $array['result']=[
            'id'=>$id,
            'title'=>$title,
            'body'=>$body
        ];
    } else {
        $array['error'] = 'Parâmetros não foram passados corretamente!';
    }
} else {
    $array['error'] = 'Método não permitido!';
}

require '../return.php';
