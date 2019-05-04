<?php

class Biomass {
 /**
 * @api {POST} /:language/biomass newBiomass
 * @apiVersion 1.0.0
 * @apiName newBiomass
 * @apiGroup Biomass
 * @apiPermission none
 *
 * @apiDescription Esta função faz o cadastramento de um registro
 * 
 * @apiParam {string} language Variavel referente a chave do idioma.
 * @apiParam {date} date Data da biomass.
 * @apiParam {int} test Chave estrangeira de test.
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se cadastrou
 * @apiSuccess {object[] } biomass Retorna um objeto com os valores cadastrados
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *     {"type":true,"biomass": {"date":"2015-10-03","test":"1","id":"6"}}
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function newBiomass($language) {

        $request = \Slim\Slim::getInstance()->request();
        $biomass = json_decode($request->getBody());
        $sql = "INSERT INTO biomass(date,test) VALUES (:date,:experiment)";
        try {

            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":date", $biomass->date, PDO::PARAM_STR);
            $stmt->bindParam(":experiment", $biomass->experiment, PDO::PARAM_INT);

            $stmt->execute();
            $biomass->id = $db->lastInsertId();
            $db = null;
            echo '{"type":true,"biomass":'.json_encode($biomass).'}';
        } catch (PDOException $e) {
            echo '{"type":false,"data": "'.$e->getMessage().'"}';
        }

    }
 /**
 * @api {PUT} /:language/biomass/:id updateBiomass
 * @apiVersion 1.0.0
 * @apiName updateBiomass
 * @apiGroup Biomass
 * @apiPermission none
 *
 * @apiDescription Esta função faz a atualização de um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {date} date Data da biomass.
 * @apiParam {int} test Chave estrangeira de test.
 * @apiParam {int} id   chave primaria de biomass
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se atualizou
 * @apiSuccess {object[] } biomass Retorna objeto com os valores atualizados
 * 
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *     {"type":true,"biomass": {"id":"1","date":"2015-10-03","test":"1"}}
 * 
 * @apiErrorExample {json} Error-Response:
 *    
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function updateBiomass($language,$id) {

        $request = \Slim\Slim::getInstance()->request();
        $biomass = json_decode($request->getBody());
        $sql = "UPDATE biomass SET date=:date,experiment=:experiment WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":date", $biomass->date, PDO::PARAM_STR);
            $stmt->bindParam(":experiment", $biomass->experiment, PDO::PARAM_INT);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            $stmt->execute();
            $db = null;
            echo '{"type":true,"biomass":'.json_encode($biomass).'}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"'.$e->getMessage().'"}';
        }

    }
 /**
 * @api {DELETE} /:language/biomass/:id deleteBiomass
 * @apiVersion 1.0.0
 * @apiName deleteBiomass
 * @apiGroup Biomass
 * @apiPermission none
 *
 * @apiDescription Esta função deleta um registro
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} id   chave primaria de biomass 
 *
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro caso não delete.
 * 
 * 
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function deleteBiomass($language,$id) {

        $sql = "DELETE FROM biomass WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":id", $id);
            
            $stmt->execute();
            $db = null;
        } catch (PDOException $e) {
            echo '{"type": false,"data": "'.$e->getMessage().'"}';
        }
    }
 /**
 * @api {GET} /:language/biomass/:id getOneBiomass
 * @apiVersion 1.0.0
 * @apiName getOneBiomass
 * @apiGroup Biomass
 * @apiPermission none
 *
 * @apiDescription Esta função retorna um registro selecionado.
 * 
 * @apiParam {string} language Variável referente a chave do idioma.
 * @apiParam {int} id   chave primaria de biomass 
 * 
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou.
 * @apiSuccess {Object[]} biomass Retorna objeto com o valor selecionado. 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Retorna uma mensagem de erro caso não encontre.
 * 
 * @apiSuccessExample {json} Success-Response:
 *     {"type":true,"biomass": {"id":"1","date":"2015-10-03","test":"1"}}
 * @apiErrorExample {json} Error-Response:
 *  
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */ 
    public function getOneBiomass($language,$id) {
        $sql = "SELECT * FROM biomass WHERE id=:id";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            
            $stmt->bindParam(":id", $id);

            $stmt->execute();
            $biomass = $stmt->fetchObject();
            $db = null;
            echo '{"type":true, "biomass":'.json_encode($biomass).'}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "'.$e->getMessage().'"}';
        }
    }
/**
 * @api {GET} /:language/biomass getAllBiomass
 * @apiVersion 1.0.0
 * @apiName getAllBiomass
 * @apiGroup Biomass
 * @apiPermission none
 *
 * @apiDescription Esta função retorna todos os registros selecionados.
 * 
 * @apiParam {string} language Variável referente a chave do idioma utilizada.
 * @apiParam {int} id   chave primaria de biomass 
 * 
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou.
 * @apiSuccess {Object[]} biomass Retorna objeto com os valores selecionados. 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Retorna uma mensagem de erro caso não encontre.
 * 
 * @apiSuccessExample {json} Success-Response:
 *     {"type": true,"biomass": [{"id":"1","date":"2015-10-03","test":"1"},{"id":"2","date":"2015-08-10","test":"1"},{"id":"3","date":"2015-05-15","test":"1"}]}
 * @apiErrorExample {json} Error-Response:
 *  
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getAllBiomass($language) {
        $sql = "SELECT * FROM biomass ORDER BY date DESC";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $biomass = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type": true,"biomass": ' . json_encode($biomass) . '}';
        } catch (PDOException $e) {
            echo '{"type": false,"data": "'.$e->getMessage().'"}';
        }
    }
 /**
 * @api {GET} /:language/biomass/:id getBiomassOfTest
 * @apiVersion 1.0.0
 * @apiName getBiomassOfTest
 * @apiGroup Biomass
 * @apiPermission none
 *
 * @apiDescription Esta função retorna todos os registros selecionados em biomass que apresentem o :id de test.
 * 
 * @apiParam {string} language Variável referente a chave do idioma utilizada.
 * @apiParam {int} test   chave estrangeira da tabela test 
 * 
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou.
 * @apiSuccess {data } biomass Objeto com os valores selecionados. 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Retorna uma mensagem de erro caso não encontre.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type": true,"biomass": [{"id":"1","date":"2015-08-10","test":"1"},{"id":"2","date":"2015-05-15","test":"1"},{"id":"3","date":"2015-10-03","test":"1"}]}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getBiomassOfExperiment($language,$experiment) {
        $sql = "SELECT * FROM biomass WHERE experiment = :experiment ORDER BY id ";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":experiment", $experiment);
            
            $stmt->execute();
            $biomass = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type": true,"biomass": ' . json_encode($biomass) . '}';
        } catch (PDOException $e) {
            echo '{"type": false,"data": "'.$e->getMessage().'"}';
        }
    }

}

?>
