<?php

require_once 'PHPUnit/Framework/TestSuite.php';

// openpne_dir is config.inc.php directory.
$current_dir = getcwd();
$openpne_dir = '/home/tama/OpenPNE/public_html/';

// Configuration from OpenPNE
chdir($openpne_dir);
require_once 'config.inc.php';
require_once OPENPNE_WEBAPP_DIR . '/init.inc';
chdir($current_dir);


class AllTest
{
    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite();

        include_once 'LoginTest.php';
        $suite->addTestSuite('LoginTest');

        include_once 'ShibbolethTest.php';
        $suite->addTestSuite('ShibbolethTest');

        return $suite;
    }
}

?>
