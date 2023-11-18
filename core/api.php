<?php
header("Content-Type: application/json"); // Set the response content type to JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the POST request
    $banner_title = isset($_POST['banner_title']) ? $_POST['banner_title'] : null;
    $banner_desc = isset($_POST['banner_desc']) ? $_POST['banner_desc'] : null;
    $fileNames = isset($_POST['fileName']) ? $_POST['fileName'] : null;

    if ($banner_title !== null && $banner_desc !== null && $fileNames !== null) {
        // Process the data and perform any necessary operations
        // For this example, we'll simply return the received data in a JSON response

        $response = [
            'status' => 'success',
            'message' => 'Data received successfully',
        ];

        echo json_encode($response);
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Incomplete data received',
        ];

        echo json_encode($response);
    }
} else {
    // Handle other HTTP request methods, if needed
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>
