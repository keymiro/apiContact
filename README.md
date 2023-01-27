# INSTALACIÓN
* composer install
* php bin/console doctrine:database:create
* php bin/console make:migration
* php bin/console doctrine:migrations:migrate
* composer update
* symfony server:start
#Json que recibe el api 

{
    "first_name": "camilo",
    "last_name": "mancipe",
    "email": "camilomanfducipe@outlook.com",
    "cel": "32571402558",
    "message": "hola mundo estoy probando mi api",
    "contact_area": "contabilidad"
}
