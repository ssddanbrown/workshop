#!/bin/bash
rsync -azvv -e ssh ~/www/workshop/ workshop4@shell.gridhost.co.uk:~ ;
