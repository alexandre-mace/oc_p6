# Snowtricks

Symfony blog, 6th project from OpenClassroom's class

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/407116031a6a47a9a53df94da54b015d)](https://app.codacy.com/app/alexandre-mace/oc_p6?utm_source=github.com&utm_medium=referral&utm_content=alexandre-mace/oc_p6&utm_campaign=Badge_Grade_Dashboard)
[![Codacy Badge](https://api.codacy.com/project/badge/Coverage/4725da237ed54d768edbd7066c7d69ca)](https://www.codacy.com/app/codacy_alexandre-mace/oc_p6?utm_source=github.com&utm_medium=referral&utm_content=alexandre-mace/oc_p6&utm_campaign=Badge_Coverage)
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

* Install dependencies.

  `composer install`

## Configuration
* Customize the .env file

#### doctrine
  `DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"`

#### swift-mailer
  `EMAIL_ADDRESS=youremailaddress`

* Create database 

  `php bin/console doctrine:database:create`

* Get tables 

```
  php bin/console make:migration
  php bin/console doctrine:migrations:migrate
```

* Get data

  `php bin/console hautelook:fixtures:load`

## Local server

* `php bin/console server:run` and go to the indicated address

## Tests
* The database comes with a user already registered to make tests (username = 'a', password = 'alexandre')

* Configure the phpunit.xml.dist file
```
<env name="DATABASE_URL" value="mysql://db_user:db_password@127.0.0.1:3306/db_name"/>
<env name="A_USERNAME" value="a"/>
<env name="A_PASSWORD" value="password"/>
```
* run in console `./bin/phpunit` and results will show up in console