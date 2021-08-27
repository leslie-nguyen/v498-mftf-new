#!/bin/bash
if [[ $1 != "" ]]; then
    printf -v params '{"project":"v498-autotest","message":"%s","status": 1, "link": ""}' "$1"
    curl --header "Content-Type: application/json" --request POST --data "$params" https://cicd.bssdev.cloud/post
fi
