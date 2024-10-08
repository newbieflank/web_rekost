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

    public static function flash()
    {
        if (isset($_SESSION['flash'])) {
            echo '<div class="alert-' . $_SESSION['flash']['tipe'] . '" role="alert">
                    ' . $_SESSION['flash']['pesan'] . '
                    </div>';
            unset($_SESSION['flash']);
        }
    }
}
