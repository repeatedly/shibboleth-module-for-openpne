<?php
/**
 * Start point of Shibboleth authentication on OpenPNE
 */

chdir('../');
require_once './config.inc.php';
require_once OPENPNE_WEBAPP_DIR . '/init.inc';

/* Test enviroment
foreach ($_SERVER as $key => $val) {
    echo "$key : $val<br />";
}
*/

openpne_forward('shibboleth', 'do', 'login');

?>