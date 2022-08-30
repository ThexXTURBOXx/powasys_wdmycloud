#!/bin/sh

#
# SPDX-FileCopyrightText: 2020 Western Digital Corporation or its affiliates.
#
# SPDX-License-Identifier: GPL-2.0-or-later
#

path=$1
APKG_WWW_DIR="/var/www/powasys"
APKG_MODULE_WEB_DIR="powasys-1.0"
APKG_ICON_FILE_NAME="powasys.png"
APKG_MULTI_LANG_DESC_XML="desc.xml"

#stop daemon
echo "stop PowaSys: "${path}
rm ${APKG_WWW_DIR} 2> /dev/null
ln -sf ${path}/web ${APKG_WWW_DIR}
