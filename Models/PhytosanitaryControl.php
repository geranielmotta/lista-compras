<?php

class PhytosanitaryControl {

    /**
     * @api {POST} /:language/phytosanitarycontrol  newPhytosanitaryControl
     * @apiVersion 1.0.0
     * @apiName newPhytosanitaryControl
     * @apiGroup Phytosanitary Control
     * @apiPermission none
     *
     * @apiDescription Esta função faz o cadastramento de um registro
     * 
     * @apiParam {string} language Variável referente a chave do idioma.
     * @apiParam {date} date Data da phytosanitary control.
     * @apiParam {string} product  Nome do produto .
     * @apiParam {int} quantity   Quantidade do produto.
     * @apiParam {string} note  Nota sobre o processo
     * @apiParam {int} parcel   Id de experiment.
     * @apiParam {string} unit_measurement   Unidade de medida utilizada.
     *
     * @apiSuccess {boolean } type  Retorna verdadeiro se cadastrou
     * @apiSuccess {object[] } phenological_stage Retorna um objeto com os valores cadastrados
     * 
     * @apiError {boolean}type  false caso ocorra um erro.
     * @apiError {string} data  Mensagem de erro.
     * 
     * @apiSuccessExample {json} Success-Response:
     * {"type":true, "phytosanitary_control": [{"date":"2015-09-13","product":"Nativo","quantity":"80","note":null,"experiment":"1","unit_measurement":"g\/ha","id":"1"}]}
     * 
     * @apiErrorExample {json} Error-Response:
     *      
     *     {"type": false,"data": "error"}
     * 
     * @apiSampleRequest off
     * 
     */
    public function newPhytosanitaryControl($language) {

        $request = \Slim\Slim::getInstance()->request();
        $phytosanitaryControl = json_decode($request->getBody());
        $sql = "INSERT INTO phytosanitary_control(date, product, quantity, note, experiment, unit_measurement) VALUES (:date, :product, :quantity, :note, :experiment, :unit_measurement)";
        try {

            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":date", $phytosanitaryControl->date, PDO::PARAM_STR);
            $stmt->bindParam(":product", $phytosanitaryControl->product, PDO::PARAM_STR);
            $stmt->bindParam(":quantity", $phytosanitaryControl->quantity, PDO::PARAM_INT);
            $stmt->bindParam(":note", $phytosanitaryControl->note, PDO::PARAM_STR);
            $stmt->bindParam(":experiment", $phytosanitaryControl->experiment, PDO::PARAM_INT);
            $stmt->bindParam(":unit_measurement", $phytosanitaryControl->unit_measurement, PDO::PARAM_INT);

            $stmt->execute();
            $phytosanitaryControl->id = $db->lastInsertId();
            $db = null;
            echo '{"type":true, "phytosanitary_control":' . json_encode($phytosanitaryControl) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }

    /**
     * @api {PUT} /:language/phytosanitarycontrol/:id  updatePhytosanitaryControl
     * @apiVersion 1.0.0
     * @apiName updatePhytosanitaryControl
     * @apiGroup Phytosanitary Control
     * @apiPermission none
     *
     * @apiDescription Esta função atualiza um registro
     * 
     * @apiParam {string} language Variável referente a chave do idioma.
     * @apiParam {date} date Data da phytosanitary control.
     * @apiParam {string} product  Nome do produto .
     * @apiParam {int} quantity   Quantidade do produto.
     * @apiParam {string} note  Nota sobre o processo
     * @apiParam {int} parcel   Id de experiment.
     * @apiParam {string} unit_measurement   Unidade de medida utilizada.
     * @apiParam {int} id   Id a ser atualizado.
     *
     * @apiSuccess {boolean } type  Retorna verdadeiro se atualizou
     * @apiSuccess {object[] } phytosanitary_control Retorna um objeto com os valores atualizados
     * 
     * @apiError {boolean}type  false caso ocorra um erro.
     * @apiError {string} data  Mensagem de erro.
     * 
     * @apiSuccessExample {json} Success-Response:
     * {"type":true, "phytosanitary_control": [{"id":"1","date":"2015-09-13","product":"Nativo","quantity":"80","note":null,"experiment":"1","unit_measurement":"g\/ha"}]}
     * 
     * @apiErrorExample {json} Error-Response:
     *      
     *     {"type": false,"data": "error"}
     * 
     * @apiSampleRequest off
     * 
     */
    public function updatePhytosanitaryControl($language, $id) {
        $request = \Slim\Slim::getInstance()->request();
        $phytosanitaryControl = json_decode($request->getBody());
        $sql = "UPDATE phytosanitary_control SET date=:date, product=:product, quantity=:quantity, note=:note, experiment=:experiment, unit_measurement=:unit_measurement WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":date", $phytosanitaryControl->date, PDO::PARAM_STR);
            $stmt->bindParam(":product", $phytosanitaryControl->product, PDO::PARAM_STR);
            $stmt->bindParam(":quantity", $phytosanitaryControl->quantity, PDO::PARAM_INT);
            $stmt->bindParam(":note", $phytosanitaryControl->note, PDO::PARAM_STR);
            $stmt->bindParam(":experiment", $phytosanitaryControl->experiment, PDO::PARAM_INT);
            $stmt->bindParam(":unit_measurement", $phytosanitaryControl->unit_measurement, PDO::PARAM_INT);

            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $db = null;
            echo '{"type":true, "phytosanitary_control":' . json_encode($phytosanitaryControl) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }

