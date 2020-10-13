<?php
function accueilControleur($twig){   
    echo $twig->render('accueil.html.twig', array());
}


 function ajoutClientControleur($twig,$db){    
    $form = array(); 
    if (isset($_POST['envoyer'])){
        $nom = $_POST['nom'];
        $coordoneesentreprise = $_POST['coordoneesentreprise'];
        $coordonneescontrat = $_POST['coordonneescontrat'];
        $form['valide'] = true;
        $client = new Client($db);
            $exec = $client->insert($coordoneesentreprise,$coordonneescontrat,$nom);
            if (!$exec){
                $form['valide'] = false;
                $form['message'] = 'Problème d\'insertion dans la table utilisateur ';
        }
    
      }
    echo $twig->render('ajoutClient.html.twig', array('form'=>$form));
   }

   function listeClientControleur($twig, $db){
    
    $form = array();
    $client = new Client($db);
    if(isset($_GET['id'])){
      
        $exec=$client->delete($_GET['id']);
       // die();
        if (!$exec){
        $etat = false;
        }
        else{
        $etat = true;
        }
        header('Location: index.php?page=liste_client&etat='.$etat);
        exit;
        }
        if(isset($_GET['etat'])){
        $form['etat'] = $_GET['etat'];
        }
    $liste = $client->select();

    echo $twig->render('liste_client.html.twig', array('form'=>$form,'liste'=>$liste));
}

   
    ?>