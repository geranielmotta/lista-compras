<?php

class PhenologyCrop {

    /**
     * @api {POST} /:language/phenologycrop newPhenologyCrop
     * @apiVersion 1.0.0
     * @apiName newPhenologyCrop
     * @apiGroup Phenology Crop
     * @apiPermission none
     *
     * @apiDescription Esta função faz o cadastramento de um registro
     * 
     * @apiParam {string} language Variável referente a chave do idioma.
     * @apiParam {date} date data de cadastramento do resgistro
     * @apiParam {string} note Descrição
     * @apiParam {string} URL URL 
     * @apiParam {int} experiment Id de experiment
     * @apiParam {int} phenological_stage  Id de phenological stage
     *
     * @apiSuccess {boolean } type  Retorna verdadeiro se cadastrou
     * @apiSuccess {object[] } phenology_crop Retorna um objeto com os valores cadastrados
     * 
     * @apiError {boolean}type  false caso ocorra um erro.
     * @apiError {string} data  Mensagem de erro.
     * 
     * @apiSuccessExample {json} Success-Response:
     * {"type": true,"phenology_crop": [{"date":"2015-06-12","note":"Teste","url":null,"experiment":"1","phenological_stage":"1","id":"1"}]}
     * 
     * @apiErrorExample {json} Error-Response:
     *      
     *     {"type": false,"data": "error"}
     * 
     * @apiSampleRequest off
     * 
     */
    public function newPhenologyCrop($language) {

        $request = \Slim\Slim::getInstance()->request();
        $phenologyCrop = json_decode($request->getBody());

        $sql = "INSERT INTO phenology_crop(date, note, url, experiment, phenological_stage) VALUES (:date, :note, :url, :experiment, :phenological_stage)";
        try {

            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":date", $phenologyCrop->date, PDO::PARAM_STR);
            $stmt->bindParam(":note", $phenologyCrop->note, PDO::PARAM_STR);
            $stmt->bindParam(":url", $phenologyCrop->url, PDO::PARAM_STR);
            $stmt->bindParam(":experiment", $phenologyCrop->experiment, PDO::PARAM_INT);
            $stmt->bindParam(":phenological_stage", $phenologyCrop->phenological_stage, PDO::PARAM_INT);

            $stmt->execute();
            $phenologyCrop->id = $db->lastInsertId();
            $db = null;
            echo '{"type": true,"phenology_crop": ' . json_encode($phenologyCrop) . '}';
        } catch (PDOException $e) {
            echo '{"type": false,"data": "' . $e->getMessage() . '"}';
        }
    }

    public function newImageOfPhenologyCrop($language) {

        $request = \Slim\Slim::getInstance()->request();
        $phenologyCrop = json_decode($request->getBody());

        if ( !empty( $_FILES ) ) {
            $tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
            //trocar pela url do servidor
            $uploadPath = '/var/www/estagio/fecoprod-app/imgs/'.time(). $_FILES[ 'file' ][ 'name' ];
            move_uploaded_file( $tempPath, $uploadPath );
            $nameImag = time(). $_FILES[ 'file' ][ 'name' ];
            echo $nameImag;
        } else {
            echo 'No files';
        }

    
    }

    /**
     * @api {PUT} /:language/phenologycrop/:id updatePhenologyCrop
     * @apiVersion 1.0.0
     * @apiName updatePhenologyCrop
     * @apiGroup Phenology Crop
     * @apiPermission none
     *
     * @apiDescription Esta função atualiza um registro
     * 
     * @apiParam {string} language Variável referente a chave do idioma.
     * @apiParam {date} date data de cadastramento do resgistro
     * @apiParam {string} note Descrição
     * @apiParam {string} URL URL 
     * @apiParam {int} experiment Id de experiment
     * @apiParam {int} phenological_stage  Id de phenological stage
     * @apiParam {int} id Id a ser atualizado
     *
     * @apiSuccess {boolean } type  Retorna verdadeiro se atualizou
     * @apiSuccess {object[] } phenology_crop Retorna um objeto com os valores atualizados
     * 
     * @apiError {boolean}type  false caso ocorra um erro.
     * @apiError {string} data  Mensagem de erro.
     * 
     * @apiSuccessExample {json} Success-Response:
     * {"type": true,"phenology_crop": [{"id":"1","date":"2015-06-12","note":"Teste","url":null,"experiment":"1","phenological_stage":"1"}]}
     * 
     * @apiErrorExample {json} Error-Response:
     *      
     *     {"type": false,"data": "error"}
     * 
     * @apiSampleRequest off
     * 
     */
    
    public function updatePhenologyCrop($language, $id) {
        $request = \Slim\Slim::getInstance()->request();
        $phenologyCrop = json_decode($request->getBody());
        $sql = "UPDATE phenology_crop SET date=:date, note=:note, url=:url, experiment=:experiment, phenological_stage=:phenological_stage WHERE id=:id";
        try {

            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":date", $phenologyCrop->date, PDO::PARAM_STR);
            $stmt->bindParam(":note", $phenologyCrop->note, PDO::PARAM_STR);
            $stmt->bindParam(":url", $phenologyCrop->url, PDO::PARAM_STR);
            $stmt->bindParam(":experiment", $phenologyCrop->experiment, PDO::PARAM_INT);
            $stmt->bindParam(":phenological_stage", $phenologyCrop->phenological_stage, PDO::PARAM_INT);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            $stmt->execute();
            $db = null;
            echo '{"type":true, "phenology_crop":' . json_encode($phenologyCrop) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }

    /**
     * @api {DELETE} /:language/phenologycrop/:id deletePhenologyCrop
     * @apiVersion 1.0.0
     * @apiName deletePhenologyCrop
     * @apiGroup Phenology Crop
     * @apiPermission none
     *
     * @apiDescription Esta função deleta um registro
     * 
     * @apiParam {string} language Variável referente a chave do idioma.
     * @apiParam {int} id Id a ser deletado
     *
     * @apiError {boolean}type  false caso ocorra um erro.
     * @apiError {string} data  Mensagem de erro.
     * @apiErrorExample {json} Error-Response:
     *      
     *     {"type": false,"data": "error"}
     * 
     * @apiSampleRequest off
     * 
     */
    public function deletePhenologyCrop($language, $id,$image) {
        
        $image = '../imgs/'.$image;
        if(unlink($image)){
        
            $sql = "DELETE FROM phenology_crop WHERE id=:id";
            try {

                $db = getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam(":id", $id);
                $stmt->execute();
                $db = null;

            } catch (PDOException $e) {
                echo '{"type":false, "data": "' . $e->getMessage() . '"}';
            }
        }else{
            echo '{"type":false, "data": "Erro ao deletar imagem"}';
        }
    }
    /**
     * @api {GET} /:language/phenologycrop/:id getOnePhenologyCrop
     * @apiVersion 1.0.0
     * @apiName getOnePhenologyCrop
     * @apiGroup Phenology Crop
     * @apiPermission none
     *
     * @apiDescription Esta função seleciona um registro
     * 
     * @apiParam {string} language Variável referente a chave do idioma.
     * @apiParam {int} id Id a ser selecionado
     *
     * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
     * @apiSuccess {object[] } phenology_crop Retorna um objeto com os valores selecionados
     * 
     * @apiError {boolean}type  false caso ocorra um erro.
     * @apiError {string} data  Mensagem de erro.
     * 
     * @apiSuccessExample {json} Success-Response:
     * {"type": true,"phenology_crop": [{"id":"1","date":"2015-06-12","note":"Teste","url":null,"experiment":"1","phenological_stage":"1"}]}
     * 
     * @apiErrorExample {json} Error-Response:
     *      
     *     {"type": false,"data": "error"}
     * 
     * @apiSampleRequest off
     * 
     */
    public function getOnePhenologyCrop($language, $id) {
        $sql = "SELECT c.id, c.date, c.note, c.url, c.experiment, ps.description_$language AS phenological_stage, ps.id AS phenological_stage_id FROM phenology_crop c INNER JOIN phenological_stage ps ON c.phenological_stage = ps.id INNER JOIN experiment t ON c.experiment = t.id WHERE c.id=:id;";
        try {

            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $phenologyCrop = $stmt->fetchObject();
            $db = null;
            echo '{"type":true, "phenology_crop": ' . json_encode($phenologyCrop) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data": "' . $e->getMessage() . '"}';
        }
    }

    /**
     * @api {GET} /:language/phenologycrop/ getAllPhenologyCrop
     * @apiVersion 1.0.0
     * @apiName getAllPhenologyCrop
     * @apiGroup Phenology Crop
     * @apiPermission none
     *
     * @apiDescription Esta função seleciona todos registro 
     * 
     * @apiParam {string} language Variável referente a chave do idioma.
     *
     * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
     * @apiSuccess {object[] } phenology_crop Retorna um objeto com todos os valores
     * 
     * @apiError {boolean}type  false caso ocorra um erro.
     * @apiError {string} data  Mensagem de erro.
     * 
     * @apiSuccessExample {json} Success-Response:
     * {"type": true,"phenology_crop": [{"id":"1","date":"2015-06-12","note":"Teste","url":null,"experiment":"1","phenological_stage":"1"}]}
     * 
     * @apiErrorExample {json} Error-Response:
     *      
     *     {"type": false,"data": "error"}
     * 
     * @apiSampleRequest off
     * 
     */
    public function getAllPhenologyCrop($language) {
        $sql = "SELECT * FROM phenology_crop";
        try {

            $db = getConnection();
            $stmt = $db->query($sql);
            $phenologyCrop = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type": true,"phenology_crop": ' . json_encode($phenologyCrop) . '}';
        } catch (PDOException $e) {
            echo '{"type": false,"data": "' . $e->getMessage() . '"}';
        }
    }
    
    /**
     * @api {GET} /:language/phenologycrop/experiment/:id getAllPhenologyCropOfExperiment
     * @apiVersion 1.0.0
     * @apiName getAllPhenologyCropOfExperiment
     * @apiGroup Phenology Crop
     * @apiPermission none
     *
     * @apiDescription Esta função seleciona todos registro que tenham uma ligação com :id de experiment
     * 
     * @apiParam {string} language Variável referente a chave do idioma.
     * @apiParam {string} id Id de experiment. 
     *
     * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
     * @apiSuccess {object[] } phenology_crop Retorna um objeto com todos os valores
     * 
     * @apiError {boolean}type  false caso ocorra um erro.
     * @apiError {string} data  Mensagem de erro.
     * 
     * @apiSuccessExample {json} Success-Response:
     * {"type": true,"phenology_crop": [{"id":"1","date":"2015-06-12","note":"Teste","url":null,"experiment":"1","phenological_stage":"1"}]}
     * 
     * @apiErrorExample {json} Error-Response:
     *      
     *     {"type": false,"data": "error"}
     * 
     * @apiSampleRequest off
     * 
     */   
    
    public function getAllPhenologyCropOfExperiment($language, $experiment) {
        $sql = "SELECT pc.id, pc.date, pc.note, pc.url, pc.experiment, ps.description_$language AS phenological_stage FROM phenology_crop pc INNER JOIN phenological_stage ps ON ps.id=pc.phenological_stage WHERE pc.experiment=:experiment";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":experiment", $experiment);

            $stmt->execute();
            $phenologyCrop = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type": true, "phenology_crop":' . json_encode($phenologyCrop) . '}';
        } catch (PDOException $e) {
            echo '{"type": false, "data":"' . $e->getMessage() . '"}';
        }
    }
}

?>