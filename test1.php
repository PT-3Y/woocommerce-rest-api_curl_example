<?php

// WooCommerce API endpoint for retrieving orders
$api_url = 'https://your_wp_site_url//wp-json/wc/v3/orders';

// WooCommerce API credentials
$consumer_key = '';
$consumer_secret = '';

// Set the authentication credentials
$auth = base64_encode($consumer_key . ':' . $consumer_secret);

// Set the request headers
$headers = array(
    'Content-Type: application/json',
    'Authorization: Basic ' . $auth
);
// Initialize cURL
$ch = curl_init();

// Set the cURL options
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Execute the cURL request
$response = curl_exec($ch);

// Get the response status code
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Close cURL
curl_close($ch);

// Check the response status code
if ($status_code === 200) {
    $orders = json_decode($response, true);
    $order_ids = array_column($orders, 'id');
    $status = array_column($orders, 'status');
    echo 'Order IDs: ' . implode(', ', $status);
} else {
    echo 'Failed to retrieve orders. Status code: ' . $status_code;
    echo 'Response: ' . $response;
} 
?>