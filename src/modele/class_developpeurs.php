<?php
    class developpeur{
        private $db;
        private $insert;
        private $select;
        

        public function __construct($db){
            $this->db = $db;
            $this->insert = $db->prepare("INSERT into developpeur(nom,prenom,indiceremuneration,couthoraire) values(:nom,:prenom,:indiceremuneration,:couthoraire)");
            $this->select = $db->prepare("SELECT nom, prenom, indiceremuneration, couthoraire from developpeur order by nom");
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
    }
    ?>