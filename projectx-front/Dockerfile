FROM node

ENV TZ Europe/Paris

COPY package.json  /usr/src/projectx-front/
COPY package-lock.json /usr/src/projectx-front/
WORKDIR /usr/src/projectx-front/
RUN npm install
COPY . /usr/src/projectx-front/

CMD npm run serve