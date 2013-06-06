#!/bin/bash

xgettext -n -p locale/en_US/LC_MESSAGES -o messages.pot --from-code=UTF-8 controllers/*php libs/*php

LPATH=locale/en_US/LC_MESSAGES
msgmerge -N  $LPATH/messages.po $LPATH/messages.pot > $LPATH/new.po
mv $LPATH/new.po $LPATH/messages.po
for file in `find . -name "*.po"` ; do msgfmt -o `echo $file | sed s/\.po/\.mo/` $file ; done
