<?php
    class Client{
        private $db;
        private $insert;
        

        public function __construct($db){
            $this->db = $db;
            $this->insert = $db->prepare("insert into client(coordoneesentreprise,coordonneescontrat,nom) values(:coordoneesentreprise,:coordonneescontrat,:nom)");

        }
        public function insert($coordoneesentreprise,$coordonneescontrat,$nom){
            $r=true;
            $this->insert->execute(array(':coordoneesentreprise'=>$coordoneesentreprise,':coordonneescontrat'=>$coordonneescontrat,':nom'=>$nom));
            if($this->insert->errorCode()!=0){
                print_r($this->insert->errorInfo());
                $r=false;
            }
            return $r;
        }
    }
    ?>