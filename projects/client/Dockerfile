FROM node:lts-alpine

WORKDIR /var/www/html/client

COPY package*.json ./

RUN npm install

CMD ["npm", "run", "build"]
