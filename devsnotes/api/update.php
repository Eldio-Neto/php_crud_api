<?php
require '../config.php';
$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method === 'put') {
    $id = $_REQUEST['id'] ?? '#';
    $sql = $pdo->prepare('SELECT * FROM notes WHERE id= :id');
    $sql->bindValue(':id', $id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        parse_str(file_get_contents('php://input'), $input);
        $title = filter_var($input['title'] ?? '#');
        $body = filter_var($input['body'] ?? '#');

        if ($id != '#' && $title != '#' && $body != '#') {
            $sql = $pdo->prepare('Update notes Set body= :body, title= :title');
            $sql->bindValue(':body', $body);
            $sql->bindValue(':title', $title);
            $sql->execute();
            $array['result'] = [
                'id' => $id,
                'title' => $title,
                'body' => $body
            ];
        } else {
            $array['error'] = 'Parâmetros não foram passados!';
        }
    }else{
        $array['error'] = 'O id não foi encontrado!';
    }
} else {
    $array['error'] = 'Método não permitido!';
}

require '../return.php';
