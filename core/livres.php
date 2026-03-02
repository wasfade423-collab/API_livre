<?php
    class Livres{
        // colonnes de la table "livres" (champs de la base de données)
        public $id;
        public $title;
        public $description;
        public $author;
        public $category_id;
        public $create_at;
        public $update_at;
        public $chemin;
        public $table = "livres";
        public $impressions;
        public $category_name;
        public $categoriy_id;
        public $etoiles;
        // objet PDO utilisé pour les requêtes SQL
        public $connection;

        // le constructeur reçoit la connexion à la base de données
        public function __construct($database){
            $this->connection = $database;
        }

//getAllLivres
        public function getAll(){
            $query = "SELECT 
                c.category_name,
                l.id,
                l.category_id,
                l.title,
                l.description,
                l.author,
                l.create_at,                
                l.update_at,                
                l.impressions,                
                l.etoiles,
                l.chemin
             FROM $this->table l LEFT JOIN categories c ON l.category_id = c.id ORDER BY l.create_at DESC";
            $stmt = $this->connection->prepare($query);
            // préparation OK, on exécute la requête
            try{
                if($stmt->execute()){
                return $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            } 
            catch(Exception $e){
                return false;
            }
        }
//getOneLivre
        public function getOne($id){
            // requête paramétrée pour empêcher l'injection SQL
            $query = "SELECT
                c.category_name,
                l.id,
                l.category_id,
                l.title,
                l.description,
                l.author,
                l.create_at,                
                l.update_at,                
                l.impressions,                
                l.etoiles,                
                l.chemin
             FROM $this->table l LEFT JOIN categories c ON l.category_id = c.id WHERE l.id =:id LIMIT 1";

            $stmt = $this->connection->prepare($query);

            $stmt->bindParam(':id', $id);

            try{
                if($stmt->execute()){
                    // retourne un enregistrement (ou tableau vide)
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
            }
            catch(Exception $e){
                return false;
            }
        }
//updateOneLivre
        public function update($id){
            // requête de mise à jour paramétrée
            $query = "UPDATE $this->table SET title = :title, description = :description, author =:author, category_id =:category_id, impressions =:impressions, etoiles =:etoiles, chemin =:chemin WHERE id =:id";
            $stmt = $this->connection->prepare($query);

            // nettoyage des données fournies dans l'objet avant liaison
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->description = htmlspecialchars(strip_tags($this->description));
            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->impressions = htmlspecialchars(strip_tags($this->impressions));
            $this->etoiles = htmlspecialchars(strip_tags($this->etoiles));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            $this->chemin = htmlspecialchars(strip_tags($this->chemin));

            // liaison des valeurs aux paramètres de la requête
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':author', $this->author);
            $stmt->bindParam(':impressions', $this->impressions);
            $stmt->bindParam(':etoiles', $this->etoiles);
            $stmt->bindParam(':category_id', $this->category_id);
            $stmt->bindParam(':chemin', $this->chemin);

            try{
                if($stmt->execute()){
                    return true;
                }
            }
            catch(Exception $e){
                return false;
            }
        }
//delete
        public function delete($id){
            $query = "DELETE FROM $this->table WHERE id =:id";

            // préparation de la requête
            $stmt=$this->connection->prepare($query);

            // liaison du paramètre id
            $stmt->bindParam(':id', $id);

            try{
                if($stmt->execute()){
                    return true;
                }
            }
            catch(Exception $e){
                return false; 
            }
        } 
//cree un livre
        public function create(){
            // requête d'insertion paramétrée
            $query = "INSERT INTO $this->table SET title = :title, description =:description, category_id =:category_id, author =:author, impressions =:impressions, etoiles =:etoiles, chemin =:chemin";
            $stmt = $this->connection->prepare($query);

            // liaison des champs de l'objet aux paramètres
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':author', $this->author);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':impressions', $this->impressions);
            $stmt->bindParam(':etoiles', $this->etoiles);
            $stmt->bindParam(':category_id', $this->category_id);
            $stmt->bindParam(':chemin', $this->chemin);

            // try{
            //     if($stmt->execute()){
            //         return true;
            //     }
            // }
            // catch(Exception $e){
            //     return false;
            // }
            if($stmt->execute()){
                return true;
            }else{
                return  false;
            }
        }       
    }
?>