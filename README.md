DOC TECHNIQUE 
DU PROJET FAIMFONY

Symfony3 project @IESA Multimédia
Group : 
Alexandre Pol, Nicola Bonaccorso,  Nolwenn Le Padellec, Thomas Brunier, Rosita Zarandi.
Minimum configuration required :
PHP -> 5.5.9 minimum
MySQL -> 5.6
Apache -> 2.4

Installation du projet : 
Clone the repo
git clone https://github.com/thomasbrunier/faimfony.git

/* Composer */
Install Symfony3 components and vendors
composer install
Or if you already have install FAIMFONY project, do an update
composer update

 /* Database */
Create your database
php bin/console doctrine:database:create
Generate table in your database
php bin/console doctrine:schema:update --dump-sql
Or if you already have install FAIMFONY project, do an update
php bin/console doctrine:schema:update --force

Load Fixtures 

php bin/console doctrine:fixtures:load

 And finally run the server
      	
php bin/console server:run
