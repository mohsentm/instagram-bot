#!/bin/sh

cd ${INSTALL_DIR:=/usr/src/app}

# Check node_modules
if [[ ! -d node_modules ]]; then
  npm install
fi

# Check .env
if [[ ! -f .env ]]; then
  # create .env
  cp .env.example .env
fi

npm start
