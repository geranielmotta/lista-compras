<?php

require 'Slim/Slim.php';
require 'CorsSlim/CorsSlim.php';

require 'Models/AccessLevels.php';
require 'Models/Biomass.php';
require 'Models/City.php';
require 'Models/Country.php';
require 'Models/Crop.php';
require 'Models/Experiment.php';
require 'Models/Fertilization.php';
require 'Models/Field.php';
require 'Models/Horizon.php';
require 'Models/Log.php';
require 'Models/Module.php';
require 'Models/Organization.php';
require 'Models/PhenologyCrop.php';
require 'Models/PhenologycalStage.php';
require 'Models/PhytosanitaryControl.php';
require 'Models/Soil.php';
require 'Models/SoilType.php';
require 'Models/State.php';
require 'Models/Station.php';
require 'Models/SubSample.php';
require 'Models/UnitMeasurement.php';
require 'Models/User.php';
require 'Models/UserField.php';
require 'Models/Variety.php';

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
$app->get('/:language/accesslevels/:id', array('AccessLevels','getOneAccessLevels'));
$app->get('/:language/accesslevels',     array('AccessLevels','getAllAccessLevels'));
$app->get('/:language/accesslevelsnotroot',     array('AccessLevels','getAllAccessLevelsNotRoot'));

//Biomass
$app->post('/:language/biomass', array('Biomass','newBiomass'));
$app->put('/:language/biomass/:id', array('Biomass','updateBiomass'));
$app->delete('/:language/biomass/:id', array('Biomass','deleteBiomass'));
$app->get('/:language/biomass/:id', array('Biomass','getOneBiomass'));
$app->get('/:language/biomass', array('Biomass','getAllBiomass'));
$app->get('/:language/biomass/experiment/:experiment', array('Biomass','getBiomassOfExperiment'));

//City
$app->post('/:language/city', array('City','newCity'));
$app->put('/:language/city/:id', array('City','updateCity'));
$app->delete('/:language/city/:id', array('City','deleteCity'));
$app->get('/:language/city/:id', array('City','getOneCity'));
$app->get('/:language/city', array('City','getAllCity'));
$app->get('/:language/city/state/:state', array('City','getAllCityOfState'));

//Country
$app->post('/:language/country', array('Country','newCountry'));
$app->put('/:language/country/:id', array('Country','updateCountry'));
$app->delete('/:language/country/:id', array('Country','deleteCountry'));
$app->get('/:language/country/:id', array('Country','getOneCountry'));
$app->get('/:language/country', array('Country','getAllCountry'));

//Crop
$app->post('/:language/crop', array('Crop','newCrop'));
$app->put('/:language/crop/:id', array('Crop','updateCrop'));
$app->delete('/:language/crop/:id', array('Crop','deleteCrop'));
$app->get('/:language/crop/:id', array('Crop','getOneCrop'));
$app->get('/:language/crop', array('Crop','getAllCrop'));

//Experiment
$app->post('/:language/experiment', array('Experiment','newExperiment'));
$app->put('/:language/experiment/:id', array('Experiment','updateExperiment'));
$app->delete('/:language/experiment/:id', array('Experiment','deleteExperiment'));
$app->get('/:language/experiment/:id', array('Experiment','getOneExperiment'));
$app->get('/:language/experiment', array('Experiment','getAllExperiment'));
$app->get('/:language/experiment/field/:field', array('Experiment','getAllExperimentOfField'));
$app->get('/:language/experiment/user/:user', array('Experiment','getAllExperimentOfUser'));
$app->get('/:language/experiment/organization/:organization', array('Experiment','getAllExperimentOfOrganization'));

//Fertilization
$app->post('/:language/fertilization', array('Fertilization','newFertilization'));
$app->put('/:language/fertilization/:id', array('Fertilization','updateFertilization'));
$app->delete('/:language/fertilization/:id', array('Fertilization','deleteFertilization'));
$app->get('/:language/fertilization/:id', array('Fertilization','getOneFertilization'));
$app->get('/:language/fertilization', array('Fertilization','getAllFertilization'));
$app->get('/:language/fertilization/experiment/:experiment', array('Fertilization','getAllFertilizationOfExperiment'));

