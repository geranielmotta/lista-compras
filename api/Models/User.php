<?php

class User {
/**
 * @api {POST} /user newUser
 * @apiVersion 1.0.0
 * @apiName newUser
 * @apiGroup User
 * @apiPermission none
 *
 * @apiDescription Esta função faz o cadastramento de um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {string} username Nome do usuário
 * @apiParam {string} password Senha do usuário
 * @apiParam {string} name Name completo do usuário
 * @apiParam {string} phone Telefone do usuário
 * @apiParam {string} email Email do usuário
 * @apiParam {string} access_levels Nivel de acesso do usuário
 * @apiParam {string} organization Organização do usuário
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se cadastrou
 * @apiSuccess {object[] } user Retorna um objeto com os valores cadastrados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type": true,"user": {"username":"dperondi","name":"Daniel Perondi","phone":"+555496416090","email":"daniel@ensoag.com","access_levels":"Adminstrador","organization":"Fundação ABC","id":"1"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function newUser() {

        $request = \Slim\Slim::getInstance()->request();
        $user = json_decode($request->getBody());
        $sql = "INSERT INTO user(username, password, name, phone, email, access_levels, organization) VALUES (:username, :password, :name, :phone, :email, :access_levels, :organization)";

        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":username", $user->username, PDO::PARAM_STR);
            $stmt->bindParam(":password", md5($user->password), PDO::PARAM_STR);
            $stmt->bindParam(":name", $user->name, PDO::PARAM_STR);
            $stmt->bindParam(":phone", $user->phone, PDO::PARAM_STR);
            $stmt->bindParam(":email", $user->email, PDO::PARAM_STR);
            $stmt->bindParam(":access_levels", $user->access_levels, PDO::PARAM_STR);
            $stmt->bindParam(":organization", $user->organization, PDO::PARAM_STR);
            $stmt->execute();
            $user->id = $db->lastInsertId();
            $db = null;
            echo '{"type":true, "user":' . json_encode($user) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
/**
 * @api {PUT} /user/:id updateUser
 * @apiVersion 1.0.0
 * @apiName updateUser
 * @apiGroup User
 * @apiPermission none
 *
 * @apiDescription Esta função atualiza um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {string} username Nome do usuário
 * @apiParam {string} password Senha do usuário
 * @apiParam {string} name Name completo do usuário
 * @apiParam {string} phone Telefone do usuário
 * @apiParam {string} email Email do usuário
 * @apiParam {string} access_levels Nivel de acesso do usuário
 * @apiParam {string} organization Organização do usuário
 * @apiParam {int} id Id a ser atualizado
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se atualizou
 * @apiSuccess {object[] } user Retorna um objeto com os valores atualizados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type": true,"user": {"id":"1","username":"dperondi","name":"Daniel Perondi","phone":"+555496416090","email":"daniel@ensoag.com","access_levels":"Adminstrador","organization":"Fundação ABC"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */

    public function updateUser($id) {
        $request = \Slim\Slim::getInstance()->request();
        $user = json_decode($request->getBody());
        $sql = "UPDATE user SET username=:username, password=:password, name=:name, phone=:phone, email=:email,access_levels=:access_levels, organization=:organization WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":username", $user->username, PDO::PARAM_STR);
            $stmt->bindParam(":password", md5($user->password), PDO::PARAM_STR);
            $stmt->bindParam(":name", $user->name, PDO::PARAM_STR);
            $stmt->bindParam(":phone", $user->phone, PDO::PARAM_STR);
            $stmt->bindParam(":email", $user->email, PDO::PARAM_STR);
            $stmt->bindParam(":access_levels", $user->access_levels, PDO::PARAM_STR);
            $stmt->bindParam(":organization", $user->organization, PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $db = null;
            echo '{"type":true, "user":' . json_encode($user) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
/**
 * @api {DELETE} /user/:id deleteUser
 * @apiVersion 1.0.0
 * @apiName deleteUser
 * @apiGroup User
 * @apiPermission none
 *
 * @apiDescription Esta função deleta um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
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
    public function deleteUser($id) {

        $sql = "DELETE FROM user WHERE id=:id";
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
 * @api {GET} /user/:id getOneUser
 * @apiVersion 1.0.0
 * @apiName getOneUser
 * @apiGroup User
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} id Id a ser selecionado
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } user Retorna um objeto com os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type": true,"user": {"id":"1","username":"dperondi","name":"Daniel Perondi","phone":"+555496416090","email":"daniel@ensoag.com","access_levels":"Adminstrador","organization":"Fundação ABC"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getOneUser($id) {
        $sql = "SELECT u.id, u.username, u.name, u.phone, u.email, al.description AS access_levels, o.description AS organization,o.id as organization_id FROM user u INNER JOIN organization o ON o.id = u.organization INNER JOIN access_levels al ON al.id = u.access_levels WHERE u.id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $user = $stmt->fetchObject();
            $db = null;
            echo '{"type":true, "user":' . json_encode($user) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
/**
 * @api {GET} /user/ getAllUser
 * @apiVersion 1.0.0
 * @apiName getAllUser
 * @apiGroup User
 * @apiPermission none
 *
 * @apiDescription Esta função seleciona todos os registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * 
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } user Retorna um objeto com todos os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type": true,"user": {"id":"1","username":"dperondi","name":"Daniel Perondi","phone":"+555496416090","email":"daniel@ensoag.com","access_levels":"Adminstrador","organization":"Fundação ABC"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getAllUser() {
        $sql = "SELECT u.id, u.username, u.name, u.phone, u.email, al.description AS access_levels, o.description AS organization FROM user u INNER JOIN organization o ON o.id = u.organization INNER JOIN access_levels al ON al.id = u.access_levels ORDER BY u.name DESC";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $user = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "user":' . json_encode($user) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
}

?>