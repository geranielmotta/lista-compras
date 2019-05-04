<?php

class Horizon {
/**
 * @api {POST} /:language/horizon/ newHorizon
 * @apiVersion 1.0.0
 * @apiName newHorizon
 * @apiGroup Horizon
 * @apiPermission none
 *
 * @apiDescription Esta função faz o cadastramento de um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {string} description   Descrição do horizonte.
 * @apiParam {double} top_depth  Altura do horizonte.
 * @apiParam {double} buttom_depth Lower Profundidade do horizonte.
 * @apiParam {double} density Densidade
 * @apiParam {double} wilting_point Ponto de murcha
 * @apiParam {double} weter_ph PH da água
 * @apiParam {double} mo matéria orgânica
 * @apiParam {double} field_capacity Capacidade de campo
 * @apiParam {double} compression Compactação do solo
 * @apiParam {double} sand_percentage Porcentagem de areia
 * @apiParam {double} clay_percentage Porcentagem de argila
 * @apiParam {double} silt_percentage Porcentagem de lodo
 * @apiParam {string} horizon_value  Valor do horizonte
 * @apiParam {string} horizon_cod    Código do horizonte
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se cadastrou
 * @apiSuccess {object[] } horizon Retorna um objeto com os valores cadastrados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *  {"type":true, "horizon":[{"description":"Horizonte 1","top_depth":"20","bottom_depth":"10","density":"5","wilting_point":"5","water_ph":"8","mo":"50","field_capacity":"30","compression":"0","sand_percentage":"25","clay_percentage":"25","silt_percentage":"50","horizon_value":"Horizonte 1","horizon_code":"h1","id":"1"}]}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function newHorizon($language) {
        $request = \Slim\Slim::getInstance()->request();
        $horizon = json_decode($request->getBody());
        $sql = "INSERT INTO horizon(description,top_depth,bottom_depth,density,wilting_point,water_ph,mo,field_capacity,compression,sand_percentage,clay_percentage,silt_percentage,horizon_value,horizon_code) VALUES (:description, :top_depth,:bottom_depth, :density, :wilting_point, :water_ph, :mo, :field_capacity, :compression, :sand_percentage, :clay_percentage, :silt_percentage, :horizon_value, :horizon_code)";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":description", $horizon->description, PDO::PARAM_STR);
            $stmt->bindParam(":top_depth", $horizon->top_depth, PDO::PARAM_INT);
            $stmt->bindParam(":bottom_depth", $horizon->bottom_depth, PDO::PARAM_INT);
            $stmt->bindParam(":density", $horizon->density, PDO::PARAM_INT);
            $stmt->bindParam(":wilting_point", $horizon->wilting_point, PDO::PARAM_INT);
            $stmt->bindParam(":water_ph", $horizon->water_ph, PDO::PARAM_INT);
            $stmt->bindParam(":mo", $horizon->mo, PDO::PARAM_STR);
            $stmt->bindParam(":field_capacity", $horizon->field_capacity, PDO::PARAM_INT);
            $stmt->bindParam(":compression", $horizon->compression, PDO::PARAM_STR);
            $stmt->bindParam(":sand_percentage", $horizon->sand_percentage, PDO::PARAM_INT);
            $stmt->bindParam(":clay_percentage", $horizon->clay_percentage, PDO::PARAM_INT);
            $stmt->bindParam(":silt_percentage", $horizon->silt_percentage, PDO::PARAM_INT);
            $stmt->bindParam(":horizon_value", $horizon->horizon_value, PDO::PARAM_INT);
            $stmt->bindParam(":horizon_code", $horizon->horizon_code, PDO::PARAM_INT);

            $stmt->execute();
            $horizon->id = $db->lastInsertId();
            $db = null;
            echo '{"type":true,"horizon":'.json_encode($horizon).'}';
        } catch (PDOException $e) {
            echo '{"type": false,"data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {PUT} /:language/horizon/:id updateHorizon
 * @apiVersion 1.0.0
 * @apiName updateHorizon
 * @apiGroup Horizon
 * @apiPermission none
 *
 * @apiDescription Esta função atualiza um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {string} description   Descrição do horizonte.
 * @apiParam {double} top_depth  Altura do horizonte.
 * @apiParam {double} buttom_depth Lower Profundidade do horizonte.
 * @apiParam {double} density Densidade
 * @apiParam {double} wilting_point Ponto de murcha
 * @apiParam {double} weter_ph PH da água
 * @apiParam {double} mo matéria orgânica
 * @apiParam {double} field_capacity Capacidade de campo
 * @apiParam {double} compression Compactação do solo
 * @apiParam {double} sand_percentage Porcentagem de areia
 * @apiParam {double} clay_percentage Porcentagem de argila
 * @apiParam {double} silt_percentage Porcentagem de lodo
 * @apiParam {string} horizon_value  Valor do horizonte
 * @apiParam {string} horizon_cod    Código do horizonte
 * @apiParam {int} id  Id a ser atualizado
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se atualizou
 * @apiSuccess {object[] } horizon Retorna um objeto com os valores atualizados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *  {"type":true, "horizon":[{"id":"1","description":"Horizonte 1","top_depth":"20","bottom_depth":"10","density":"5","wilting_point":"5","water_ph":"8","mo":"50","field_capacity":"30","compression":"0","sand_percentage":"25","clay_percentage":"25","silt_percentage":"50","horizon_value":"Horizonte 1","horizon_code":"h1"}]}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function updateHorizon($language,$id) {
        $request = \Slim\Slim::getInstance()->request();
        $horizon = json_decode($request->getBody());
        $sql = "UPDATE horizon SET description=:description, top_depth=:top_depth, bottom_depth=:bottom_depth, density=:density, wilting_point=:wilting_point, water_ph=:water_ph, mo=:mo, field_capacity=:field_capacity, compression=:compression, sand_percentage=:sand_percentage, clay_percentage=:clay_percentage, silt_percentage=:silt_percentage, horizon_value=:horizon_value, horizon_code=:horizon_code WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":description", $horizon->description, PDO::PARAM_STR);
            $stmt->bindParam(":top_depth", $horizon->top_depth, PDO::PARAM_INT);
            $stmt->bindParam(":bottom_depth", $horizon->bottom_depth, PDO::PARAM_INT);
            $stmt->bindParam(":density", $horizon->density, PDO::PARAM_INT);
            $stmt->bindParam(":wilting_point", $horizon->wilting_point, PDO::PARAM_INT);
            $stmt->bindParam(":water_ph", $horizon->water_ph, PDO::PARAM_INT);
            $stmt->bindParam(":mo", $horizon->mo, PDO::PARAM_STR);
            $stmt->bindParam(":field_capacity", $horizon->field_capacity, PDO::PARAM_INT);
            $stmt->bindParam(":compression", $horizon->compression, PDO::PARAM_STR);
            $stmt->bindParam(":sand_percentage", $horizon->sand_percentage, PDO::PARAM_INT);
            $stmt->bindParam(":clay_percentage", $horizon->clay_percentage, PDO::PARAM_INT);
            $stmt->bindParam(":silt_percentage", $horizon->silt_percentage, PDO::PARAM_INT);
            $stmt->bindParam(":horizon_value", $horizon->horizon_value, PDO::PARAM_STR);
            $stmt->bindParam(":horizon_code", $horizon->horizon_code, PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            $stmt->execute();
            $db = null;
            echo '{"type":true, "horizon":'.json_encode($horizon).'}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {DELETE} /:language/horizon/:id deleteHorizon
 * @apiVersion 1.0.0
 * @apiName deleteHorizon
 * @apiGroup Horizon
 * @apiPermission none
 *
 * @apiDescription Esta função deleta um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} id  Id a ser deletado
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
    public function deleteHorizon($language,$id) {
        $sql = "DELETE FROM horizon WHERE id=:id";
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
 * @api {GET} /:language/horizon/:id getOneHorizon
 * @apiVersion 1.0.0
 * @apiName getOneHorizon
 * @apiGroup Horizon
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} id  Id a ser selecionado
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } horizon Retorna um objeto com o valor selecionado
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *  {"type":true, "horizon":[{"id":"1","description":"Horizonte 1","top_depth":"20","bottom_depth":"10","density":"5","wilting_point":"5","water_ph":"8","mo":"50","field_capacity":"30","compression":"0","sand_percentage":"25","clay_percentage":"25","silt_percentage":"50","horizon_value":"Horizonte 1","horizon_code":"h1"}]}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getOneHorizon($language,$id) {
        $sql = "SELECT * FROM horizon WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":id", $id);
            
            $stmt->execute();
            $horizon = $stmt->fetchObject();
            $db = null;
            echo '{"type":true, "horizon":'.json_encode($horizon).'}';
        } catch (PDOException $e) {
            echo '{"type": false, "data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {GET} /:language/horizon/:id getAllHorizon
 * @apiVersion 1.0.0
 * @apiName getAllHorizon
 * @apiGroup Horizon
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } horizon Retorna um objeto com todos os valores 
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *  {"type":true, "horizon":[{"id":"1","description":"Horizonte 1","top_depth":"20","bottom_depth":"10","density":"5","wilting_point":"5","water_ph":"8","mo":"50","field_capacity":"30","compression":"0","sand_percentage":"25","clay_percentage":"25","silt_percentage":"50","horizon_value":"Horizonte 1","horizon_code":"h1"},{"id":"2","description":"Horizonte 2","top_depth":"35","bottom_depth":"20","density":"10","wilting_point":"50","water_ph":"5","mo":"40","field_capacity":"40","compression":"0","sand_percentage":"25","clay_percentage":"25","silt_percentage":"50","horizon_value":"Horizonte 2","horizon_code":"h2"},{"id":"3","description":"Horizonte 3","top_depth":"30","bottom_depth":"30","density":"7","wilting_point":"30","water_ph":"20","mo":"60","field_capacity":"50","compression":"0","sand_percentage":"25","clay_percentage":"25","silt_percentage":"50","horizon_value":"Horizonte 3","horizon_code":"h3"}]}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 */
    public function getAllHorizon($language){
        $sql = "SELECT * FROM horizon ORDER BY description";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $horizon = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "horizon":'.json_encode($horizon).'}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }

