#!/bin/bash
rsync --exclude='.git/' --exclude='.sass-cache/' -azvv -e ssh ~/www/workshop/ workshop4@shell.gridhost.co.uk:~/ ;
