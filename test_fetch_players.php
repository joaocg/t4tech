<?php

// Your API key
$apiKey = 'eabe2808-4427-4606-832d-c83bf8f1cbc3'; // Replace with your actual API key

// Base URL of the BallDontLie API
$baseUrl = 'https://api.balldontlie.io/v1/players';

// Initialize cURL
$ch = curl_init();

// Set the URL and headers
curl_setopt($ch, CURLOPT_URL, $baseUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: ' . $apiKey,
    'Accept: application/json',
]);

// Execute the cURL request
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'cURL Error: ' . curl_error($ch) . "\n";
} else {
    // Get the HTTP response code
    $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    echo "HTTP Response Code: " . $responseCode . "\n";

    // If the response code is 200 (OK), decode and display the response
    if ($responseCode === 200) {
        $data = json_decode($response, true);
        print_r($data);
    } else {
        echo "Unexpected response code: " . $responseCode . "\n";
        echo "Response: " . $response . "\n";
    }
}

// Close cURL session
curl_close($ch);