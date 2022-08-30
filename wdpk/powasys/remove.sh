#!/bin/sh

#
# SPDX-FileCopyrightText: 2020 Western Digital Corporation or its affiliates.
#
# SPDX-License-Identifier: GPL-2.0-or-later
#

path=$1
APKG_PATH=$1
APKG_WWW_DIR="/var/www/powasys"
APKG_MODULE="powasys"
APKG_MODULE_WEB_DIR="powasys-1.0"

#stop daemon

#remove link
rm -rf $APKG_WWW_DIR

#remove intstalled directory
rm -rf $path
