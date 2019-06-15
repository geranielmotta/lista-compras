<?php

class Report {
/**
 * @api {GET} /report/most-purchased-products getMostPurchasedProducts
 * @apiVersion 1.0.0
 * @apiName getMostPurchasedProducts
 * @apiGroup Report
 * @apiPermission root
 *
 * @apiDescription Esta função busca os produtos mais selecionados pelos usuários do sistema  
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } Report Retorna um objeto com os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type": true,"report": {"id":"1","products":"Arroz","price":"10.50","category":"Grãos","amount":"200"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest off
 * 
 */
    public function getMostPurchasedProducts() {
        $sql = "SELECT p.description,p.price,c.amount, cat.description as category
        FROM cart c
        JOIN products p ON c.products = p.id
        JOIN category cat ON p.category = cat.id
        ORDER BY amount DESC";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $report = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "productsreport":' . json_encode($report) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
/**
 * @api {GET} /report/users-who-spent-more getUsersWhoSpentMore
 * @apiVersion 1.0.0
 * @apiName getUsersWhoSpentMore
 * @apiGroup Report
 * @apiPermission root
 *
 * @apiDescription Esta função busca os maiores gastos em produtos por usuários
 *
 * @apiSuccess {boolean } type  Retorna verdadeiro se encontrou
 * @apiSuccess {object[] } Report Retorna um objeto com todos os valores
 * 
 * @apiError {boolean}type  false caso ocorra um erro.
 * @apiError {string} data  Mensagem de erro.
 * 
 * @apiSuccessExample {json} Success-Response:
 *   {"type": true,"Report": {"id":"1","username":"geranielmotta","date":"01/06/2019 22:06","email":"geraniel.motta@gmail.com","spending ":"200.60"}}
 * @apiErrorExample {json} Error-Response:
 *      
 *     {"type": false,"data": "error"}
 * 
 * @apiSampleRequest http://api.lista-compras.com/Report  
 * @apiHeader {String} [Authorization=bearer f7a18c7871d160d4202b1878c73eefc9]
 * 
 */
    public function getUsersWhoSpentMore() {
        $sql = "SELECT u.name,u.email,l.date, l.spending FROM shoppinglist l JOIN user u ON u.id = l.user ORDER by l.spending DESC LIMIT 10 ";
        try {
            $db = getConnection();
            $stmt = $db->query($sql);
            $report = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"type":true, "usersreport":' . json_encode($report) . '}';
        } catch (PDOException $e) {
            echo '{"type":false, "data":"' . $e->getMessage() . '"}';
        }
    }
}

?>