#!/bin/bash

./vendor/bin/atlas-skeleton.php \
    --full \
    --dir=./src/Data \
    --conn=./atlas.php \
    --table=entries \
    App\\Data\\Entry

./vendor/bin/atlas-skeleton.php \
    --full \
    --dir=./src/Data \
    --conn=./atlas.php \
    --table=tags \
    App\\Data\\Tag

./vendor/bin/atlas-skeleton.php \
    --full \
    --dir=./src/Data \
    --conn=./atlas.php \
    --table=taggings \
    App\\Data\\Tagging

