#!/bin/bash

SCRIPT=$(realpath "$0")
SCRIPT_PATH=$(dirname "$SCRIPT")
toolsPaths=("phpmetrics", "phpcs")

echo Started creating analysis paths from $SCRIPT_PATH ...

for toolPath in ${toolsPaths[@]}; do
    if [ ! -d "$toolPath" ]; then
        mkdir -p "$SCRIPT_PATH/../analysis/$toolPath"
    fi
done