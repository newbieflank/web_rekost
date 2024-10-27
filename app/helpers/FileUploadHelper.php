<?php

class FileUploadHelper
{
    // Uploads a new file and deletes the previous file if it exists
    public static function uploadFile($file, $targetDir, $previousFile = null, $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf'])
    {
        // Ensure the upload directory exists
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Get file information
        $fileName = basename($file['name']);
        $targetFilePath = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Check if the file type is allowed
        if (!in_array($fileType, $allowedTypes)) {
            return ['status' => false, 'message' => "Error: Only " . implode(', ', $allowedTypes) . " files are allowed."];
        }

        // Delete previous file if it exists
        if ($previousFile && file_exists($previousFile)) {
            unlink($previousFile);
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
            return ['status' => true, 'filePath' => $targetFilePath, 'message' => "File uploaded successfully."];
        } else {
            return ['status' => false, 'message' => "Error: There was an error uploading the file."];
        }
    }
}
