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
        $Utilisateur = new Utilisateur($db);
            $exec = $Utilisateur->insert($nom, $prenom, $indiceremuneration, $couthoraire);
            if (!$exec){
                $form['valide'] = false;
                $form['message'] = 'Problème d\'insertion dans la table utilisateur ';
        }
        





      }
    echo $twig->render('creerUtilisateur.html.twig', array('form'=>$form));
   }


    
    ?>