/**
 * @api {GET} /:language/horizon1/organization/:organization getHorizonOneOfOrganiztion
 * @apiVersion 1.0.0
 * @apiName getHorizonOneOfOrganiztion
 * @apiGroup Horizon
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos os horizontes 1
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {string} organization Variável referente a organização.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } horizon Retorna um objeto com todos os valores 
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *  
 *      {"type":true, "horizon":[{"id":"1","description":"Horizonte 1","top_depth":"20","bottom_depth":"10","density":"5","wilting_point":"5","water_ph":"8","mo":"50","field_capacity":"30","compression":"0","sand_percentage":"25","clay_percentage":"25","silt_percentage":"50","horizon_value":"Horizonte 1","horizon_code":"h1"},{"id":"2","description":"Horizonte 2","top_depth":"35","bottom_depth":"20","density":"10","wilting_point":"50","water_ph":"5","mo":"40","field_capacity":"40","compression":"0","sand_percentage":"25","clay_percentage":"25","silt_percentage":"50","horizon_value":"Horizonte 2","horizon_code":"h2"},{"id":"3","description":"Horizonte 3","top_depth":"30","bottom_depth":"30","density":"7","wilting_point":"30","water_ph":"20","mo":"60","field_capacity":"50","compression":"0","sand_percentage":"25","clay_percentage":"25","silt_percentage":"50","horizon_value":"Horizonte 3","horizon_code":"h3"}]}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *      {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 */    
    public function getAllHorizonOneOfOrganization($language,$organization){
        $sql = "SELECT DISTINCT h1.id, h1.description, h1.top_depth, h1.bottom_depth, h1.density, h1.wilting_point, h1.water_ph, h1.mo, h1.field_capacity, h1.compression, h1.sand_percentage, h1.clay_percentage, h1.silt_percentage, h1.horizon_value, h1.horizon_code 
                FROM horizon h1
                INNER JOIN soil s ON s.horizon_h1 = h1.id
                INNER JOIN field f ON f.soil = s.id  
                INNER JOIN user_field uf ON uf.field= f.id
                INNER JOIN user u ON u.id = uf.user
                INNER JOIN organization o ON o.id = u.organization
                WHERE o.id = :organization;";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":organization", $organization);
            $stmt->execute();
            $horizon = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "horizon_one":'.json_encode($horizon).'}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }
  
