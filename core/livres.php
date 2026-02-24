<?php
    class Livres{
        public $id;
        public $title;
        public $description;
        public $author;
        public $category_id;
        public $create_at;
        public $update_at;
        public $table = "livres";
        public $impressions;
        public $category_name;
        public $categoriy_id;
        public $etoiles;
        public $connection;

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
                l.etoiles
             FROM $this->table l LEFT JOIN categories c ON l.category_id = c.id ORDER BY l.create_at DESC";
            $stmt = $this->connection->prepare($query);
            if($stmt->execute()){
                return $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else{
                return false;
            }
        }
//getOneLivre
        public function getOne($id){
            $query = "SELECT
                c.category_name as categories.category_name,
                l.id,
                l.category_id,
                l.title,
                l.description,
                l.author,
                l.create_at,                
                l.update_at,                
                l.impressions,                
                l.etoiles                
            
             FROM $this->table l LEFT JOIN categories c ON l.category_id = c.id WHERE id =:id LIMIT 1";

            $stmt = $this->connection->prepare($query);

            $stmt->bindParam(':id', $id);

            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }else{
                return false;
            }
        }
//updateOneLivre
        public function update($id){
            $query = "UPDATE $this->table SET title = :title, description = :description, author =:author, category_id =!category_id impressions =:impressions, etoiles =:etoiles WHERE id =:id";
            $stmt = $this->connection->prepare($query);

            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->description = htmlspecialchars(strip_tags($this->description));
            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->impressions = htmlspecialchars(strip_tags($this->impressions));
            $this->etoiles = htmlspecialchars(strip_tags($this->etoiles));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':author', $this->author);
            $stmt->bindParam(':impressions', $this->impressions);
            $stmt->bindParam(':etoiles', $this->etoiles);
            $stmt->bindParam(':category_id', $this->category_id);

            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }
//delete
        public function delete($id){
            $query = "DELETE FROM $this->table WHERE id =:id";

            $stmt=$this->connection->prepare($query);

            $stmt->bindParam(':id', $id);

            if($stmt->execute()){
                return true;
            }else{
                return false; 
            }
        } 
//cree un livre
        public function create(){
            $query = "INSERT INTO $this->table SET title = :title, description =:description, category_id =:category_id, author =:author, impressions =:impressions, etoiles =:etoiles";
            $stmt = $this->connection->prepare($query);

            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':author', $this->author);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':impressions', $this->impressions);
            $stmt->bindParam(':etoiles', $this->etoiles);
            $stmt->bindParam(':category_id', $this->category_id);

            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }       
    }
?>