//Field
$app->post('/:language/field', array('Field','newField'));
$app->put('/:language/field/:id', array('Field','updateField'));
$app->delete('/:language/field/:id', array('Field','deleteField'));
$app->get('/:language/field/:id', array('Field','getOneField'));
$app->get('/:language/field', array('Field','getAllField'));
$app->get('/:language/field/user/:id', array('Field','getAllFieldOfUser'));
$app->get('/:language/field/organization/:id', array('Field','getAllFieldOfOrganization'));
$app->get('/:language/field/organization/:id/user/:user', array('Field','getAllFieldOfOrganizationAndNotUser'));

//Horizon
$app->post('/:language/horizon', array('Horizon','newHorizon'));
$app->put('/:language/horizon/:id', array('Horizon','updateHorizon'));
$app->delete('/:language/horizon/:id', array('Horizon','deleteHorizon'));
$app->get('/:language/horizon/:id', array('Horizon','getOneHorizon'));
$app->get('/:language/horizon', array('Horizon','getAllHorizon'));
$app->get('/:language/horizon1/organization/:id', array('Horizon','getAllHorizonOneOfOrganization'));
$app->get('/:language/horizon2/organization/:id', array('Horizon','getAllHorizonTwoOfOrganization'));
$app->get('/:language/horizon3/organization/:id', array('Horizon','getAllHorizonThreeOfOrganization'));

//Log
$app->post('/:language/log', array('Log','newLog'));
$app->get('/:language/log/organization/:id/module/:module', array('Log','getAllLogOfOrganizationAndModule'));

//Module
$app->get('/:language/module/:id', array('Module','getOneModule'));
$app->get('/:language/module', array('Module','getAllModule'));

//Organization
$app->post('/:language/organization', array('Organization','newOrganization'));
$app->put('/:language/organization/:id', array('Organization','updateOrganization'));
$app->delete('/:language/organization/:id', array('Organization','deleteOrganization'));
$app->get('/:language/organization/:id', array('Organization','getOneOrganization'));
$app->get('/:language/organization', array('Organization','getAllOrganization'));

//PhenologyCrop
$app->post('/:language/phenologycrop', array('PhenologyCrop','newPhenologyCrop'));
$app->post('/:language/phenologycrop/image', array('PhenologyCrop','newImageOfPhenologyCrop'));
$app->put('/:language/phenologycrop/:id', array('PhenologyCrop','updatePhenologyCrop'));
$app->delete('/:language/phenologycrop/:id/:img', array('PhenologyCrop','deletePhenologyCrop'));
$app->get('/:language/phenologycrop/:id', array('PhenologyCrop','getOnePhenologyCrop'));
$app->get('/:language/phenologycrop', array('PhenologyCrop','getAllPhenologyCrop'));
$app->get('/:language/phenologycrop/experiment/:id', array('PhenologyCrop','getAllPhenologyCropOfExperiment'));

//Phenologycal Stage
$app->post('/:language/phenologycalstage', array('PhenologycalStage','newPhenologycalStage'));
$app->put('/:language/phenologycalstage/:id', array('PhenologycalStage','updatePhenologycalStage'));
$app->delete('/:language/phenologycalstage/:id', array('PhenologycalStage','deletePhenologycalStage'));
$app->get('/:language/phenologycalstage/:id', array('PhenologycalStage','getOnePhenologycalStage'));
$app->get('/:language/phenologycalstage', array('PhenologycalStage','getAllPhenologycalStage'));
$app->get('/:language/phenologycalstage/crop/:crop', array('PhenologycalStage','getAllPhenologycalStageOfCrop'));
$app->get('/:language/phenologycalstage/experiment/:experiment', array('PhenologycalStage','getAllPhenologycalStageOfExperiment'));

//Control Pest Desease
$app->post('/:language/phytosanitarycontrol', array('PhytosanitaryControl','newPhytosanitaryControl'));
$app->put('/:language/phytosanitarycontrol/:id', array('PhytosanitaryControl','updatePhytosanitaryControl'));
$app->delete('/:language/phytosanitarycontrol/:id', array('PhytosanitaryControl','deletePhytosanitaryControl'));
$app->get('/:language/phytosanitarycontrol/:id', array('PhytosanitaryControl','getOnePhytosanitaryControl'));
$app->get('/:language/phytosanitarycontrol', array('PhytosanitaryControl','getAllPhytosanitaryControl'));
$app->get('/:language/phytosanitarycontrol/experiment/:experiment', array('PhytosanitaryControl','getAllPhytosanitaryControlOfExperiment'));

