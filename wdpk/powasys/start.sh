#!/bin/sh

#
# SPDX-FileCopyrightText: 2020 Western Digital Corporation or its affiliates.
#
# SPDX-License-Identifier: GPL-2.0-or-later
#

path=$1
APKG_WWW_DIR="/var/www/powasys"
APKG_MODULE="powasys"
APKG_MODULE_WEB_DIR="powasys-1.0"
echo  "[PowaSys] start"
rm ${APKG_WWW_DIR} 2> /dev/null
ln -sf ${path}/${APKG_MODULE} ${APKG_WWW_DIR}

#cmd on start daemon
