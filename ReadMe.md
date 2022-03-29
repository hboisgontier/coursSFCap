#Creation projet Symfony
composer create-project symfony/skeleton nomProjet 5.4.*

#Ajout des recettes de base nécessaires
composer req symfony/apache-pack annotations requirements-checker make

#Création d'un controleur
php bin/console make:controller

#Ajout de Twig
composer req twig

#Ajout des assets
composer req asset

#Ajout de la debugBar et du Profiler
composer req debug

#Ajout de Doctrine
composer req doctrine

#Création de la base de données
php bin/console doctrine:database:create

#Création ou modification d'une entité
php bin/console make:entity

#Vérification du mappage
php bin/console doctrine:schema:validate

#Mise à jour de la base de données
php bin/console doctrine:schema:update --force