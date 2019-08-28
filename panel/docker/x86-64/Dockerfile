FROM node:12.9.0-alpine

LABEL maintainer="mail@mohsenhosseini.info"
LABEL version="1.0.0"
LABEL description="Instagram bot panel 1.0.0"

ENV INSTALL_DIR /usr/src/app

# set working directory
RUN mkdir -p $INSTALL_DIR
WORKDIR $INSTALL_DIR

ADD ./.env.example $INSTALL_DIR/.env
# add `/usr/src/app/node_modules/.bin` to $PATH
ENV PATH $INSTALL_DIR/node_modules/.bin:$PATH

COPY ./ $INSTALL_DIR