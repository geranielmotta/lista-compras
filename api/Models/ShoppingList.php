<?php

class ShoppingList {
/**
 * @api {POST} /shoppinglist newShoppingList
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
        $shoppingList = json_decode($request->getBody());
        $sql = "INSERT INTO shoppinglist(user) VALUES ( :user)";

        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":user",     $shoppingList->user,     PDO::PARAM_STR);
            $stmt->execute();
            $shoppingList->id = $db->lastInsertId();
            $db = null;
            echo '{"type":true, "shoppinglist":' . json_encode($shoppingList) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
    

/**
 * @api {PUT} /shoppingList/:id updateshoppingList
 * @apiVersion 1.0.0
 * @apiName updateshoppingList
 * @apiGroup shoppingList
 * @apiPermission Root Admin
 *
 * @apiDescription Esta função atualiza um registro
 * 
 * @apiParam {string} name Nome da categoria
 * @apiParam {int} id Id a ser atualizado
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se atualizou
 * @apiSuccess {object[] } shoppingList Retorna um objeto com os valores atualizados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type": true,"shoppingList": {"id":"1","name":"Feijão","value":"2.5","category":"1"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
public function updateshoppingList($id) {
    $request = \Slim\Slim::getInstance()->request();
    $shoppinglist = json_decode($request->getBody());
    $sql = "UPDATE shoppinglist SET spending=:spending WHERE id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":spending", strval($shoppinglist->spending), PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $db = null;
        echo '{"type":true, "shoppinglist":' . json_encode($shoppinglist) . '}';
    } catch (PDOException $e) {
        echo '{"type":false, "data":"' . $e->getMessage() . '"}';
    }
} 
/**
 * @api {DELETE} /shoppinglist/:id deleteShoppingList
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

        $sql = "DELETE FROM shoppinglist WHERE id=:id";
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
 * @api {GET} /shoppinglist/:id getOneShoppingList
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
                    FROM shoppinglist l 
                        INNER JOIN cart c ON c.shoppinglist = l.id
                        INNER JOIN products p ON p.id = c.products
                        INNER JOIN user u ON u.id = l.user    
                    WHERE l.id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $shoppingList = $stmt->fetchObject();
            $db = null;
            echo '{"type":true, "shoppinglist":' . json_encode($shoppingList) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
/**
 * @api {GET} /shoppinglist/user/:user getAllShoppingListOfUser
 * @apiVersion 1.0.0
 * @apiName getAllShoppingListOfUser
 * @apiGroup ShoppingList
 * @apiPermission none
 *
 * @apiParam {int} user id do usuário a ser selecionado
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
    public function getAllShoppingListOfUser($user) {
        $sql = "SELECT l.*,(select COUNT(c.products) from cart c where c.shoppinglist = l.id) AS amount
                FROM shoppinglist l 
                WHERE l.user=:user ORDER BY l.id DESC";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":user", $user);
            $stmt->execute();
            $shoppingList = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
        
            echo '{"type":true, "shoppinglist":' . json_encode($shoppingList) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }

}
?>