<?php

class State {

    /**
     * @api {POST} /:language/state  newState
     * @apiVersion 1.0.0
     * @apiName newState
     * @apiGroup State
     * @apiPermission none
     *
     * @apiDescription Esta função faz o cadastramento de um registro
     * 
     * @apiParam {string} language Variável referente a chave do idioma.
     * @apiParam {string} name Nome do estado.
     * @apiParam {string} symbol Sigla do estado.
     * @apiParam {int} country id do país.
     *
     * @apiSuccess {boolean } type  Retorna verdadeiro se cadastrou
     * @apiSuccess {object[] } state Retorna um objeto com os valores cadastrados
     * 
     * @apiError {boolean}type  false caso ocorra um erro.
     * @apiError {string} data  Mensagem de erro.
     * 
     * @apiSuccessExample {json} Success-Response:
     * {"type":true, "state ": {"description":"Rio Grande do Sul","symbol":"RS","country":"1","id":"1"}}
     * 
     * @apiErrorExample {json} Error-Response:
     *      
     *     {"type": false,"data": "error"}
     * 
     * @apiSampleRequest off
     * 
     */
    public function newState($language) {

        $request = \Slim\Slim::getInstance()->request();
        $state = json_decode($request->getBody());
        $sql = "INSERT INTO state(description, symbol, country) VALUES (:description, :symbol, :country)";
        try {

            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":description", $state->description, PDO::PARAM_STR);
            $stmt->bindParam(":symbol", $state->symbol, PDO::PARAM_STR);
            $stmt->bindParam(":country", $state->country, PDO::PARAM_INT);
            $stmt->execute();
            $state->id = $db->lastInsertId();
            $db = null;
            echo '{"type":true, "state": ' . json_encode($state) . '}';
        } catch (PDOException $e) {
            echo '{"type": false,"data": "' . $e->getMessage() . '"}';
        }
    }

    /**
     * @api {PUT} /:language/state/:id  updateState
     * @apiVersion 1.0.0
     * @apiName updateState
     * @apiGroup State
     * @apiPermission none
     *
     * @apiDescription Esta função atualiza um registro
     * 
     * @apiParam {string} language Variável referente a chave do idioma.
     * @apiParam {string} name Nome do estado.
     * @apiParam {string} symbol Sigla do estado.
     * @apiParam {int} country id do país.
     * @apiParam {int} id Id a ser atualizado
     *
     * @apiSuccess {boolean } type  Retorna verdadeiro se atualizou
     * @apiSuccess {object[] } state Retorna um objeto com os valores atualizados
     * 
     * @apiError {boolean}type  false caso ocorra um erro.
     * @apiError {string} data  Mensagem de erro.
     * 
     * @apiSuccessExample {json} Success-Response:
     * {"type":true, "state ": {"id":"1","description":"Rio Grande do Sul","symbol":"RS","country":"1"}}
     * 
     * @apiErrorExample {json} Error-Response:
     *      
     *     {"type": false,"data": "error"}
     * 
     * @apiSampleRequest off
     * 
     */
    public function updateState($language, $id) {
        $request = \Slim\Slim::getInstance()->request();
        $state = json_decode($request->getBody());
        $sql = "UPDATE state SET description=:description, symbol=:symbol, country=:country WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":description", $state->description, PDO::PARAM_STR);
            $stmt->bindParam(":symbol", $state->symbol, PDO::PARAM_STR);
            $stmt->bindParam(":country", $state->country, PDO::PARAM_INT);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $db = null;
            echo '{"type":true, "state":' . json_encode($state) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }

    /**
     * @api {DELETE} /:language/state/:id  deleteState
     * @apiVersion 1.0.0
     * @apiName deleteState
     * @apiGroup State
     * @apiPermission none
     *
     * @apiDescription Esta função deleta um registro
     * 
     * @apiParam {string} language Variável referente a chave do idioma.
     * @apiParam {int} id Id a ser atualizado
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
    public function deleteState($language, $id) {

        $sql = "DELETE FROM state WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $db = null;
        } catch (PDOException $e) {
            echo '{"type": false, "data":"' . $e->getMessage() . '"}';
        }
    }

    /**
     * @api {GET} /:language/state/:id  getOneState
     * @apiVersion 1.0.0
     * @apiName getOneState
     * @apiGroup State
     * @apiPermission none
     *
     * @apiDescription Esta função seleciona um registro
     * 
     * @apiParam {string} language Variável referente a chave do idioma.
     * @apiParam {int} id Id a ser selecionado
     *
     * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
     * @apiSuccess {object[] } state Retorna um objeto com os valores
     * 
     * @apiError {boolean}type  false caso ocorra um erro.
     * @apiError {string} data  Mensagem de erro.
     * 
     * @apiSuccessExample {json} Success-Response:
     * {"type":true, "state ": {"id":"1","description":"Rio Grande do Sul","symbol":"RS","country":"1"}}
     * 
     * @apiErrorExample {json} Error-Response:
     *      
     *     {"type": false,"data": "error"}
     * 
     * @apiSampleRequest off
     * 
     */
    public function getOneState($language, $id) {
        $sql = "SELECT s.id, s.description, s.symbol, c.description_$language AS country FROM state s INNER JOIN country c ON c.id = s.country WHERE s.id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $state = $stmt->fetchObject();
            $db = null;
            echo '{"type":true, "state": ' . json_encode($state) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "' . $e->getMessage() . '"}';
        }
    }

    /**
     * @api {GET} /:language/state/  getAllState
     * @apiVersion 1.0.0
     * @apiName getAllState
     * @apiGroup State
     * @apiPermission none
     *
     * @apiDescription Esta função seleciona todos os registro
     * 
     * @apiParam {string} language Variável referente a chave do idioma.
     *
     * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
     * @apiSuccess {object[] } state Retorna um objeto com todos os valores
     * 
     * @apiError {boolean}type  false caso ocorra um erro.
     * @apiError {string} data  Mensagem de erro.
     * 
     * @apiSuccessExample {json} Success-Response:
     * {"type":true, "state ": {"id":"1","description":"Rio Grande do Sul","symbol":"RS","country":"1"}}
     * 
     * @apiErrorExample {json} Error-Response:
     *      
     *     {"type": false,"data": "error"}
     * 
     * @apiSampleRequest off
     * 
     */
    public function getAllState($language) {
        $sql = "SELECT s.id, s.description, s.symbol, c.description_$language AS country FROM state s INNER JOIN country c ON c.id = s.country";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $state = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;

            echo '{"type":true, "state": ' . json_encode($state) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "' . $e->getMessage() . '"}';
        }
    }

    /**
     * @api {GET} /:language/state/:id  getStateOfCountry
     * @apiVersion 1.0.0
     * @apiName getStateOfCountry
     * @apiGroup State
     * @apiPermission none
     *
     * @apiDescription Esta função seleciona todos os registro de um determinado país
     * 
     * @apiParam {string} language Variável referente a chave do idioma.
     * @apiParam {int} pais Id de país
     *
     * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
     * @apiSuccess {object[] } state Retorna um objeto com os valores
     * 
     * @apiError {boolean}type  false caso ocorra um erro.
     * @apiError {string} data  Mensagem de erro.
     * 
     * @apiSuccessExample {json} Success-Response:
     * {"type":true, "state ": {"id":"1","description":"Rio Grande do Sul","symbol":"RS","country":"1"}}
     * 
     * @apiErrorExample {json} Error-Response:
     *      
     *     {"type": false,"data": "error"}
     * 
     * @apiSampleRequest off
     * 
     */
    public function getAllStateOfCountry($language, $country) {
        $sql = "SELECT * FROM state  WHERE country =:country ORDER BY description";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":country", $country);
            $stmt->execute();
            $state = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "state": ' . json_encode($state) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }

}

?>