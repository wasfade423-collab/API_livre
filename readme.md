Nom de l'API: "Books API"

Type de l'API: REST;
Format de réponse: JSON Uniquement;
URL locale actuelle: http://localhost:900/api/
RESSOURCES DISPONIBLES
  Livres
    GET /livres : Tous les livres de la base de données
    GET /livres/{id} : Toutes les donnéees du livre ayant l'id {id}. Ex: GET /livres/1
    POST /livres : Crée un nouveau livre en définissant :
        titre -> title,
        auteur -> author,
        description -> description,
        impressions -> impressions,
        etoiles -> etoiles
    PUT /livres/{id} : Modifiez des donnéees du livre ayant l'id {id}. Ex: PUT /livres/2
        titre -> title,
        auteur -> author,
        description -> description,
        impressions -> impressions,
        etoiles -> etoiles    
    DELETE /livres/{id} : Supprimer un livre et tous ses données de la base de données
  Categories
    GET /categories : Tous les categories de la base de données
    GET /categories/{id}/livres : Toutes les donnéees de la categorie ayant l'id {id}. Ex: GET /categories/1/livres/
STRUCTURES DES DONNEES
  Livres
    id,
    title,
    author,
    description,
    impressions,
    etoiles,
    categorie_id,
    create_at,
    update_at
  Categories    
    id,
    category_name,
    description
SECURITE
    Sans CORS
    No API key and token
REQUESTE FORMAT
    JSON(php://input)
JE NE GERES AUCUNE ERREUR
OUTIL DE TEST
    Postman
BASE DE DONNEE
    Mysql
OBJECTIF DU READ ME
    Github et Documention interne    