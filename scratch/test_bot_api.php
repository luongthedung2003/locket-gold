<?php

$url = "http://127.0.0.1:8080/api/activate";
$payload = [
    "uid" => "B0HqJ8bsIAPoPxee7HocWbqUa6p2", // thedung_106
    "username" => "thedung_106"
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);

$response = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);

echo "Status: " . $info['http_code'] . "\n";
echo "Response: " . $response . "\n";
