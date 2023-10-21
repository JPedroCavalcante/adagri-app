## Instalando o projeto

1. ``` git clone git@github.com:JPedroCavalcante/adagri-app.git ```
2. ```docker compose up -d```
3. Copie ```.env.example``` para ```.env```
5. ``` docker-compose exec app composer install && npm install```
6. ``` docker-compose exec app php artisan key:generate ```
7. ``` docker-compose exec app php artisan migrate --seed ```
7. Você já poderá acessar o projeto em ```127.0.0.1:8080```

## Rodando algum comando dentro do container da aplicação

1. ```cd src```
2. ```docker-compose exec app {comando}```