1) Clone project
2) Make .env by .env.example
3) Change DB_DATABASE, DB_USERNAME, DB_PASSWORD, REDIS_PASSWORD, RABBITMQ_USER, RABBITMQ_PASSWORD if you want at your .env
4) Do command docker-compose up -d
5) Do command docker-compose exec app php artisan key:generate
6) Set MAIL_USERNAME and MAIL_PASSWORD from service mailtrap.io at your .env