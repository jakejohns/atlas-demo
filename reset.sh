#!/bin/bash

rm ./data/app.db
cat ./data.sql | sqlite3 ./data/app.db

