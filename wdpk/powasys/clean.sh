#!/bin/sh

#
# SPDX-FileCopyrightText: 2020 Western Digital Corporation or its affiliates.
#
# SPDX-License-Identifier: GPL-2.0-or-later
#

path=$1
APKG_WWW_DIR="/var/www/powasys"

#remove link
rm -rf $APKG_WWW_DIR  2> /dev/null
