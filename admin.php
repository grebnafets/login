<?php
    function microtime_float() {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }
    $time_start = microtime_float();
?>
<?php
    $lang = 'is';
    $txt = array(
        'is' => array(
            'password'    => 'Lykilorð: ',
            'login me in' => 'Skráðu mig inn'
        ),
        'en' => array(
            'password'    => 'Password: ',
            'login me in' => 'Log me in'
        )
    );
    error_reporting(E_ALL);
    include 'path.php';
    include 'admin/functions/login.php';
    session_start();
    session_regenerate_id(true);
    if (!isset($_SESSION['login'])) {
        $static_pass  = file_get_contents(ADMIN_HASH);
        $dynamic_pass = explode(' ', file_get_contents(ADMIN_KEYS));
        $_SESSION['login'] = new \admin\Login($static_pass, $dynamic_pass);
    }
    if (isset($_POST['pass'])) {
        if (isset($_SESSION['login'])) {
            if ($_SESSION['login']->compere($_POST['pass'])) {
                echo 'You where successful.';
                exit();
            } else {
                echo 'Nope, not today.';
                exit();
            }
        }
    }
?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Admin</title>
        <style>
            input {
                font-size: 9px;
                width: 750px;
            }
            p {
                font-size: 9px;
            }
        </style>
    </head>
    <body>
        <?php
            echo '<input id="login-salt" type="hidden" value="' . $_SESSION['login']->salt . '" >';
            echo $_SESSION['login']->table();
            echo $_SESSION['login']->form($txt[$lang]['password'], $txt[$lang]['login me in']);
            echo '<p>' . $_SESSION['login']->password . '</p>';
        ?>
        <?php 
        $time_end = microtime_float();
        $time = $time_end - $time_start;
        echo '<div id="page_render">Vefsíða búin til á: ' . $time . '</div>';
        ?>
         <script type="text/javascript" src="admin/scripts/Ajax.js"></script>
        <script type="text/javascript" src="admin/scripts/sha512.js"></script>
        <script type="text/javascript">
            (function () {
                var ajax, _form, _pass, _hash, _salt;
                _form = document.getElementById('login')      || false;
                _pass = document.getElementById('login-pass') || false;
                _hash = document.getElementById('login-hash') || false;
                _salt = document.getElementById('login-salt') || false;
                
                function ajax_callback(data) {
                    alert(data.responseText);
                }
                
                ajax = new Ajax('', '', ajax_callback);
                if (_form && _pass && _hash && _salt) {
                    _pass.onkeyup = function() {
                        var static, dynamic, salt;
                        static  = CryptoJS.SHA512(_pass.value.substring(0, _pass.value.length -2));
                        dynamic = _pass.value.substring(_pass.value.length -2, _pass.value.length);
                        salt    = _salt.value;
                        _hash.value = CryptoJS.SHA512(static + dynamic + salt);
                    };
                    _form.onclick = function() {
                        ajax.update('pass=' + _hash.value);
                        return false;
                    };
                }
            }());
        </script>
    </body>
</html>