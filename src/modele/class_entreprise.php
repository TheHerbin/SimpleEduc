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
            $this->insert = $db->prepare("INSERT into Entreprise(adresse,email,tel) values(:adresse,:email,:tel)");
            $this->select = $db->prepare("SELECT id,adresse,email,tel from Entreprise order by email");
            $this->connect = $this->db->prepare("SELECT id,adresse,email,tel from Entreprise where id=:id");
            $this->selectById = $db->prepare("SELECT id,adresse,email,tel from Entreprise where id=:id");
            $this->update = $db->prepare("UPDATE Entreprise set adresse=:adresse, email=:email, tel=:tel");
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

        public function update($adresse,$email,$tel,$id){
            
            $r = true;
            $this->update->execute(array(':adresse'=>$adresse, ':email'=>$email, ':tel'=>$tel,':id'=>$id));
            if ($this->update->errorCode()!=0){
            print_r($this->update->errorInfo());
            $r=false;
            }
            return $r;
            }

        public function insert($adresse,$email,$tel){
            $r=true;
            $this->insert->execute(array(':adresse'=>$adresse,':email'=>$email,':tel'=>$tel));
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