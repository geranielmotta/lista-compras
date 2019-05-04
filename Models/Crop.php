<?php

class Crop {
/**
 * @api {POST} /:language/crop newCrop
 * @apiVersion 1.0.0
 * @apiName newCrop
 * @apiGroup Crop
 * @apiPermission none
 *
 * @apiDescription Esta função faz o cadastramento de um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {string} description_pt Nome do país em português.
 * @apiParam {string} description_en Nome do país em inglês.
 * @apiParam {string} description_sp Nome do país em espanhol.
 * @apiParam {string} note_code Uma nota sobre a cultura.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se cadastrou
 * @apiSuccess {object[] } crop Retorna objeto com os valores cadastrados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *     {"description_pt":"Gergelim","description_en":"Sesame","description_sp":"Sesamo","note_code":"teste","id":"1"}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function newCrop($language) {
        $request = \Slim\Slim::getInstance()->request();
        $crop = json_decode($request->getBody());
        $sql = "INSERT INTO crop(description_pt, description_en, description_sp, note_code) VALUES (:description_pt, :description_en, :description_sp, :note_code)";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":description_pt", $crop->description_pt, PDO::PARAM_STR);
            $stmt->bindParam(":description_en", $crop->description_en, PDO::PARAM_STR);
            $stmt->bindParam(":description_sp", $crop->description_sp, PDO::PARAM_STR);
            $stmt->bindParam(":note_code", $crop->note_code, PDO::PARAM_STR);
            
            $stmt->execute();
            $crop->id = $db->lastInsertId();
            $db = null;
            echo '{"type":true, "crop":'.json_encode($crop).'}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"'.$e->getMessage().'"}';
        }
    }
/**
 * @api {PUT} /:language/crop/:id updateCrop
 * @apiVersion 1.0.0
 * @apiName updateCrop
 * @apiGroup Crop
 * @apiPermission none
 *
 * @apiDescription Esta função atualiza um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {string} description_pt Nome do país em português.
 * @apiParam {string} description_en Nome do país em inglês.
 * @apiParam {string} description_sp Nome do país em espanhol.
 * @apiParam {string} note_code Uma nota sobre a cultura.
 * @apiParam {int} id Id a ser atualizado.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se atualizado
 * @apiSuccess {object[] } crop Retorna objeto com os valores atualiazados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *     {"id":"1","description_pt":"Gergelim","description_en":"Sesame","description_sp":"Sesamo","note_code":"teste"}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function updateCrop($language,$id) {
        $request = \Slim\Slim::getInstance()->request();
        $crop = json_decode($request->getBody());
        $sql = "UPDATE crop SET description_pt=:description_pt, description_en=:description_en, description_sp=:description_sp, note_code=:note_code WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":description_pt", $crop->description_pt, PDO::PARAM_STR);
            $stmt->bindParam(":description_en", $crop->description_en, PDO::PARAM_STR);
            $stmt->bindParam(":description_sp", $crop->description_sp, PDO::PARAM_STR);
            $stmt->bindParam(":note_code", $crop->note_code, PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            $stmt->execute();
            $db = null;
            echo '{"type":true, "crop":'.json_encode($crop).'}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"'.$e->getMessage().'"}';
        }
    }
/**
 * @api {DELETE} /:language/crop/:id deleteCrop
 * @apiVersion 1.0.0
 * @apiName deleteCrop
 * @apiGroup Crop
 * @apiPermission none
 *
 * @apiDescription Esta função deleta um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} id Id a ser deletado.
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
    public function deleteCrop($language,$id) {
        $sql = "DELETE FROM crop WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $db = null;
        } catch (PDOException $e) {
            echo '{"type": false, "data":"'.$e->getMessage().'"}';
        }
    }
/**
 * @api {GET} /:language/crop/:id getOneCrop
 * @apiVersion 1.0.0
 * @apiName getOneCrop
 * @apiGroup Crop
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona um registro
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} id Id a ser selecionado.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou.
 * @apiSuccess {object[] } crop Retorna um objeto com os valores.
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *     {"id":"1","description_pt":"Gergelim","description_en":"Sesame","description_sp":"Sesamo","note_code":"teste"}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getOneCrop($language,$id) {
        $sql = "SELECT id, description_pt, description_en, description_sp, note_code FROM crop WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $crop = $stmt->fetchObject();
            $db = null;
            echo '{"type":true, "crop":'.json_encode($crop).'}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"'.$e->getMessage().'"}';
        }
    }
/**
 * @api {GET} /:language/crop/ getAllCrop
 * @apiVersion 1.0.0
 * @apiName getAllCrop
 * @apiGroup Crop
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos os registros
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou.
 * @apiSuccess {object[] } crop Retorna um objeto com todos os valores.
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *     {"type":true, "crop":[{"id":"1","description_pt":"Gergelim","description_en":"Sesame","description_sp":"Sesamo","note_code":"teste"},{"id":"2","description_pt":"Soja","description_en":"Soybean","description_sp":"Soja","note_code":null}]}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getAllCrop($language) {
        $sql = "SELECT id, description_$language as description, note_code FROM crop";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $crop = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "crop":'.json_encode($crop).'}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"'.$e->getMessage().'"}';
        }
    }

}

?>