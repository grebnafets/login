<?php
namespace admin;
class Make {
    function form($txt_password, $txt_log_me_in) {
        ob_start();
        ?>
            <div>
                <p><?php echo $txt_password; ?></p>
            </div>
            <input id='login-pass' type='password' >
            <form id="login" action="" method="post">
                <input id="login-hash" name="login-hash" type='text' >
                <br />
                <input id="login-submit" type="submit" value="<?php echo $txt_log_me_in; ?>" >
            </form> 
        <?php
        return ob_get_clean();
    }
    function table($sercrets) {
        $range_i  = range(1, 10);
        $range_j  = range(1, 10);
        ob_start();
        ?><table border="1"><?php
        ?><tr><td></td><?php
        foreach(range(1, 10) as $i) {
            ?><td><?php echo $i; ?></td><?php
        }
        $i = 0;
        ?></tr><?php
        foreach ($range_i as $i) {
            ?><tr><?php
            ?><td><?php echo $i; ?></td><?php
                foreach ($range_j as $j) {
                    ?><td><?php echo $sercrets[$i][$j]; ?></td><?php
                }
            ?></tr><?php
        }
        ?></table><?php
        return ob_get_clean();
    }
}
class Init {
    function sercrets() {
        $range_i  = range(1, 10);
        $range_j  = range(1, 10);
        $sercrets = array();
        foreach ($range_i as $i) {
            foreach ($range_j as $j) {
                $sercrets[$i][$j] = rand(1, 9);
            }
        }
        return $sercrets;
    }
}
class Login {
    public $salt = "
        ) )         /\__
       / /         /    e`--O   \ /
      (  (________/    ___-,'    VOOoofff
       \             /
       (            /
       /)  ______   \
      ((  (      ((  \
       \_\_)      \_\_)
    ";
    private $sercrets        = null;
    private $staticpassword  = '';
    private $dynamicpassword = '';
    public  $password        = '';//node that this is supposed to be private.
    private $make            = null;
    private $init            = null;
    function __construct($static, $dynamic) {
        $this->salt            = base64_encode(hash('md5', $this->salt . rand(1, 100)));
        $this->staticpassword  = $static;
        $this->dynamicpassword = $dynamic;
        $this->init            = new Init();
        $this->sercrets        = $this->init->sercrets();
        $this->make            = new Make();
        $this->password        = hash('sha512', 
            $static .
            $this->sercrets[$this->dynamicpassword[0]][$this->dynamicpassword[1]] .
            $this->sercrets[$this->dynamicpassword[2]][$this->dynamicpassword[3]] .
            $this->salt
        );
    }
    function form($txt_password, $txt_log_me_in) {
        return $this->make->form($txt_password, $txt_log_me_in);
    }
    function table() {
        return $this->make->table($this->sercrets);
    }
    function compere($pass) {
        $isequal = false;
        if ($pass === $this->password) {
            $isequal = true;
        }
        return $isequal;
    }
}
