#!/bin/bash
echo "Pulling from git server....";

git pull;

echo "Rebuilding css using compass";

compass compile public;
