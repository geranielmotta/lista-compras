<?php

class City {
/**
 * @api {POST} /:language/city newCity
 * @apiVersion 1.0.0
 * @apiName newCity
 * @apiGroup City
 * @apiPermission none
 *
 * @apiDescription Esta função faz o cadastramento de um registro
 * 
 * @apiParam {string} language Variavel referente a chave do idioma.
 * @apiParam {string} name Nome da cidade.
 * @apiParam {int} state Chave estrangeira de state.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se cadastrou
 * @apiSuccess {object[] } city Retorna objeto com os valores cadastrados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *     {"type":true,"city": {"description":"Passo Fundo","state":"1","id":"1"}}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function newCity($language) {
        
        $request = \Slim\Slim::getInstance()->request();
        $city = json_decode($request->getBody());
        $sql = "INSERT INTO city(description,state) VALUES (:description,:state)";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":description", $city->description, PDO::PARAM_STR);
            $stmt->bindParam(":state", $city->state, PDO::PARAM_INT);

            $stmt->execute();
            $city->id = $db->lastInsertId();
            $db = null;
            echo '{"type":true, "city":'.json_encode($city).'}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"'.$e->getMessage().'"}';
        }
    }
/**
 * @api {PUT} /:language/city/:id  updateCity
 * @apiVersion 1.0.0
 * @apiName updateCity
 * @apiGroup City
 * @apiPermission none
 * 
 * @apiDescription Esta função atualiza um registro
 * 
 * @apiParam {string} language Variavel referente a chave do idioma.
 * @apiParam {string} name Nome da cidade.
 * @apiParam {int} state Chave estrangeira de state.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se atualizou.
 * @apiSuccess {object[] } city Retorna um objeto com os valores atualizados.
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *     {"type":true,"city": {"id":"1","description":"Passo Fundo","state":"1"}}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function updateCity($language,$id) {
        $request = \Slim\Slim::getInstance()->request();
        $city = json_decode($request->getBody());
        $sql = "UPDATE city SET description=:description,state=:state WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":description", $city->description, PDO::PARAM_STR);
            $stmt->bindParam(":state", $city->state, PDO::PARAM_INT);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            $stmt->execute();
            $db = null;
            echo '{"type":true, "city":'.json_encode($city).'}';
        } catch (PDOException $e) {
            echo '{"type": false, "data":"'.$e->getMessage().'"}';
        }
    }
/**
 * @api {DELETE} /:language/city/:id deleteCity
 * @apiVersion 1.0.0
 * @apiName deleteCity
 * @apiGroup City
 * @apiPermission none
 * 
 * @apiDescription Esta função deleta um registro
 * 
 * @apiParam {string} language Variavel referente a chave do idioma.
 * @apiParam {int} id Chave primaria de city.
 *
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function deleteCity($language,$id) {

        $sql = "DELETE FROM city WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $db = null;
        } catch (PDOException $e) {
            echo '{"type":false, "data":"'.$e->getMessage().'"}';
        }
    }
/**
 * @api {GET} /:language/city/:id  getOneCity
 * @apiVersion 1.0.0
 * @apiName getOneCity
 * @apiGroup City
 * @apiPermission none
 * 
 * @apiDescription Esta função busca um determinado registro
 * 
 * @apiParam {string} language Variavel referente a chave do idioma.
 * @apiParam {int} id Chave primaria de city.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou.
 * @apiSuccess {object[] } city Retorna um objeto com os valores.
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *     {"type":true,"city": {"id":"1","description":"Passo Fundo","state":"1"}}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getOneCity($language,$id) {
        $sql = "SELECT c.id, c.description, s.id AS id_state, s.description AS state FROM city c INNER JOIN state s ON s.id = c.state WHERE c.id=:id; ";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $city = $stmt->fetchObject();
            $db = null;
            echo '{"type":true, "city":'.json_encode($city).'}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {GET} /:language/city/  getAllCity
 * @apiVersion 1.0.0
 * @apiName getAllCity
 * @apiGroup City
 * @apiPermission none
 * 
 * @apiDescription Esta função busca todos os registro
 * 
 * @apiParam {string} language Variavel referente a chave do idioma.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou.
 * @apiSuccess {object[] } city Retorna um objeto com os valores.
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *     {"type":true,"city": {"id":"1","description":"Passo Fundo","state":"1"}}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getAllCity($language) {
        $sql = "SELECT c.id, c.description, s.id AS id_state, s.description AS state FROM city c INNER JOIN state s ON s.id = c.state";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $city = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "city":'.json_encode($city).'}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"'.$e->getMessage().'"}';
        }
    }
/**
 * @api {GET} /:language/city/:state  getCityOFState
 * @apiVersion 1.0.0
 * @apiName getCityOFState
 * @apiGroup City
 * @apiPermission none
 * 
 * @apiDescription Esta função busca todos os registro com id de um estado
 * 
 * @apiParam {string} language Variavel referente a chave do idioma.
 * @apiParam {int} id Chave estrangeira de state.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou.
 * @apiSuccess {object[] } city Retorna um objeto com os valores.
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *     {"type":true,"city": {"id":"1","description":"Passo Fundo","state":"1"}}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getAllCityOFState($language,$state) {
        $sql = "SELECT c.id, c.description, s.id AS id_state, s.description AS state  FROM city c INNER JOIN state s ON s.id=c.state WHERE c.state =:state ORDER BY c.description";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":state", $state);
            $stmt->execute();
            $city = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "city":'.json_encode($city).'}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"'.$e->getMessage().'"}';
        }
    }

}

?>