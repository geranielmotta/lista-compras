<?php

class AccessLevels{

/**
 * @api {GET} /:language/accesslevels/:id getOneAccessLevels
 * @apiVersion 1.0.0
 * @apiName getOneAccessLevels
 * @apiGroup Access Levels
 * @apiPermission none
 *
 * @apiDescription Esta função consulta um nivel de acesso de um usuário.
 * 
 * @apiParam {string} language Variavel referente a chave do idioma.
 * @apiParam {int} id Id do usuário.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou.
 * @apiSuccess {object[] } access_levels Retorna objeto com o valor selecionado.
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *     {"type":true,"access_levels": {"id":"4","description":"Usuário","code":"1"}}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */    
    
    public function getOneAccessLevels($language,$id) {
        $sql = "SELECT id,description_$language AS description, code FROM access_levels WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $accessLevels = $stmt->fetchObject();
            $db = null;
            echo '{"type":true,"access_levels": ' . json_encode($accessLevels) . '}';
        } catch (PDOException $e) {
            echo '{"type": false,"data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {GET} /:language/accesslevels/:id getAllAccessLevels
 * @apiVersion 1.0.0
 * @apiName getAllAccessLevels
 * @apiGroup Access Levels
 * @apiPermission none
 *
 * @apiDescription Esta função consulta todos os niveis de acesso.
 * 
 * @apiParam {string} language Variavel referente a chave do idioma.
 * @apiParam {int} id Id do usuário.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou.
 * @apiSuccess {object[] } access_levels Retorna objeto com o valor selecionado.
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *     {"type":true,"access_levels": {"id":"4","description":"Usuário","code":"1"}}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */ 
    public function getAllAccessLevels($language) {
        $sql = "SELECT id,description_$language AS description, code FROM access_levels";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $accessLevels = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true,"access_levels": ' . json_encode($accessLevels) . '}';
        } catch (PDOException $e) {
            echo '{"type":false,"data":"'.$e->getMessage().'"}';
        }
    }
    
/**
 * @api {GET} /:language/accesslevelsnotroot getAllAccessLevelsNotRoot
 * @apiVersion 1.0.0
 * @apiName getAllAccessLevelsNotRoot
 * @apiGroup Access Levels
 * @apiPermission none
 *
 * @apiDescription Esta função consulta todos os niveis de acesso que não são ROOT.
 * 
 * @apiParam {string} language Variavel referente a chave do idioma.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou.
 * @apiSuccess {object[] } access_levels Retorna objeto com o valor selecionado.
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *     {"type":true,"access_levels": {"id":"4","description":"Usuário","code":"1"},{"id":"3","description":"Técnico","code":"10"},{"id":"2","description":"Administrador","code":"100"}}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */ 
    
    public function getAllAccessLevelsNotRoot($language) {
        $sql = "SELECT id,description_$language AS description,code FROM access_levels WHERE id <> 1";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $accessLevels = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true,"access_levels": ' . json_encode($accessLevels) . '}';
        } catch (PDOException $e) {
            echo '{"type":false,"data":"'.$e->getMessage().'"}';
        }
    }
    
}

?>