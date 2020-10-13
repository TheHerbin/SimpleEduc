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
        $Developpeur = new Developpeur($db);
            $exec = $Developpeur->insert($nom, $prenom, $indiceremuneration, $couthoraire);
            if (!$exec){
                $form['valide'] = false;
                $form['message'] = 'Problème d\'insertion dans la table utilisateur ';
        }
      }
    echo $twig->render('ajoutdeveloppeur.html.twig', array('form'=>$form));
   }

   function listedeveloppeurControleur($twig, $db){
    
    $form = array();
    $Developpeur = new Developpeur($db);
    if(isset($_GET['iddeveloppeur'])){
      
        $exec=$Developpeur->delete($_GET['iddeveloppeur']);
       // die();
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
    $liste = $Developpeur->select();

    echo $twig->render('listedeveloppeur.html.twig', array('form'=>$form,'liste'=>$liste));
}

function modifDeveloppeurControleur($twig, $db){
    $form = array();
 if(isset($_GET['email'])){
 $Developpeur = new Developpeur($db);
 $undeveloppeur = $Developpeur->selectByEmail($_GET['iddeveloppeur']);
 
 if ($undeveloppeur!=null){
 $form['developpeur'] = $undeveloppeur;
 //Patch ca : 
 $role = new Role($db);
 $liste = $role->select();
 $form['roles']=$liste;
 }
 else{
 $form['message'] = 'Utilisateur incorrect';
 }
 }
 else{
     //jusque ici
 if(isset($_POST['btEnvoyer'])){
 $utilisateur = new Utilisateur($db);
 $nom = $_POST['nom'];
 $email = $_POST['email'];
 $prenom = $_POST['prenom'];
 $idrole = $_POST['idrole'];
 $motdepasse = $_POST['motdepasse'];
 $tel = $_POST['tel'];
 $exec=$utilisateur->update($tel, $idrole, $nom, $prenom, $email, password_hash($motdepasse,PASSWORD_DEFAULT));
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
    echo $twig->render('modifUtilisateur.html.twig', array('form'=>$form));
   }



    
    ?>
        