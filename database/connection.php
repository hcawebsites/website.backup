<?php 
// MYSQLI Database
$con = mysqli_connect('localhost', 'root', '', 'hcamis');
//

/**if($con){
    echo 'success';
}else{
    echo 'failed';
}
**/

//Firebase Database
require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Auth;

$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/hcamis-1d6d1-firebase-adminsdk.json');
$factory = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->withDatabaseUri('https://hcamis-1d6d1-default-rtdb.firebaseio.com')
    ->create();

    $database = $factory->getDatabase();
    $auth = $factory->getAuth();
//
?>