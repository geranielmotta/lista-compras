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
 *   {"type": true,"Products": {"id":"1","name":"Feijão"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest http://api.lista-compras/api/products
 * 
 */
    public function newProducts() {

        $request = \Slim\Slim::getInstance()->request();
        $products = json_decode($request->getBody());
        $sql = "INSERT INTO products(name,value,category) VALUES (:name,:value,:category)";

        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":name", $products->name,     PDO::PARAM_STR);
            $stmt->bindParam(":value", strval($products->value),    PDO::PARAM_STR);
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
    $sql = "UPDATE products SET name=:name,value=:value,category=:category WHERE id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":name",     $products->name,          PDO::PARAM_STR);
        $stmt->bindParam(":value",    strval($products->value), PDO::PARAM_STR);
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
        $sql = "SELECT p.name,p.value,c.name as category
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
 * @apiHeader {String} [Authorization=bearer f7a18c7871d160d4202b1878c73eefc9]
 * 
 */
    public function getAllProducts() {
        $sql = "SELECT p.name,p.value,c.name as category
                FROM products p
                JOIN category c ON c.id = p.category
                ORDER BY p.name DESC";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $products = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "products":' . json_encode($products) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
}
?>