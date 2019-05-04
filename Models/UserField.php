<?php

class UserField {

    public function newUserField($language) {
        $request = \Slim\Slim::getInstance()->request();
        $userField = json_decode($request->getBody());
        $sql = "INSERT INTO user_field(user,field) VALUES (:user,:field)";
        try {

            $db = getConnection();
            $stmt = $db->prepare($sql);
            
            $stmt->bindParam(":user", $userField->user, PDO::PARAM_INT);
            $stmt->bindParam(":field", $userField->field, PDO::PARAM_INT);
            
            $stmt->execute();
            $userField->id = $db->lastInsertId();
            $db = null;
            echo '{"type":true, "user_field": ' . json_encode($userField) . '}';
        } catch (PDOException $e) {
            echo '{"type": false,"data": "'.$e->getMessage().'"}';
        }
    }

    public function updateUserField($language,$id) {
        $request = \Slim\Slim::getInstance()->request();
        $userField = json_decode($request->getBody());
        $sql = "UPDATE user_field SET user=:user, field=:field WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":user", $userField->user, PDO::PARAM_INT);
            $stmt->bindParam(":field", $userField->field, PDO::PARAM_INT);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $db = null;
            echo '{"type":true, "user_field": ' . json_encode($userField) . '}';
        } catch (PDOException $e) {
            echo '{"type": false,"data": "'.$e->getMessage().'"}';
        }
    }

    public function deleteUserField($language,$id) {

        $sql = "DELETE FROM user_field WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $db = null;
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }

    public function getOneUserField($language,$id) {
        $sql = "SELECT * FROM user_field WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $userField = $stmt->fetchObject();
            $db = null;
            echo '{"type":true, "user_field": ' . json_encode($userField) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }

    public function getAllUserField($language) {
        $sql = "SELECT * FROM user_field ORDER BY id DESC";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $userField = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "user_field": ' . json_encode($userField) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }

    public function getAllUserFieldOfOrganization($language,$organization){
        $sql = "SELECT u.id AS user_id, u.name, count(uf.id) AS quantity
            FROM field f
            INNER JOIN user_field uf ON uf.field = f.id
            RIGHT JOIN user u ON u.id = uf.user
            INNER JOIN organization o ON o.id = u.organization
            WHERE o.id = :organization            
            GROUP BY u.id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":organization", $organization);
            $stmt->execute();
            $userField = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "user_field": ' . json_encode($userField) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }

}

?>