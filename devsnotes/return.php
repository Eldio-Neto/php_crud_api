<?php

header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Content-Type:application/; charset=utf-8");

echo json_encode($array);
exit;