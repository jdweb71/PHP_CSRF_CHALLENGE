//////////////////////////////
// test / demo
/////////////////////////////

//start session
session_start();

// include challenge class
include('challenge.php');

echo '<pre>';

// declare class
$challenge = new challenge();

//generate token
if(isset($_GET['gen_tk'])){
    $challenge->gen_tk($_GET['gen_tk']);
}

if(isset($_SESSION['challenge'])){

// check token without action binded
if(isset($_GET['tk']) && !isset($_GET['action'])){ 
    echo '<br>check token: ';
echo $challenge->check_tk($_GET['tk']);
}

//check token with action binded
else if(isset($_GET['tk']) && isset($_GET['action'])){  
    echo '<br>check token: ';
echo $challenge->check_tk($_GET['tk'],$_GET['action']);
}

// list tokens
echo '<br>tokens list: ';
print_r($_SESSION['challenge']);


}else{
    echo 'no token';    
}
echo '</pre>';
?>
