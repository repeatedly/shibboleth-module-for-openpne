#!/bin/sh

#
# install.sh extected by bash
#


# Editing your OpenPNE directory path.
# If your OpenPNE deployment is default, PNE_PUBLIC_PATH is empty.
PNE_PATH=/home/tama/OpenPNE/
#PNE_PUBLIC_PATH=

if [ -z "${PNE_PUBLIC_PATH}" ]; then
    PNE_PUBLIC_PATH=${PNE_PATH}/public_html/
fi
echo "Install path."
echo "${PNE_PATH}"
echo "${PNE_PUBLIC_PATH}"
echo ""

# Error checks
echo "Checking..."

if [ -z "${PNE_PATH}" ]; then
    echo "Error : ${PNE_PATH} is empty!!"
    exit 1
fi

if [ ! -d "${PNE_PATH}" ]; then
    echo "Error : ${PNE_PATH} directory is not exist!!"
    exit 1
fi

if [ ! -d "${PNE_PUBLIC_PATH}" ]; then
    echo "Error : ${PNE_PUBLIC_PATH} directory is not exist!!"
    exit 1
fi

echo "No error."
echo ""

EXT_LIB_DIR=lib/
EXT_TEMPLATE_DIR=template/
PNE_SHIB_PATH=${PNE_PATH}/webapp/modules/shibboleth/
PNE_PUBLIC_SHIB_PATH=${PNE_PUBLIC_PATH}/shibboleth/
PNE_PAGE_FILE=${PNE_PATH}/webapp/modules/pc/templates/o_login.tpl

function remove_cache()
{
    CACHE=`find ${PNE_PATH}/var/templates_c/ -name *o_login.tpl.php`
    rm -f $CACHE
}


# ./install.sh clean
if [ "$1" == "clean" ]; then
    for file in "${PNE_PUBLIC_SHIB_PATH}" "${PNE_SHIB_PATH}" "${PNE_PATH}/webapp/lib/OpenPNE/Shibboleth.php"
    do
        rm -rf "${file}"
    done
    cp -f "${EXT_TEMPLATE_DIR}/o_login.tpl.orig" "${PNE_PAGE_FILE}"
    remove_cache

    echo "Clean done!"
    exit 0
fi

# ./install template 
# template revert
if [ "$1" == "template" ]; then
    cp -f "${EXT_TEMPLATE_DIR}/o_login.tpl.orig" $PNE_PAGE_FILE
    remove_cache

    echo "Template revert done!"
    exit 0
fi


# Make directories
echo "Making directories..."

rm -rf "${PNE_SHIB_PATH}"
mkdir -p "${PNE_SHIB_PATH}/do/"

rm -rf "${PNE_PUBLIC_SHIB_PATH}"
mkdir -p "${PNE_PUBLIC_SHIB_PATH}"


# Copy files
echo "Copying files..."

cp "${EXT_LIB_DIR}/index.php" "${PNE_PUBLIC_SHIB_PATH}/"
cp "${EXT_LIB_DIR}/init.inc"  "${PNE_SHIB_PATH}"
cp "${EXT_LIB_DIR}/login.php" "${PNE_SHIB_PATH}/do/"
cp "${EXT_LIB_DIR}/Shibboleth.php" "${PNE_PATH}/webapp/lib/OpenPNE/"

# Replace template
echo "Replace template"

cp -f "${EXT_TEMPLATE_DIR}/o_login.tpl" $PNE_PAGE_FILE
remove_cache


echo "Install done!"
exit 0
