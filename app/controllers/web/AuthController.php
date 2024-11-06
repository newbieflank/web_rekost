<?php

class AuthController extends Controller
{
    private $googleClient;

    private $userModel;
    private $form;

    public function __construct()
    {
        $this->googleClient = new Google_Client();
        $this->googleClient->setClientId($_ENV['CLIENT_ID_GOOGLE']);
        $this->googleClient->setClientSecret($_ENV['CLIENT_SECRET']);
        $this->googleClient->setRedirectUri('http://localhost/web_rekost/auth/callback');
        $this->googleClient->addScope("email");
        $this->googleClient->addScope("profile");

        $this->userModel = $this->model('UsersModel');
    }


    public function login()
    {
        $_SESSION['form'] = 'login';
        $authUrl = $this->googleClient->createAuthUrl();
        header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
        exit();
    }

    public function register()
    {
        $_SESSION['form'] = 'register';

        $authUrl = $this->googleClient->createAuthUrl();
        header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
        exit();
    }

    public function callback()
    {

        if (!isset($_GET['code'])) {
            echo 'No authorization code provided';
            exit();
        }

        // Log the code for debugging
        error_log('Authorization Code: ' . $_GET['code']);

        $token = $this->googleClient->fetchAccessTokenWithAuthCode($_GET['code']);

        if (isset($token['error'])) {
            echo 'Error fetching access token: ' . $token['error'] . ' - ' . $token['error_description'];
            echo 'Client ID: ' . $this->googleClient->getClientId();
            echo 'Redirect URI: ' . $this->googleClient->getRedirectUri();
            echo 'Auth Code: ' . $_GET['code'];
            exit();
        }

        $this->googleClient->setAccessToken($token);

        $googleService = new Google_Service_Oauth2($this->googleClient);
        $googleUser = $googleService->userinfo->get();

        switch ($_SESSION['form']) {
            case 'login':
                $user = $this->userModel->findUserByEmail($googleUser->email);
                if (!$user) {
                    Flasher::setFlash('Akun Tidak Di Temukan', 'danger');
                    $this->header('/login');
                    exit();
                }

                if ($user['role'] === 'pemilik kos') {
                    $data = $this->userModel->findOwnerById($user['id_user']);

                    $_SESSION['user'] = [
                        "id_user" => $user['id_user'],
                        "email" => $user['email'],
                        "role" => $user['role'],
                        "id_kos" => $data['id_kos']
                    ];
                    return $this->view('home/landingpemilik');
                } else {
                    $_SESSION['user'] = [
                        "id_user" => $user['id_user'],
                        "email" => $user['email'],
                        "role" => $user['role']
                    ];
                    return $this->view('home/landingpage');
                }

                unset($_SESSION['form']);

                break;

            case 'register':
                $data = [
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                ];

                if ($this->userModel->findUserByEmail($googleUser->email)) {
                    Flasher::setFlash('*Akun Email Sudah Terdaftar', 'danger');
                    $this->header('/register');
                    exit();
                }

                unset($_SESSION['form']);
                $this->view('login/setpassword', $data);
                break;

            default:
                echo "Invalid form type";
                echo 'Form' . $this->form;
                exit();
        }
    }
}
