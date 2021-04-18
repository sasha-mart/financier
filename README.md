## Installation

1. `docker-compose up -d`
2. `docker-compose exec php composer install`

Then you can see API docs at http://localhost:8100/api/v1

3. Database migrations:
`docker-compose exec php bin/console d:m:m`
   
Now the API works! :)