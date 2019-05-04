<?php

class Soil {
/**
 * @api {POST} /:language/soil  newSoil
 * @apiVersion 1.0.0
 * @apiName newSoil
 * @apiGroup Soil
 * @apiPermission none
 *
 * @apiDescription Esta função faz o cadastramento de um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {string} name Nome do solo
 * @apiParam {int} inclination Inclinação do solo
 * @apiParam {string} infiltration_capacity Capacidade de infiltração do solo   
 * @apiParam {string}  dreinage Drenagem do solo
 * @apiParam {string} depth  Profundidade do solo
 * @apiParam {int} soil_type Tipo de solo
 * @apiParam {int} horizon_h1 Id de horizonte 1
 * @apiParam {int} horizon_h2 Id de horizonte 2
 * @apiParam {int} horizon_h3 Id de horizonte 3
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se cadastrou
 * @apiSuccess {object[] } soil Retorna um objeto com os valores cadastrados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 * {"type":true, "soil": [{"name":"soil","inclination":"null","infiltration_capacity":"null","drainage":"null","depth":"null","soil_type":"1","horizon_h1":"1","horizon_h2":"2","horizon_h3":"3","id":"1"}]}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function newSoil($language) {
        
        $request = \Slim\Slim::getInstance()->request();
        $soil = json_decode($request->getBody());
        $sql = "INSERT INTO soil(description, infiltration_capacity, drainage, depth,soil_type, horizon_h1, horizon_h2, horizon_h3) VALUES (:description, :infiltration_capacity, :drainage, :depth, :soil_type, :horizon_h1, :horizon_h2, :horizon_h3)";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":description", $soil->description, PDO::PARAM_STR);
            $stmt->bindParam(":infiltration_capacity", $soil->infiltration_capacity, PDO::PARAM_STR);
            $stmt->bindParam(":drainage", $soil->drainage, PDO::PARAM_STR);
            $stmt->bindParam(":depth", $soil->depth, PDO::PARAM_STR);
            $stmt->bindParam(":soil_type", $soil->soil_type, PDO::PARAM_INT);
            $stmt->bindParam(":horizon_h1", $soil->horizon_h1, PDO::PARAM_INT);
            $stmt->bindParam(":horizon_h2", $soil->horizon_h2, PDO::PARAM_INT);
            $stmt->bindParam(":horizon_h3", $soil->horizon_h3, PDO::PARAM_INT);
            $stmt->execute();
            $soil->id = $db->lastInsertId();
            $db = null;
            echo '{"type":true, "soil":' . json_encode($soil) . '}';
        } catch (PDOException $e) {
            echo '{"type":false,"data":"'.$e->getMessage().'"}';
        }
    }
/**
 * @api {PUT} /:language/soil/:id  updateSoil
 * @apiVersion 1.0.0
 * @apiName updateSoil
 * @apiGroup Soil
 * @apiPermission none
 *
 * @apiDescription Esta função atualiza um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {string} name Nome do solo
 * @apiParam {int} inclination Inclinação do solo
 * @apiParam {string} infiltration_capacity Capacidade de infiltração do solo   
 * @apiParam {string}  dreinage Drenagem do solo
 * @apiParam {string} depth  Profundidade do solo
 * @apiParam {int} soil_type Tipo de solo
 * @apiParam {int} horizon_h1 Id de horizonte 1
 * @apiParam {int} horizon_h2 Id de horizonte 2
 * @apiParam {int} horizon_h3 Id de horizonte 3
 * @apiParam {int} id Id a ser atualizado
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se atualizou
 * @apiSuccess {object[] } soil Retorna um objeto com os valores atualizados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 * {"type":true, "soil": [{"id":"1","name":"soil","inclination":"null","infiltration_capacity":"null","drainage":"null","depth":"null","soil_type":"1","horizon_h1":"1","horizon_h2":"2","horizon_h3":"3"}]}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function updateSoil($language,$id) {
        $request = \Slim\Slim::getInstance()->request();
        $soil = json_decode($request->getBody());
        $sql = "UPDATE soil SET name=:name ,inclination=:inclination ,infiltration_capacity=:infiltration_capacity ,drainage=:drainage ,depth=:depth ,soil_type=:soil_type ,horizon_h1=:horizon_h1 ,horizon_h2=:horizon_h2 ,horizon_h3=:horizon_h3 WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":description", $soil->description, PDO::PARAM_STR);
            $stmt->bindParam(":infiltration_capacity", $soil->infiltration_capacity, PDO::PARAM_STR);
            $stmt->bindParam(":drainage", $soil->drainage, PDO::PARAM_STR);
            $stmt->bindParam(":depth", $soil->depth, PDO::PARAM_STR);
            $stmt->bindParam(":soil_type", $soil->soil_type, PDO::PARAM_INT);
            $stmt->bindParam(":horizon_h1", $soil->horizon_h1, PDO::PARAM_INT);
            $stmt->bindParam(":horizon_h2", $soil->horizon_h2, PDO::PARAM_INT);
            $stmt->bindParam(":horizon_h3", $soil->horizon_h3, PDO::PARAM_INT);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $db = null;
            echo '{"type": true,"soil": ' . json_encode($soil) . '}';
        } catch (PDOException $e) {
            echo '{"type": false,"data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {DELETE} /:language/soil/:id  deleteSoil
 * @apiVersion 1.0.0
 * @apiName deleteSoil
 * @apiGroup Soil
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
    public function deleteSoil($language,$id) {
        $sql = "DELETE FROM soil WHERE id=:id";
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
 * @api {GET} /:language/soil/:id  getOneSoil
 * @apiVersion 1.0.0
 * @apiName getOneSoil
 * @apiGroup Soil
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} id Id a ser selecionado
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } soil Retorna um objeto com os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 * {"type": true,"soil": {"id":"1","name":"Solo Arenoso","inclination":"25","infiltration_capacity":"1","drainage":"0","depth":"30","h1_id":"1","h1_description":"Horizonte 1","h1_top_depth":"20","h1_bottom_depth":"10","h1_density":"5","h1_wilting_point":"5","h1_water_ph":"8","h1_mo":"50","h1_field_capacity":"30","h1_compression":"0","h1_sand_percentage":"25","h1_clay_percentage":"25","h1_silt_percentage":"50","h2_id":"2","h2_description":"Horizonte 2","h2_top_depth":"35","h2_bottom_depth":"20","h2_density":"10","h2_wilting_point":"50","h2_water_ph":"5","h2_mo":"40","h2_field_capacity":"40","h2_compression":"0","h2_sand_percentage":"25","h2_clay_percentage":"25","h2_silt_percentage":"50","h3_id":"3","h3_description":"Horizonte 3","h3_top_depth":"30","h3_bottom_depth":"30","h3_density":"7","h3_wilting_point":"30","h3_water_ph":"20","h3_mo":"60","h3_field_capacity":"50","h3_compression":"0","h3_sand_percentage":"25","h3_clay_percentage":"25","h3_silt_percentage":"50","soil_type":"Arenoso"}} * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getOneSoil($language,$id) {
        $sql = "SELECT s.id, s.description, s.infiltration_capacity, s.drainage, s.depth, h1.id as h1_id, h1.description as horizon_h1, h1.top_depth as h1_top_depth, h1.bottom_depth as h1_bottom_depth, h1.density as h1_density, h1.wilting_point as h1_wilting_point, h1.water_ph as h1_water_ph, h1.mo as h1_mo, h1.field_capacity as h1_field_capacity, h1.compression as h1_compression, h1.sand_percentage as h1_sand_percentage, h1.clay_percentage as h1_clay_percentage, h1.silt_percentage as h1_silt_percentage, h2.id as h2_id, h2.description as horizon_h2, h2.top_depth as h2_top_depth, h2.bottom_depth as h2_bottom_depth, h2.density as h2_density, h2.wilting_point as h2_wilting_point, h2.water_ph as h2_water_ph, h2.mo as h2_mo, h2.field_capacity as h2_field_capacity, h2.compression as h2_compression, h2.sand_percentage as h2_sand_percentage, h2.clay_percentage as h2_clay_percentage, h2.silt_percentage as h2_silt_percentage, h3.id as h3_id, h3.description as horizon_h3, h3.top_depth as h3_top_depth, h3.bottom_depth as h3_bottom_depth, h3.density as h3_density, h3.wilting_point as h3_wilting_point, h3.water_ph as h3_water_ph, h3.mo as h3_mo, h3.field_capacity as h3_field_capacity, h3.compression as h3_compression, h3.sand_percentage as h3_sand_percentage, h3.clay_percentage as h3_clay_percentage, h3.silt_percentage as h3_silt_percentage,  t.description_$language as soil_type FROM soil s INNER JOIN horizon h1 ON s.horizon_h1 = h1.id INNER JOIN horizon h2 ON s.horizon_h2 = h2.id INNER JOIN horizon h3 ON s.horizon_h3 = h3.id INNER JOIN soil_type t ON t.id=s.soil_type WHERE s.id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $soil = $stmt->fetchObject();
            $db = null;
            echo '{"type":true, "soil":' . json_encode($soil) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"'.$e->getMessage().'"}';
        }
    }
/**
 * @api {GET} /:language/soil/:id  getAllSoil
 * @apiVersion 1.0.0
 * @apiName getAllSoil
 * @apiGroup Soil
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos os registros
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } soil Retorna um objeto com todos os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 * {"type": true,"soil": {"id":"1","name":"Solo Arenoso","inclination":"25","infiltration_capacity":"1","drainage":"0","depth":"30","h1_id":"1","h1_description":"Horizonte 1","h1_top_depth":"20","h1_bottom_depth":"10","h1_density":"5","h1_wilting_point":"5","h1_water_ph":"8","h1_mo":"50","h1_field_capacity":"30","h1_compression":"0","h1_sand_percentage":"25","h1_clay_percentage":"25","h1_silt_percentage":"50","h2_id":"2","h2_description":"Horizonte 2","h2_top_depth":"35","h2_bottom_depth":"20","h2_density":"10","h2_wilting_point":"50","h2_water_ph":"5","h2_mo":"40","h2_field_capacity":"40","h2_compression":"0","h2_sand_percentage":"25","h2_clay_percentage":"25","h2_silt_percentage":"50","h3_id":"3","h3_description":"Horizonte 3","h3_top_depth":"30","h3_bottom_depth":"30","h3_density":"7","h3_wilting_point":"30","h3_water_ph":"20","h3_mo":"60","h3_field_capacity":"50","h3_compression":"0","h3_sand_percentage":"25","h3_clay_percentage":"25","h3_silt_percentage":"50","soil_type":"Arenoso"}} * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getAllSoil($language) {
        $sql = "SELECT s.id, s.description, s.infiltration_capacity, s.drainage, s.depth, h1.id as h1_id, h1.description as h1_description, h1.top_depth as h1_top_depth, h1.bottom_depth as h1_bottom_depth, h1.density as h1_density, h1.wilting_point as h1_wilting_point, h1.water_ph as h1_water_ph, h1.mo as h1_mo, h1.field_capacity as h1_field_capacity, h1.compression as h1_compression, h1.sand_percentage as h1_sand_percentage, h1.clay_percentage as h1_clay_percentage, h1.silt_percentage as h1_silt_percentage, h2.id as h2_id, h2.description as h2_description, h2.top_depth as h2_top_depth, h2.bottom_depth as h2_bottom_depth, h2.density as h2_density, h2.wilting_point as h2_wilting_point, h2.water_ph as h2_water_ph, h2.mo as h2_mo, h2.field_capacity as h2_field_capacity, h2.compression as h2_compression, h2.sand_percentage as h2_sand_percentage, h2.clay_percentage as h2_clay_percentage, h2.silt_percentage as h2_silt_percentage, h3.id as h3_id, h3.description as h3_description, h3.top_depth as h3_top_depth, h3.bottom_depth as h3_bottom_depth, h3.density as h3_density, h3.wilting_point as h3_wilting_point, h3.water_ph as h3_water_ph, h3.mo as h3_mo, h3.field_capacity as h3_field_capacity, h3.compression as h3_compression, h3.sand_percentage as h3_sand_percentage, h3.clay_percentage as h3_clay_percentage, h3.silt_percentage as h3_silt_percentage,  t.description_$language as soil_type FROM soil s INNER JOIN horizon h1 ON s.horizon_h1 = h1.id INNER JOIN horizon h2 ON s.horizon_h2 = h2.id INNER JOIN horizon h3 ON s.horizon_h3 = h3.id INNER JOIN soil_type t ON t.id=s.soil_type";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $soil = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;

            echo '{"type":true, "soil": ' . json_encode($soil) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {GET} /:language/soil/user/:id getSoilOfUser
 * @apiVersion 1.0.0
 * @apiName getSoilOfUser
 * @apiGroup Soil
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos os registro com id de um usuário
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} id Id a ser selecionado
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } soil Retorna um objeto com os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 * {"type":true, "soil": [{"id":"1","soil":"Solo Arenoso","field":"Parcela de Sesamo"}]}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getAllSoilOfUser($language,$id) {
        $sql = "SELECT s.id, s.description AS soil, f.name AS field FROM soil s INNER JOIN field f ON f.soil = s.id INNER JOIN user_field uf ON uf.field = f.id INNER JOIN user u ON uf.user = u.id WHERE u.id=:id;";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $soil = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "soil": ' . json_encode($soil) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }

/**
 * @api {GET} /:language/soil/organization/:id getAllSoilOfOrganization
 * @apiVersion 1.0.0
 * @apiName getAllSoilOfOrganization
 * @apiGroup Soil
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos os registro com id da organização
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} id Id a ser selecionado
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } soil Retorna um objeto com os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 * {"type":true, "soil": [{"id":"1","name":"soil","inclination":"null","infiltration_capacity":"null","drainage":"null","depth":"null","soil_type":"1","horizon_h1":"1","horizon_h2":"2","horizon_h3":"3"}]}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */    
    
    public function getAllSoilOfOrganization($language,$organization){
        $sql = "SELECT DISTINCT s.id, s.description, s.infiltration_capacity, s.drainage, s.depth, st.description_$language AS soil_type, h1.description AS horizon_h1, h2.description AS horizon_h2, h3.description AS horizon_h3, f.name AS field 
                FROM soil s
                INNER JOIN field f ON f.soil = s.id
                INNER JOIN soil_type st ON st.id = s.soil_type
                INNER JOIN horizon h1 ON h1.id = s.horizon_h1
                INNER JOIN horizon h2 ON h2.id = s.horizon_h2
                INNER JOIN horizon h3 ON h3.id = s.horizon_h3
                INNER JOIN user_field uf ON uf.field = f.id 
                INNER JOIN user u ON uf.user = u.id 
                INNER JOIN organization o ON o.id=u.organization
                WHERE o.id=:organization
                GROUP BY s.id ;";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":organization", $organization);
            $stmt->execute();
            $soil = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "soil": ' . json_encode($soil) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }

}

?>