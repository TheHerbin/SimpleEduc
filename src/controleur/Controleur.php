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
                $form['message'] = 'Problème d\'insertion dans la table utilisateur ';
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
 if(isset($_GET['email'])){
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
 
 $exec = $developpeur->update($nom, $prenom, $indiceremuneration, $couthoraire);
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
        