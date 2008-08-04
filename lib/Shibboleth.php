<?php

require_once 'OpenPNE/Auth.php';

class OpenPNE_Shibboleth extends OpenPNE_Auth
{
    /**
     * @acccess protected
     * @var array Mapping table regarding association between Attribute and Environment
     */
    protected static $MAP = array('username' => 'HTTP_SHIB_INETORGPERSON_MAIL');


    public function __construct($storageDriver = 'DB', $options = '')
    {
        parent::__construct($storageDriver, $options, false);
    }

    /**
     * Shibboleth login using setAuth
     *
     * @access public
     * @return true/false
     */
    public function login($is_save_cookie = false, $is_encrypt_username = false)
    {
        $this->auth =& $this->factory(true);

        if (!$this->_adjust_config())
            return false;
        
        if (!IS_SLAVEPNE) {  // IS_SLAVEPNE is false on Shibboleth
            if ($is_encrypt_username)
                $this->auth->post[$this->auth->_postUsername] =
                    t_encrypt($this->auth->post[$this->auth->_postUsername]);
        }

        $this->auth->setAuth($this->auth->post[$this->auth->_postUsername]);
        if ($this->auth->getAuth()) {
            if (OPENPNE_SESSION_CHECK_URL)
                $this->auth->setAuthData('OPENPNE_URL', OPENPNE_URL);

            $this->sess_id = session_id();

            if ($is_save_cookie)
                $expire = time() + 2592000; // 30 days
            else
                $expire = 0;

            /* Shibboleth don't consider the ktai. */
            if (!$this->is_ktai)
                setcookie(session_name(), session_id(), $expire, $this->cookie_path);
            $this->_adjust_cookie();

            return true;
        } else {
            return false;
        }
    }

    /**
     * Configurate a Shibboleth variable for PEAR::Auth.
     * Return true if Essential attibute exist.
     *
     * @access protected
     * @return true/false
     */
    protected function _adjust_config()
    {
        if (empty($_SERVER[self::$MAP[$this->auth->_postUsername]]))
            return false;

        $this->auth->post[$this->auth->_postUsername] =
            $_SERVER[self::$MAP[$this->auth->_postUsername]];
        return true;
    }

    /**
     * Adjust cookie path of 'authchallenge' path.
     *
     * @access protected
     */
    protected function _adjust_cookie()
    {
        setcookie('authchallenge', '', time() - 3600);
        setcookie('authchallenge', $this->auth->session['challengecookie'], 0, $this->cookie_path);
    }
}

?>
