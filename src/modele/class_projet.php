<?php
    class Projet{
        private $db;
        private $insert;
        private $select;
        private $connect;
        private $selectById;
        private $update;
        private $delete;
        

        public function __construct($db){
            $this->db = $db;
            $this->insert = $db->prepare("INSERT into developpeurs(nom,prenom,indiceremuneration,couthoraire) values(:nom,:prenom,:indiceremuneration,:couthoraire)");
            $this->select = $db->prepare("SELECT id, nom, prenom, indiceremuneration, couthoraire from developpeurs order by nom");
            $this->connect = $this->db->prepare("SELECT nom, prenom, indiceremuneration, couthoraire from developpeurs where id=:id");
            $this->selectById = $db->prepare("SELECT id, nom, prenom, indiceremuneration, couthoraire from developpeurs where id=:id");
            $this->update = $db->prepare("UPDATE developpeurs set nom=:nom, prenom=:prenom, indiceremuneration=:indiceremuneration, couthoraire=:couthoraire where id=:id");
            $this->delete = $db->prepare("DELETE from developpeurs where id = :id");
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

        public function update($nom,$prenom,$indiceremuneration,$couthoraire,$id){
            
            $r = true;
            $this->update->execute(array(':nom'=>$nom, ':prenom'=>$prenom, ':indiceremuneration'=>$indiceremuneration,':couthoraire'=>$couthoraire, ':id'=>$id));
            if ($this->update->errorCode()!=0){
            print_r($this->update->errorInfo());
            $r=false;
            }
            return $r;
            }

        public function insert($nom,$prenom,$indiceremuneration,$couthoraire){
            $r=true;
            $this->insert->execute(array(':nom'=>$nom,':prenom'=>$prenom,':indiceremuneration'=>$indiceremuneration,':couthoraire'=>$couthoraire));
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