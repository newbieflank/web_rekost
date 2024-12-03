<?php

class Flasher
{
    public static function setFlash($pesan, $tipe)
    {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'tipe' => $tipe
        ];
    }

    public static function setFF($pesan, $tipe)
    {
        $_SESSION['flashF'] = [
            'pesan' => $pesan,
            'tipe' => $tipe
        ];
    }

    public static function flash()
    {
        if (isset($_SESSION['flash'])) {
            echo '<div class="alert-' . $_SESSION['flash']['tipe'] . '" role="alert">
                    ' . $_SESSION['flash']['pesan'] . '
                    </div>';
            unset($_SESSION['flash']);
        }
    }

    public static function fadeFlash()
    {
        if (isset($_SESSION['flashF'])) {
            echo '<div id="flashMessage" class="alert alert-' . htmlspecialchars($_SESSION['flashF']['tipe']) . ' alert-dismissible fade show" role="alert">
                ' . htmlspecialchars($_SESSION['flashF']['pesan']) . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            unset($_SESSION['flash']);
        }
    }
}