    /**
     * @api {DELETE} /:language/phytosanitarycontrol/:id  deletePhytosanitaryControl
     * @apiVersion 1.0.0
     * @apiName deletePhytosanitaryControl
     * @apiGroup Phytosanitary Control
     * @apiPermission none
     *
     * @apiDescription Esta função deleta um registro
     * 
     * @apiParam {string} language Variável referente a chave do idioma.
     * @apiParam {int} id   Id a ser deletado.
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
    public function deletePhytosanitaryControl($language, $id) {

        $sql = "DELETE FROM phytosanitary_control WHERE id=:id";
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
     * @api {GET} /:language/phytosanitarycontrol/:id  getOnePhytosanitaryControl
     * @apiVersion 1.0.0
     * @apiName getOnePhytosanitaryControl
     * @apiGroup Phytosanitary Control
     * @apiPermission none
     *
     * @apiDescription Esta função seleciona um registro
     * 
     * @apiParam {string} language Variável referente a chave do idioma.
     * @apiParam {int} id   Id a ser selecionado.
     * 
     *
     * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
     * @apiSuccess {object[] } phytosanitary_control Retorna um objeto com os valores
     * 
     * @apiError {boolean}type  false caso ocorra um erro.
     * @apiError {string} data  Mensagem de erro.
     * 
     * @apiSuccessExample {json} Success-Response:
     * {"type":true, "phytosanitary_control": [{"id":"1","date":"2015-09-13","product":"Nativo","quantity":"80","note":null,"experiment":"1","unit_measurement":"g\/ha"}]}
     * 
     * @apiErrorExample {json} Error-Response:
     *      
     *     {"type": false,"data": "error"}
     * 
     * @apiSampleRequest off
     * 
     */
    public function getOnePhytosanitaryControl($language, $id) {
        $sql = "SELECT pc.id, pc.date, pc.product, pc.quantity, pc.note, pc.experiment, u.code AS unit_measurement FROM phytosanitary_control pc INNER JOIN unit_measurement u  ON pc.unit_measurement=u.id WHERE pc.id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $phytosanitaryControl = $stmt->fetchObject();
            $db = null;
            echo '{"type":true, "phytosanitary_control":' . json_encode($phytosanitaryControl) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "' . $e->getMessage() . '"}';
        }
    }

    /**
     * @api {GET} /:language/phytosanitarycontrol/  getAllPhytosanitaryControl
     * @apiVersion 1.0.0
     * @apiName getAllPhytosanitaryControl
     * @apiGroup Phytosanitary Control
     * @apiPermission none
     *
     * @apiDescription Esta função seleciona todos os registro
     * 
     * @apiParam {string} language Variável referente a chave do idioma.
     * 
     *
     * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
     * @apiSuccess {object[] } phytosanitary_control Retorna um objeto com todos os valores
     * 
     * @apiError {boolean}type  false caso ocorra um erro.
     * @apiError {string} data  Mensagem de erro.
     * 
     * @apiSuccessExample {json} Success-Response:
     * {"type":true, "phytosanitary_control": [{"id":"1","date":"2015-09-13","product":"Nativo","quantity":"80","note":null,"experiment":"1","unit_measurement":"g\/ha"}]}
     * 
     * @apiErrorExample {json} Error-Response:
     *      
     *     {"type": false,"data": "error"}
     * 
     * @apiSampleRequest off
     * 
     */
    function getAllPhytosanitaryControl($language) {
        $sql = "SELECT pc.id, pc.date, pc.product, pc.quantity, pc.note, pc.experiment, u.code AS unit_measurement FROM phytosanitary_control pc INNER JOIN unit_measurement u  ON pc.unit_measurement=u.id";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $phytosanitaryControl = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "phytosanitary_control": ' . json_encode($phytosanitaryControl) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "' . $e->getMessage() . '"}';
        }
    }

    /**
     * @api {GET} /:language/phytosanitarycontrol/experiment/:experiment getPhytosanitaryControlOfParcel
     * @apiVersion 1.0.0
     * @apiName getPhytosanitaryControlOfParcel
     * @apiGroup Phytosanitary Control
     * @apiPermission none
     *
     * @apiDescription Esta função seleciona todos os registro com id de experiment
     * 
     * @apiParam {string} language Variável referente a chave do idioma.
     * @apiParam {int} experiment  Id de experimente.
     *
     * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
     * @apiSuccess {object[] } phytosanitary_control Retorna um objeto com todos os valores
     * 
     * @apiError {boolean}type  false caso ocorra um erro.
     * @apiError {string} data  Mensagem de erro.
     * 
     * @apiSuccessExample {json} Success-Response:
     * {"type":true, "phytosanitary_control": [{"id":"1","date":"2015-09-13","product":"Nativo","quantity":"80","note":null,"experiment":"1","unit_measurement":"g\/ha"}]}
     * 
     * @apiErrorExample {json} Error-Response:
     *      
     *     {"type": false,"data": "error"}
     * 
     * @apiSampleRequest off
     * 
     */
    public function getAllPhytosanitaryControlOfExperiment($language, $experiment) {
        $sql = "SELECT pc.id, pc.date, pc.product, pc.quantity, pc.note, pc.experiment, u.code AS unit_measurement FROM phytosanitary_control pc INNER JOIN unit_measurement u  ON pc.unit_measurement=u.id WHERE pc.experiment=:experiment";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":experiment", $experiment);
            $stmt->execute();
            $phytosanitaryControl = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "phytosanitary_control":' . json_encode($phytosanitaryControl) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }

}

?>