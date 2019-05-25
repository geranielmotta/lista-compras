<?php

class Cart {
/**
 * @api {POST} /List newCart
 * @apiVersion 1.0.0
 * @apiName newCart
 * @apiGroup Cart
 * @apiPermission none
 *
 * @apiDescription Esta função faz o cadastramento de um registro
 * 
 * @apiParam {products} data da criação da lista
 * @apiParam {int} shoppinglist Id do usuário
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se cadastrou
 * @apiSuccess {object[] } Object Retorna um objeto com os valores cadastrados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type": true,"Cart": {"product":"1","shooplist":"1"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest http://api.lista-compras/api/Cart
 * 
 */
    public function newCart() {

        $request = \Slim\Slim::getInstance()->request();
        $cart = json_decode($request->getBody());
        $sql = "INSERT INTO cart( products, shoppinglist) VALUES (:products, :shoppinglist)";

        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":products",     $cart->products,     PDO::PARAM_STR);
            $stmt->bindParam(":shoppinglist",     $cart->shoppinglist,     PDO::PARAM_STR);
            $stmt->execute();
            $cart->id = $db->lastInsertId();
            $db = null;
            echo '{"type":true, "Cart":' . json_encode($cart) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }

/**
 * @api {DELETE} /List/:id deleteCart
 * @apiVersion 1.0.0
 * @apiName deleteCart
 * @apiGroup Cart
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
    public function deleteCart($id) {

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
 * @api {GET} /List/:id getOneCart
 * @apiVersion 1.0.0
 * @apiName getOneCart
 * @apiGroup Cart
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
 *   {"type": true,"Cart": {"id":"1","spending":"200","amount":"3","shoppinglist":"1","products":"20/05/2019"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getOneCart($id) {
        $sql = "SELECT ROUND(SUM(p.value), 2) as spending, COUNT(c.products) AS amount, l.shoppinglist, l.products
                    FROM List l 
                        INNER JOIN cart c ON c.list = l.id
                        INNER JOIN products p ON p.id = c.products
                        INNER JOIN shoppinglist u ON u.id = l.shoppinglist    
                    WHERE l.id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $cart = $stmt->fetchObject();
            $db = null;
            echo '{"type":true, "Cart":' . json_encode($cart) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
/**
 * @api {GET} /cart/user/:user getAllProductsFromUserCart
 * @apiVersion 1.0.0
 * @apiName getAllCart
 * @apiGroup Cart
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
 *   {"type": true,"Cart": {"id":"1","spending":"200","amount":"3","shoppinglist":"1","products":"20/05/2019"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest http://api.lista-compras.com/Cart  
 * @apiHeader {String} [Authorization=bearer f7a18c7871d160d4202b1878c73eefc9]
 * 
 */
    public function getAllCart($shoppinglist) {
        $sql = "SELECT l.id, ROUND(SUM(p.value), 2) as spending, COUNT(c.products) AS amount, l.shoppinglist, l.products
                    FROM cart c
                    INNER JOIN list c ON c.list = l.id
                    INNER JOIN products p ON p.id = c.products
                    INNER JOIN shoppinglist u ON u.id = l.shoppinglist    
                    WHERE u.id=:shoppinglist ORDER BY l.id DESC";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":shoppinglist", $shoppinglist);
            $stmt->execute();
            $cart = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "Cart":' . json_encode($cart) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
}
?>