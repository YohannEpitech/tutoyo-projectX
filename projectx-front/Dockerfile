FROM node

ENV TZ Europe/Paris

COPY package.json  /usr/src/projectx-ront/
COPY package-lock.json /usr/src/projectx-front/
WORKDIR /usr/src/projectx-front/
RUN npm install
COPY ./resources /usr/src/projectx-front/resources/
COPY webpack.mix.js /usr/src/projectx-front/

RUN npm run serve