//Soil
$app->post('/:language/soil', array('Soil','newSoil'));
$app->put('/:language/soil/:id', array('Soil','updateSoil'));
$app->delete('/:language/soil/:id', array('Soil','deleteSoil'));
$app->get('/:language/soil/:id', array('Soil','getOneSoil'));
$app->get('/:language/soil', array('Soil','getAllSoil'));
$app->get('/:language/soil/user/:id', array('Soil','getAllSoilOfUser'));
$app->get('/:language/soil/organization/:id', array('Soil','getAllSoilOfOrganization'));

//Soil Type
$app->post('/:language/soiltype', array('SoilType','newSoilType'));
$app->put('/:language/soiltype/:id', array('SoilType','updateSoilType'));
$app->delete('/:language/soiltype/:id', array('SoilType','deleteSoilType'));
$app->get('/:language/soiltype/:id', array('SoilType','getOneSoilType'));
$app->get('/:language/soiltype', array('SoilType','getAllSoilType'));

//State
$app->post('/:language/state', array('State','newState'));
$app->put('/:language/state/:id', array('State','updateState'));
$app->delete('/:language/state/:id', array('State','deleteState'));
$app->get('/:language/state/:id', array('State','getOneState'));
$app->get('/:language/state', array('State','getAllState'));
$app->get('/:language/state/country/:country', array('State','getAllStateOfCountry'));

//Station
$app->post('/:language/station', array('Station','newStation'));
$app->put('/:language/station/:id', array('Station','updateStation'));
$app->delete('/:language/station/:id', array('Station','deleteStation'));
$app->get('/:language/station/:id', array('Station','getOneStation'));
$app->get('/:language/station', array('Station','getAllStation'));

//Sub Sample
$app->post('/:language/subsample', array('SubSample','newSubSample'));
$app->put('/:language/subsample/:id', array('SubSample','updateSubSample'));
$app->delete('/:language/subsample/:id', array('SubSample','deleteSubSample'));
$app->get('/:language/subsample/:id', array('SubSample','getOneSubSample'));
$app->get('/:language/subsample', array('SubSample','getAllSubSample'));
$app->get('/:language/subsample/biomass/:biomass', array('SubSample','getAllSubSampleOfBiomass'));

//Unit Measurement
$app->post('/:language/unitmeasurement', array('UnitMeasurement','newUnitMeasurement'));
$app->put('/:language/unitmeasurement/:id', array('UnitMeasurement','updateUnitMeasurement'));
$app->delete('/:language/unitmeasurement/:id', array('UnitMeasurement','deleteUnitMeasurement'));
$app->get('/:language/unitmeasurement/:id', array('UnitMeasurement','getOneUnitMeasurement'));
$app->get('/:language/unitmeasurement', array('UnitMeasurement','getAllUnitMeasurement'));

//User
$app->post('/:language/user', array('User','newUser'));
$app->put('/:language/user/:id', array('User','updateUser'));
$app->delete('/:language/user/:id', array('User','deleteUser'));
$app->get('/:language/user/:id', array('User','getOneUser'));
$app->get('/:language/user', array('User','getAllUser'));
$app->get('/:language/user/organization/:organization', array('User','getAllUserOfOrganization'));
$app->get('/:language/user/field/:field', array('User','getAllUserOfField'));

//User Field
$app->post('/:language/userfield', array('UserField','newUserField'));
$app->put('/:language/userfield/:id', array('UserField','updateUserField'));
$app->delete('/:language/userfield/:id', array('UserField','deleteUserField'));
$app->get('/:language/userfield/:id', array('UserField','getOneUserField'));
$app->get('/:language/userfield', array('UserField','getAllUserField'));
$app->get('/:language/userfield/organization/:id', array('UserField','getAllUserFieldOfOrganization'));

//Variety
$app->post('/:language/variety', array('Variety','newVariety'));
$app->put('/:language/variety/:id', array('Variety','updateVariety'));
$app->delete('/:language/variety/:id', array('Variety','deleteVariety'));
$app->get('/:language/variety/:id', array('Variety','getOneVariety'));
$app->get('/:language/variety', array('Variety','getAllVariety'));
$app->get('/:language/variety/crop/:id', array('Variety','getAllVarietyOfCrop'));


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
	$dbpass="root";
    $dbname="collect_data";
/*
    $dbuser="collectdata";
    $dbpass="c0ll3ctd4t43ns04g";
    $dbname="collect_data";
*/
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}

$app->run();

?>
