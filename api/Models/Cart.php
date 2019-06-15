<?php

class Cart {
/**
 * @api {POST} /cart/addproducts addCart
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
 * @apiSampleRequest off
 * 
 */
    public function addProductsInCart() {

        $request = \Slim\Slim::getInstance()->request();
        $cart = json_decode($request->getBody());
        $sql = "INSERT INTO cart( products, shoppinglist) VALUES (:products, :shoppinglist)";

        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":products",     $cart->products,     PDO::PARAM_INT);
            $stmt->bindParam(":shoppinglist",     $cart->shoppinglist,     PDO::PARAM_INT);
            $stmt->execute();
            $cart->id = $db->lastInsertId();
            $db = null;
            echo '{"type":true, "Cart":' . json_encode($cart) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
/**
 * @api {PUT} /cart/producer/:id updateCart
 * @apiVersion 1.0.0
 * @apiName updateCart
 * @apiGroup Cart
 * @apiPermission Root
 *
 * @apiDescription Esta função atualiza a quantidade de produtos selecionados pelo usuário
 * 
 * @apiParam {int} products Id do produto no carrinho
 * @apiParam {int} shoppinglist Id da lista no carrinho
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se atualizou
 * @apiSuccess {object[] } Cart Retorna um objeto com a quantidade atualizada
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type": true,"Cart": {"id":"1","amount":"2"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
public function updateCart($products) {
    $request = \Slim\Slim::getInstance()->request();
    $cart = json_decode($request->getBody());
    $sql = "UPDATE cart SET amount=:amount WHERE products=:products AND shoppinglist=:shoppinglist";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);

        $stmt->bindParam(":amount", $cart->amount, PDO::PARAM_INT);
        $stmt->bindParam(":products", $products, PDO::PARAM_INT);
        $stmt->bindParam(":shoppinglist", $cart->shoppinglist, PDO::PARAM_INT);
        $stmt->execute();
        $db = null;
        echo '{"type":true, "cart":' . json_encode($cart) . '}';
    } catch (PDOException $e) {
        echo '{"type":false, "data":"' . $e->getMessage() . '"}';
    }
}   
/**
 * @api {DELETE} /cart/:id deleteProductsInCart
 * @apiVersion 1.0.0
 * @apiName deleteProductsInCart
 * @apiGroup Cart
 * @apiPermission root admin user
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
    public function deleteProductsInCart($products,$shoppinglist) {
        $sql = "DELETE FROM cart WHERE products=:products AND shoppinglist=:shoppinglist";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":products",     $products);
            $stmt->bindParam(":shoppinglist", $shoppinglist);
            $stmt->execute();
            $db = null;
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
 * @apiSampleRequest http://api.lista-compras.com/cart/shoppinglist/21 
 * @apiHeader {String}  Authorization=bearer bearer ad985e3af071adc3dbccb5703ecf164b 
 * 
 */
    public function getAllCartOfShoppingList($shoppinglist) {
        $sql = "SELECT s.id as shoppinglist, p.id as products, p.price, p.description, c.amount, ROUND(p.price * c.amount,2) as amountProd,  cat.description as category,s.spending
                FROM cart c
                INNER JOIN products p ON p.id = c.products
                INNER JOIN category cat ON cat.id = p.category
                INNER JOIN shoppinglist s ON s.id = c.shoppinglist    
                WHERE s.id=:shoppinglist ORDER BY p.description DESC";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":shoppinglist", $shoppinglist);
            $stmt->execute();
            $cart = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "cart":' . json_encode($cart) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
}
?>