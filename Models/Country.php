<?php

class Country {
/**
 * @api {POST} /:language/country newCountry
 * @apiVersion 1.0.0
 * @apiName newCountry
 * @apiGroup Country
 * @apiPermission none
 *
 * @apiDescription Esta função faz o cadastramento de um registro
 * 
 * @apiParam {string} language Variavel referente a chave do idioma.
 * @apiParam {string} description_pt Nome do país em português.
 * @apiParam {string} description_en Nome do país em inglês.
 * @apiParam {string} description_sp Nome do país em espanhol.
 * @apiParam {string} symbol Sigla do país.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se cadastrou
 * @apiSuccess {object[] } country Retorna objeto com os valores cadastrados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *     {"description_pt":"Brasil","description_en":"Brazil","description_sp":"Brasil","symbol":"BR","id":"1"}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function newCountry($language) {
        $request = \Slim\Slim::getInstance()->request();
        $country = json_decode($request->getBody());
        $sql = "INSERT INTO country(description_pt, description_en, description_sp, symbol) VALUES (:description_pt, :description_en, :description_sp, :symbol)";
        try {

            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":description_pt", $country->description_pt, PDO::PARAM_STR);
            $stmt->bindParam(":description_en", $country->description_en, PDO::PARAM_STR);
            $stmt->bindParam(":description_sp", $country->description_sp, PDO::PARAM_STR);
            $stmt->bindParam(":symbol", $country->symbol, PDO::PARAM_STR);

            $stmt->execute();
            $country->id = $db->lastInsertId();
            $db = null;
            echo '{"type":false, "country":'.json_encode($country).'}';
        } catch (PDOException $e) {
            echo '{"type": false, "data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {PUT} /:language/country/:id  updateCountry
 * @apiVersion 1.0.0
 * @apiName updateCountry
 * @apiGroup Country
 * @apiPermission none
 *
 * @apiDescription Esta função faz a atualização de um registro
 * 
 * @apiParam {string} language Variavel referente a chave do idioma.
 * @apiParam {int} id Id a ser atualizado.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se atualizou
 * @apiSuccess {object[] } country Retorna objeto com os valores atualizados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *     {"id":"1","description_pt":"Brasil","description_en":"Brazil","description_sp":"Brasil","symbol":"BR"}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function updateCountry($language,$id) {
        $request = \Slim\Slim::getInstance()->request();
        $country = json_decode($request->getBody());
        $sql = "UPDATE country SET description_pt=:description_pt, description_en=:description_en, description_sp=description_sp, symbol=:symbol WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":description_pt", $country->description_pt, PDO::PARAM_STR);
            $stmt->bindParam(":description_en", $country->description_en, PDO::PARAM_STR);
            $stmt->bindParam(":description_sp", $country->description_sp, PDO::PARAM_STR);
            $stmt->bindParam(":symbol", $country->symbol, PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            $stmt->execute();
            $db = null;
            echo '{"type":false, "country":'.json_encode($country).'}';
        } catch (PDOException $e) {
            echo '{"type": false,"data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {DELETE} /:language/country/:id  deleteCountry
 * @apiVersion 1.0.0
 * @apiName deleteCountry
 * @apiGroup Country
 * @apiPermission none
 *
 * @apiDescription Esta função deleta um registro
 * 
 * @apiParam {string} language Variavel referente a chave do idioma.
 * @apiParam {int} id Id a ser deletado.
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
    public function deleteCountry($language,$id) {
        $sql = "DELETE FROM country WHERE id=:id";
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
 * @api {GET} /:language/country/:id  getOneCountry
 * @apiVersion 1.0.0
 * @apiName getOneCountry
 * @apiGroup Country
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona um registro.
 * 
 * @apiParam {string} language Variavel referente a chave do idioma.
 * @apiParam {int} id Id a ser selecionado.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou.
 * @apiSuccess {object[] } country Retorna objeto com os valores.
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *     {"id":"1","description_pt":"Brasil","description_en":"Brazil","description_sp":"Brasil","symbol":"BR"}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getOneCountry($language,$id) {
        $sql = "SELECT id, description_$language as description, symbol  FROM country WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":id", $id);
            
            $stmt->execute();
            $country = $stmt->fetchObject();
            $db = null;
            echo '{"type":false, "country":'.json_encode($country).'}';
        } catch (PDOException $e) {
            echo '{"type": false,"data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {GET} /:language/country/  getAllCountry
 * @apiVersion 1.0.0
 * @apiName getAllCountry
 * @apiGroup Country
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos os registros.
 * 
 * @apiParam {string} language Variavel referente a chave do idioma.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou.
 * @apiSuccess {object[] } country Retorna objeto com os valores.
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *     {"type":false, "country":[{"id":"1","description_pt":"Brasil","description_en":"Brazil","description_sp":"Brasil","symbol":"BR"},{"id":"2","description_pt":"Paraguai","description_en":"Paraguay","description_sp":"Paraguay","symbol":"PR"}]}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getAllCountry($language) {
        $sql = "SELECT * FROM country";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $country = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":false, "country":'.json_encode($country).'}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }

}

?>