<?php

class SubSample {
/**
 * @api {POST} /:language/subsample  newSubSample
 * @apiVersion 1.0.0
 * @apiName newSubSample
 * @apiGroup Sub Sample
 * @apiPermission none
 *
 * @apiDescription Esta função faz o cadastramento de um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} plants_meter  Plantas pr metro
 * @apiParam {int} plants_height   Altura da planta
 * @apiParam {int} leaf_area_index Indice de área folear
 * @apiParam {int} fresh_weight   Peso freco
 * @apiParam {int} dry_weight Peso seco
 * @apiParam {int} leaves_weight Peso das folhas
 * @apiParam {int} stem_weight Peso das hastes
 * @apiParam {int} flowers_weight Peso das flores
 * @apiparam {int} capsules_weight Peso do caule
 * @apiParam {string} note Nota na coleta
 * @apiParam {int} biomass Id de biomass
 * @apiParam {int} phenological_stage Id de phenological stage 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se cadastrou
 * @apiSuccess {object[] } sub_sample Retorna um objeto com os valores cadastrados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type":true, "sub_sample": [{"plants_meter":"40","plants_height":"80","leaf_area_index":"80","fresh_weight":"80","dry_weight":"80","leaves_weight":"80","stem_weight":"80","flowers_weight":"80","capsules_weight":"80","note":"Primeira sub-amostra de uma fenologia colocada como um dos principais estadios fenológico","biomass":"3","phenological_stage":"2","id":"1"}]} 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function newSubSample($language) {       
        $request = \Slim\Slim::getInstance()->request();
        $subsample = json_decode($request->getBody());
        $sql = "INSERT INTO subsample(plants_meter, plants_height, leaf_area_index, fresh_weight, dry_weight, leaves_weight, stem_weight, flowers_weight, capsules_weight, note, biomass,phenological_stage) VALUES (:plants_meter, :plants_height, :leaf_area_index, :fresh_weight, :dry_weight, :leaves_weight, :stem_weight, :flowers_weight, :capsules_weight, :note, :biomass,:phenological_stage)";
        try {

            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":plants_meter", $subsample->plants_meter, PDO::PARAM_INT);
            $stmt->bindParam(":plants_height", $subsample->plants_height, PDO::PARAM_INT);
            $stmt->bindParam(":leaf_area_index", $subsample->leaf_area_index, PDO::PARAM_INT);
            $stmt->bindParam(":fresh_weight", $subsample->fresh_weight, PDO::PARAM_INT);
            $stmt->bindParam(":dry_weight", $subsample->dry_weight, PDO::PARAM_INT);
            $stmt->bindParam(":leaves_weight", $subsample->leaves_weight, PDO::PARAM_INT);
            $stmt->bindParam(":stem_weight", $subsample->stem_weight, PDO::PARAM_INT);
            $stmt->bindParam(":flowers_weight", $subsample->flowers_weight, PDO::PARAM_INT);
            $stmt->bindParam(":capsules_weight", $subsample->capsules_weight, PDO::PARAM_INT);
            $stmt->bindParam(":note", $subsample->note, PDO::PARAM_STR);
            $stmt->bindParam(":biomass", $subsample->biomass, PDO::PARAM_INT);
            $stmt->bindParam(":phenological_stage", $subsample->phenological_stage, PDO::PARAM_INT);
            $stmt->execute();
            $subsample->id = $db->lastInsertId();
            $db = null;
            echo '{"type":true, "sub_sample": '.json_encode($subsample).'}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {PUT} /:language/subsample/:id  updateSubSample
 * @apiVersion 1.0.0
 * @apiName updateSubSample
 * @apiGroup Sub Sample
 * @apiPermission none
 *
 * @apiDescription Esta função atualiza um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} plants_meter  Plantas pr metro
 * @apiParam {int} plants_height   Altura da planta
 * @apiParam {int} leaf_area_index Indice de área folear
 * @apiParam {int} fresh_weight   Peso freco
 * @apiParam {int} dry_weight Peso seco
 * @apiParam {int} leaves_weight Peso das folhas
 * @apiParam {int} stem_weight Peso das hastes
 * @apiParam {int} flowers_weight Peso das flores
 * @apiparam {int} capsules_weight Peso do caule
 * @apiParam {string} note Nota na coleta
 * @apiParam {int} biomass Id de biomass
 * @apiParam {int} phenological_stage Id de phenological stage
 * @apiParam {int} id Id a ser atualizado 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se atualizou
 * @apiSuccess {object[] } sub_sample Retorna um objeto com os valores atualizados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type":true, "sub_sample": [{"id":"1","plants_meter":"40","plants_height":"80","leaf_area_index":"80","fresh_weight":"80","dry_weight":"80","leaves_weight":"80","stem_weight":"80","flowers_weight":"80","capsules_weight":"80","note":"Primeira sub-amostra de uma fenologia colocada como um dos principais estadios fenológico","biomass":"3","phenological_stage":"2"}]} 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function updateSubSample($language,$id) {
        $request = \Slim\Slim::getInstance()->request();
        $subsample = json_decode($request->getBody());
        $sql = "UPDATE subsample SET plants_meter=:plants_meter, plants_height=:plants_height, leaf_area_index=:leaf_area_index, fresh_weight=:fresh_weight, dry_weight=:dry_weight, leaves_weight=:leaves_weight, stem_weight=:stem_weight, flowers_weight=:flowers_weight, capsules_weight=:capsules_weight, note=:note, biomass=:biomass,phenological_stage=:phenological_stage WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":plants_meter", $subsample->plants_meter, PDO::PARAM_INT);
            $stmt->bindParam(":plants_height", $subsample->plants_height, PDO::PARAM_INT);
            $stmt->bindParam(":leaf_area_index", $subsample->leaf_area_index, PDO::PARAM_INT);
            $stmt->bindParam(":fresh_weight", $subsample->fresh_weight, PDO::PARAM_INT);
            $stmt->bindParam(":dry_weight", $subsample->dry_weight, PDO::PARAM_INT);
            $stmt->bindParam(":leaves_weight", $subsample->leaves_weight, PDO::PARAM_INT);
            $stmt->bindParam(":stem_weight", $subsample->stem_weight, PDO::PARAM_INT);
            $stmt->bindParam(":flowers_weight", $subsample->flowers_weight, PDO::PARAM_INT);
            $stmt->bindParam(":capsules_weight", $subsample->capsules_weight, PDO::PARAM_INT);
            $stmt->bindParam(":note", $subsample->note, PDO::PARAM_STR);
            $stmt->bindParam(":biomass", $subsample->biomass, PDO::PARAM_INT);
            $stmt->bindParam(":phenological_stage", $subsample->phenological_stage, PDO::PARAM_INT);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $db = null;
            echo '{"type":true, "sub_sample": '.json_encode($subsample).'}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {DELETE} /:language/subsample/:id  deleteSubSample
 * @apiVersion 1.0.0
 * @apiName deleteSubSample
 * @apiGroup Sub Sample
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
    public function deleteSubSample($language,$id) {
        $sql = "DELETE FROM subsample WHERE id=:id";
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
 * @api {GET} /:language/subsample/:id  getOneSubSample
 * @apiVersion 1.0.0
 * @apiName getOneSubSample
 * @apiGroup Sub Sample
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} id Id a ser selecionado
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } sub_sample Retorna um objeto com os valores 
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type":true, "sub_sample": [{"id":"1","plants_meter":"40","plants_height":"80","leaf_area_index":"80","fresh_weight":"80","dry_weight":"80","leaves_weight":"80","stem_weight":"80","flowers_weight":"80","capsules_weight":"80","note":"Primeira sub-amostra de uma fenologia colocada como um dos principais estadios fenológico","biomass":"3","phenological_stage":"2"}]} 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getOneSubSample($language,$id) {
        $sql = "SELECT s.id, s.plants_meter, s.plants_height, s.leaf_area_index, s.fresh_weight, s.dry_weight, s.leaves_weight, s.stem_weight, s.flowers_weight, s.capsules_weight, s.note, s.biomass, p.description_$language AS phenological_stage FROM  subsample s INNER JOIN phenological_stage p ON s.phenological_stage = p.id WHERE s.id = :id ORDER BY id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $subsample = $stmt->fetchObject();
            $db = null;
            echo '{"type":true, "sub_sample": '.json_encode($subsample).'}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {GET} /:language/subsample/  getAllSubSample
 * @apiVersion 1.0.0
 * @apiName getAllSubSample
 * @apiGroup Sub Sample
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos os registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } sub_sample Retorna um objeto com todos os valores 
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type":true, "sub_sample": [{"id":"1","plants_meter":"40","plants_height":"80","leaf_area_index":"80","fresh_weight":"80","dry_weight":"80","leaves_weight":"80","stem_weight":"80","flowers_weight":"80","capsules_weight":"80","note":"Primeira sub-amostra de uma fenologia colocada como um dos principais estadios fenológico","biomass":"3","phenological_stage":"2"}]} 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getAllSubSample($language) {
        $sql = "SELECT s.id, s.plants_meter, s.plants_height, s.leaf_area_index, s.fresh_weight, s.dry_weight, s.leaves_weight, s.stem_weight, s.flowers_weight, s.capsules_weight, s.note, s.biomass, p.description_$language AS phenological_stage FROM  subsample s INNER JOIN phenological_stage p ON s.phenological_stage = p.id ORDER BY id";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $subsample = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "sub_sample": ' . json_encode($subsample) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {GET} /:language/subsample/biomass/:biomass  getSubSampleOfBiomass
 * @apiVersion 1.0.0
 * @apiName getSubSampleOfBiomass
 * @apiGroup Sub Sample
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos os registro que possuam o id de uma biomassa
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} biomass Id da biomassa
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } sub_sample Retorna um objeto com os valores 
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type":true, "sub_sample": [{"id":"1","plants_meter":"40","plants_height":"80","leaf_area_index":"80","fresh_weight":"80","dry_weight":"80","leaves_weight":"80","stem_weight":"80","flowers_weight":"80","capsules_weight":"80","note":"Primeira sub-amostra de uma fenologia colocada como um dos principais estadios fenológico","biomass":"3","phenological_stage":"2"}]} 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getAllSubSampleOfBiomass($language,$biomass) {
        $sql = "SELECT s.id, s.plants_meter, s.plants_height, s.leaf_area_index, s.fresh_weight, s.dry_weight, s.leaves_weight, s.stem_weight, s.flowers_weight, s.capsules_weight, s.note, s.biomass, p.description_$language AS phenological_stage FROM  subsample s INNER JOIN phenological_stage p ON s.phenological_stage = p.id WHERE biomass = :biomass ORDER BY id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":biomass", $biomass);
            $stmt->execute();
            $subsample = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type": true,"sub_sample":'.json_encode($subsample).'}';
        } catch (PDOException $e) {
            echo '{"type": false,"data": "'.$e->getMessage().'"}';
        }
    }

}

?>