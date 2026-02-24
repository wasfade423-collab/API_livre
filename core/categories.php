<?php
    class categories{
        public $id;
        public $category_name;
        public $connection;
        public $table = "categories";

        public function __construct($database){
            $this->connection = $database;
        }

//getAll
        public function getCategories(){
            $query = "SELECT * FROM $this->table";
            $stmt = $this->connection->prepare($query);
            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }else{
                return false;
            }
        }  
//getLivresByCategorie
        public function getLivresByCategorie($id){
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

            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }else{
                return false;
            }
        }              
    }
?>