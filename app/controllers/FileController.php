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
            $id = $_SESSION['user']['id_user'];

            $baseDir = $_SERVER['DOCUMENT_ROOT'] . '/web_rekost/public/uploads/';
            $uploadDir = $baseDir . $id . '/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true); 
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
                $file = $_FILES['file'];

               
                if ($file['error'] !== UPLOAD_ERR_OK) {
                    echo "An error occurred during file upload.";
                    return;
                }

                
                if ($file['size'] > 2 * 1024 * 1024) { 
                    echo "File size exceeds the limit.";
                    return;
                }

                
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($file['type'], $allowedTypes)) {
                    echo "Only JPG, PNG, and GIF files are allowed.";
                    return;
                }

                $existingImage = $this->ImageModel->getImageByUserId($id);
                if ($existingImage) {
                    $existingFilePath = $uploadDir . $existingImage['id_gambar'];

                    if (file_exists($existingFilePath)) {
                        unlink($existingFilePath);
                    }
                }

                $randomNumber = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);

                // Generate a unique file name to avoid overwrites
                $fileName = $randomNumber . basename($id . '.png');
                $targetPath = $uploadDir . $fileName;

                // Move the file to the target directory
                if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                    if ($this->ImageModel->insert($id, $fileName) > 0) {
                        $this->header('/profile');
                        exit;
                    }
                } else {
                    echo "Failed to move uploaded file.";
                }
            } else {
                echo "No file uploaded.";
            }
        }


        public function user($id)
        {
            $baseDir = $_SERVER['DOCUMENT_ROOT'] . '/web_rekost/public/uploads/2024105278/';
            $imagePath = $baseDir . $id . '.png';

            if (file_exists($imagePath)) {
                header("Content-Type: image/jpeg");
                header("Content-Length: " . filesize($imagePath));


                readfile($imagePath);
            } else {
                // If the image doesn't exist, return a 404 response
                header("HTTP/1.0 404 Not Found");
                echo json_encode(["error" => "Image not found"]);
            }
        }
    }
