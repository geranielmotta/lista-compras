<?php

class Category {
/**
 * @api {POST} /category newCategory
 * @apiVersion 1.0.0
 * @apiName newCategory
 * @apiGroup Category
 * @apiPermission Root
 *
 * @apiDescription Esta função faz o cadastramento de um registro
 * 
 * @apiParam {products} data da criação da lista
 * @apiParam {int} category Id do categoria
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se cadastrou
 * @apiSuccess {object[] } Object Retorna um objeto com os valores cadastrados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type": true,"Category": {"id":"1","name":"Grãos"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest http://api.lista-compras/api/category
 * 
 */
    public function newCategory() {

        $request = \Slim\Slim::getInstance()->request();
        $category = json_decode($request->getBody());
        $sql = "INSERT INTO category(description) VALUES (:description)";

        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":description",     $category->description,     PDO::PARAM_STR);
            $stmt->execute();
            $category->id = $db->lastInsertId();
            $db = null;
            echo '{"type":true, "category":' . json_encode($category) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
/**
 * @api {PUT} /user/:id updateUser
 * @apiVersion 1.0.0
 * @apiName updateCategory
 * @apiGroup Category
 * @apiPermission Root
 *
 * @apiDescription Esta função atualiza um registro
 * 
 * @apiParam {string} name Nome da categoria
 * @apiParam {int} id Id a ser atualizado
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se atualizou
 * @apiSuccess {object[] } category Retorna um objeto com os valores atualizados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type": true,"category": {"id":"1","name":"Grãos"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
public function updateCategory($id) {
    $request = \Slim\Slim::getInstance()->request();
    $category = json_decode($request->getBody());
    $sql = "UPDATE category SET description=:description WHERE id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);

        $stmt->bindParam(":description", $category->description, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $stmt->execute();
        $db = null;
        echo '{"type":true, "category":' . json_encode($category) . '}';
    } catch (PDOException $e) {
        echo '{"type":false, "data":"' . $e->getMessage() . '"}';
    }
}    

/**
 * @api {DELETE} /category/:id deleteCategory
 * @apiVersion 1.0.0
 * @apiName deleteCategory
 * @apiGroup Category
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
    public function deleteCategory($id) {

        $sql = "DELETE FROM category WHERE id=:id";
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
 * @api {GET} /category/:id getOneCategory
 * @apiVersion 1.0.0
 * @apiName getOneCategory
 * @apiGroup Category
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
 *   {"type": true,"category": {"id":"1","name":"Grãos"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getOneCategory($id) {
        $sql = "SELECT description FROM category WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $category = $stmt->fetchObject();
            $db = null;
            echo '{"type":true, "category":' . json_encode($category) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
/**
 * @api {GET} /category getAllCategory
 * @apiVersion 1.0.0
 * @apiName getAllCategory
 * @apiGroup Category
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
 *   {"type": true,"Category": {"id":"1","name":"Grãos"},{"id":"2","name":"Carnes"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest http://api.lista-compras.com/category  
 * @apiHeader {String} [Authorization=bearer f7a18c7871d160d4202b1878c73eefc9]
 * 
 */
    public function getAllCategory() {
        $sql = "SELECT id, description FROM category  ORDER BY description DESC";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $category = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "category":' . json_encode($category) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
}
?>