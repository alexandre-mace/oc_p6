# Snowtricks

Symfony blog, 6th project from OpenClassroom's class

### Codacy
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/407116031a6a47a9a53df94da54b015d)](https://app.codacy.com/app/alexandre-mace/oc_p6?utm_source=github.com&utm_medium=referral&utm_content=alexandre-mace/oc_p6&utm_campaign=Badge_Grade_Dashboard)

## Installation 
* Clone the repository and open it.

`git clone https://github.com/alexandre-mace/oc_p6.git`
`cd oc_p6`

* Update dependencies.

`composer update`

## Configuration
* Customize the .env file

### doctrine

`DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"`

### swift-mailer

`MAILER_URL=gmail://username:password@localhost`

* Create database 

` php bin/console doctrine:database:create`

* Get data

` php bin/console doctrine:fixtures:load`

