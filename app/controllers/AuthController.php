<?php

class AuthController extends Controller
{
    private $googleClient;
    private $userModel;

    public function __construct()
    {
        $this->googleClient = new Google_Client();
        $this->googleClient->setClientId('272642355990-ivv56go9et6dd5uckis4vtt32gnuomvo.apps.googleusercontent.com');
        $this->googleClient->setClientSecret('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');
        $this->googleClient->setRedirectUri('http://localhost/web_rekost/public/auth/callback');
        $this->googleClient->addScope("email");
        $this->googleClient->addScope("profile");

        $this->userModel = $this->model('UsersModel');
    }

    public function login()
    {
        // Generate the Google auth URL
        $authUrl = $this->googleClient->createAuthUrl();

        // Redirect the user to the Google login page
        header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
        exit();
    }

    public function callback()
    {

        if (isset($_GET['code'])) {
            $token = $this->googleClient->fetchAccessTokenWithAuthCode($_GET['code']);
            $this->googleClient->setAccessToken($token);

            $googleService = new Google_Service_Oauth2($this->googleClient);
            $googleUser = $googleService->userinfo->get();


            $existingUser = $this->userModel->findUserByEmail($googleUser->email);
            if (!$existingUser) {
                $data = [
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id
                ];
                $this->view('login/register', $data);
            }

            session_set_cookie_params(0);
            // Log the user in (start session, etc.)
            $_SESSION['user'] = $googleUser;

            $this->header('/');
            exit;
        } else {
            $this->header('/login');
            exit;
        }
    }
}
