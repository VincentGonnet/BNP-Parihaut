# BNP Parihaut

BNP Parihaut est une interface de gestion bancaire, développée pour une banque fictive. 

Ce projet a été développé en 2023 dans le cadre du Projet SPRINT, de deuxième année de Licence Informatique à l'Université d'Orléans.

Made with ❤️ by [@JoanGuillard](https://www.github.com/JoanGuillard), [@mhamze04](https://www.github.com/mhamze04) and [@VincentGonnet](https://www.github.com/VincentGonnet)

# Setup
Version de la base de donnée testée : 10.4.32-MariaDB (disponible nativement dans les dernières versions de XAMPP)
Le fichier à importer est disponible dans le dossier `database/init.sql`.

Pour faciliter la connexion, sur la page de login du site, tapez "help" dans le champ "Identifiant".
Le mot de passe par défaut pour tous les comptes est "password". 
Une fois changé, le mot de passe n'apparaîtra pas dans la fenêtre d'aide.

# Fonctionnalités :

## 🕵️‍♂️ Agent 
- enregistrer un nouveau client
- rechercher un client
- visualiser et modifier certaines informations personnelles
- visualiser les comptes
- effectuer un crédit / débit sur un compte
- visualiser les contrats en cours
- planifier un rendez-vous avec le conseiller du client

## ⚙️ Conseiller
- visualiser son emploi du temps et celui de ses collègues
- se bloquer des créneaux 
- effectuer un rendez-vous avec un client
- modifier les informations personnelles du client
- ajouter, supprimer un compte
- modifier le découvert d'un compte si le type de compte le permet
- ajouter, supprimer un contrat
- planifier un nouveau rendez-vous

## 📈 Directeur
- rechercher les employés
- modifier les informations de connexion des employés
- ajouter un nouvel employé
- créer un type de compte
- créer un type de contrat
- gérer les justificatifs à fournir pour chaque type de compte / contrat
- Visualiser certaines statistiques de la banque
