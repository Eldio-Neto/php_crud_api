<?php
require '../config.php';
$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method === 'get') {
    $id = $_REQUEST['id'] ? $_REQUEST['id'] : '#';

    if ($id != '#') {
        $sql = $pdo->prepare("Select * from notes where id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            $array['result'] = [
                'id' => $data['id'],
                'title' => $data['title'],
                'body' => $data['body']
            ];
        } else {
            $array['error'] = 'Esse id nao Existe!';
        }
    } else {
        $array['error'] = 'Parâmetro ID não identificado!';
    }
} else {
    $array['error'] = 'Método não permitido!';
}

require '../return.php';
