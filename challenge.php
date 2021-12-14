<?php


///////////////////////////////////////////////
// CSRF Challenge
///////////////////////////////////////////////

class challenge{

///////////////////////////////////////////////
// generate token for CSRF protection     
// $action= (lier le jeton à une action, string , optionnel)
///////////////////////////////////////////////
 
function gen_tk($action=false){

    GLOBAL $_SESSION;

    if(!isset($_SESSION['challenge'])){  
      $_SESSION['challenge'] = array();
    }

    $tk = sha1(uniqid(rand(), true));
    
 $challenge = array('tk'=>$tk,'action'=>$action);
 array_push($_SESSION['challenge'],$challenge);

      return $tk;
    }

///////////////////////////////////////////////
// check if token is correct for CSRF protection    
// $tk=  (jeton à verifier, string , requis)
// $action= (action à verifier si le jeton est lié à une action, string , optionnel)
// note: si une action est lié au jeton , le paramètre action est requis.
///////////////////////////////////////////////    
function check_tk($tk,$action=false){
GLOBAL $_SESSION;

$valid = false;

if(isset($tk) && isset($action) && isset($_SESSION['challenge'])){
  foreach(array_keys($_SESSION['challenge']) as $key){
    if(($_SESSION['challenge'][$key]['tk'] == $tk) && ($_SESSION['challenge'][$key]['action'] == $action)){
      unset($_SESSION['challenge'][$key]); 
      $valid = true;
      break;
    }
  }
}
if(isset($tk) && ($action == false) && isset($_SESSION['challenge'])){  

  foreach(array_keys($_SESSION['challenge']) as $key){
    if(($_SESSION['challenge'][$key]['tk'] == $tk) && ($_SESSION['challenge'][$key]['action'] == false)){
      unset($_SESSION['challenge'][$key]); 
      $valid = true;
      break;
    }
  }
}

return $valid;

}

}

?>
