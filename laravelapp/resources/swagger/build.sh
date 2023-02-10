#!/usr/bin/env bash

BASEDIR=$(dirname $0)
DIR="$( cd "$( dirname "$0" )" && pwd )"

# Remove previous build
cat /dev/null > ${DIR}/build.yaml

# Take each file from /yaml directory and merge into build.yaml
find ${BASEDIR}/yaml -name "*.yaml" -print0 | sort -z | xargs -0 docker run --rm -i -v ${PWD}:/workdir mikefarah/yq:3 yq m -i -x ${BASEDIR}/build.yaml
