<?php
function getPage(){    
    $lesPages['accueil'] = "accueilControleur";     
    $lesPages['ajoutdeveloppeur'] = "ajoutdeveloppeurControleur";    
    if (isset($_GET['page'])){        
        $page = $_GET['page'];    
    }    else{        
        $page = 'accueil';
    }    if (isset($lesPages[$page])){        
        $contenu = $lesPages[$page];    
        }    else{        
            $contenu = $lesPages['accueil'];    
            }    return $contenu;}
            
            
            ?>