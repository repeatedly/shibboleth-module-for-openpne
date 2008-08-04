<?php

require_once 'PHPUnit/Framework.php';
require_once OPENPNE_WEBAPP_DIR . '/modules/shibboleth/do/login.php';

class LoginTest extends PHPUnit_Framework_TestCase
{
    protected $auth;

    protected function setUp()
    {
        $this->auth = new shibboleth_do_login();
    }

    /**
     * @test
     */
    public function isSecure()
    {
        $this->assertFalse($this->auth->isSecure());
    }
}

?>