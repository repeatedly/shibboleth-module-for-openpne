# About

This module conduct Shibboleth authentication on OpenPNE. 

# Environment

* OpenPNE 2.10.x
* PHP     5 later

# Installation

## Get source

* via git

  The recommended way of installation. You pull from the github repository.

    $ git clone git://github.com/repeatedly/shibboleth-module-for-openpne.git

* via github on the web

  The way of installation using some Web browser.

  Access to http://github.com/repeatedly/shibboleth-module-for-openpne/tree/master .

  You download the zip or tar, and decompress donwloaded file.

## Install module

  Run the install.sh.

    $  ./install.sh [option]

### Option

* clean

  Uninstall this module.

* template

  Replace shibbolized o\_login.tpl to original o\_login.tpl.

* only(Unpopulated)

  Use Shibboleth only o\_login.tpl.

  Unpopulated reason begin that Prepare of login page images is a bother.

# Configration

## OPENPNE\_DIR/config.inc.php

OPENPNE\_SSL\_URL set a appropriate value, because Shibboleth use the SSL.

## init.inc

* $GLOBALS['OpenPNE']['shibboleth']['essential']

  Essential attribute mapping using Shibboleth.

  e.g.) array('username' => 'HTTP\_SHIB\_INETORGPERSON\_MAIL');

* OPENPNE\_SHIB\_AUTO\_REGIST

  If true, unregistered user is registered automatically.

  If false, unregistered user fails login.

* OPENPNE\_SHIB\_INVITE\_ID

  This value is used to register user as invite user ID.

# TODO

* Support other version(2.12, 3, etc...)
* Add other authentication root(e.g. pass through the user registration)
* Improve the performance

# Copyright

    Copyright (c) 2008-2009 Masahiro Nakagawa

This library is released under the PHP License, version 3.01.
