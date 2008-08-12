<?php

/**
 * Essential attribute mapping using Shibboleth.
 */
$GLOBALS['OpenPNE']['shibboleth']['essential'] =
      array('username' => 'mail');

/**
 * If register a unregistered user automatically, set true.
 */
define('OPENPNE_SHIB_AUTO_REGIST', true);

/**
 * If OPENPNE_SHIB_AUTO_REGIST is true, this constant set a user ID.
 * This value is used to register user as invite user ID.
 */
define('OPENPNE_SHIB_INVITE_ID', 1);

?>
