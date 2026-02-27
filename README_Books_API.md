# 📚 Books API - Documentation Complète

API REST pour la gestion de livres et de catégories, développée en PHP avec MySQL.  
Elle permet de créer, lire, modifier et supprimer des livres, ainsi que de récupérer les livres par catégorie avec un système de gestion complet.

---

## 📋 Table des matières

1. [Technologies](#-technologies-utilisées)
4. [Endpoints](#-endpoints)
5. [Format des données](#-format-des-données)
6. [Exemples d'utilisation](#-exemples-dutilisation)
7. [Gestion des erreurs](#-gestion-des-erreurs)
8. [Sécurité](#-sécurité)
9. [Architecture](#-architecture-du-projet)
10. [Améliorations futures](#-améliorations-futures)

---

## 🚀 Technologies utilisées

| Technologie | Version | Utilisation |
|-------------|---------|------------|
| **PHP** | 7.x+ | Langage principal |
| **PDO** | Native | Accès à la base de données |
| **MySQL** | 5.7+ | Base de données relationnelle |
| **JSON** | Standard | Format de requête/réponse |
| **Postman** | Latest | Tests API |
| **Apache/WAMP** | - | Serveur web local |

---

## 🌐 Configuration de base

### URL de base
```
http://localhost:900/api/
```

### Headers par défaut (gérés automatiquement)
```
Access-Control-Allow-Origin: *
Content-Type: application/json
Access-Control-Allow-Methods: POST, PUT, GET, OPTIONS
Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Access-Control-Allow-Origin, X-Requested-With, Authorization
```

**Note** : CORS est actuellement ouvert à tous les domaines (`*`). À adapter selon vos besoins de sécurité.

---

## 📦 Format des données

### Requêtes entrantes (input)

**Format** : JSON via `php://input`

```json
{
  "title": "Le Seigneur des Anneaux",
  "author": "J.R.R. Tolkien",
  "description": "Une épopée fantastique majeure du XXe siècle",
  "category_id": 1,
  "impressions": 5000000,
  "etoiles": 5,
  "chemin": "xxx.pdf"
}
```

### Réponses sortantes (output)

**Format** : JSON structuré

```json
{
  "data": [
    {
      "id": 1,
      "title": "Le Seigneur des Anneaux",
      "author": "J.R.R. Tolkien",
      "description": "Une épopée fantastique majeure du XXe siècle",
      "category_id": 1,
      "category_name": "Fantasy",
      "impressions": 5000000,
      "etoiles": 5,
      "chemin": "xxx.pdf",
      "create_at": "2024-01-15 10:30:00",
      "update_at": "2024-01-20 14:45:30"
    }
  ]
}
```

---

## 🗺️ Endpoints

### 📚 LIVRES

#### 1️⃣ Récupérer tous les livres

**Requête**
```http
GET /api/livres
```

**Vue d'ensemble**
- **Méthode** : `GET`
- **URL** : `http://xxxxxx/api/livres`
- **Paramètres** : Aucun
- **Authentification** : Non requise

**Réponse (200 OK)**
```json
{
  "data": [
    {
      "id": 1,
      "title": "1984",
      "author": "George Orwell",
      "description": "Roman dystopique",
      "category_id": 1,
      "category_name": "Science-Fiction",
      "impressions": 2000000,
      "etoiles": 5,
      "chemin": "xxx.pdf",
      "create_at": "2024-01-10 08:00:00",
      "update_at": "2024-01-15 09:30:00"
    },
    {
      "id": 2,
      "title": "Pride and Prejudice",
      "author": "Jane Austen",
      "description": "Un classique de la romance",
      "category_id": 2,
      "category_name": "Romance",
      "impressions": 3000000,
      "etoiles": 4,
      "chemin": "xxx.pdf",
      "create_at": "2024-01-12 10:15:00",
      "update_at": "2024-01-18 11:20:00"
    }
  ]
}
```

**Cas d'erreur (aucun livre)**
```json
{
  "message": "Aucun livre pour le moment!"
}
```

---

#### 2️⃣ Récupérer un livre par ID

**Requête**
```http
GET /api/livres/{id}
```

**Vue d'ensemble**
- **Méthode** : `GET`
- **URL** : `http://xxxxxxxx/api/livres/1`
- **Paramètres** : 
  - `id` (entier, obligatoire) : Identifiant du livre

**Validation** : L'ID doit être numérique

**Réponse (200 OK)**
```json
{
  "data": [
    {
      "id": 1,
      "title": "1984",
      "author": "George Orwell",
      "description": "Roman dystopique",
      "category_id": 1,
      "category_name": "Science-Fiction",
      "impressions": 2000000,
      "etoiles": 5,
      "chemin": "xxx.pdf",
      "create_at": "2024-01-10 08:00:00",
      "update_at": "2024-01-15 09:30:00"
    }
  ]
}
```

**Erreur - ID invalide**
```json
{
  "message": "Endpoint incorrect."
}
```

**Erreur - Livre non trouvé (200 OK)**
```json
{
  "message": "Nous n'avons pas trouvé ce livre."
}
```

---

#### 3️⃣ Créer un nouveau livre

**Requête**
```http
POST /api/livres
Content-Type: application/json

{
  "title": "Dune",
  "author": "Frank Herbert",
  "description": "Une épopée spatiale majeure",
  "category_id": 1,
  "impressions": 3000000,
  "etoiles": 5,
  "chemin": "xxx.pdf"
}
```

**Vue d'ensemble**
- **Méthode** : `POST`
- **URL** : `http://xxxxxxxx/api/livres`
- **Body** : JSON (voir format ci-dessus)
- **Authentification** : Non requise
- **Sanitization** : Automatique (htmlspecialchars + strip_tags)

**Champs obligatoires**
| Champ | Type | Format | Exemple |
|-------|------|--------|---------|
| `title` | string | Max 255 caractères | "Dune" |
| `author` | string | Max 150 caractères | "Frank Herbert" |
| `description` | string | Texte libre | "Une épopée spatiale" |
| `impressions` | integer | Nombre positif | 3000000 |
| `etoiles` | integer | Entre 0 et 5 | 5 |
| `chemin` | string | Texte libre | "Une épopée spatiale" |
| `category_id` | integer | ID existant dans categories | 1 |

**Réponse (201 Created)**
```json
{
  "message": "Création effectuée"
}
```

**Erreur - Création échouée**
```json
{
  "message": "Création non effectuée"
}
```

**Erreur - Endpoint incorrect**
```json
{
  "message": "Endpoint incorrect."
}
```

---

#### 4️⃣ Modifier un livre existant

**Requête**
```http
PUT /api/livres/1
Content-Type: application/json

{
  "title": "Dune - Édition révisée",
  "author": "Frank Herbert",
  "description": "Une épopée spatiale majeure - Version mises à jour",
  "impressions": 3500000,
  "etoiles": 5,
  "chemin": "xxxx.pdf"
}
```

**Vue d'ensemble**
- **Méthode** : `PUT`
- **URL** : `http://xxxxxxxxx/api/livres/1`
- **Paramètres** :
  - `id` (entier, obligatoire) : Identifiant du livre
- **Body** : JSON avec champs à modifier
- **Authentification** : Non requise

**Champs modifiables**
```php
$livre->title
$livre->author
$livre->description
$livre->impressions
$livre->etoiles
$livre->chemin
$livre->category_id  // Peut être omis si non fourni
```

**Réponse (200 OK)**
```json
{
  "message": "Modification effectuée"
}
```

**Erreur - Modification échouée**
```json
{
  "message": "Modification non effectuée"
}
```

**Erreur - ID manquant**
```json
{
  "message": "Endpoint incorrect."
}
```

---

#### 5️⃣ Supprimer un livre

**Requête**
```http
DELETE /api/livres/1
```

**Vue d'ensemble**
- **Méthode** : `DELETE`
- **URL** : `http://xxxxxxxxxx/api/livres/1`
- **Paramètres** :
  - `id` (entier, obligatoire) : Identifiant du livre
- **Authentification** : Non requise

**Réponse (200 OK)**
```json
{
  "message": "Suppression effectuée."
}
```

**Erreur - Suppression échouée**
```json
{
  "message": "Suppression échouée."
}
```

**Erreur - ID manquant**
```json
{
  "message": "Endpoint incorrect."
}
```

---

### 🏷️ CATÉGORIES

#### 1️⃣ Récupérer toutes les catégories

**Requête**
```http
GET /api/categories
```

**Vue d'ensemble**
- **Méthode** : `GET`
- **URL** : `http://xxxxxxxxxx/api/categories`
- **Paramètres** : Aucun
- **Authentification** : Non requise

**Réponse (200 OK)**
```json
{
  "data": [
    {
      "id": 1,
      "category_name": "Science-Fiction",
      "description": "Romans de science-fiction et dystopie"
    },
    {
      "id": 2,
      "category_name": "Romance",
      "description": "Histoires d'amour et relations"
    },
    {
      "id": 3,
      "category_name": "Mystère",
      "description": "Thrillers et romans policiers"
    }
  ]
}
```

**Cas d'erreur (aucune catégorie)**
```json
{
  "message": "Aucune catégorie pour le moment."
}
```

---

#### 2️⃣ Récupérer les livres d'une catégorie

**Requête**
```http
GET /api/categories/1
```

**Vue d'ensemble**
- **Méthode** : `GET`
- **URL** : `http://localhost:900/api/categories/1`
- **Paramètres** :
  - `id` (entier, obligatoire) : Identifiant de la catégorie
- **Authentification** : Non requise

**Réponse (200 OK)**
```json
{
  "data": [
    {
      "id": 1,
      "title": "1984",
      "author": "George Orwell",
      "description": "Roman dystopique",
      "category_id": 1,
      "category_name": "Science-Fiction",
      "impressions": 2000000,
      "etoiles": 5,
      "chemin": "xxx.pdf",
      "create_at": "2024-01-10 08:00:00",
      "update_at": "2024-01-15 09:30:00"
    },
    {
      "id": 3,
      "title": "Fondation",
      "author": "Isaac Asimov",
      "description": "Cycle de science-fiction",
      "category_id": 1,
      "category_name": "Science-Fiction",
      "impressions": 1500000,
      "etoiles": 5,
      "chemin": "xxx.pdf",
      "create_at": "2024-01-12 14:20:00",
      "update_at": "2024-01-16 10:05:00"
    }
  ]
}
```

**Erreur - Catégorie sans livres**
```json
{
  "message": "Aucun livres dans cette catégorie."
}
```

**Erreur - ID invalide**
```json
{
  "message": "Endpoint incorrect."
}
```

---

## 🧪 Exemples d'utilisation

### Avec Postman

#### Exemple 1 : Créer un livre

1. **Créer une nouvelle requête**
   - Cliquer sur `+` → New request
   - Méthode : `POST`
   - URL : `http://xxxxxxxxx/api/livres`

2. **Configurer le Body**
   - Cliquer sur l'onglet `Body`
   - Sélectionner `raw`
   - Sélectionner le format `JSON`

3. **Ajouter les données**
```json
{
  "title": "Neuromancien",
  "author": "William Gibson",
  "description": "Le premier roman cyberpunk",
  "category_id": 1,
  "impressions": 1000000,
  "etoiles": 4,
  "chemin": "xxx.pdf"
}
```

4. **Envoyer**
   - Cliquer sur `Send`
   - Vérifier la réponse : `"message": "Création effectuée"`

---

#### Exemple 2 : Récupérer tous les livres

1. **Créer une requête**
   - Méthode : `GET`
   - URL : `http://xxxxxxxxxxx/api/livres`

2. **Envoyer**
   - Cliquer sur `Send`
   - Observer la liste des livres en réponse

---

#### Exemple 3 : Modifier un livre

1. **Créer une requête**
   - Méthode : `PUT`
   - URL : `http://xxxxxxxxxx/api/livres/1`

2. **Body (JSON)**
```json
{
  "title": "Neuromancien - Édition 2024",
  "author": "William Gibson",
  "description": "Le premier roman cyberpunk - Édition anniversaire",
  "impressions": 1500000,
  "etoiles": 5,
  "chemin": "xxx.pdf",
}
```

3. **Envoyer et vérifier**

---

#### Exemple 4 : Supprimer un livre

1. **Créer une requête**
   - Méthode : `DELETE`
   - URL : `http://xxxxxxxx/api/livres/5`

2. **Envoyer**

---

### Avec cURL (Terminal)

#### Récupérer tous les livres
```bash
curl -X GET "http://xxxxxxx/api/livres" \
  -H "Content-Type: application/json"
```

#### Créer un livre
```bash
curl -X POST "http://xxxxxxxxx/api/livres" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Cryptonomicon",
    "author": "Neal Stephenson",
    "description": "Thriller cryptographique",
    "category_id": 1,
    "impressions": 500000,
    "etoiles": 4,
    "chemin": "xxx.pdf",
  }'
```

#### Modifier un livre
```bash
curl -X PUT "http://xxxxxxx/api/livres/1" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "1984 - Édition annotée",
    "author": "George Orwell",
    "description": "Roman dystopique avec annotations",
    "impressions": 2500000,
    "etoiles": 5,
    "chemin": "xxx.pdf"
  }'
```

#### Supprimer un livre
```bash
curl -X DELETE "http://xxxxxxxxx/api/livres/5" \
  -H "Content-Type: application/json"
```

---

## ⚠️ Gestion des erreurs

### Codes HTTP attendus

| Code | Signification | Exemple |
|------|---------------|---------|
| **200** | OK - Requête réussie | GET, PUT, DELETE réussis |
| **201** | Created - Ressource créée | POST réussi |
| **400** | Bad Request - Requête invalide | ID non numérique |
| **404** | Not Found - Ressource non trouvée | Livre inexistant |
| **405** | Method Not Allowed | Méthode HTTP non supportée |
| **500** | Server Error - Erreur serveur | Erreur de base de données |

### Erreurs courantes

#### ❌ Endpoint incorrect
```json
{
  "message": "Endpoint incorrect."
}
```
**Cause** : Paramètre invalide ou manquant  
**Solution** : Vérifier l'URL et les paramètres

---

#### ❌ Livre non trouvé
```json
{
  "message": "Nous n'avons pas trouvé ce livre."
}
```
**Cause** : L'ID du livre n'existe pas  
**Solution** : Vérifier l'ID via GET /livres

---

#### ❌ Création/Modification échouée
```json
{
  "message": "Création non effectuée"
}
```
**Cause** : Données invalides ou erreur base de données  
**Solution** : 
- Vérifier le format JSON
- Vérifier que la catégorie existe
- Consulter les logs d'erreur PHP

---

#### ❌ Méthode non autorisée
```json
{
  "message": "Methode non autorisée."
}
```
**Code HTTP** : 405  
**Cause** : Méthode HTTP non supportée  
**Solution** : Utiliser GET, POST, PUT, ou DELETE

---

## 🔒 Sécurité

### Mesures implémentées

✅ **Requêtes préparées (PDO)**
- Prévient les injections SQL
- Binding des paramètres

✅ **Sanitization des données**
- `htmlspecialchars()` : Échappe les caractères HTML
- `strip_tags()` : Supprime les balises HTML
- Appliqué à la création et modification de livres

✅ **Validation des ID**
- `ctype_digit()` : Vérifie que l'ID est numérique
- Rejette les ID invalides

✅ **Headers CORS**
- Accepte les requêtes cross-origin
- Permet POST, PUT, GET, OPTIONS

### ⚠️ Points de sécurité à améliorer

🔴 **CORS trop permissif**
- `Access-Control-Allow-Origin: *` accepte toutes les sources
- À restreindre en production

🔴 **Pas d'authentification**
- N'importe qui peut modifier/supprimer des livres
- À ajouter : JWT, API Key, ou session

🔴 **Pas de validation côté serveur**
- Pas de vérification de longueur pour `title`, `author`
- Pas de limites de débit (rate limiting)
- Pas de gestion des fichiers volumineux

🔴 **Mots de passe en clair**
- Credentials MySQL stockés dans le code source
- À utiliser avec variables d'environnement

---

## 📁 Architecture du projet

```
apiLivre/
├── 📄 index.php                 # Routeur principal - Point d'entrée
├── 📄 README_Books_API.md       # Cette documentation
├──
├── 📁 /apiVue                   # Fichiers de traitement des requêtes
│  ├── create.php               # POST /livres
│  ├── getAll.php               # GET /livres
│  ├── getOne.php               # GET /livres/{id}
│  ├── update.php               # PUT /livres/{id}
│  ├── delete.php               # DELETE /livres/{id}
│  ├── getCategories.php        # GET /categories
│  └── getLivreCategorie.php    # GET /categories/{id}
│
├── 📁 /core                     # Logique métier (Classes)
│  ├── initialize.php           # Initialisation des dépendances
│  ├── livres.php               # Classe Livres (CRUD)
│  └── categories.php           # Classe Categories (lecture)
│
└── 📁 /database                 # Connexion base de données
   └── database.php             # Configuration PDO
```

### Flux de requête

```
Requête HTTP
    ↓
[index.php] - Route la requête
    ↓
[core/initialize.php] - Charge les classes
    ↓
[core/livres.php ou core/categories.php] - Logique métier
    ↓
[database/database.php] - Exécute la requête SQL
    ↓
[apiVue/...php] - Formate la réponse JSON
    ↓
Réponse HTTP (JSON)
```

---

## 📊 Structure des tables

### Table `categories`

```sql
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

| Colonne | Type | Contraintes | Description |
|---------|------|-------------|-------------|
| `id` | INT | PRIMARY KEY, AUTO_INCREMENT | Identifiant unique |
| `category_name` | VARCHAR(100) | NOT NULL, UNIQUE | Nom de la catégorie (unique) |
| `description` | TEXT | - | Description optionnelle |
| `created_at` | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Timestamp de création |

---

### Table `livres`

```sql
CREATE TABLE livres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    author VARCHAR(150) NOT NULL,
    category_id INT,
    impressions INT DEFAULT 0,
    etoiles INT DEFAULT 0 CHECK (etoiles BETWEEN 0 AND 5),
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);
```

| Colonne | Type | Contraintes | Description |
|---------|------|-------------|-------------|
| `id` | INT | PRIMARY KEY, AUTO_INCREMENT | Identifiant unique |
| `title` | VARCHAR(255) | NOT NULL | Titre du livre |
| `description` | TEXT | NOT NULL | Description complète |
| `author` | VARCHAR(150) | NOT NULL | Nom de l'auteur |
| `category_id` | INT | FOREIGN KEY | Lien vers categories (optionnel) |
| `impressions` | INT | DEFAULT 0 | Nombre d'impressions |
| `etoiles` | INT | DEFAULT 0, CHECK (0-5) | Note entre 0 et 5 |
| `chemin` | TEXT | NOT NULL | chemin complet |
| `create_at` | TIMESTAMP | AUTO | Timestamp de création |
| `update_at` | TIMESTAMP | AUTO | Timestamp de dernière modification |

---

## 🎯 Améliorations futures

### 🔐 Sécurité
- [ ] Authentification avec JWT (JSON Web Token)
- [ ] Gestion des API Keys
- [ ] Restreindre CORS à des domaines spécifiques
- [ ] Rate limiting (limitation du nombre de requêtes)
- [ ] Validation strict des données côté serveur
- [ ] Hachage des identifiants sensibles

### 🚀 Fonctionnalités
- [ ] Pagination des résultats (`?page=1&limit=10`)
- [ ] Tri configurable (`?sort=title&order=asc`)
- [ ] Filtrage avancé (`?author=Tolkien&minRating=4`)
- [ ] Recherche textuelle
- [ ] Système de permissions (admin, éditeur, lecteur)
- [ ] Gestion des avatars/covers de livres
- [ ] Commentaires et critiques
- [ ] Système de favoris

### 🛠️ Code
- [ ] Refactoring en MVC ou architecture modulaire
- [ ] Utiliser un framework (Laravel, Slim, Symfony)
- [ ] Tests unitaires et d'intégration
- [ ] Logging des erreurs (Monolog)
- [ ] Documentation API (Swagger/OpenAPI)
- [ ] Cache Redis pour les requêtes fréquentes

### 📱 Performance
- [ ] Compression GZIP
- [ ] Optimisation des requêtes SQL (index)
- [ ] Pagination obligatoire pour grandes listes
- [ ] CDN pour les fichiers statiques

### 📦 Déploiement
- [ ] Docker/Docker Compose
- [ ] Variables d'environnement (.env)
- [ ] Tests automatisés (CI/CD)
- [ ] Documentation déploiement

---

## 👨‍💻 Auteur

Projet réalisé dans le cadre de l'apprentissage des API REST avec PHP et MySQL.

**Objectifs d'apprentissage atteints** :
- ✅ Architecture REST
- ✅ Requêtes préparées (PDO)
- ✅ Gestion des requêtes HTTP
- ✅ Routage d'API
- ✅ Sanitization des données
- ✅ Gestion des erreurs basique

---

## 📞 Support

Pour des questions ou problèmes :
1. Vérifier la configuration [database/database.php](database/database.php)
2. Consulter les logs Apache/PHP
3. Utiliser Postman pour tester les endpoints
4. Lire la section [Gestion des erreurs](#-gestion-des-erreurs)

---

**Dernière mise à jour** : février 2026  
**Version** : 1.0
