<?php

require_once 'PHPUnit/Framework.php';

require_once '../Shibboleth.php';

class ShibbolethTest extends PHPUnit_Framework_TestCase
{
    protected $shib;

    protected function setUp()
    {
        //$_SERVER['HTTP_SHIB_INETORGPERSON_MAIL'] = 'm_nakagawa@is.tokushima-u.ac.jp';
        $config = get_auth_config();
        $this->shib = new OpenPNE_Shibboleth($config['storage'], $config['options']);
    }

    /**
     * @test
     */
    public function login()
    {
        $this->assertTrue($this->shib->login(true, true));
    }
}

?>
