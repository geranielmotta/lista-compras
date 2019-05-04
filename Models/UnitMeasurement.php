<?php

class UnitMeasurement {
/**
 * @api {POST} /:language/unitmeasurement newUnitMeasurement
 * @apiVersion 1.0.0
 * @apiName newUnitMeasurement
 * @apiGroup Unit Measurement
 * @apiPermission none
 *
 * @apiDescription Esta função faz o cadastramento de um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {string} code Código
 * @apiParam {string} description Descrição
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se cadastrou
 * @apiSuccess {object[] } unit_measurement Retorna um objeto com os valores cadastrados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type":true, "unit_measurement": {"code":"g/ha","description":"Gramas Hectare","id":"1"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function newUnitMeasurement($language) {
        $request = \Slim\Slim::getInstance()->request();
        $unitMeasurement = json_decode($request->getBody());
        $sql = "INSERT INTO unit_measurement(code,description) VALUES (:code,:description)";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":code", $unitMeasurement->code, PDO::PARAM_STR);
            $stmt->bindParam(":description", $unitMeasurement->description, PDO::PARAM_STR);
            $stmt->execute();
            $unitMeasurement->id = $db->lastInsertId();
            $db = null;
            echo '{"type":true, "unit_measurement": ' . json_encode($unitMeasurement) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {PUT} /:language/unitmeasurement/:id updateUnitMeasurement
 * @apiVersion 1.0.0
 * @apiName updateUnitMeasurement
 * @apiGroup Unit Measurement
 * @apiPermission none
 *
 * @apiDescription Esta função atualiza um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {string} code Código
 * @apiParam {string} description Descrição
 * @apiParam {int} id Id a ser atualizado
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se atualizou
 * @apiSuccess {object[] } unit_measurement Retorna um objeto com os valores atualizados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type":true, "unit_measurement": {"id":"1","code":"g/ha","description":"Gramas Hectare"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function updateUnitMeasurement($language,$id) {
        $request = \Slim\Slim::getInstance()->request();
        $unitMeasurement = json_decode($request->getBody());
        $sql = "UPDATE unit_measurement SET code=:code,description=:description WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":code", $unitMeasurement->code, PDO::PARAM_STR);
            $stmt->bindParam(":description", $unitMeasurement->description, PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $db = null;
            echo '{"type":true, "unit_measurement": ' . json_encode($unitMeasurement) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {DELETE} /:language/unitmeasurement/:id deleteUnitMeasurement
 * @apiVersion 1.0.0
 * @apiName deleteUnitMeasurement
 * @apiGroup Unit Measurement
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
    public function deleteUnitMeasurement($language,$id) {
        $sql = "DELETE FROM unit_measurement WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $db = null;
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {GET} /:language/unitmeasurement/:id getOneUnitMeasurement
 * @apiVersion 1.0.0
 * @apiName getOneUnitMeasurement
 * @apiGroup Unit Measurement
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} id Id a ser selecionado
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } unit_measurement Retorna um objeto com os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type":true, "unit_measurement": {"id":"1","code":"g/ha","description":"Gramas Hectare"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getOneUnitMeasurement($language,$id) {
        $sql = "SELECT * FROM unit_measurement WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $unitMeasurement = $stmt->fetchObject();
            $db = null;
            echo '{"type":true, "unit_measurement": ' . json_encode($unitMeasurement) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {GET} /:language/unitmeasurement/ getAllUnitMeasurement
 * @apiVersion 1.0.0
 * @apiName getAllUnitMeasurement
 * @apiGroup Unit Measurement
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos os registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } unit_measurement Retorna um objeto com os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type":true, "unit_measurement": {"id":"1","code":"g/ha","description":"Gramas Hectare"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getAllUnitMeasurement($language) {
        $sql = "SELECT * FROM unit_measurement ORDER BY code DESC";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $unitMeasurement = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "unit_measurement": ' . json_encode($unitMeasurement) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }
}

?>