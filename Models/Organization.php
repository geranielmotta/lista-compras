<?php

class Organization {

    /**
     * @api {POST} /:language/organization newOrganization
     * @apiVersion 1.0.0
     * @apiName newOrganization
     * @apiGroup Organization
     * @apiPermission none
     *
     * @apiDescription Esta função faz o cadastramento de um registro
     * 
     * @apiParam {string} language Variável referente a chave do idioma.
     * @apiParam {string} description  Descrição da organização
     * @apiParam {string} symbol    Simbolo da organização
     *
     * @apiSuccess {boolean } type  Retorna verdadeiro se cadastrou
     * @apiSuccess {object[] } organization Retorna um objeto com os valores cadastrados
     * 
     * @apiError {boolean}type  false caso ocorra um erro.
     * @apiError {string} data  Mensagem de erro.
     * 
     * @apiSuccessExample {json} Success-Response:
     *  {"type":true,"organization":[{"description":"Fundação ABC","symbol":null},{"id":"1","description":"FECOPROD","symbol":null,"id":"1"}]}
     * 
     * @apiErrorExample {json} Error-Response:
     *      
     *     {"type": false,"data": "error"}
     * 
     * @apiSampleRequest off
     * 
     */
    public function newOrganization($language) {
        $request = \Slim\Slim::getInstance()->request();
        $organization = json_decode($request->getBody());
        $sql = "INSERT INTO organization(description, symbol) VALUES (:description,:symbol)";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":description", $organization->description, PDO::PARAM_STR);
            $stmt->bindParam(":symbol", $organization->symbol, PDO::PARAM_STR);

            $stmt->execute();
            $organization->id = $db->lastInsertId();
            $db = null;
            echo '{"type":true, "organization":' . json_encode($organization) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }

    /**
     * @api {PUT} /:language/organization/:id updateOrganization
     * @apiVersion 1.0.0
     * @apiName updateOrganization
     * @apiGroup Organization
     * @apiPermission none
     *
     * @apiDescription Esta função atualiza um registro
     * 
     * @apiParam {string} language Variável referente a chave do idioma.
     * @apiParam {string} description  Descrição da organização
     * @apiParam {string} symbol    Simbolo da organização
     * @apiParam {int} id Id a ser atualizado
     *
     * @apiSuccess {boolean } type  Retorna verdadeiro se atualizou
     * @apiSuccess {object[] } organization Retorna um objeto com os valores atualizados
     * 
     * @apiError {boolean}type  false caso ocorra um erro.
     * @apiError {string} data  Mensagem de erro.
     * 
     * @apiSuccessExample {json} Success-Response:
     *  {"type":true,"organization":[{""id":"1",description":"Fundação ABC","symbol":null},{"id":"1","description":"FECOPROD","symbol":null}]}
     * 
     * @apiErrorExample {json} Error-Response:
     *      
     *     {"type": false,"data": "error"}
     * 
     * @apiSampleRequest off
     * 
     */
    public function updateOrganization($language, $id) {
        $request = \Slim\Slim::getInstance()->request();
        $organization = json_decode($request->getBody());
        $sql = "UPDATE organization SET description=:description,symbol=:symbol WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":description", $organization->description, PDO::PARAM_STR);
            $stmt->bindParam(":symbol", $organization->symbol, PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            $stmt->execute();
            $db = null;
            echo '{"type":true, "organization":' . json_encode($organization) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }

    /**
     * @api {DELETE} /:language/organization/:id deleteOrganization
     * @apiVersion 1.0.0
     * @apiName deleteOrganization
     * @apiGroup Organization
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
    public function deleteOrganization($language, $id) {
        $sql = "DELETE FROM organization WHERE id=:id";
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
     * @api {GET} /:language/organization/:id getOneOrganization
     * @apiVersion 1.0.0
     * @apiName getOneOrganization
     * @apiGroup Organization
     * @apiPermission none
     *
     * @apiDescription Esta função seleciona um registro
     * 
     * @apiParam {string} language Variável referente a chave do idioma.
     * @apiParam {int} id Id a ser selecionado
     *
     * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
     * @apiSuccess {object[] } organization Retorna um objeto com os valores selecionados
     * 
     * @apiError {boolean}type  false caso ocorra um erro.
     * @apiError {string} data  Mensagem de erro.
     * 
     * @apiSuccessExample {json} Success-Response:
     *  {"type":true,"organization":[{""id":"1",description":"Fundação ABC","symbol":null},{"id":"1","description":"FECOPROD","symbol":null}]}
     * 
     * @apiErrorExample {json} Error-Response:
     *      
     *     {"type": false,"data": "error"}
     * 
     * @apiSampleRequest off
     * 
     */
    public function getOneOrganization($language, $id) {
        $sql = "SELECT * FROM organization WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $organization = $stmt->fetchObject();
            $db = null;
            echo '{"type":true, "organization":' . json_encode($organization) . '}';
        } catch (PDOException $e) {
            echo '{"type": false, "data": "' . $e->getMessage() . '"}';
        }
    }

    /**
     * @api {GET} /:language/organization/:id getAllOrganization
     * @apiVersion 1.0.0
     * @apiName getAllOrganization
     * @apiGroup Organization
     * @apiPermission none
     *
     * @apiDescription Esta função seleciona todos os registro
     * 
     * @apiParam {string} language Variável referente a chave do idioma.
     *
     * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
     * @apiSuccess {object[] } organization Retorna um objeto com todos os valores
     * 
     * @apiError {boolean}type  false caso ocorra um erro.
     * @apiError {string} data  Mensagem de erro.
     * 
     * @apiSuccessExample {json} Success-Response:
     *  {"type":true,"organization":[{""id":"1",description":"Fundação ABC","symbol":null},{"id":"1","description":"FECOPROD","symbol":null}]}
     * 
     * @apiErrorExample {json} Error-Response:
     *      
     *     {"type": false,"data": "error"}
     * 
     * @apiSampleRequest off
     * 
     */
    public function getAllOrganization($language) {
        $sql = "SELECT * FROM organization ORDER BY description DESC";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $organization = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true,"organization":' . json_encode($organization) . '}';
        } catch (PDOException $e) {
            echo '{"type":false,"data": "' . $e->getMessage() . '"}';
        }
    }

}

?>