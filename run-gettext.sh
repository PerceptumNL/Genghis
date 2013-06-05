#!/bin/bash

xgettext -n -p locale/en/LC_MESSAGES -o messages.pot --from-code=UTF-8 controllers/*php
#xgettext -n -p locale/es_ES/LC_MESSAGES -o messages.pot --from-code=UTF-8 controllers/*php

LPATH=locale/en/LC_MESSAGES/
msgmerge -N  $LPATH/messages.po $LPATH/messages.pot > $LPATH/new.po
mv $LPATH/new.po $LPATH/messages.po
