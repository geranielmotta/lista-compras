<?php

class Experiment{

/**
 * @api {POST} /:language/experiment  newExperiment
 * @apiVersion 1.0.0
 * @apiName newExperiment
 * @apiGroup Experiment
 * @apiPermission none
 *
 * @apiDescription Esta função faz o cadastramento de um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {string} name Nome do teste
 * @apiParam {string} type_test Tipo de teste
 * @apiParam {string} surface  Superficie
 * @apiParam {int} planting_date Data de plantio
 * @apiParam {int} distance_lines Distância entre as linhas
 * @apiParam {string} plants_meter Plantas por metro
 * @apiParam {int} plant_ha Plantas por hectare
 * @apiParam {string} origin_seeds Origem das sementes
 * @apiparam {int} soil_moisture  Mistura do solo
 * @apiParam {int} planting_depth Profundidade de plantio
 * @apiParam {strin} tillage Platio direto
 * @apiParam {string} previous_crop Descrição da culturaa
 * @apiParam {int} variety id da variety
 * @apiParam {int} field id da parcela
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se cadastrou
 * @apiSuccess {object[] } experiment Retorna um objeto com os valores cadastrados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type":true, "experiment": [{"name":"Nome","type_test":"Ensaio Experimental","surface":"64","planting_date":"2015-08-06","distance_lines":"2","plants_meter":"12","plants_ha":"200","origin_seeds":"Cooperativa Central","soil_moisture":"2.5","planting_depth":"2","tillage":"Sim","previous_crop":"Milho","field":"1","variety":"1","id":"1"}]}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */     
    public function newExperiment($language) {

        $request = \Slim\Slim::getInstance()->request();
        $experiment = json_decode($request->getBody());
        $sql = "INSERT INTO experiment(name, type, area, planting_date, distance_lines, plants_meter, plants_ha, origin_seeds, soil_moisture, planting_depth, tillage, previous_crop, field, variety) VALUES (:name, :type_experiment, :area, :planting_date, :distance_lines, :plants_meter, :plants_ha, :origin_seeds, :soil_moisture, :planting_depth, :tillage, :previous_crop, :field, :variety)";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":name", $experiment->name, PDO::PARAM_STR);
            $stmt->bindParam(":type", $experiment->type, PDO::PARAM_STR);
            $stmt->bindParam(":area", $experiment->area, PDO::PARAM_STR);
            $stmt->bindParam(":planting_date", $experiment->planting_date, PDO::PARAM_INT);
            $stmt->bindParam(":distance_lines", $experiment->distance_lines, PDO::PARAM_INT);
            $stmt->bindParam(":plants_meter", $experiment->plants_meter, PDO::PARAM_INT);
            $stmt->bindParam(":plants_ha", $experiment->plants_ha, PDO::PARAM_INT);
            $stmt->bindParam(":origin_seeds", $experiment->origin_seeds, PDO::PARAM_STR);
            $stmt->bindParam(":soil_moisture", $experiment->soil_moisture, PDO::PARAM_INT);
            $stmt->bindParam(":planting_depth", $experiment->planting_depth, PDO::PARAM_INT);
            $stmt->bindParam(":tillage", $experiment->tillage, PDO::PARAM_STR);
            $stmt->bindParam(":previous_crop", $experiment->previous_crop, PDO::PARAM_STR);
            $stmt->bindParam(":field", $experiment->field, PDO::PARAM_INT);
            $stmt->bindParam(":variety", $experiment->variety, PDO::PARAM_INT);
            $stmt->execute();
            $experiment->id = $db->lastInsertId();
            $db = null;
            echo '{"type":true, "experiment": ' . json_encode($experiment) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {PUT} /:language/experiment/:id  updateExperiment
 * @apiVersion 1.0.0
 * @apiName updateExperiment
 * @apiGroup Experiment
 * @apiPermission none
 *
 * @apiDescription Esta função atualiza um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {string} name Nome do teste
 * @apiParam {string} type_test Tipo de teste
 * @apiParam {string} surface  Superficie
 * @apiParam {int} planting_date Data de plantio
 * @apiParam {int} distance_lines Distância entre as linhas
 * @apiParam {string} plants_meter Plantas por metro
 * @apiParam {int} plant_ha Plantas por hectare
 * @apiParam {string} origin_seeds Origem das sementes
 * @apiparam {int} soil_moisture  Mistura do solo
 * @apiParam {int} planting_depth Profundidade de plantio
 * @apiParam {strin} tillage Platio direto
 * @apiParam {string} previous_crop Descrição da culturaa
 * @apiParam {int} variety id da variety
 * @apiParam {int} field id da parcela
 * @apiParam {int} id a ser atualizado
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se atualizou
 * @apiSuccess {object[] } experiment Retorna um objeto com os valores atualizados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type":true, "experiment": [{"id":"1","name":"Nome","type_test":"Ensaio Experimental","surface":"64","planting_date":"2015-08-06","distance_lines":"2","plants_meter":"12","plants_ha":"200","origin_seeds":"Cooperativa Central","soil_moisture":"2.5","planting_depth":"2","tillage":"Sim","previous_crop":"Milho","field":"1","variety":"1"}]}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function updateExperiment($language,$id) {
        $request = \Slim\Slim::getInstance()->request();
        $experiment = json_decode($request->getBody());
        $sql = "UPDATE experiment SET name=:name, type=:type, area=:area, planting_date=:planting_date, distance_lines=:distance_lines, plants_meter=:plants_meter, plants_ha=:plants_ha, origin_seeds=:origin_seeds, soil_moisture=:soil_moisture, planting_depth=:planting_depth, tillage=:tillage, previous_crop=:previous_crop, field=:field, variety=:variety WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":name", $experiment->name, PDO::PARAM_STR);
            $stmt->bindParam(":type", $experiment->type, PDO::PARAM_STR);
            $stmt->bindParam(":area", $experiment->area, PDO::PARAM_INT);
            $stmt->bindParam(":planting_date", $experiment->planting_date, PDO::PARAM_INT);
            $stmt->bindParam(":distance_lines", $experiment->distance_lines, PDO::PARAM_INT);
            $stmt->bindParam(":plants_meter", $experiment->plants_meter, PDO::PARAM_INT);
            $stmt->bindParam(":plants_ha", $experiment->plants_ha, PDO::PARAM_INT);
            $stmt->bindParam(":origin_seeds", $experiment->origin_seeds, PDO::PARAM_STR);
            $stmt->bindParam(":soil_moisture", $experiment->soil_moisture, PDO::PARAM_INT);
            $stmt->bindParam(":planting_depth", $experiment->planting_depth, PDO::PARAM_INT);
            $stmt->bindParam(":tillage", $experiment->tillage, PDO::PARAM_STR);
            $stmt->bindParam(":previous_crop", $experiment->previous_crop, PDO::PARAM_STR);
            $stmt->bindParam(":field", $experiment->field, PDO::PARAM_INT);
            $stmt->bindParam(":variety", $experiment->variety, PDO::PARAM_INT);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $db = null;
            echo '{"type":true, "experiment": ' . json_encode($experiment) . '}';
        } catch (PDOException $e) {
            echo '{"type": false,"data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {DELETE} /:language/experiment/:id  deleteExperiment
 * @apiVersion 1.0.0
 * @apiName deleteExperiment
 * @apiGroup Experiment
 * @apiPermission none
 *
 * @apiDescription Esta função deleta um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} id a ser deletado
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
    public function deleteExperiment($language,$id) {
        $sql = "DELETE FROM experiment WHERE id=:id";
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
 * @api {GET} /:language/experiment/:id'  getOneExperiment
 * @apiVersion 1.0.0
 * @apiName getOneExperiment
 * @apiGroup Experiment
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} id a ser selecionado
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } experiment Retorna um objeto com os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type":true, "test": [{"id":"1","name":"Nome","type_test":"Ensaio Experimental","surface":"64","planting_date":"2015-08-06","distance_lines":"2","plants_meter":"12","plants_ha":"200","origin_seeds":"Cooperativa Central","soil_moisture":"2.5","planting_depth":"2","tillage":"Sim","previous_crop":"Milho","field":"1","variety":"1"}]}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
     public function getOneExperiment($language,$id) {
        $sql = "SELECT e.id, e.name, e.type, e.area, e.planting_date, e.distance_lines, e.plants_meter, e.plants_ha, e.origin_seeds, e.soil_moisture, e.planting_depth, e.tillage, e.previous_crop, e.name AS field, v.description AS variety, c.description_$language AS crop FROM experiment e INNER JOIN variety v ON v.id = e.variety INNER JOIN field f ON f.id = e.field INNER JOIN crop c ON c.id = v.crop WHERE e.id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $experiment = $stmt->fetchObject();
            $db = null;
            echo '{"type":true, "experiment": ' . json_encode($experiment) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {GET} /:language/experiment  getAllExperiment
 * @apiVersion 1.0.0
 * @apiName getAllExperiment
 * @apiGroup Test
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos os registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * 
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } experiment Retorna um objeto com todos os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type":true, "experiment": [{"id":"1","name":"Nome","type_test":"Ensaio Experimental","surface":"64","planting_date":"2015-08-06","distance_lines":"2","plants_meter":"12","plants_ha":"200","origin_seeds":"Cooperativa Central","soil_moisture":"2.5","planting_depth":"2","tillage":"Sim","previous_crop":"Milho","field":"1","variety":"1"}]}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getAllExperiment($language) {
        $sql = "SELECT e.id, e.name, e.type, e.area, e.planting_date, e.distance_lines, e.plants_meter, e.plants_ha, e.origin_seeds, e.soil_moisture, e.planting_depth, e.tillage, e.previous_crop, f.name AS field, v.description AS variety, c.description_pt AS crop FROM experiment e INNER JOIN field f ON f.id = e.field INNER JOIN variety v ON v.id = e.variety INNER JOIN crop c ON c.id = v.crop";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $experiment = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "experiment": ' . json_encode($experiment) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }
    
    /**
 * @api {GET} /:language/experiment/field/:field  getAllExperimentOfField
 * @apiVersion 1.0.0
 * @apiName getAllExperimentOfField
 * @apiGroup Experiment
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos os registro que tenham uma ligação com :field
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} field a ser selecionado
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } experiment Retorna um objeto com os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type":true, "experiment": [{"id":"1","name":"Nome","type_test":"Ensaio Experimental","surface":"64","planting_date":"2015-08-06","distance_lines":"2","plants_meter":"12","plants_ha":"200","origin_seeds":"Cooperativa Central","soil_moisture":"2.5","planting_depth":"2","tillage":"Sim","previous_crop":"Milho","field":"1","variety":"1"}]}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */  

    public function getAllExperimentOfField($language,$field) {
        $sql = "SELECT e.id, e.name, e.type, e.area, e.planting_date, e.distance_lines, e.plants_meter, e.plants_ha, e.origin_seeds, e.soil_moisture, e.planting_depth, e.tillage, e.previous_crop, e.field, v.description AS variety, c.description_$language AS crop FROM experiment e INNER JOIN variety v ON v.id = e.variety INNER JOIN crop c ON c.id = v.crop WHERE e.field = :field";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":field", $field);
            $stmt->execute();
            $experiment = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "experiment": ' . json_encode($experiment) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }
    
        /**
 * @api {GET} /:language/experiment/user/:user  getAllExperimentOfUser
 * @apiVersion 1.0.0
 * @apiName getAllExperimentOfUser
 * @apiGroup Experiment
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos os registro que tenham uma ligação com :user
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} user a ser selecionado
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } experiment Retorna um objeto com os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type":true, "experiment": [{"id":"1","name":"Nome","type_test":"Ensaio Experimental","surface":"64","planting_date":"2015-08-06","distance_lines":"2","plants_meter":"12","plants_ha":"200","origin_seeds":"Cooperativa Central","soil_moisture":"2.5","planting_depth":"2","tillage":"Sim","previous_crop":"Milho","field":"1","variety":"1"}]}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */ 
       
    public function getAllExperimentOfUser($language,$user) {
        $sql = "SELECT e.id, e.name, e.type, e.area, e.planting_date, e.distance_lines, e.plants_meter, e.plants_ha, e.origin_seeds, e.soil_moisture, e.planting_depth, e.tillage, e.previous_crop, e.field, v.description AS variety, c.description_$language AS crop FROM experiment e INNER JOIN variety v ON v.id = e.variety INNER JOIN crop c ON c.id = v.crop INNER JOIN field f ON f.id = e.field INNER JOIN user_field uf ON uf.field = f.id WHERE uf.user=:user";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":user", $user);
            $stmt->execute();
            $experiment = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "experiment": ' . json_encode($experiment) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }
        /**
 * @api {GET} /:language/experiment/organization/:organization  getAllExperimentOfOrganization
 * @apiVersion 1.0.0
 * @apiName getAllExperimentOfOrganization
 * @apiGroup Experiment
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos os registro que tenham uma ligação com :organization
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} organization a ser selecionado
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } experiment Retorna um objeto com os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type":true, "experiment": [{"id":"1","name":"Nome","type_test":"Ensaio Experimental","surface":"64","planting_date":"2015-08-06","distance_lines":"2","plants_meter":"12","plants_ha":"200","origin_seeds":"Cooperativa Central","soil_moisture":"2.5","planting_depth":"2","tillage":"Sim","previous_crop":"Milho","field":"1","variety":"1"}]}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */   
    public function getAllExperimentOfOrganization($language,$organization){
        $sql = "SELECT DISTINCT e.id, e.name, e.type, e.area, e.planting_date, e.distance_lines, e.plants_meter, e.plants_ha, e.origin_seeds, e.soil_moisture, e.planting_depth, e.tillage, e.previous_crop, f.name AS field, v.description AS variety, cr.description_pt AS crop
                FROM experiment e
                INNER JOIN field f ON f.id = e.field
                INNER JOIN user_field uf ON uf.field = f.id
                INNER JOIN user u ON u.id = uf.user
                INNER JOIN organization o ON o.id = u.organization
                INNER JOIN city c ON c.id = f.city
                INNER JOIN station ws ON ws.id = f.station
                INNER JOIN soil s ON s.id = f.soil
                INNER JOIN variety v ON v.id = e.variety
                INNER JOIN crop cr ON cr.id = v.crop
                WHERE o.id=:organization;";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":organization", $organization);
            $stmt->execute();
            $experiment = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "experiment": ' . json_encode($experiment) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }

    
}

?>