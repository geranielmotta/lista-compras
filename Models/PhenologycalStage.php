<?php

class PhenologycalStage {
/**
 * @api {POST} /:language/phenologycalstage newPhenologycalStage
 * @apiVersion 1.0.0
 * @apiName newPhenologycalStage
 * @apiGroup Phenologycal Stage
 * @apiPermission none
 *
 * @apiDescription Esta função faz o cadastramento de um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {string} description_pt Nome do país em português.
 * @apiParam {string} description_en Nome do país em inglês.
 * @apiParam {string} description_sp Nome do país em espanhol.
 * @apiParam {string} symbol Simbolo.
 * @apiParam {int} crop Id da cultura.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se cadastrou
 * @apiSuccess {object[] } phenological_stage Retorna um objeto com os valores cadastrados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 * {"type": true,"phenological_stage": [{"description_pt":"Germinação das sementes","description_en":"","description_sp":"Germinação","symbol":"VG","crop":"1","id":"1"}]}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function newPhenologycalStage($language) {
        $request = \Slim\Slim::getInstance()->request();
        $phenologycal_stage = json_decode($request->getBody());
        $sql = "INSERT INTO phenological_stage (description_pt, description_en, description_sp, symbol, crop) VALUES (:description_pt,:description_en,:description_sp,:symbol,:crop)";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":description_pt", $phenologycal_stage->description_pt, PDO::PARAM_STR);
            $stmt->bindParam(":description_en", $phenologycal_stage->description_en, PDO::PARAM_STR);
            $stmt->bindParam(":description_sp", $phenologycal_stage->description_sp, PDO::PARAM_STR);
            $stmt->bindParam(":symbol", $phenologycal_stage->symbol, PDO::PARAM_STR);
            $stmt->bindParam(":crop", $phenologycal_stage->crop, PDO::PARAM_INT);

            $stmt->execute();
            $phenologycal_stage->id = $db->lastInsertId();
            $db = null;
            echo '{"type":true, "phenological_stage": '.json_encode($phenologycal_stage).'}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {PUT} /:language/phenologycalstage/:id  updatePhenologycalStage
 * @apiVersion 1.0.0
 * @apiName updatePhenologycalStage
 * @apiGroup Phenologycal Stage
 * @apiPermission none
 *
 * @apiDescription Esta função atualiza um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {string} description_pt Nome do país em português.
 * @apiParam {string} description_en Nome do país em inglês.
 * @apiParam {string} description_sp Nome do país em espanhol.
 * @apiParam {string} symbol Simbolo.
 * @apiParam {int} crop Id da cultura.
 * @apiParam {int} id Id a ser atualizado.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se atualizou
 * @apiSuccess {object[] } phenological_stage Retorna um objeto com os valores atualizados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 * {"type": true,"phenological_stage": [{"id":"1","description_pt":"Germinação das sementes","description_en":"","description_sp":"Germinação","symbol":"VG","crop":"1"}]}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function updatePhenologycalStage($language,$id) {
        $request = \Slim\Slim::getInstance()->request();
        $phenologycal_stage = json_decode($request->getBody());
        $sql = "UPDATE phenological_stage SET description_pt=:description_pt,description_en=:description_en,description_sp=:description_sp,symbol=:symbol,crop=:crop  WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":description_pt", $phenologycal_stage->description_pt, PDO::PARAM_STR);
            $stmt->bindParam(":description_en", $phenologycal_stage->description_en, PDO::PARAM_STR);
            $stmt->bindParam(":description_sp", $phenologycal_stage->description_sp, PDO::PARAM_STR);
            $stmt->bindParam(":symbol", $phenologycal_stage->symbol, PDO::PARAM_STR);
            $stmt->bindParam(":crop", $phenologycal_stage->crop, PDO::PARAM_INT);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            $stmt->execute();
            $db = null;
            echo '{"type": true,"phenological_stage": '.json_encode($phenologycal_stage).'}';
        } catch (PDOException $e) {
            echo '{"type": false,"data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {DELETE} /:language/phenologycalstage/:id  deletePhenologycalStage
 * @apiVersion 1.0.0
 * @apiName deletePhenologycalStage
 * @apiGroup Phenologycal Stage
 * @apiPermission none
 *
 * @apiDescription Esta função deleta um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} id Id a ser atualizado.
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
    public function deletePhenologycalStage($language,$id) {
        $sql = "DELETE FROM phenological_stage WHERE id=:id";
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
 * @api {GET} /:language/phenologycalstage/:id  getOnePhenologycalStage
 * @apiVersion 1.0.0
 * @apiName getOnePhenologycalStage
 * @apiGroup Phenologycal Stage
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} id Id a ser selecionado.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } phenological_stage Retorna um objeto com os valores selecionados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 * {"type": true,"phenological_stage": [{"id":"1","description_pt":"Germinação das sementes","description_en":"","description_sp":"Germinação","symbol":"VG","crop":"1"}]}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getOnePhenologycalStage($language,$id) {
        $sql = "SELECT id,description_pt,description_en,description_sp, symbol, crop FROM phenological_stage WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            $phenologycal_stage = $stmt->fetchObject();
            $db = null;
            echo '{"type": true,"phenological_stage": '.json_encode($phenologycal_stage).'}';
        } catch (PDOException $e) {
            echo '{"type": false,"data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {GET} /:language/phenologycalstage/  getAllPhenologycalStage
 * @apiVersion 1.0.0
 * @apiName getAllPhenologycalStage
 * @apiGroup Phenologycal Stage
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos os registros
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } phenological_stage Retorna um objeto com todos os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 * {"type": true,"phenological_stage": [{"id":"1","description_pt":"Germinação das sementes","description_en":"","description_sp":"Germinação","symbol":"VG","crop":"1"}]}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getAllPhenologycalStage($language) {
        $sql = "SELECT ps.id,ps.description_$language as description, ps.symbol, c.description_$language As crop FROM phenological_stage ps INNER JOIN crop c ON c.id=ps.crop";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $phenologycalstage = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type": true,"phenological_stage": ' . json_encode($phenologycalstage) . '}';
        } catch (PDOException $e) {
            echo '{"type": false,"data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {GET} /:language/phenologycalstage/crop/:crop  getPhenologycalStageOfCrop
 * @apiVersion 1.0.0
 * @apiName getPhenologycalStageOfCrop
 * @apiGroup Phenologycal Stage
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos os registro com id de crop
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} crop Id de crop
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } phenological_stage Retorna um objeto com todos os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 * {"type": true,"phenological_stage": [{"id":"1","description_pt":"Germinação das sementes","description_en":"","description_sp":"Germinação","symbol":"VG","crop":"1"}]}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */    
    public function getAllPhenologycalStageOfCrop($language,$crop) {
        $sql = "SELECT id ,description_$language AS description, symbol, crop FROM phenological_stage WHERE crop = :crop";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":crop", $crop);
            $stmt->execute();
            $phenologycal_stage = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type": true,"phenological_stage": '.json_encode($phenologycal_stage).'}';
        } catch (PDOException $e) {
            echo '{"type": false,"data": "'.$e->getMessage().'"}';
        }
    }
    
/**
 * @api {GET} /:language/phenologycalstage/test/:test  getPhenologycalStageOfTest
 * @apiVersion 1.0.0
 * @apiName getPhenologycalStageOfTest
 * @apiGroup Phenologycal Stage
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos os estadios fenologicos da cultura plantada no ensaio xxx
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} test Id de Test
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } phenological_stage Retorna um objeto com todos os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 * {"type": true,"phenological_stage": [{"id":"1","description_pt":"Germinação das sementes","description_en":"","description_sp":"Germinação","symbol":"VG","crop":"1"}]}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */    
    public function getAllPhenologycalStageOfExperiment($language,$experiment) {
        $sql = "SELECT ps.id, ps.description_$language AS description, ps.symbol, ps.crop FROM phenological_stage ps INNER JOIN crop c ON c.id = ps.crop INNER JOIN variety v ON v.crop = c.id INNER JOIN experiment e ON e.variety = v.id WHERE e.id = :experiment";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":experiment", $experiment);
            $stmt->execute();
            $phenologycal_stage = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "phenological_stage":'.json_encode($phenologycal_stage).'}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"'.$e->getMessage().'"}';
        }
    }
}

?>