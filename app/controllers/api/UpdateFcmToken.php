<?php
class UpdateFcmToken
{
    public function update()
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode([
                'success' => false,
                'message' => 'Hanya menerima metode POST.'
            ]);
            exit;
        }

        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['id_user']) || !isset($input['fcm_token'])) {
            echo json_encode([
                'success' => false,
                'message' => 'id_user dan fcm_token wajib diisi.'
            ]);
            exit;
        }

        $id_user = $input['id_user'];
        $fcm_token = $input['fcm_token'];


        if (strlen($fcm_token) < 1 || strlen($fcm_token) > 255) {
            echo json_encode([
                'success' => false,
                'message' => 'FCM token tidak valid.'
            ]);
            exit;
        }

        try {
            $db = new Database();

            $db->query('UPDATE user SET fcm_token = :fcm_token WHERE id_user = :id_user');
            $db->bind(':fcm_token', $fcm_token);
            $db->bind(':id_user', $id_user);
            $db->execute();

            if ($db->rowCount() > 0) {
                echo json_encode([
                    'success' => true,
                    'message' => 'FCM token berhasil diperbarui.'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Tidak ada perubahan atau id_user tidak ditemukan.'
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }
} 