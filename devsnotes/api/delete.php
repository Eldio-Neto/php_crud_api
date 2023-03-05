<?php
require '../config.php';
$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method === 'delete') {

    $id = $_REQUEST['id'] ?? '#';
   
    if ($id != '#') {
        $sql = $pdo->prepare('DELETE FROM notes WHERE id= :id');
        $sql->bindValue(':id', $id);
        $sql->execute();
        $array['result']=[
            'id'=>$id
        ];
    } else {
        $array['error'] = 'Parâmetros não foram passados!';
    }
} else {
    $array['error'] = 'Método não permitido!';
}

require '../return.php';
