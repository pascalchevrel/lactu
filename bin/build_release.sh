#!/bin/bash

set -eu

tmp=$(mktemp -d -t lactu)

echo "[*] Building into $tmp..."

cd "$tmp"
git clone https://github.com/pascalchevrel/lactu.git --depth=1 --recursive -j8
cd lactu
composer install --no-suggest --prefer-dist --no-dev
git describe --abbrev=0 --tags > VERSION
find . -name .DS_Store -exec rm {} \;
rm -rf .git .github .travis.yml .gitignore .gitmodules docs/.git/
mkdir cache
cd ..
zip -r "lactu-$(cat lactu/VERSION).zip" .

echo "[*] Grab the archive: ${tmp}/lactu-$(cat lactu/VERSION).zip"
