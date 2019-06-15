<?php

class Products {
/**
 * @api {POST} /products newProducts
 * @apiVersion 1.0.0
 * @apiName newProducts
 * @apiGroup Products
 * @apiPermission Root
 *
 * @apiDescription Esta função faz o cadastramento de um registro
 * 
 * @apiParam {products} data da criação da lista
 * @apiParam {int} Products Id do produto
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se cadastrou
 * @apiSuccess {object[] } Object Retorna um objeto com os valores cadastrados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type": true,"Products": {"id":"1","description":"Feijão","price":"4.00","category":"1"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function newProducts() {

        $request = \Slim\Slim::getInstance()->request();
        $products = json_decode($request->getBody());
        $sql = "INSERT INTO products(description,price,category) VALUES (:description,:price,:category)";

        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":description", $products->description,     PDO::PARAM_STR);
            $stmt->bindParam(":price", strval($products->price),    PDO::PARAM_STR);
            $stmt->bindParam(":category", $products->category, PDO::PARAM_INT);
            $stmt->execute();
            $products->id = $db->lastInsertId();
            $db = null;
            echo '{"type":true, "products":' . json_encode($products) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
/**
 * @api {PUT} /products/:id updateProducts
 * @apiVersion 1.0.0
 * @apiName updateProducts
 * @apiGroup Products
 * @apiPermission Root Admin
 *
 * @apiDescription Esta função atualiza um registro
 * 
 * @apiParam {string} name Nome da categoria
 * @apiParam {int} id Id a ser atualizado
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se atualizou
 * @apiSuccess {object[] } Products Retorna um objeto com os valores atualizados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type": true,"products": {"id":"1","name":"Feijão","value":"2.5","category":"1"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
public function updateProducts($id) {
    $request = \Slim\Slim::getInstance()->request();
    $products = json_decode($request->getBody());
    $sql = "UPDATE products SET description=:description,price=:price,category=:category WHERE id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":description",     $products->description,          PDO::PARAM_STR);
        $stmt->bindParam(":price",    strval($products->price), PDO::PARAM_STR);
        $stmt->bindParam(":category", $products->category,      PDO::PARAM_INT);
        $stmt->bindParam(":id",       $id,                      PDO::PARAM_INT);
        $stmt->execute();
        $db = null;
        echo '{"type":true, "products":' . json_encode($products) . '}';
    } catch (PDOException $e) {
        echo '{"type":false, "data":"' . $e->getMessage() . '"}';
    }
}    

/**
 * @api {DELETE} /products/:id deleteProducts
 * @apiVersion 1.0.0
 * @apiName deleteProducts
 * @apiGroup Products
 * @apiPermission Root
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
    public function deleteProducts($id) {

        $sql = "DELETE FROM products WHERE id=:id";
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
 * @api {GET} /products/:id getOneProducts
 * @apiVersion 1.0.0
 * @apiName getOneProducts
 * @apiGroup Products
 * @apiPermission Root Admin User
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
 *   {"type": true,"Products": {"id":"1","name":"Grãos"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getOneProducts($id) {
        $sql = "SELECT p.description,p.price,c.id as category
                FROM products p
                JOIN category c ON c.id = p.category
                WHERE p.id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $products = $stmt->fetchObject();
            $db = null;
            echo '{"type":true, "products":' . json_encode($products) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
/**
 * @api {GET} /products getAllProducts
 * @apiVersion 1.0.0
 * @apiName getAllProducts
 * @apiGroup Products
 * @apiPermission Root Admin User
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
 *   {"type": true,"Products": {"id":"1","name":"Feijão","value":"4.80","category":"Grãos"},{"id":"2","name":"Arroz","value":"5.80","category":"Grãos"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest http://api.lista-compras.com/products  
 * @apiHeader {String} [Authorization=bearer ad985e3af071adc3dbccb5703ecf164b]
 * 
 */
    public function getAllProducts() {
        $sql = "SELECT p.id, p.description,p.price,c.description as category
                FROM products p
                JOIN category c ON c.id = p.category
                ORDER BY p.description DESC";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $products = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "products":' . json_encode($products) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
/**
 * @api {GET} products/not-have-cart/shoppinglist getAllProductsNotHaveCart
 * @apiVersion 1.0.0
 * @apiName getAllProductsNotHaveCart
 * @apiGroup Products
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos os produtos que ainda não estão na lista
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } Object Retorna um objeto com todos os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type": true,"Products": {"id":"1","name":"Feijão","value":"4.80","category":"Grãos"},{"id":"2","name":"Arroz","value":"5.80","category":"Grãos"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest http://api.lista-compras.com/products/not-have-cart/shoppinglist 
 * @apiHeader {String} [Authorization=bearer ad985e3af071adc3dbccb5703ecf164b]
 * 
 */
    public function getAllProductsNotHaveCart($shoppinglist){
        $sql = "SELECT p.id, p.description,p.price,c.description as category
        FROM products p
        JOIN category c ON c.id = p.category
        WHERE p.id NOT IN (SELECT ca.products FROM cart ca
                         			WHERE p.id = ca.products AND ca.shoppinglist  = :shoppinglist ) 
        ORDER BY p.description DESC";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":shoppinglist", $shoppinglist);
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "products":' . json_encode($products) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
}
?>