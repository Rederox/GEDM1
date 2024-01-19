# Gestion Électronique des Documents (GED) pour ChemicalBrothers

Ce projet consiste à développer une GED (Gestion Électronique des Documents) pour ChemicalBrothers, une entreprise familiale dans le secteur des produits chimiques. L'objectif est de fournir aux clients un accès sécurisé aux fiches de données de sécurité (FDS) des produits chimiques qu'ils ont commandés.

## Contexte du Projet

### Objectifs
- Mettre à disposition des clients les FDS au format PDF.
- Permettre l'accès aux FDS uniquement pour les produits déjà commandés.
- Envoyer des notifications lors des mises à jour des FDS.

### Technologies Utilisées
- **Framework**: Symfony 6.4
- **Frontend**: Twig avec Bootstrap
- **Base de données**: MySQL 8
- **Autres outils**: Docker, PhpMyAdmin

## Structure de la Base de Données

La base de données est conçue pour stocker les informations des utilisateurs, des produits, des FDS, et des notifications de mise à jour. Elle inclut les tables suivantes :
- `User`: Informations sur les clients.
- `Product`: Détails des produits chimiques vendus.
- `Notification`: Notifications envoyées aux clients pour les mises à jour des FDS.
- `AccessFDS`: Enregistrements des accès des utilisateurs aux FDS des produits.

## Cas d'Utilisation

1. **Accès aux FDS**:
   Les clients après s'être identifiés peuvent accéder aux FDS des produits qu'ils ont commandés.

2. **Mise à jour des FDS**:
   Lorsqu'une FDS est mise à jour, une notification est envoyée automatiquement aux clients ayant accès à cette FDS.

3. **Gestion des Utilisateurs**:
   Les utilisateurs peuvent gérer leur profil et consulter l'historique de leurs produits commandés.

## Maquette (Mockup)

### Guide d'installation

```
git clone https://github.com/Rederox/GEDM1.git

cd GEDM1

docker-compose build

docker-compose up -d

cd project

npm install

npm run dev-server

docker exec -it symfony bash

#! Docker container command

composer install

#! Instruction Faker

php bin/console doctrine:fixtures:load
```
