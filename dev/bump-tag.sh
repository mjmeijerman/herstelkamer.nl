#!/bin/bash

#get highest tag number
VERSION=`git describe --abbrev=0 --tags`

git checkout $VERSION
LATEST_COMMIT_PREVIOUS_VERSION=`git rev-parse HEAD`

git checkout trunk
LATEST_COMMIT_ON_TRUNK=`git rev-parse HEAD`

if [ $LATEST_COMMIT_PREVIOUS_VERSION == $LATEST_COMMIT_ON_TRUNK ]; then
    echo "Not tagging because there are no new commits in trunk since previous tag (${VERSION})"
else
    #replace . with space so can split into an array
    VERSION_BITS=(${VERSION//./ })

    #get number parts and increase last one by 1
    VNUM1=${VERSION_BITS[0]}
    VNUM2=${VERSION_BITS[1]}
    VNUM3=${VERSION_BITS[2]}
    VNUM2=$((VNUM2+1))

    #create new tag
    NEW_TAG="$VNUM1.$VNUM2.0"

    echo "Updating $VERSION to $NEW_TAG"

    git tag $NEW_TAG
    echo "Tagged with $NEW_TAG"
fi
