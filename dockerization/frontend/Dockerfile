FROM node:lts-alpine

WORKDIR /usr/src/frontend

COPY . .

RUN npm install -g http-server

RUN yarn global add @vue/cli
RUN yarn install

CMD [ "yarn", "run", "dev" ]
EXPOSE 8081