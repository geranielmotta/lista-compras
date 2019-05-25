<?php

class ShoppingList {
/**
 * @api {POST} /List newShoppingList
 * @apiVersion 1.0.0
 * @apiName newShoppingList
 * @apiGroup ShoppingList
 * @apiPermission none
 *
 * @apiDescription Esta função faz o cadastramento de um registro
 * 
 * @apiParam {date} data da criação da lista
 * @apiParam {int} user Id do usuário
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se cadastrou
 * @apiSuccess {object[] }  Retorna um objeto com os valores cadastrados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type": true,"shoppingList": {"date":"20/05/2019","user":"1"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest http://api.lista-compras/api/shoppinglist
 * 
 */
    public function newShoppingList() {

        $request = \Slim\Slim::getInstance()->request();
        $List = json_decode($request->getBody());
        $sql = "INSERT INTO List( date, user) VALUES (:date, :user)";

        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":date",     $List->date,     PDO::PARAM_STR);
            $stmt->bindParam(":user",     $List->user,     PDO::PARAM_STR);
            $stmt->execute();
            $List->id = $db->lastInsertId();
            $db = null;
            echo '{"type":true, "List":' . json_encode($List) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }

/**
 * @api {DELETE} /List/:id deleteShoppingList
 * @apiVersion 1.0.0
 * @apiName deleteShoppingList
 * @apiGroup ShoppingList
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
    public function deleteShoppingList($id) {

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
 * @api {GET} /List/:id getOneShoppingList
 * @apiVersion 1.0.0
 * @apiName getOneShoppingList
 * @apiGroup ShoppingList
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona um registro
 * 
 * @apiParam {int} id Id a ser selecionado
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } object Retorna um objeto com os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type": true,"shoppingList": {"id":"1","spending":"200","amount":"3","user":"1","date":"20/05/2019"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getOneShoppingList($id) {
        $sql = "SELECT ROUND(SUM(p.value), 2) as spending, COUNT(c.products) AS amount, l.user, l.date
                    FROM List l 
                        INNER JOIN cart c ON c.list = l.id
                        INNER JOIN products p ON p.id = c.products
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
 * @api {GET} /List/ getAllShoppingList
 * @apiVersion 1.0.0
 * @apiName getAllShoppingList
 * @apiGroup ShoppingList
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos os registro
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } Object Retorna um objeto com todos os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type": true,"ShoppingList": {"id":"1","spending":"200","amount":"3","user":"1","date":"20/05/2019"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest http://api.lista-compras.com/shoppinglist  
 * @apiHeader {String} [Authorization=bearer f7a18c7871d160d4202b1878c73eefc9]
 * 
 */
    public function getAllShoppingList($user) {
        $sql = "SELECT ROUND(SUM(p.value), 2) as spending, COUNT(c.products) AS amount, l.user, l.date
                    FROM List l 
                    INNER JOIN cart c ON c.list = l.id
                    INNER JOIN products p ON p.id = c.products
                    INNER JOIN user u ON u.id = l.user    
                    WHERE u.id=:user ORDER BY l.id DESC";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $stmt->bindParam(":user", $user);
            $List = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "List":' . json_encode($List) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
}

?>