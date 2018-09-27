# Snowtricks

Symfony blog, 6th project from OpenClassroom's class

### Codacy
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/407116031a6a47a9a53df94da54b015d)](https://app.codacy.com/app/alexandre-mace/oc_p6?utm_source=github.com&utm_medium=referral&utm_content=alexandre-mace/oc_p6&utm_campaign=Badge_Grade_Dashboard)

## Requirements 
* MySQL : https://www.mysql.com/fr/

* PHP : http://php.net/manual/fr/intro-whatis.php

* Apache : https://www.apache.org/

## Installation 
* Clone the repository and open it.

```
  git clone https://github.com/alexandre-mace/oc_p6.git
  cd oc_p6
```

* Update dependencies.

  `composer update`

## Configuration
* Customize the .env file

### doctrine
  `DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"`

### swift-mailer
  `MAILER_URL=gmail://username:password@localhost`

* Create database 

  `php bin/console doctrine:database:create`

* Get tables 

```
  php bin/console doctrine:schema:update --dump-sql
  php bin/console doctrine:schema:update --force
```

* Get data

  `php bin/console doctrine:fixtures:load`

## Tests
* The databse comes with a user already registered to make tests (username = 'a', password = 'alexandre')

* Configure the phpunit.xml.dist file
```
<env name="DATABASE_URL" value="mysql://db_user:db_password@127.0.0.1:3306/db_name"/>
<env name="A_USERNAME" value="a"/>
<env name="A_PASSWORD" value="alexandre"/>
```
* run in console `./bin/phpunit` and results will show up in console