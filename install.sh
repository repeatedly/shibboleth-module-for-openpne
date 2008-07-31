#!/bin/sh

#
# install.sh extected by bash
#


# Editing your OpenPNE directory path.
# If your OpenPNE deployment is default, PNE_PUBLIC_PATH is empty.
PNE_PATH=/home/tama/OpenPNE/
#PNE_PUBLIC_PATH=

if [ -z "$PNE_PUBLIC_PATH" ]; then
    PNE_PUBLIC_PATH=${PNE_PATH}/public_html/
fi
echo "Install path."
echo "$PNE_PATH"
echo "$PNE_PUBLIC_PATH"
echo ""

# Error checks
echo "Error checking..."

if [ -z "$PNE_PATH" ]; then
    echo "Error : ${PNE_PATH} is empty!!"
    exit 1
fi

if [ ! -d "$PNE_PATH" ]; then
    echo "Error : ${PNE_PATH} directory is not exist!!"
    exit 1
fi

if [ ! -d "$PNE_PUBLIC_PATH" ]; then
    echo "Error : ${PNE_PUBLIC_PATH} directory is not exist!!"
    exit 1
fi

echo "No error."
echo ""


PNE_SHIB_PATH=${PNE_PATH}/webapp/modules/shibboleth/
PNE_PUBLIC_SHIB_PATH=${PNE_PUBLIC_PATH}/shibboleth/


# ./install.sh clean
if [ "$1" == "clean" ]; then
    #rm -rf "${PNE_PUBLIC_SHIB_PATH}/index.php"
    #rm -rf "${PNE_SHIB_PATH}/do/login.php"
    #rm -rf "${PNE_PATH}/webapp/lib/OpenPNE/Shibboleth.php"
    for file in "${PNE_PUBLIC_SHIB_PATH}" "${PNE_SHIB_PATH}" "${PNE_PATH}/webapp/lib/OpenPNE/Shibboleth.php"
    do
        rm -rf "$file"
    done

    echo "Clean complete!"
    exit 0
fi


# Make directories
echo "Directories making..."

rm -rf "$PNE_SHIB_PATH"
mkdir -p "${PNE_SHIB_PATH}/do/"

rm -rf "$PNE_PUBLIC_SHIB_PATH"
mkdir -p "$PNE_PUBLIC_SHIB_PATH"


# Copy files
echo "Copy files..."

cp index.php "${PNE_PUBLIC_SHIB_PATH}/"
cp login.php "${PNE_SHIB_PATH}/do/"
cp Shibboleth.php "${PNE_PATH}/webapp/lib/OpenPNE/"

echo "Install complete!"
exit 0
