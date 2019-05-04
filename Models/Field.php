<?php

class Field {
/**
 * @api {POST} /:language/field newField
 * @apiVersion 1.0.0
 * @apiName newField
 * @apiGroup Field
 * @apiPermission none
 *
 * @apiDescription Esta função faz o cadastramento de um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {string} name Nome da parcela.
 * @apiParam {string} producer Produtor da parcela.
 * @apiParam {double} latitude Latitude da parcela.
 * @apiParam {double} longitude Longitude da parcela.
 * @apiParam {double} altitude Altitude da parcela.
 * @apiParam {string} size Tamanho da parcela.
 * @apiParam {int} city Id da cidade.
 * @apiParam {int} station  Id da estação.
 * @apiParam {int} soil  Id da solo.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se cadastrou
 * @apiSuccess {object[] } field Retorna um objeto com os valores cadastrados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 * {"type":true, "field": [{"name":"Parcela de Sesamo","producer":"Daniel Perondi","latitude":"-58.58","longitude":"-48.48","altitude":"200","size":"10x10","city":"Asuncion","station":"2","soil":"1","id":"1"}]}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */ 
    public function newField($language) {

        $request = \Slim\Slim::getInstance()->request();
        $field = json_decode($request->getBody());
        $sql = "INSERT INTO field(name, producer, latitude, longitude, altitude, area, inclination, city, station, soil) VALUES (:name, :producer, :latitude, :longitude, :altitude, :area, :inclination, :city, :station, :soil)";
        try {

            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":name", $field->name, PDO::PARAM_STR);
            $stmt->bindParam(":producer", $field->producer, PDO::PARAM_STR);
            $stmt->bindParam(":latitude", $field->latitude, PDO::PARAM_INT);
            $stmt->bindParam(":longitude", $field->longitude, PDO::PARAM_INT);
            $stmt->bindParam(":altitude", $field->altitude, PDO::PARAM_INT);
            $stmt->bindParam(":area", $field->area, PDO::PARAM_INT);
            $stmt->bindParam(":inclination", $field->inclination, PDO::PARAM_INT);
            $stmt->bindParam(":city", $field->city, PDO::PARAM_INT);
            $stmt->bindParam(":station", $field->station, PDO::PARAM_INT);
            $stmt->bindParam(":soil", $field->soil, PDO::PARAM_INT);

            $stmt->execute();
            $field->id = $db->lastInsertId();
            $db = null;
            echo '{"type":true, "field":' . json_encode($field) . '}';
        } catch (PDOException $e) {
            echo '{"type": false,"data":"' . $e->getMessage() . '"}';
        }
    }
