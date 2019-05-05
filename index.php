<?php

require 'Slim/Slim.php';
require 'CorsSlim/CorsSlim.php';

require 'Models/AccessLevels.php';
require 'Models/User.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$corsOptions = array("origin" => "*", "allowMethods" => array("POST, GET, OPTIONS, PUT, DELETE"));

$cors = new \CorsSlim\CorsSlim($corsOptions);

$app->add($cors);

//public routes
$app->hook('slim.before.dispatch', function () use ($app) {
    
    $publicRoutes = array('/login');

    if(!in_array($app->router()->getCurrentRoute()->getPattern(), $publicRoutes)){ 
        
        $token = validateToken();

        if($token['type'] == FALSE){
            $app->halt(401);
        }
    }
    
});

$app->post('/login', 'login');

//Access Levels
$app->get('accesslevels/:id', array('AccessLevels','getOneAccessLevels'));
$app->get('accesslevels',     array('AccessLevels','getAllAccessLevels'));
$app->get('accesslevelsnotroot',     array('AccessLevels','getAllAccessLevelsNotRoot'));


//User
$app->post('user', array('User','newUser'));
$app->put('user/:id', array('User','updateUser'));
$app->delete('user/:id', array('User','deleteUser'));
$app->get('user/:id', array('User','getOneUser'));
$app->get('user', array('User','getAllUser'));


/**
 * @api {POST} /login 
 * @apiVersion 1.0.0
 * @apiName login
 * @apiGroup Login
 * @apiPermission none
 *
 * @apiDescription Faz a autenticação dos usuários
 * 
 * @apiParam {string} email Email do usuário.
 * @apiParam {string} password Senha do usuário.
 *
 * @apiSuccess {boolean} type Retorna verdadeiro se existe o usuário.
 * @apiSuccess {object[]} data Retorna um objeto com informações do usuário.
 * @apiError {boolean}FALSE  Retorna falso se o usuário não existe.
 * @apiError {string} data Mensagem de erro. 
 * @apiSuccessExample {json} Success-Response:
 *      OK
 *     {"type":true,"data":"name","id":"id","token":"token","access_levels":"access_levels","organization":"organization"}
 * 
 * @apiErrorExample {json} Error-Response:
 *      Not Found
 *     {"type": false,"data": "Incorrect email/password"}
 * 
 * @apiSampleRequest off
 * 
 */


function login(){
    
    $request = \Slim\Slim::getInstance()->request();
	$login = json_decode($request->getBody());
        
        $sql = "SELECT u.id, u.name, u.token, al.code AS access_levels, o.id AS organization FROM user u INNER JOIN access_levels al ON al.id=u.access_levels INNER JOIN organization o ON u.organization=o.id WHERE u.email = :email AND u.password = :password";	
        
        if((isset($login->password)) && (isset($login->email))){
            
            try {

                $db = getConnection();
                $stmt = $db->prepare($sql); 
                $stmt->bindParam(':email', $login->email, PDO::PARAM_STR);
                $stmt->bindParam(':password', md5($login->password), PDO::PARAM_STR);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_OBJ);
                $db = null;

                if($user){
                    $token = bin2hex(openssl_random_pseudo_bytes(16)); 
                    $db = getConnection();
                    $sql = "UPDATE user SET token = :token WHERE id = :id";
                    $stmt = $db->prepare($sql); 
                    $stmt->bindParam(':token', $token, PDO::PARAM_STR);
                    $stmt->bindParam(':id', $user->id, PDO::PARAM_INT);
                    $stmt->execute();
                    $db = null;
                    print('{"type":true,"data":"'.$user->name.'","id":"'.$user->id.'","token":"'.$token.'","access_levels":"'.$user->access_levels.'","organization":"'.$user->organization.'"}'); 
                } else {
                    print('{"type":false,"data":"Incorrect email/password"}');    
                }

            } catch(PDOException $e) {
                echo '{"type":false,"data":"'.$e->getMessage().'"}'; 
            }
        }else{
            $app = \Slim\Slim::getInstance();
            $app->halt(406);
        }
        
}

function validateToken(){
    
    $isset = apache_request_headers();
        
    if(isset($isset["Authorization"])){

        $head = $isset["Authorization"];//apache_request_headers()["Authorization"];
    
        $token = explode(" ", $head);

        $token = $token[1];

        $sql = "SELECT name, token FROM user WHERE token = :token;";    

        $db = getConnection();
        $stmt = $db->prepare($sql); 
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;

        if($user) {
            $return = array("type" => TRUE, "data" => $user->name, "token" => $user->token);
        } else {
            $return = array("type" => FALSE, "data" => "Incorrect Token", "token"=> NULL);
        }
    }else{
        $return = array("type" => FALSE, "data" => "No Token", "token"=> NULL);
    }
    
    return $return;
}

function getConnection() {
	$dbhost="127.0.0.1";
    
	$dbuser="root";
	$dbpass="";
    $dbname="lista-compras";

	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}

$app->run();

?>