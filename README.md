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
- **Autres outils**: Docker, PhpMyAdmin, MailHog

## Structure de la Base de Données

La base de données est conçue pour stocker les informations des utilisateurs, des produits, des FDS, et des notifications de mise à jour. Elle inclut les tables suivantes :
- `User`: Informations sur les clients.
- `Product`: Détails des produits chimiques vendus.
- `File`: Fiches de données de sécurité (FDS) des produits.
- `Notification`: Notifications envoyées aux clients pour les mises à jour des FDS.

## Cas d'Utilisation

1. **Accès aux FDS**:
   Les clients après s'être identifiés peuvent accéder aux FDS des produits qu'ils ont commandés.

2. **Mise à jour des FDS**:
   Lorsqu'une FDS est mise à jour, une notification est envoyée automatiquement aux clients ayant accès à cette FDS.

3. **Gestion des Utilisateurs**:
   Les utilisateurs peuvent gérer leur profil et consulter l'historique de leurs produits commandés.

## Maquette (Mockup)

Une maquette de l'interface utilisateur est fournie pour illustrer l'interaction avec le système. (Inclure le lien ou les images des maquettes ici)

## Démonstration en Direct

Une démonstration en direct sera effectuée pour montrer le fonctionnement de la plateforme. Elle comprendra :
- Accès et consultation des FDS.
- Processus de notification lors d'une mise à jour de FDS.
- Interaction avec l'interface utilisateur.

## Problématiques Rencontrées et Solutions

1. **Problématique 1**: (Description du problème et de la solution adoptée)
2. **Problématique 2**: (Description du problème et de la solution adoptée)
3. **Problématique 3**: (Description du problème et de la solution adoptée)

## Appréciation de l'Équipe

(Chaque membre de l'équipe écrira une appréciation sur le travail des autres membres, en soulignant leurs contributions et leurs compétences.)

## Contact

Pour toute question ou retour, veuillez contacter : alexandre.moittie@ensup.eu

---

Ce README offre un aperçu du projet GED pour ChemicalBrothers, mettant en lumière les objectifs, la structure, et les fonctionnalités clés de la plateforme.

