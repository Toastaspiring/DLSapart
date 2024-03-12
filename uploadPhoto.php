<?php
header('Content-Type: application/json; charset=utf-8');

try {
    // Error handling (improved)
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Only POST requests are allowed for file uploads.');
    }

    // File upload processing
    if (isset($_FILES['image'])) {
        $errors = []; // Array to store any errors encountered

        // Validate file type (enhanced)
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $mimeType = $_FILES['image']['type'];
        if (!in_array($mimeType, $allowedMimeTypes)) {
            $errors[] = 'Invalid file type. Only JPEG, PNG, and GIF images are allowed.';
        }

        // Validate file size (optional, adjust limit as needed)
        $maxSize = 20 * 1048576; // 20 MB (as requested)
        if ($_FILES['image']['size'] > $maxSize) {
            $errors[] = 'File size exceeds limit (20 MB).';
        }

        // Check for other potential errors (e.g., temporary file creation failure)
        if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'Upload failed with error code: ' . $_FILES['image']['error'];
        }

        if (empty($errors)) {
            // Generate a unique filename (improved)
            $targetDir = 'uploads/'; // Modify this path if needed
            $targetFile = $targetDir . basename(uniqid() . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

            // Move uploaded file to permanent location
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $imageURL = str_replace($_SERVER['DOCUMENT_ROOT'], '', $targetFile); // Replace with appropriate path construction for your server

                // Success response with image URL
                $response = array(
                    'data' => array(
                        'reponse' => "https://api.dlsappart.fr/" . $imageURL,
                    ),
                );
                echo json_encode($response);
                exit;
            } else {
                $errors[] = 'Failed to move uploaded file.';
            }
        }
    } else {
        $errors[] = 'No image file uploaded.';
    }

    // Throw an exception for any encountered errors
    throw new Exception(implode(', ', $errors));
} catch (Exception $e) {
    // Error response with error message in JSON format
    http_response_code(400); // Bad Request
    $response = array(
        'data' => array(
            'reponse' => $e->getMessage(),
        ),
    );
    echo json_encode($response);
    exit;
}

?>