/**
 * @api {GET} /:language/horizon2/organization/:organization getHorizonTwoOfOrganiztion
 * @apiVersion 1.0.0
 * @apiName getHorizonTwoOfOrganiztion
 * @apiGroup Horizon
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos os horizontes 2
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {string} organization Variável referente a organização.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } horizon Retorna um objeto com todos os valores 
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *  
 *      {"type":true, "horizon":[{"id":"1","description":"Horizonte 1","top_depth":"20","bottom_depth":"10","density":"5","wilting_point":"5","water_ph":"8","mo":"50","field_capacity":"30","compression":"0","sand_percentage":"25","clay_percentage":"25","silt_percentage":"50","horizon_value":"Horizonte 1","horizon_code":"h1"},{"id":"2","description":"Horizonte 2","top_depth":"35","bottom_depth":"20","density":"10","wilting_point":"50","water_ph":"5","mo":"40","field_capacity":"40","compression":"0","sand_percentage":"25","clay_percentage":"25","silt_percentage":"50","horizon_value":"Horizonte 2","horizon_code":"h2"},{"id":"3","description":"Horizonte 3","top_depth":"30","bottom_depth":"30","density":"7","wilting_point":"30","water_ph":"20","mo":"60","field_capacity":"50","compression":"0","sand_percentage":"25","clay_percentage":"25","silt_percentage":"50","horizon_value":"Horizonte 3","horizon_code":"h3"}]}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *      {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 */     
    public function getAllHorizonTwoOfOrganization($language,$organization){
        $sql = "SELECT DISTINCT h2.id, h2.description, h2.top_depth, h2.bottom_depth, h2.density, h2.wilting_point, h2.water_ph, h2.mo, h2.field_capacity, h2.compression, h2.sand_percentage, h2.clay_percentage, h2.silt_percentage, h2.horizon_value, h2.horizon_code 
                FROM horizon h2
                INNER JOIN soil s ON s.horizon_h2 = h2.id
                INNER JOIN field f ON f.soil = s.id  
                INNER JOIN user_field uf ON uf.field= f.id
                INNER JOIN user u ON u.id = uf.user
                INNER JOIN organization o ON o.id = u.organization
                WHERE o.id = :organization;";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":organization", $organization);
            $stmt->execute();
            $horizon = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "horizon_two":'.json_encode($horizon).'}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }

