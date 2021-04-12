FROM node:14.15.3

ENV APP_ROOT /src
ENV HOST 0.0.0.0

WORKDIR ${APP_ROOT}
ADD . ${APP_ROOT}
RUN npm install && npm run build