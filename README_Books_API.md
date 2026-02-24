
# 📚 Books API

API REST pour la gestion de livres et de catégories, développée en PHP avec MySQL.  
Elle permet de créer, lire, modifier et supprimer des livres, ainsi que de récupérer les livres par catégorie.

---

# 🚀 Technologies utilisées

- PHP (PDO, requêtes préparées)
- MySQL
- JSON (format de réponse)
- Postman (tests)
- Architecture REST

---

# 🌐 URL de base

http://localhost:900/api/

---

# 📦 Format des données

- 📥 Requêtes : application/json via php://input  
- 📤 Réponses : application/json

---

# 🗂️ Ressources disponibles

## 📚 Livres

### 🔹 GET /livres  
   Ex: api/livres/
Récupérer tous les livres

### 🔹 GET /livres/{id}  
   Ex: api/livres/1
Récupérer un livre par son ID

### 🔹 POST /livres 
   Ex: api/livres/
Créer un nouveau livre

Body JSON :
{
  "title": "Nouveau livre",
  "author": "Auteur",
  "description": "Description du livre",
  "impressions": 10,
  "etoiles": 4
}

### 🔹 PUT /livres/{id} 
   Ex: api/livres/1
Modifier un livre existant

### 🔹 DELETE /livres/{id} 
   Ex: api/livres/2
Supprimer un livre

---

## 🏷️ Catégories

### 🔹 GET /categories  
   Ex: api/categories/
Récupérer toutes les catégories

### 🔹 GET /categories/{id}/livres  
   Ex: api/categories/2/livres
Récupérer tous les livres d’une catégorie

---

# 🧱 Structure des données

## 📚 Livre

| Champ | Type | Description |
|-------|------|-------------|
id | int | Identifiant unique |
title | string | Titre du livre |
author | string | Auteur |
description | text | Description |
impressions | int | Nombre d’impressions |
etoiles | int | Note |
categorie_id | int | ID de la catégorie |
create_at | datetime | Date de création |
update_at | datetime | Date de modification |

---

## 🏷️ Catégorie

| Champ | Type | Description |
|-------|------|-------------|
id | int | Identifiant unique |
category_name | string | Nom de la catégorie |
description | text | Description |

---

# 🧪 Tests avec Postman

1. Choisir la méthode HTTP (GET, POST, PUT, DELETE)  
2. Entrer l’URL (ex: http://localhost:900/api/livres)  
3. Pour POST/PUT :  
   - Body → raw → JSON  
   - Ajouter les données du livre  

---

# 🗄️ Base de données

- SGBD : MySQL  
- Accès via PDO  
- Requêtes préparées pour éviter les injections SQL  

---

# ⚠️ Sécurité actuelle

- Pas de CORS  
- Pas d’authentification (API publique)  
- Pas encore de gestion des erreurs HTTP  

---

# 📁 Structure du projet

api/
├── apiVue/           # Dossier des fichiers communiquent avec la vue  
├── core/             # Logique CRUD livres & categories  
├── database/         # Dossier de la base de données  
├── index.php        # Routeur principal  
├── README_Books_API.md        # Documentation  

---

# 🔧 Installation

1. Cloner le projet  
2. Créer la base MySQL  
3. Configurer les accès dans db.php  
4. Lancer le serveur local :  
   php -S localhost:900  
5. Tester avec Postman  

---

# 🎯 Améliorations futures

- Gestion des erreurs HTTP (400, 404, 500)  
- Validation des données  
- Authentification (API Key ou JWT)  
- Pagination des résultats  
- CORS configurable  

---

# 👨‍💻 Auteur

Projet réalisé dans le cadre de l’apprentissage des API REST avec PHP et MySQL.
