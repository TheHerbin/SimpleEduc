<?php
    class developpeur{
        private $db;
        private $insert;
        

        public function __construct($db){
            $this->db = $db;
            $this->insert = $db->prepare("insert into developpeur(nom,prenom,indiceremuneration,couthoraire,) values(:nom,:prenom,:indiceremuneration,:couthoraire)");

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
    }
    ?>