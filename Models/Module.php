<?php
/**
 * @api {GET} /:language/module/:id  getOneModule
 * @apiVersion 1.0.0
 * @apiName getOneModule
 * @apiGroup Module
 * @apiPermission none
 *
 * @apiDescription Esta função busca um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} id Id a ser selecionado
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } module Retorna um objeto com os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 *  
 * @apiSuccessExample {json} Success-Response:
 *      OK
 *    {"type":true, "module": [{"id":"1","name":"Parcelas","description":"Parcela",}]}
 * 
 * @apiErrorExample {json} Error-Response:
 *      Not Found
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
class Module{
    
    public function getOneModule($language,$id) {
        $sql = "SELECT id, name, description_$language FROM module WHERE id=:id;";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $module = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "module": ' . json_encode($module) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {GET} /:language/module getAllModule
 * @apiVersion 1.0.0
 * @apiName getAllModule
 * @apiGroup Module
 * @apiPermission none
 *
 * @apiDescription Esta função busca todos os registros
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} id Id a ser selecionado
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } module Retorna um objeto com os valores 
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 *  
 * @apiSuccessExample {json} Success-Response:
 *      OK
 *    {"type":true, "module": [{"id":"1","name":"Parcelas","description":"Parcela","id":"2","name":"Usuários","description":"Usuários"}]}
 * 
 * @apiErrorExample {json} Error-Response:
 *      Not Found
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */    
    public function getAllModule($language) {
        $sql = "SELECT id, name, description_$language AS description FROM module";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $module = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "module": ' . json_encode($module) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }
        
}

?>