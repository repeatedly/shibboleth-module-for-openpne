# About

This module conduct Shibboleth authentication on OpenPNE. 

# Requirements

* OpenPNE 2.10.x
* PHP     5 later

# Installation

## Get source

* via git

  The recommended way of installation. You pull from the github repository.

      $ git clone git://github.com/tama/

* via github on the web

  The way of installation using some Web browser.

  Access to http://github.com/tama/shibboleth-module-for-openpne/tree/master .

  You download the zip or tar, and decompress donwloaded file.

## module install

  Run the install.sh.

      $  ./install.sh [option]

### Option

* clean

  Uninstall this module.

* revert

  Replace shibbolized o_login.tpl to original o_login.tpl.

* only(Unpopulated)

  Use Shibboleth only o_login.tpl.

  Unpopulated reason begin that Prepare of login page images is a bother.

# Setting

## init.inc

* $GLOBALS['OpenPNE']['shibboleth']['essential']

  Essential attribute mapping using Shibboleth.

  e.g.) array('username' => 'HTTP_SHIB_INETORGPERSON_MAIL');

* OPENPNE\_SHIB\_AUTO\_REGIST

  If true, unregistered user is registered automatically.

  If false, unregistered user fail login.

* OPENPNE\_SHIB\_INVITE\_ID

  Set a user ID.

  This value is used to register user as invite user ID.

# License

  suspension
