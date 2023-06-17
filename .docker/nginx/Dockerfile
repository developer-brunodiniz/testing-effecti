FROM nginx:stable-alpine

ARG user=brunodiniz
ARG uid=1000

# serve api in development
RUN apk update && apk add bash

RUN rm /etc/nginx/conf.d/default.conf
COPY ./nginx.conf /etc/nginx/conf.d