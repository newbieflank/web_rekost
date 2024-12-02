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
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');

        $allowedFileTypes = ['image/*'];

        if (isset($_FILES['file']) && isset($_POST['user_id'])) {
            $userId = intval($_POST['user_id']);
            $image = $_FILES['file'];


            $baseDir = $_SERVER['DOCUMENT_ROOT'] . '/web_rekost/public/uploads/';
            $uploadDir = $baseDir . $userId . '/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (in_array($image['type'], $allowedFileTypes)) {

                $type = $image['type'];

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
                    $imageName = $randomNumber . basename($userId . '.jpg');
                    $imageTmpName = $image['tmp_name'];
                    $imagePath = $uploadDir . $imageName;

                    if (move_uploaded_file($imageTmpName, $imagePath) &&  ($this->ImageModel->insert($userId, $imageName)) > 0) {
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
