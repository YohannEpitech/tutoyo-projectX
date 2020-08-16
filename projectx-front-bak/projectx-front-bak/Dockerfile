FROM node

ENV TZ Europe/Paris

COPY package.json  /usr/src/projectx-ront/
COPY package-lock.json /usr/src/projectx-front/
WORKDIR /usr/src/projectx-front/
RUN npm install --loglevel verbose
COPY ./resources /usr/src/projectx-front/resources/
COPY webpack.mix.js /usr/src/projectx-front/

RUN npm run build

# FROM nginx


FROM node:lts-alpine
ENV TZ Europe/Paris
RUN npm install -g http-server

WORKDIR /app

COPY package*.json ./

RUN npm install

COPY . .

RUN npm run build

EXPOSE 8080
CMD [ "http-server", "dist" ]