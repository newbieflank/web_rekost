<?php
function asset($path)
{
    return BASEURL . 'public/' . $path;
}

function uploads($path)
{
    return $_SERVER['DOCUMENT_ROOT'] . '/web_rekost/public/uploads/' . $path;
}
