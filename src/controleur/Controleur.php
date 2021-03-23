<?php
function accueilControleur($twig){   
    echo $twig->render('accueil.html.twig', array());
}

function ajoutdeveloppeurControleur($twig,$db){
    $form = array(); 
    if (isset($_POST['envoyer'])){
        
        $nom =$_POST['nom']; 
        $prenom = $_POST['prenom'];
        $indiceremuneration = $_POST['indiceremuneration'];
        $couthoraire = $_POST['couthoraire'];
        $form['valide'] = true;
        $Developpeurs = new Developpeurs($db);
            $exec = $Developpeurs->insert($nom, $prenom, $indiceremuneration, $couthoraire);
            if (!$exec){
                $form['valide'] = false;
                $form['message'] = 'Problème d\'insertion dans la table développeur ';
        }
      }
    echo $twig->render('ajoutdeveloppeur.html.twig', array('form'=>$form));
   }



   function listedeveloppeurControleur($twig, $db){
    
    $form = array();
    $Developpeurs = new Developpeurs($db);
    if(isset($_GET['id'])){
      
        $exec=$Developpeurs->delete($_GET['id']);
        
        if (!$exec){
        $etat = false;
        }
        else{
        $etat = true;
        }
        header('Location: index.php?page=listedeveloppeur&etat='.$etat);
        exit;
        }
        if(isset($_GET['etat'])){
        $form['etat'] = $_GET['etat'];
        }
    $liste = $Developpeurs->select();
        
    echo $twig->render('listedeveloppeur.html.twig', array('form'=>$form,'liste'=>$liste));
}



function modifDeveloppeurControleur($twig, $db){
    
    $form = array();
 if(isset($_GET['id'])){
 $Developpeurs = new Developpeurs($db);
 $undeveloppeur = $Developpeurs->selectById($_GET['id']);
 if ($undeveloppeur!=null){
 $form['developpeur'] = $undeveloppeur;
 }
 else{
 $form['message'] = 'Utilisateur incorrect';
 }
 }
 else{
    
 if(isset($_POST['btEnvoyer'])){
 $developpeur = new Developpeurs($db);
 
 $nom = $_POST['nom'];
 $prenom = $_POST['prenom'];
 $indiceremuneration = $_POST['indiceremuneration'];
 $couthoraire = $_POST['couthoraire'];
 $id = $_POST['id'];
 
 $exec = $developpeur->update($nom, $prenom, $indiceremuneration, $couthoraire, $id);
 if(!$exec){
 $form['valide'] = false;
 $form['message'] = 'Echec de la modification';
 }
 else{
    $form['valide'] = true;
    $form['message'] = 'Modification réussie';
    }
    }
    else{
    $form['message'] = 'Utilisateur non précisé';
    }
    }
    echo $twig->render('modifdeveloppeur.html.twig', array('form'=>$form));
   }


   function ajoutEntrepriseControleur($twig,$db){
    $form = array(); 
    if (isset($_POST['envoyer'])){
        
        $adresse =$_POST['adresse']; 
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $nom = $_POST['nom'];
        $form['valide'] = true;
        $Entreprise = new Entreprise($db);
            $exec = $Entreprise->insert($adresse, $email, $tel, $nom);
            if (!$exec){
                $form['valide'] = false;
                $form['message'] = 'Problème d\'insertion dans la table Entreprise ';
        }
      }
    echo $twig->render('ajoutEntreprise.html.twig', array('form'=>$form));
   }


   function listeEntrepriseControleur($twig, $db){
    
    $form = array();
    $Entreprise = new Entreprise($db);
    if(isset($_GET['id'])){
      
        $exec=$Entreprise->delete($_GET['id']);
        
        if (!$exec){
        $etat = false;
        }
        else{
        $etat = true;
        }
        header('Location: index.php?page=listeEntreprise&etat='.$etat);
        exit;
        }
        if(isset($_GET['etat'])){
        $form['etat'] = $_GET['etat'];
        }
    $liste = $Entreprise->select();
    var_dump($liste);
        
    echo $twig->render('listeEntreprise.html.twig', array('form'=>$form,'liste'=>$liste));
}

function modifEntrepriseControleur($twig, $db){
    
    $form = array();
 if(isset($_GET['id'])){
 $Entreprise = new Entreprise($db);
 $uneEntreprise = $Entreprise->selectById($_GET['id']);
 if ($uneEntreprise!=null){
 $form['entreprise'] = $uneEntreprise;
 }
 else{
 $form['message'] = 'Utilisateur incorrect';
 }
 }
 else{
    
 if(isset($_POST['btEnvoyer'])){
 $Entreprise = new Entreprise($db);
                                                                //A FINIR A PARTIR D'ICI : IL FAUT CONTINUER DE TRANSFORMER POUR LENTREPRISE
 $nom = $_POST['nom'];
 $prenom = $_POST['prenom'];
 $indiceremuneration = $_POST['indiceremuneration'];
 $couthoraire = $_POST['couthoraire'];
 $id = $_POST['id'];
 
 $exec = $developpeur->update($nom, $prenom, $indiceremuneration, $couthoraire, $id);
 if(!$exec){
 $form['valide'] = false;
 $form['message'] = 'Echec de la modification';
 }
 else{
    $form['valide'] = true;
    $form['message'] = 'Modification réussie';
    }
    }
    else{
    $form['message'] = 'Utilisateur non précisé';
    }
    }
    echo $twig->render('modifdeveloppeur.html.twig', array('form'=>$form));
   }



   
    
    ?>
        