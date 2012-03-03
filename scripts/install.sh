#!/bin/sh

cd ../www/libraries/less/
git submodule init https://github.com/leafo/lessphp.git

cd ../../libraries/ToroPHP/
git submodule init https://github.com/anandkunal/ToroPHP.git

cd ../../
git submodule update

