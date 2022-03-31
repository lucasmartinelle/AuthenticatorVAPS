# Authentication using Symfony, API Platform and Vue.js
---

![banner](https://zupimages.net/up/22/13/qnjm.jpg)

Simple web application created by a beginner. The application uses Symfony with API Platform and Vue.js.

### Installation

The installation can be done using docker. You just have to execute the following command

```bash
docker-compose up -d --build
```

To install the project, please run the following command. 

```bash
docker exec -it php bash /var/www/api/installation.sh
```

If you want to deploy your application on a domain other than localhost, modify the following line in api/.env.local.php

```php
//'CORS_ALLOW_ORIGIN' => '^https?://(localhost|127\\.0\\.0\\.1)(:[0-9]+)?$',
//CHANGE THIS BY
'CORS_ALLOW_ORIGIN' => '^https?://(sub.domain.ext)(:[0-9]+)?$',
```

### Usage

The API is available at the following address : `http://localhost/api`

The front application is available at the following address : `http://localhost:8080`