/**
 * @api {GET} /:language/horizon3/organization/:organization getHorizonThreeOfOrganiztion
 * @apiVersion 1.0.0
 * @apiName getHorizonThreeOfOrganiztion
 * @apiGroup Horizon
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos os horizontes 1
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {string} organization Variável referente a organização.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } horizon Retorna um objeto com todos os valores 
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *  
 *      {"type":true, "horizon":[{"id":"1","description":"Horizonte 1","top_depth":"20","bottom_depth":"10","density":"5","wilting_point":"5","water_ph":"8","mo":"50","field_capacity":"30","compression":"0","sand_percentage":"25","clay_percentage":"25","silt_percentage":"50","horizon_value":"Horizonte 1","horizon_code":"h1"},{"id":"2","description":"Horizonte 2","top_depth":"35","bottom_depth":"20","density":"10","wilting_point":"50","water_ph":"5","mo":"40","field_capacity":"40","compression":"0","sand_percentage":"25","clay_percentage":"25","silt_percentage":"50","horizon_value":"Horizonte 2","horizon_code":"h2"},{"id":"3","description":"Horizonte 3","top_depth":"30","bottom_depth":"30","density":"7","wilting_point":"30","water_ph":"20","mo":"60","field_capacity":"50","compression":"0","sand_percentage":"25","clay_percentage":"25","silt_percentage":"50","horizon_value":"Horizonte 3","horizon_code":"h3"}]}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *      {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 */     
    
    public function getAllHorizonThreeOfOrganization($language,$organization){
        $sql = "SELECT DISTINCT h3.id, h3.description, h3.top_depth, h3.bottom_depth, h3.density, h3.wilting_point, h3.water_ph, h3.mo, h3.field_capacity, h3.compression, h3.sand_percentage, h3.clay_percentage, h3.silt_percentage, h3.horizon_value, h3.horizon_code
                FROM horizon h3
                INNER JOIN soil s ON s.horizon_h3 = h3.id
                INNER JOIN field f ON f.soil = s.id  
                INNER JOIN user_field uf ON uf.field= f.id
                INNER JOIN user u ON u.id = uf.user
                INNER JOIN organization o ON o.id = u.organization
                WHERE o.id = :organization;";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":organization", $organization);
            $stmt->execute();
            $horizon = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "horizon_three":'.json_encode($horizon).'}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }
    
}

?>