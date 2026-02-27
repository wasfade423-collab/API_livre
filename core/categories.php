<?php
    class categories{
        // colonnes de la table "categories"
        public $id;
        public $category_name;
        // objet PDO pour les opérations de base
        public $connection;
        public $table = "categories";
        public $description;
        public $create_at;

        // constructeur : on passe la connexion à la base de données
        public function __construct($database){
            $this->connection = $database;
        }
//creer une Categorie
        public  function createCategorie(){
            // préparation de la requête d'insertion
            $query = "INSERT INTO $this->table SET category_name = :category_name, description = :description";
            $stmt = $this->connection->prepare($query);
            // liaison des valeurs
            $stmt->bindParam(":category_name", $this->category_name);
            $stmt->bindParam(":description", $this->description);
            try{
                if($stmt->execute()){
                    return true;
                }
            }catch(Exception $e){
                return false;
            }
        } 
        
//modifier une categorie
        public function updateCategory($id){
            $query =  "UPDATE $this->table SET category_name = :category_name, description = :description WHERE id = :id";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(":category_name", $this->category_name);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":id", $id);
            try{                
                if($stmt->execute()){
                    return true;
                }
            }
            catch(Exception $e){
                return false;
            }
        }  
        
//supprimer une categorie
        public function deleteCategorie($id){
            $query = "DELETE FROM $this->table WHERE id = :id";
            $stmt = $this->connection->prepare($query);
            // liaison de l'id
            $stmt->bindParam(":id", $id);
            try{
                if($stmt->execute()){
                    return true;
                }
            }
            catch(Exception $e){
                return false;
            }
        }

//getAll
        public function getCategories(){
            $query = "SELECT * FROM $this->table";
            $stmt = $this->connection->prepare($query);
            try{
                if($stmt->execute()){
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
            }
            catch(Exception $e){
                return false;
            }
        }
        
//getOneCatgorie
        public function getOneCategorie($id){
            // requête paramétrée sélection limitée
            $query = "SELECT * FROM $this->table WHERE id = :id LIMIT 1";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(":id", $id);
            try{
                if($stmt->execute()){
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
            }
            catch(Exception $e){
                return false;
            }
        }
//getLivresByCategorie
        public function getLivresByCategorie($id){
            // jointure avec la table livres pour récupérer les détails
            $query = "SELECT
                c.category_name as category_name,
                l.id,
                l.category_id,
                l.title,
                l.description,
                l.author,
                l.create_at,                
                l.update_at,                
                l.impressions,                
                l.etoiles                
            
             FROM livres l LEFT JOIN categories c ON l.category_id = c.id WHERE l.category_id =:id";
            $stmt = $this->connection->prepare($query);

            $stmt->bindPAram(":id", $id);
            try{
                if($stmt->execute()){
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
            }
            catch(Exception $e){
                return false;
            }
        }              
    }
?>