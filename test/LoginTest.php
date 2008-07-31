<?php

require_once 'PHPUnit/Framework.php';
require_once '../login.php';

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