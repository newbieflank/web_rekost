<?php

use PHPUnit\Framework\TestCase;

require_once './app/controllers/web/LoginController.php';
require_once './app/models/UsersModel.php';
class AuthTest extends TestCase
{
    protected $controller;
    protected $userModelMock;

    protected function setUp(): void
    {
        $this->userModelMock = $this->createMock(UserSModel::class);

        $this->controller = new loginController();
        $this->controller->userModel = $this->userModelMock;
    }

    public function testAuthOwnerWithRememberOption()
    {
        $_POST['username'] = 'test@example.com';
        $_POST['password'] = 'correct_password';
        $_POST['remember'] = 'on';

        $this->userModelMock->method('getProfile')
            ->willReturn([
                'id_user' => 1,
                'email' => 'test@example.com',
                'role' => 'pemilik kos'
            ]);

        $this->userModelMock->method('findOwnerById')
            ->willReturn([
                'id_kos' => 123
            ]);

        $this->controller->auth();

        $this->assertArrayHasKey('user', $_COOKIE);
        $this->assertEquals('/pemilik', $this->controller->redirectUrl);
    }

    public function testAuthUserWithoutRememberOption()
    {
        $_POST['username'] = 'user@example.com';
        $_POST['password'] = 'correct_password';

        $this->userModelMock->method('getProfile')
            ->willReturn([
                'id_user' => 2,
                'email' => 'user@example.com',
                'role' => 'user'
            ]);

        $this->controller->auth();

        $this->assertArrayHasKey('user', $_SESSION);
        $this->assertEquals('/', $this->controller->redirectUrl);
    }

    public function testAuthWithIncorrectPassword()
    {
        $_POST['username'] = 'user@example.com';
        $_POST['password'] = 'wrong_password';

        $this->userModelMock->method('getProfile')
            ->willReturn(null);

        $this->userModelMock->method('findUserByEmail')
            ->willReturn(true);

        $this->controller->auth();

        $this->assertEquals('*Password Salah', Flasher::getFlash('danger'));
        $this->assertEquals('/login', $this->controller->redirectUrl);
    }

    public function testAuthWithEmailNotFound()
    {
        $_POST['username'] = 'notfound@example.com';
        $_POST['password'] = 'any_password';

        $this->userModelMock->method('getProfile')
            ->willReturn(null);
        $this->userModelMock->method('findUserByEmail')
            ->willReturn(false);

        $this->controller->auth();

        // Periksa apakah error yang benar muncul dan redirect benar
        $this->assertEquals('*Akun Tidak di Temukan', Flasher::getFlash('danger'));
        $this->assertEquals('/login', $this->controller->redirectUrl);
    }
}