/**
 * @api {PUT} /:language/field/:id updateField
 * @apiVersion 1.0.0
 * @apiName updateField
 * @apiGroup Field
 * @apiPermission none
 *
 * @apiDescription Esta função atualiza um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {string} name Nome da parcela.
 * @apiParam {string} producer Produtor da parcela.
 * @apiParam {double} latitude Latitude da parcela.
 * @apiParam {double} longitude Longitude da parcela.
 * @apiParam {double} altitude Altitude da parcela.
 * @apiParam {string} size Tamanho da parcela.
 * @apiParam {int} city Id da cidade.
 * @apiParam {int} station  Id da estação.
 * @apiParam {int} soil  Id da solo.
 * @apiParam {int} id Id a ser atualizado
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se atualizou
 * @apiSuccess {object[] } field Retorna um objeto com os valores atualizados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 * {"type":true, "field": [{"id":"1","name":"Parcela de Sesamo","producer":"Daniel Perondi","latitude":"-58.58","longitude":"-48.48","altitude":"200","size":"10x10","city":"Asuncion","station":"2","soil":"1"}]}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function updateField($language, $id) {
        $request = \Slim\Slim::getInstance()->request();
        $field = json_decode($request->getBody());
        $sql = "UPDATE field SET name=:name, producer=:producer, latitude=:latitude, longitude=:longitude, altitude=:altitude, area=:area, inclination=:inclination, station=:station, city=:city, soil=:soil WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":name", $field->name, PDO::PARAM_STR);
            $stmt->bindParam(":producer", $field->producer, PDO::PARAM_STR);
            $stmt->bindParam(":latitude", $field->latitude, PDO::PARAM_INT);
            $stmt->bindParam(":longitude", $field->longitude, PDO::PARAM_INT);
            $stmt->bindParam(":altitude", $field->altitude, PDO::PARAM_INT);
            $stmt->bindParam(":area", $field->area, PDO::PARAM_INT);
            $stmt->bindParam(":inclination", $field->inclination, PDO::PARAM_INT);
            $stmt->bindParam(":city", $field->city, PDO::PARAM_INT);
            $stmt->bindParam(":station", $field->station, PDO::PARAM_INT);
            $stmt->bindParam(":soil", $field->soil, PDO::PARAM_INT);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            $stmt->execute();
            $db = null;
            echo '{"type":true, "field":' . json_encode($field) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
/**
 * @api {DELETE} /:language/field/:id deleteField
 * @apiVersion 1.0.0
 * @apiName deleteField
 * @apiGroup Field
 * @apiPermission none
 *
 * @apiDescription Esta função delete um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} id Id a ser deletado
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
    public function deleteField($language, $id) {
        $sql = "DELETE FROM field WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $db = null;
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
/**
 * @api {GET} /:language/field/:id getOneField
 * @apiVersion 1.0.0
 * @apiName getOneField
 * @apiGroup Field
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} id Id a ser selecionado
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } field Retorna um objeto com os valores selecionados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 * {"type":true, "field": [{"id":"1","name":"Parcela de Sesamo","producer":"Daniel Perondi","latitude":"-58.58","longitude":"-48.48","altitude":"200","size":"10x10","city":"Asuncion","station":"2","soil":"1"}]}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getOneField($language, $id) {
        $sql = "SELECT f.id, f.name, f.producer, f.latitude, f.longitude, f.altitude, f.area, f.inclination, c.description AS city, st.description AS station, s.description AS soil FROM field f INNER JOIN station st ON st.id = f.station INNER JOIN soil s ON s.id = f.soil INNER JOIN city c ON c.id = f.city WHERE f.id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $field = $stmt->fetchObject();
            $db = null;
            echo '{"type":true, "field":' . json_encode($field) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
/**
 * @api {GET} /:language/field getAllField
 * @apiVersion 1.0.0
 * @apiName getAllField
 * @apiGroup Field
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos os registros
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } field Retorna um objeto com todos os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 * {"type":true, "field": [{"id":"1","name":"Parcela de Sesamo","producer":"Daniel Perondi","latitude":"-58.58","longitude":"-48.48","altitude":"200","size":"10x10","city":"Asuncion","station":"Vivenda das Palmeiras","soil":"Solo Arenoso"},{"id":"2","name":"Teste","producer":null,"latitude":"-48","longitude":"48","altitude":"84","size":null,"city":"Passo Fundo","station":"Sede Fecoprod","soil":"Solo Siltoso"}]} 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getAllField($language) {
        $sql = "SELECT f.id, f.name, f.producer, f.latitude, f.longitude, f.altitude, f.area, f.inclination, c.description AS city, st.description AS station, s.description AS soil FROM field f INNER JOIN station st ON st.id = f.station INNER JOIN soil s ON s.id = f.soil INNER JOIN city c ON c.id = f.city ORDER BY f.name";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $stmt->execute();
            $field = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "field":' . json_encode($field) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }

/**
 * @api {GET} /:language/field/organization/:id getAllFieldOfOrganization
 * @apiVersion 1.0.0
 * @apiName getAllFieldOfOrganization
 * @apiGroup Field
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos os registros que tenham uma ligação com :id da organização
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } field Retorna um objeto com todos os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 * {"type":true, "field": [{"id":"1","name":"Parcela de Sesamo","producer":"Daniel Perondi","latitude":"-58.58","longitude":"-48.48","altitude":"200","size":"10x10","city":"Asuncion","station":"Vivenda das Palmeiras","soil":"Solo Arenoso"},{"id":"2","name":"Teste","producer":null,"latitude":"-48","longitude":"48","altitude":"84","size":null,"city":"Passo Fundo","station":"Sede Fecoprod","soil":"Solo Siltoso"}]} 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */    
    
    public function getAllFieldOfOrganization($language, $organization) {
        $sql = "SELECT DISTINCT f.id, f.name, f.producer, f.latitude, f.longitude, f.altitude, f.area, f.inclination, c.description AS city, ws.description AS station, s.description AS soil
                FROM field f
                INNER JOIN user_field uf ON uf.field = f.id
                INNER JOIN user u ON u.id = uf.user
                INNER JOIN organization o ON o.id = u.organization
                INNER JOIN city c ON c.id = f.city
                INNER JOIN station ws ON ws.id = f.station
                INNER JOIN soil s ON s.id = f.soil
                WHERE o.id = :organization;";

        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":organization", $organization);
            $stmt->execute();
            $field = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "field":' . json_encode($field) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }

