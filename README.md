# Authentication using Symfony, API Platform and Vue.js
---

![banner](https://zupimages.net/up/22/13/qnjm.jpg)

Simple web application created by a beginner. The application uses Symfony with API Platform and Vue.js.

### Installation

The installation can be done using docker. You just have to execute the following command

```bash
docker-compose up -d --build
```

To install the project, please run the following command

```
docker-compose exec composer install
```

Then, to initialize the database, you need to run the following command

```bash
docker-compose exec php bin/console doctrine:migrations:migrate
```

### Usage

The API is available at the following address : `http://localhost/api`

The front application is available at the following address : `http://localhost:8080`
