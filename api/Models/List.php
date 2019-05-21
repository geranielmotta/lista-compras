<?php

class List {
/**
 * @api {POST} /List newList
 * @apiVersion 1.0.0
 * @apiName newList
 * @apiGroup List
 * @apiPermission none
 *
 * @apiDescription Esta função faz o cadastramento de um registro
 * 
 * @apiParam {string} Listname Nome do usuário
 * @apiParam {string} spending Soma dos valores dos produtos na lista
 * @apiParam {string} name Name completo do usuário
 * @apiParam {string} phone Telefone do usuário
 * @apiParam {string} email Email do usuário
 * @apiParam {string} access_levels Nivel de acesso do usuário
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se cadastrou
 * @apiSuccess {object[] } List Retorna um objeto com os valores cadastrados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type": true,"List": {"spending":"200,00","user":"1","cart":"1","date":"20/05/2019"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest http://api.lista-compras/api/List
 * 
 */
    public function newList() {

        $request = \Slim\Slim::getInstance()->request();
        $List = json_decode($request->getBody());
        $sql = "INSERT INTO List(spending, user, cart, date) VALUES (:spending, :user, :cart, :date)";

        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":spending", $List->spending, PDO::PARAM_STR);
            $stmt->bindParam(":user",     $List->user,     PDO::PARAM_STR);
            $stmt->bindParam(":cart",     $List->cart,     PDO::PARAM_STR);
            $stmt->bindParam(":date",     $List->date,     PDO::PARAM_STR);
            $stmt->execute();
            $List->id = $db->lastInsertId();
            $db = null;
            echo '{"type":true, "List":' . json_encode($List) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }

/**
 * @api {DELETE} /List/:id deleteList
 * @apiVersion 1.0.0
 * @apiName deleteList
 * @apiGroup List
 * @apiPermission admin
 *
 * @apiDescription Esta função deleta um registro
 * 
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
    public function deleteList($id) {

        $sql = "DELETE FROM List WHERE id=:id";
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
 * @api {GET} /List/:id getOneList
 * @apiVersion 1.0.0
 * @apiName getOneList
 * @apiGroup List
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona um registro
 * 
 * @apiParam {int} id Id a ser selecionado
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } List Retorna um objeto com os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type": true,"List": {"id":"1","spending":"200","amount":"3","user":"1","date":"20/05/2019"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getOneList($id) {
        $sql = "SELECT l.spending, SUM(c.id) AS amount, l.user, l.date
                    FROM List l 
                        INNER JOIN cart c ON c.list = l.id
                        INNER JOIN user u ON u.id = l.user    
                    WHERE l.id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $List = $stmt->fetchObject();
            $db = null;
            echo '{"type":true, "List":' . json_encode($List) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
/**
 * @api {GET} /List/ getAllList
 * @apiVersion 1.0.0
 * @apiName getAllList
 * @apiGroup List
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos os registro
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } List Retorna um objeto com todos os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type": true,"List": {"id":"1","spending":"200","amount":"3","user":"1","date":"20/05/2019"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest http://api.lista-compras.com/List  
 * @apiHeader {String} [Authorization=bearer f7a18c7871d160d4202b1878c73eefc9]
 * 
 */
    public function getAllList() {
        $sql = "SELECT l.spending, SUM(c.id) AS amount, u.user, l.date 
                    FROM List l 
                    INNER JOIN cart c ON c.list = l.id
                    INNER JOIN user u ON u.id = l.user    
                    WHERE l.id=:id ORDER BY l.id DESC";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $List = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "List":' . json_encode($List) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
}

?>