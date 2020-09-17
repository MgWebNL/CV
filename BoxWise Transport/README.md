# README #

## What is this repository for? ##

The P&D Group Profit library allows one to connect to Afas Profit.
With this we can retrieve data from and submit data to Profit, through it's various connectors

# DIRECTORY STRUCTURE

      .         contains the composer information, docker configuration and this ReadMe file
      .docker/  contains the docker container system configuration files
      bin/      contains the cli applications entrypoint(s)
      config/   contains the DI configuration for the application
      src/      contains the iibrary classes
      tests/    contains the iibrary test cases


# REQUIREMENTS

The minimum requirement by this library is PHP 7.3.0.
All secondary requirements are loaded by composer.

# Installation via Composer

#### Private Packagist Auth

The first step is to setup authentication with private packagist.  
On your [private packagist profile page](https://packagist.com/profile/auth) you find the instructions how to do this.

#### Private Packagist custom repository

Before trying to install you'll need to add private packagist as repository to your main project  
This can be done with the following commands:

~~~
composer config repositories.private-packagist composer https://repo.packagist.com/pd-group/
composer config repositories.packagist.org false
~~~

or paste the following code into your `composer.json`

~~~
{
    "repositories": [
        {"type": "composer", "url": "https://repo.packagist.com/pd-group/"},
        {"packagist.org": false}
    ]
}
~~~

#### New Project

You can create a new project with the following command:

~~~
composer create-project --repository=https://repo.packagist.com/pd-group/ pend/docker-template-php73-cli <my-new-project-name>
~~~

# Configuration

After the creation of your project you'll need to do some configuration

In the `.docker` directory you'll find the `usr/local/etx/php/php.ini` for PHP configuration,  
as well as the root crontab in `etc/crontabs/root`

You'll have to deterine the interval the application runs (crontab) and which php settings your new project requires (php.ini)

# Run the application

To run the application there are 2 ways:

For development you can call the following command
```
./bin/console
```

for production (or if you dont have the right PHP version on you machine) you'll need Docker
and with the following command the application is run from inside a docker container.
```
docker-compose up -d --no-deps --build cli && docker-compose up
```
To end/kill the docker container press ctrl+c (twice)