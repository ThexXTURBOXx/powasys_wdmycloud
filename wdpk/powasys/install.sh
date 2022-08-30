#!/bin/sh

#
# SPDX-FileCopyrightText: 2020 Western Digital Corporation or its affiliates.
#
# SPDX-License-Identifier: GPL-2.0-or-later
#

path_src=$1
path_des=$2

APKG_WWW_DIR="/var/www/powasys"
APKG_MODULE="powasys"
APKG_MODULE_WEB_DIR="powasys-1.0"
APKG_PATH=${path_des}/${APKG_MODULE}

cp -R $path_src $path_des
mv ${APKG_PATH}/${APKG_MODULE_WEB_DIR} ${APKG_PATH}/${APKG_MODULE}
ln -sf ${APKG_PATH}/${APKG_MODULE}  ${APKG_WWW_DIR}
cp -rf ${APKG_PATH}/web/* ${APKG_PATH}/${APKG_MODULE}
