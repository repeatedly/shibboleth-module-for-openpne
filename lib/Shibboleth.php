<?php

class OpenPNE_Shibboleth extends OpenPNE_Auth
{
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

        $address = $this->get_attribute();

        // Login fail if essential attribute is empty.
        if (!$address)
            return false;

        if (!IS_SLAVEPNE) {  // IS_SLAVEPNE is false on Shibboleth
            if ($is_encrypt_username)
                $this->auth->post[$this->auth->_postUsername] = t_encrypt($address);
        }

        // Is $address existing?
        if (db_member_c_member_id4pc_address($address)) {
            $this->auth->setAuth($this->auth->post[$this->auth->_postUsername]);

            if (OPENPNE_SESSION_CHECK_URL)
                $this->auth->setAuthData('OPENPNE_URL', OPENPNE_URL);

            $this->sess_id = session_id();

            if ($is_save_cookie)
                $expire = time() + 2592000; // 30 days
            else
                $expire = 0;

            // Shibboleth don't consider the ktai, because $this->ktai is false.
            setcookie(session_name(), session_id(), $expire, $this->cookie_path);
            $this->adjust_cookie();

            return true;
        } else {
            if (OPENPNE_SHIB_AUTO_REGIST)
                $this->register_user($address);
            return false;
        }
    }

    /**
     * Prepare regiter and redirect to register page.
     * This method is called if OPENPNE_SHIB_AUTO_REGIST is true.
     *
     * @access protected
     */
    protected function register_user($address)
    {
        $c_member_id_invite = OPENPNE_SHIB_INVITE_ID;

        // Do $address register?
        if (!db_member_is_limit_domain4mail_address($address)) {
            $msg = "$address is unregistrable address.";
            $p   = array('msg' => $msg);
            openpne_redirect('pc', 'page_o_public_invite', $p);
        }

        $session = create_hash();

        // Do $address exist prepare register?
        if (db_member_c_member_pre4pc_address($address))
            db_member_update_c_invite($c_member_id_invite, $address, '', $session);
        else
            db_member_insert_c_invite($c_member_id_invite, $address, '', $session);

        setcookie(session_name(), '', time() - 3600, ini_get('session.cookie_path'));

        openpne_redirect('pc', 'page_o_ri', array('sid' => $session));
    }

    /**
     * Get a Shibboleth variable for Login.
     * Return true if Essential attibute exist.
     *
     * @access protected
     * @return true/false
     */
    protected function get_attribute()
    {
        $mapping = $GLOBALS['OpenPNE']['shibboleth']['essential'];
        $address = $_SERVER[$mapping[$this->auth->_postUsername]];
        if (empty($address))
            return false;
        return $address;
    }

    /**
     * Adjust cookie path of 'authchallenge'.
     *
     * @access protected
     */
    protected function adjust_cookie()
    {
        setcookie('authchallenge', '', time() - 3600);
        setcookie('authchallenge', $this->auth->session['challengecookie'], 0, $this->cookie_path);
    }
}

?>