/**
 * @api {GET} /:language/field/user/:id getAllFieldOfOrganization
 * @apiVersion 1.0.0
 * @apiName getAllFieldOfOrganization
 * @apiGroup Field
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos os registros que tenham uma ligação com :id do usuário
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } field Retorna um objeto com todos os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 * {"type":true, "field": [{"id":"1","name":"Parcela de Sesamo","producer":"Daniel Perondi","latitude":"-58.58","longitude":"-48.48","altitude":"200","size":"10x10","city":"Asuncion","station":"Vivenda das Palmeiras","soil":"Solo Arenoso"},{"id":"2","name":"Teste","producer":null,"latitude":"-48","longitude":"48","altitude":"84","size":null,"city":"Passo Fundo","station":"Sede Fecoprod","soil":"Solo Siltoso"}]} 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */      
    
    public function getAllFieldOfUser($language,$user) {
        $sql = "SELECT f.id, f.name, f.producer, f.latitude, f.longitude, f.altitude, f.area, f.inclination, c.description AS city, ws.description AS station, s.description AS soil, uf.id AS user_field_id
                FROM field f
                INNER JOIN user_field uf ON f.id = uf.field
                INNER JOIN city c ON c.id = f.city
                INNER JOIN station ws ON ws.id = f.station
                INNER JOIN soil s ON s.id = f.soil
                WHERE uf.user = :user
                ORDER BY f.name;";

        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":user", $user);
            $stmt->execute();
            $field = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "field": ' . json_encode($field) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {GET} /:language/field/organization/:id/user/:user getAllFieldOfOrganizationAndNotUser
 * @apiVersion 1.0.0
 * @apiName getAllFieldOfOrganization
 * @apiGroup Field
 * @apiPermission none
 *
 * @apiDescription Esta função filtra todos os registros que tenham uma ligação com :id do usuário e com :id da organização para não repetilos.
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } field Retorna um objeto com todos os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 * {"type":true, "field": [{"id":"1","name":"Parcela de Sesamo","producer":"Daniel Perondi","latitude":"-58.58","longitude":"-48.48","altitude":"200","size":"10x10","city":"Asuncion","station":"Vivenda das Palmeiras","soil":"Solo Arenoso"},{"id":"2","name":"Teste","producer":null,"latitude":"-48","longitude":"48","altitude":"84","size":null,"city":"Passo Fundo","station":"Sede Fecoprod","soil":"Solo Siltoso"}]} 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */   
    public function getAllFieldOfOrganizationAndNotUser($language, $organization, $user) {

        $sql = "SELECT DISTINCT f.id, f.name, f.producer
                FROM field f
                INNER JOIN user_field uf ON uf.field = f.id
                INNER JOIN user u ON u.id = uf.user
                INNER JOIN organization o ON o.id = u.organization
                WHERE o.id=:organization
                AND f.id NOT IN (SELECT f.id
                                 FROM field f
                                 INNER JOIN user_field uf ON uf.field = f.id
                                 INNER JOIN user u ON u.id = uf.user
                                 INNER JOIN organization o ON o.id = u.organization
                                 WHERE u.id=:user)";

        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":organization", $organization);
            $stmt->bindParam(":user", $user);
            $stmt->execute();
            $field = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "field":' . json_encode($field) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
    
    

}

?>