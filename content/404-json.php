<?php
header("Content-Type: application/json");

$data = [
   "code" => 404,
   "message" => "Not Found"
];

echo json_encode($data);
