<?php
    class Entreprise{
        private $db;
        private $insert;
        private $select;
        private $connect;
        private $selectById;
        private $update;
        private $delete;
        

        public function __construct($db){
            $this->db = $db;
            $this->insert = $db->prepare("INSERT into Entreprise(adresse,tel,nom) values(:adresse,:tel,:nom)");
            $this->select = $db->prepare("SELECT id,adresse,tel,nom from Entreprise order by nom");
            $this->connect = $this->db->prepare("SELECT id,adresse,tel,nom from Entreprise where id=:id");
            $this->selectById = $db->prepare("SELECT id,adresse,tel,nom from Entreprise where id=:id");
            $this->update = $db->prepare("UPDATE Entreprise set adresse=:adresse, tel=:tel, nom=:nom where id=:id");
            $this->delete = $db->prepare("DELETE from Entreprise where id = :id");
        }

        public function connect($id){
            $unUtilisateur = $this->connect->execute(array(':id'=>$id));
            if ($this->connect->errorCode()!=0){
            print_r($this->connect->errorInfo());
            }
            return $this->connect->fetch();
            }

        public function delete($id){
            
            $r = true;
            $this->delete->execute(array(':id'=>$id));
            if ($this->delete->errorCode()!=0){
            print_r($this->delete->errorInfo());
            $r=false;
            }
            return $r;
            }

        public function update($adresse,$tel,$nom,$id){
            
            $r = true;
            $this->update->execute(array(':adresse'=>$adresse, ':tel'=>$tel,':nom'=>$nom,':id'=>$id));
            if ($this->update->errorCode()!=0){
            print_r($this->update->errorInfo());
            $r=false;
            }
            return $r;
            }

        public function insert($adresse,$tel,$nom){
            $r=true;
            $this->insert->execute(array(':adresse'=>$adresse,':tel'=>$tel, ':nom'=>$nom));
            if($this->insert->errorCode()!=0){
                print_r($this->insert->errorInfo());
                $r=false;
            }
            return $r;
        }

        public function select(){
            $this->select->execute();
            if ($this->select->errorCode()!=0){
            print_r($this->select->errorInfo());
            }
            return $this->select->fetchAll();
            }

        public function selectById($id){
        
            $this->selectById->execute(array(':id'=>$id));
            if ($this->selectById->errorCode()!=0){
            print_r($this->selectById->errorInfo());
            }
            return $this->selectById->fetch();
            }
    }
    ?>