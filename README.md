# Bookeo 📚

**Site de gestion de collection BD/Manga – PHP + JavaScript + MySQL**

## 📋 Description

Bookeo est une plateforme web dédiée à la gestion d’une collection de BD et de mangas. Elle permet de consulter, ajouter, modifier et supprimer des ouvrages depuis une interface d’administration sécurisée. Le site intègre un carrousel dynamique en JavaScript pour mettre en valeur les visuels des ouvrages de façon fluide et interactive.

Ce projet met en œuvre les bases d’un back-office en PHP avec gestion des données via MySQL, tout en offrant une interface agréable en HTML/CSS/Bootstrap.

## ✨ Fonctionnalités

### ✅ Fonctionnalités déjà mises en place :
- Authentification sécurisée pour accéder à l’administration
- Interface de gestion des articles (CRUD complet)
- Affichage dynamique des BD/Manga
- Carrousel JavaScript pour les visuels
- Mise en page responsive avec Bootstrap
- Protection des accès (pages publiques vs admin)

### 🛠️ Fonctionnalités prévues :
- Système de recherche ou de filtrage par genre ou auteur
- Ajout d’un espace utilisateur pour créer sa propre bibliothèque
- Pagination des articles
- Optimisation SEO des fiches œuvres

## 🧰 Technologies utilisées

- **Backend** : PHP
- **Base de données** : MySQL
- **Frontend** : HTML5, CSS3, Bootstrap, JavaScript (vanilla)
- **Sécurité** : Système de connexion + gestion des sessions

## 🚀 Installation

```bash
git clone https://git@github.com:AlexDelapierre/Bookeo.git
cd bookeo
```

## Configuration :

1. Créez une base de données MySQL et importez le fichier `bookeo.sql` (fourni).

2. Configurez les accès à la BDD dans un fichier `config.php` :

   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'bookeo');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   ```

3. Lancez le projet dans un serveur local type XAMPP ou WAMP.

## 📌 Évolutions envisagées
- Espace membre pour sauvegarder sa collection
- Ajout de commentaires ou de notes sur les œuvres
- Tri par catégories, genres, auteurs
- Upload d’images via formulaire

## 👤 Auteur
Alexandre Delapierre – [LinkedIn](https://www.linkedin.com/in/alexandre-delapierre/)
