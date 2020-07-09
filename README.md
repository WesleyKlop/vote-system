# Vote System

![Automated tests](https://github.com/WesleyKlop/vote-system/workflows/Automated%20tests/badge.svg?event=push)
![Deliver](https://github.com/WesleyKlop/vote-system/workflows/Deliver/badge.svg)

Vote System is a general purpose voting application that,
especially during these stay-at-home times can be useful in enabling digital voting.

## Usage / Deployment

### Deployment with docker-compose

Docker compose should **not** be used for production!

The simplest way to run the application with almost zero configuration is by using docker-compose.
Just download the [docker-compose.yml](./docker-compose.yml) and [example environment file](./.env.example),
edit the environment file, verify the docker-compose file configuration and then run the following command:

```bash
docker-compose up -d
```

This will automatically initialize a database, create an application key, run the migrations,
setup the admin user and start the application! By default, the application will be reachable via [localhost:80](http://localhost:80).

### Manual docker deployment

The most easy way to use and deploy this application is using Docker.
You can grab the latest version from this github or use a certain tag by viewing the [packages page](https://github.com/WesleyKlop/vote-system/packages/289544)

### Prerequisites

Before you get ready to start the docker image, you should setup the following:

-   A database like postgres, mysql, sqlite3(not recommended)
-   Copy the [.env](./.env.example) file from this repository, save it somewhere and fill in your database credentials.
    The application will automatically configure an application key if it could not be found on first run.

### Using

You can now run the following command to start the application on the foreground:

```bash
IMAGE=docker.pkg.github.com/wesleyklop/vote-system/vote-system:latest
docker run --rm -p 1337:80 -v /abs/path/to/your/.env-file:/app/.env $IMAGE
```

## Contributing

Thank you for wanting to contribute to this project!
You can go to the issues page to view things that need to be worked on.

The easiest way to set up this project for development is by using Valet or Homestead, just follow the [laravel documentation](https://laravel.com/docs/7.x#installation)

### Requirements

-   PHP ^7.4
-   A somewhat recent version of Node
-   sqlite/mysql/postgres database
-   Composer

## Security Vulnerabilities

If you discover a security vulnerability within Vote system, please send an e-mail to Wesley Klop via [wesley19097@gmail.com](mailto:wesley19097@gmail.com). All security vulnerabilities will be promptly addressed.

## License

The Vote system is open-sourced software licensed under the [GPLv3](https://opensource.org/licenses/GPL-3.0).
