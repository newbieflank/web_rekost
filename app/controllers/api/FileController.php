<?php

class FileController extends Controller
{
    private $ImageModel;

    public function __construct()
    {
        $this->ImageModel = $this->model('ImageModel');
    }

    public function upload()
    {
        header('Content-Type: application/json');
        $allowedFileTypes = ['image/jpeg', 'image/png'];  // Allowed image types

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file']) && isset($_POST['userId'])) {
            $userId = $_POST['userId'];
            $image = $_FILES['file'];

            $baseDir = $_SERVER['DOCUMENT_ROOT'] . '/web_rekost/public/uploads/';
            $uploadDir = $baseDir . $userId . '/';

            // Create directory if it does not exist
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Check if the uploaded file type is allowed
            if (in_array($image['type'], $allowedFileTypes)) {

                // Check if there are no upload errors
                if ($image['error'] === 0) {

                    // Check for existing image and delete it
                    $existingImage = $this->ImageModel->getImageByUserId($userId);
                    if ($existingImage) {
                        $existingFilePath = $uploadDir . $existingImage['id_gambar'];

                        // Delete the existing image file if it exists
                        if (is_file($existingFilePath) && file_exists($existingFilePath)) {
                            unlink($existingFilePath);
                        }
                    }

                    // Generate a unique filename for the new image
                    $randomNumber = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);
                    $imageName = $randomNumber . basename($userId . '.png');
                    $imageTmpName = $image['tmp_name'];
                    $imagePath = $uploadDir . $imageName;

                    // Move the uploaded file to the target directory
                    if (move_uploaded_file($imageTmpName, $imagePath)) {
                        $this->ImageModel->insert($userId, $imageName);

                        echo json_encode(['status' => 'success', 'message' => 'Image uploaded successfully!']);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Failed to upload image.']);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Error uploading file. Please try again.']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid file type. Only JPG and PNG files are allowed.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No file uploaded or user ID not provided.']);
        }
    }
}
