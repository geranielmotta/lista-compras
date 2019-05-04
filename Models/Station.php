<?php

class Station {
/**
 * @api {POST} /:language/statation  newStation
 * @apiVersion 1.0.0
 * @apiName newStation
 * @apiGroup Station
 * @apiPermission none
 *
 * @apiDescription Esta função faz o cadastramento de um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {string} description Nome da estação
 * @apiParam {double} latitude Latitude 
 * @apiParam {double} longitude Longitude 
 * @apiParam {double} altitude Altitude 
 * @apiParam {int} city  Id de city
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se cadastrou
 * @apiSuccess {object[] } station Retorna um objeto com os valores cadastrados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 * {"type":true, "station": {"description":"Sede Fecoprod","latitude":"-57.5784","longitude":"-25.2616","altitude":null,"city":"3","id":"1"}}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function newStation($language) {
        $request = \Slim\Slim::getInstance()->request();
        $station = json_decode($request->getBody());
        $sql = "INSERT INTO station(description, latitude, longitude, altitude, city) VALUES (:description, :latitude, :longitude, :altitude, :city)";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":description", $station->description, PDO::PARAM_STR);
            $stmt->bindParam(":latitude", $station->latitude, PDO::PARAM_INT);
            $stmt->bindParam(":longitude", $station->longitude, PDO::PARAM_INT);
            $stmt->bindParam(":altitude", $station->altitude, PDO::PARAM_INT);
            $stmt->bindParam(":city", $station->city, PDO::PARAM_INT);

            $stmt->execute();
            $station->id = $db->lastInsertId();
            $db = null;
            echo '{"type":true, "station": ' . json_encode($station) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {PUT} /:language/statation/:id  updateStation
 * @apiVersion 1.0.0
 * @apiName updateStation
 * @apiGroup Station
 * @apiPermission none
 *
 * @apiDescription Esta função atualiza um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {string} description Nome da estação
 * @apiParam {double} latitude Latitude 
 * @apiParam {double} longitude Longitude 
 * @apiParam {double} altitude Altitude 
 * @apiParam {int} city  Id de city
 * @apiParam {int} id Id a ser atualizado
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se atualizou
 * @apiSuccess {object[] } station Retorna um objeto com os valores atualizados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 * {"type":true, "station": {"id":"1","description":"Sede Fecoprod","latitude":"-57.5784","longitude":"-25.2616","altitude":null,"city":"3"}}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function updateStation($language,$id) {
        $request = \Slim\Slim::getInstance()->request();
        $station = json_decode($request->getBody());
        $sql = "UPDATE station SET description=:description, latitude=:latitude, longitude=:longitude, altitude=:altitude, city=:city WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":description", $station->description, PDO::PARAM_STR);
            $stmt->bindParam(":latitude", $station->latitude, PDO::PARAM_INT);
            $stmt->bindParam(":longitude", $station->longitude, PDO::PARAM_INT);
            $stmt->bindParam(":altitude", $station->altitude, PDO::PARAM_INT);
            $stmt->bindParam(":city", $station->city, PDO::PARAM_INT);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            $stmt->execute();
            $db = null;
            echo '{"type":true, "station":' . json_encode($station) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"'.$e->getMessage().'"}';
        }
    }
/**
 * @api {DELETE} /:language/statation/:id  deleteStation
 * @apiVersion 1.0.0
 * @apiName deleteStation
 * @apiGroup Station
 * @apiPermission none
 *
 * @apiDescription Esta função deleta um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} id Id a ser deletado
 *
 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function deleteStation($language,$id) {
        $sql = "DELETE FROM station WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $db = null;
        } catch (PDOException $e) {
            echo '{"type": false,"data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {GET} /:language/statation/:id  getOneStation
 * @apiVersion 1.0.0
 * @apiName getOneStation
 * @apiGroup Station
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} id Id a ser selecionado
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } station Retorna um objeto com os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 * {"type":true, "station": {"id":"1","description":"Sede Fecoprod","latitude":"-57.5784","longitude":"-25.2616","altitude":null,"city":"3"}}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getOneStation($language,$id) {
        $sql = "SELECT * FROM station WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $station = $stmt->fetchObject();
            $db = null;
            echo '{"type":true, "station":' . json_encode($station) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"'.$e->getMessage().'"}';
        }
    }
/**
 * @api {GET} /:language/statation/  getAllStation
 * @apiVersion 1.0.0
 * @apiName getAllStation
 * @apiGroup Station
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } station Retorna um objeto com todos os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 * {"type":true, "station": {"id":"1","description":"Sede Fecoprod","latitude":"-57.5784","longitude":"-25.2616","altitude":null,"city":"3"}}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getAllStation($language) {
        $sql = "SELECT * FROM station ORDER BY description DESC";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $station = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;

            echo '{"type":true, "station":' . json_encode($station) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"'.$e->getMessage().'"}';
        }
    }

}

?>