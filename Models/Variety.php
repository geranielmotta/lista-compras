<?php

class Variety {
/**
 * @api {POST} /:language/variety newVariety
 * @apiVersion 1.0.0
 * @apiName newVariety
 * @apiGroup Variety
 * @apiPermission none
 *
 * @apiDescription Esta função faz o cadastramento de um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {string} description Descrição
 * @apiParam {string} cycle Ciclo
 * @apiParam {string} code Código
 * @apiParam {string} seed_company Indica a origem das sementes
 * @apiParam {int} crop id da cultura
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se cadastrou
 * @apiSuccess {object[] } variety Retorna um objeto com os valores cadastrados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type":true, "variety": {"description":"Nome","cycle":"ciclo","code":"000","company":"null","crop":"1","id":"1"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function newVariety($language) {
        $request = \Slim\Slim::getInstance()->request();
        $variety = json_decode($request->getBody());
        $sql = "INSERT INTO variety(description,cycle,code,seed_company,crop) VALUES (:description,:cycle,:code,:seed_company,:crop)";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":description", $variety->description, PDO::PARAM_STR);
            $stmt->bindParam(":cycle", $variety->cycle, PDO::PARAM_STR);
            $stmt->bindParam(":code", $variety->code, PDO::PARAM_STR);
            $stmt->bindParam(":seed_company", $variety->seed_company, PDO::PARAM_STR);
            $stmt->bindParam(":crop", $variety->crop, PDO::PARAM_INT);
            $stmt->execute();
            $variety->id = $db->lastInsertId();
            $db = null;
            echo '{"type":true, "variety": ' . json_encode($variety) . '}';
        } catch (PDOException $e) {
            echo '{"type": false,"data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {PUT} /:language/variety updateVariety
 * @apiVersion 1.0.0
 * @apiName updateVariety
 * @apiGroup Variety
 * @apiPermission none
 *
 * @apiDescription Esta função faz a atualização de um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {string} description Descrição
 * @apiParam {string} cycle Ciclo
 * @apiParam {string} code Código
 * @apiParam {string} seed_company Indica a origem das sementes
 * @apiParam {int} crop id da cultura
 * @apiParam {int} id Id da variedade
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se atualizou
 * @apiSuccess {object[] } variety Retorna um objeto com os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type":true, "variety": {"description":"Nome","cycle":"ciclo","code":"000","company":"null","crop":"1","id":"1"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function updateVariety($language,$id) {
        $request = \Slim\Slim::getInstance()->request();
        $variety = json_decode($request->getBody());
        $sql = "UPDATE variety SET description=:description,cycle=:cycle,code=:code,seed_company=:seed_company,crop=:crop WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":description", $variety->description, PDO::PARAM_STR);
            $stmt->bindParam(":cycle", $variety->cycle, PDO::PARAM_STR);
            $stmt->bindParam(":code", $variety->code, PDO::PARAM_STR);
            $stmt->bindParam(":seed_company", $variety->seed_company, PDO::PARAM_STR);
            $stmt->bindParam(":crop", $variety->crop, PDO::PARAM_INT);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $db = null;
            echo '{"type":true, "variety": ' . json_encode($variety) . '}';
        } catch (PDOException $e) {
            echo '{"type": false,"data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {DELETE} /:language/variety/:id deleteVariety
 * @apiVersion 1.0.0
 * @apiName deleteVariety
 * @apiGroup Variety
 * @apiPermission none
 *
 * @apiDescription Esta função deleta um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} id Id da variedade
 * 
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
    public function deleteVariety($language,$id) {
        $sql = "DELETE FROM variety WHERE id=:id";
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
 * @api {GET} /:language/variety/:id getOneVariety
 * @apiVersion 1.0.0
 * @apiName getOneVariety
 * @apiGroup Variety
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} id Id da variedade
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } variety Retorna um objeto com os valores 
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type":true, "variety": {"id":"1","description":"Nome","cycle":"ciclo","code":"000","company":"null","crop":"1"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getOneVariety($language,$id) {
        $sql = "SELECT v.id,v.description,v.cycle,v.code,v.seed_company,c.description_$language AS crop FROM variety v INNER JOIN crop c ON c.id = v.crop WHERE v.id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $variety = $stmt->fetchObject();
            $db = null;
            echo '{"type":true, "variety": ' . json_encode($variety) . '}';
        } catch (PDOException $e) {
            echo '{"type": false,"data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {GET} /:language/variety getAllVariety
 * @apiVersion 1.0.0
 * @apiName getAllVariety
 * @apiGroup Variety
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } variety Retorna um objeto com os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type":true, "variety": {"id":"1","description":"Nome","cycle":"ciclo","code":"000","company":"null","crop":"1"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getAllVariety($language) {
        $sql = "SELECT v.id,v.description,v.cycle,v.code,v.seed_company,c.description_$language AS crop FROM variety v INNER JOIN crop c ON c.id = v.crop";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $variety = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "variety": ' . json_encode($variety) . '}';
        } catch (PDOException $e) {
            echo '{"type": false,"data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {GET} /:language/variety/crop/:id getAllVarietyOfCrop
 * @apiVersion 1.0.0
 * @apiName getAllVarietyOfCrop
 * @apiGroup Variety
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos registro que possuam ligação direta com uma cultura
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} crop Id da cultura.
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } variety Retorna um objeto com os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type":true, "variety": {"id":"1","description":"Nome","cycle":"ciclo","code":"000","company":"null","crop":"1"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */   
    public function getAllVarietyOfCrop($language,$id) {
        $sql = "SELECT * FROM variety WHERE crop=:crop";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":crop", $id, PDO::PARAM_INT);
            $stmt->execute();
            $variety = $stmt->fetchObject();
            $db = null;
            echo '{"type":true, "variety": ' . json_encode($variety) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"'.$e->getMessage().'"}';
        }
    }

}

?>