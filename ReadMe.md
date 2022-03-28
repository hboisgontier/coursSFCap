#Creation projet Symfony
composer create-project symfony/skelton nomProjet 5.4.*

#Ajout des recettes de base nécessaires
composer req symfony/apache-pack annotation requirements-cheker make

#Création d'un controleur
php bin/console make:controller

#Ajout de Twig
composer req twig

#Ajout des assets
composer req asset