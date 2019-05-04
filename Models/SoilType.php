<?php

class SoilType {
/**
 * @api {POST} /:language/soiltype  newSoilType
 * @apiVersion 1.0.0
 * @apiName newSoilType
 * @apiGroup Soil Type
 * @apiPermission none
 *
 * @apiDescription Esta função faz o cadastramento de um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {string} description_pt Nome do país em português.
 * @apiParam {string} description_en Nome do país em inglês.
 * @apiParam {string} description_sp Nome do país em espanhol.
 * @apiParam {int} fc   fc
 * @apiParam {int} wp  wp
 * @apiParam {int} taw taw
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se cadastrou
 * @apiSuccess {object[] } soil_type Retorna um objeto com os valores cadastrados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 * {"type":true, "soil_type": [{"description":"Arenoso","fc":"0.12","wp":"0.05","taw":"0.07","id":"1"}]}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function newSoilType($language) { 
        $request = \Slim\Slim::getInstance()->request();
        $soil_type = json_decode($request->getBody());
        $sql = "INSERT INTO soil_type(description_pt, description_en, description_sp, fc, wp, taw) VALUES (:description_pt, :description_en, :description_sp, :fc, :wp, :taw)";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":description_pt", $soil_type->description_pt, PDO::PARAM_STR);
            $stmt->bindParam(":description_en", $soil_type->description_en, PDO::PARAM_STR);
            $stmt->bindParam(":description_sp", $soil_type->description_sp, PDO::PARAM_STR);
            $stmt->bindParam(":fc", $soil_type->fc, PDO::PARAM_INT);
            $stmt->bindParam(":wp", $soil_type->wp, PDO::PARAM_INT);
            $stmt->bindParam(":taw", $soil_type->taw, PDO::PARAM_INT);

            $stmt->execute();
            $soil_type->id = $db->lastInsertId();
            $db = null;
            echo '{"type": true,"soil_type": ' . json_encode($soil_type) . '}';
           
        } catch (PDOException $e) {
            echo '{"type": false,"data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {PUT} /:language/soiltype/:id  updateSoilType
 * @apiVersion 1.0.0
 * @apiName updateSoilType
 * @apiGroup Soil Type
 * @apiPermission none
 *
 * @apiDescription Esta função atualiza um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {string} description_pt Nome do país em português.
 * @apiParam {string} description_en Nome do país em inglês.
 * @apiParam {string} description_sp Nome do país em espanhol.
 * @apiParam {int} fc   fc
 * @apiParam {int} wp  wp
 * @apiParam {int} taw taw
 * @apiParam {int} id Id a ser atualizado
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se atualizou
 * @apiSuccess {object[] } soil_type Retorna um objeto com os valores atualizados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 * {"type":true, "soil_type": [{"id":"1","description":"Arenoso","fc":"0.12","wp":"0.05","taw":"0.07"}]}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function updateSoilType($language,$id) {
        $request = \Slim\Slim::getInstance()->request();
        $soil_type = json_decode($request->getBody());
        $sql = "UPDATE soil_type SET description_pt=:description_pt, description_en=:description_en, description_sp=:description_sp, fc=:fc, wp=:wp, taw=:taw WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":description_pt", $soil_type->description_pt, PDO::PARAM_STR);
            $stmt->bindParam(":description_en", $soil_type->description_en, PDO::PARAM_STR);
            $stmt->bindParam(":description_sp", $soil_type->description_sp, PDO::PARAM_STR);
            $stmt->bindParam(":fc", $soil_type->fc, PDO::PARAM_INT);
            $stmt->bindParam(":wp", $soil_type->wp, PDO::PARAM_INT);
            $stmt->bindParam(":taw", $soil_type->taw, PDO::PARAM_INT);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            
            $stmt->execute();
            $db = null;
            echo '{"type": true,"soil_type": ' . json_encode($soil_type) . '}';
        } catch (PDOException $e) {
            echo '{"type": false,"data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {DELETE} /:language/soiltype/:id  deleteSoilType
 * @apiVersion 1.0.0
 * @apiName deletaSoilType
 * @apiGroup Soil Type
 * @apiPermission none
 *
 * @apiDescription Esta função deleta um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} id Id a ser atualizado
 *
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function deleteSoilType($language,$id) {
        $sql = "DELETE FROM soil_type WHERE id=:id";
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
 * @api {GET} /:language/soiltype/:id  getOneSoilType
 * @apiVersion 1.0.0
 * @apiName getOneSoilType
 * @apiGroup Soil Type
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} id Id a ser selecionado
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } soil_type Retorna um objeto com os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 * {"type":true, "soil_type": [{"id":"1","description":"Arenoso","fc":"0.12","wp":"0.05","taw":"0.07"}]}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getOneSoilType($language,$id) {
        $sql = "SELECT id, description_pt, description_en, description_sp, fc, wp, taw FROM soil_type WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $soil_type = $stmt->fetchObject();
            $db = null;
            echo '{"type": true,"soil_type": ' . json_encode($soil_type) . '}';
        } catch (PDOException $e) {
            echo '{"type": false,"data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {GET} /:language/soiltype/  getAllSoilType
 * @apiVersion 1.0.0
 * @apiName getAllSoilType
 * @apiGroup Soil Type
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos os registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } soil_type Retorna um objeto com todos os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 * {"type":true, "soil_type": [{"id":"1","description":"Arenoso","fc":"0.12","wp":"0.05","taw":"0.07"}]}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getAllSoilType($language) {
        $sql = "SELECT id, description_$language AS description, fc, wp, taw FROM soil_type";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $soil_type = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type": true,"soil_type": ' . json_encode($soil_type) . '}';
        } catch (PDOException $e) {
            echo '{"type": false,"data": "'.$e->getMessage().'"}';
        }
    }

}

?>