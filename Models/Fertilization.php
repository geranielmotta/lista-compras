<?php

class Fertilization {
    
    public function newFertilization($language) {
        
        $request = \Slim\Slim::getInstance()->request();
        $fertilization = json_decode($request->getBody());
        $sql = "INSERT INTO fertilization(date, product, quantity, experiment, unit_measurement) VALUES (:date, :product, :quantity, :experiment, :unit_measurement)";
        try {

            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":date", $fertilization->date, PDO::PARAM_STR);
            $stmt->bindParam(":product", $fertilization->product, PDO::PARAM_STR);
            $stmt->bindParam(":quantity", $fertilization->quantity, PDO::PARAM_INT);
            $stmt->bindParam(":experiment", $fertilization->experiment, PDO::PARAM_INT);
            $stmt->bindParam(":unit_measurement", $fertilization->unit_measurement, PDO::PARAM_INT);

            $stmt->execute();
            $fertilization->id = $db->lastInsertId();
            $db = null;
            echo '{"type":true, "fertilization":'.json_encode($fertilization).'}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"'.$e->getMessage().'"}';
        }
    }

    public function updateFertilization($language,$id) {
        $request = \Slim\Slim::getInstance()->request();
        $fertilization = json_decode($request->getBody());
        $sql = "UPDATE fertilization SET date=:date, product=:product, quantity=:quantity, experiment=:experiment, unit_measurement=:unit_measurement WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":date", $fertilization->date, PDO::PARAM_STR);
            $stmt->bindParam(":product", $fertilization->product, PDO::PARAM_STR);
            $stmt->bindParam(":quantity", $fertilization->quantity, PDO::PARAM_INT);
            $stmt->bindParam(":experiment", $fertilization->experiment, PDO::PARAM_INT);
            $stmt->bindParam(":unit_measurement", $fertilization->unit_measurement, PDO::PARAM_INT);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            
            $stmt->execute();
            $db = null;
            echo '{"type":true, "fertilization":'.json_encode($fertilization).'}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"'.$e->getMessage().'"}';
        }
    }

    public function deleteFertilization($language,$id) {

        $sql = "DELETE FROM fertilization WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":id", $id);

            $stmt->execute();
            $db = null;
        } catch (PDOException $e) {
            echo '{"type":false, "data":"'.$e->getMessage().'"}';
        }
    }

    public function getOneFertilization($language,$id){
        $sql = "SELECT f.id, f.date, f.quantity, f.product, f.experiment, u.code AS unit_measurement FROM fertilization f INNER JOIN unit_measurement u ON u.id = f.unit_measurement WHERE f.id = :id ORDER BY f.date DESC ";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $fertilization = $stmt->fetchObject();
            $db = null;
            echo '{"type":true, "fertilization":' . json_encode($fertilization) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"'.$e->getMessage().'"}';
        }
    }

    public function getAllFertilization($language) {
        $sql = "SELECT f.id, f.date, f.quantity, f.product, f.experiment, u.code AS unit_measurement FROM fertilization f INNER JOIN unit_measurement u ON u.id = f.unit_measurement ORDER BY f.date DESC ";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $fertilization = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;

            echo '{"type":true, "fertilization":'. json_encode($fertilization).'}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"'.$e->getMessage().'"}';
        }
    }

    public function getAllFertilizationOfExperiment($language,$experiment) {
        $sql = "SELECT f.id, f.date, f.quantity, f.product, f.experiment, u.code AS unit_measurement FROM fertilization f INNER JOIN unit_measurement u ON u.id = f.unit_measurement WHERE f.experiment = :experiment ORDER BY f.date DESC ";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":experiment", $experiment);

            $stmt->execute();
            $fertilization = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "fertilization":' . json_encode($fertilization) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"'.$e->getMessage().'"}';
        }
    }

}

?>