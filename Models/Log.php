<?php

class Log {
/**
 * @api {POST} /:language/log  newLog
 * @apiVersion 1.0.0
 * @apiName newLog
 * @apiGroup Log
 * @apiPermission none
 *
 * @apiDescription Esta função faz o cadastramento de um registro
 * 
 * @apiParam {string} description Descrição que contem o nome do usuário e informações deletadas.
 * @apiParam {string} organization Id da organização.
 * @apiParam {string} module Id do module.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se cadastrou
 * @apiSuccess {object[] } log Retorna um objeto com os valores cadastrados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 *  
 * @apiSuccessExample {json} Success-Response:
 *      OK
 *    {"type":true, "log": [{"description":"Mensagem do log","organization":"1","module":"1",}]}
 * 
 * @apiErrorExample {json} Error-Response:
 *      Not Found
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function newLog($language) {

        $request = \Slim\Slim::getInstance()->request();
        $log = json_decode($request->getBody());
        $sql = "INSERT INTO log(description, organization, module) VALUES (:description, :organization, :module)";

        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":description", $log->description, PDO::PARAM_STR);
            $stmt->bindParam(":organization", $log->organization, PDO::PARAM_INT);
            $stmt->bindParam(":module", $log->module, PDO::PARAM_INT);
            $stmt->execute();
            $log->id = $db->lastInsertId();
            $db = null;
            echo '{"type":true, "log":' . json_encode($log) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
/**
 * @api {PET} /:language/log/organization/:id/module/:module  getAllLogOfOrganizationAndModule
 * @apiVersion 1.0.0
 * @apiName getAllLogOfOrganizationAndModule
 * @apiGroup Log
 * @apiPermission none
 *
 * @apiDescription Esta função busca todos os registro de uma determinada organização
 * 
 * @apiParam {string} description Descrição que contem o nome do usuário e as informações deletadas.
 * @apiParam {string} organization Id da organização.
 * @apiParam {string} module Id do module.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se cadastrou
 * @apiSuccess {object[] } log Retorna um objeto com os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 *  
 * @apiSuccessExample {json} Success-Response:
 *      OK
 *    {"type":true, "log": [{"description":"Mensagem do log","organization":"1","module":"1",}]}
 * 
 * @apiErrorExample {json} Error-Response:
 *      Not Found
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getAllLogOfOrganizationAndModule($language, $organization, $module) {
        $sql = "SELECT l.datetime, l.description AS log, o.description AS organization, m.id AS id_module, m.description_$language AS module
                FROM log l
                INNER JOIN organization o ON l.organization=o.id
                INNER JOIN module m ON m.id=l.module
                WHERE o.id=:organization
                and m.id=:module
                ORDER BY l.datetime DESC;";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":organization", $organization);
            $stmt->bindParam(":module", $module);
            $stmt->execute();
            $log = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "log":' . json_encode($log) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }

}

?>