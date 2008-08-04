<?php

require_once 'PHPUnit/Framework.php';

require_once 'OpenPNE/Shibboleth.php';

class ShibbolethTest extends PHPUnit_Framework_TestCase
{
    protected $shib;

    protected function setUp()
    {
        $config = get_auth_config();
        $this->shib = new OpenPNE_Shibboleth($config['storage'], $config['options']);
    }

    /**
     * @test
     */
    public function login()
    {
        $this->assertFalse($this->shib->login(false, true));
    }
}

?>
