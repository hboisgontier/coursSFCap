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

#Installation des formulaires
composer req form

#Génération d'un formulaire
php bin/console make:form

#Activation de la validation des données
composer req validator

#Protection contre CSRF
composer req security-csrf

#Ajout de la recette pour activer le bundle de sécurité
composer req symfony/security-bundle

#Création d'une entité représentant un utilisateur
php bin/console make:user

#Cette entité peut être modifiée pour ajouter d'autre attributs
php bin/console make:entity

#génération du formulaire d'inscription
php bin/console make:registration-form


