<?php
require 'vendor/autoload.php';
use Illuminate\Support\Facades\Http;

// Mocking the environment for a standalone script
$username = "thedung_106";
echo "Testing resolve for: $username\n";

try {
    $response = @file_get_contents("http://127.0.0.1:8080/api/resolve", false, stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => "Content-type: application/json\r\n",
            'content' => json_encode(['username' => $username]),
            'timeout' => 5
        ]
    ]));

    if ($response === false) {
        echo "Error: Could not reach engine or engine returned error.\n";
        print_r($http_response_header);
    } else {
        echo "Response: $response\n";
    }
} catch (Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n";
}
