<?php

class users {

    /**
     *
     * @var \Pdo 
     */
    private $pdo;
    /**
     *
     * @var type 
     */
    private $urlData;
    /**
     *
     * @var array 
     */
    private $formData;
    /**
     *
     * @var array 
     */
    private $result = [];

    /**
     * 
     * @param string $method
     * @param array $urlData
     * @param array $formData
     * @param \Pdo $pdo
     */
    public function __construct($method, $urlData, $formData, $pdo) {
        if (method_exists('users', $method)) {
            $this->pdo = $pdo;
            $this->urlData = $urlData;
            $this->formData = $formData;

            $this->$method();
        } else {
            header('HTTP/1.0 400 Bad Request');
            $this->result = [
                'error' => 'Bad Request'
            ];
        }
        
        $this->printResult();
    }
    
    private function printResult() {
        header('Content-Type: application/json');
        echo json_encode($this->result);
    }

    private function get() {      
        if (count($this->urlData) === 1 && $this->urlData[0] > 0) {         
            $sth = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
            $sth->bindParam(':id', $this->urlData[0]);
            $sth->execute();
            $this->result = $sth->fetch(PDO::FETCH_ASSOC);
        } else {
            $this->result = $this->pdo->query('SELECT * FROM users')->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    private function post() {
        $sth = $this->pdo->prepare("INSERT INTO `users` (`name`, `phone`) VALUES (:name, :phone)");
        $sth->bindParam(':name', $this->formData['name']);
        $sth->bindParam(':phone', $this->formData['phone']);
        $sth->execute();
        
        $this->result = [
            'id' => $this->pdo->lastInsertId()
        ];
    }

    private function put() {
        $this->result = ['put'];
    }

    private function patch() {
        $this->result = ['patch'];
    }

    private function delete() {
        $this->result = ['delete'];
    }

}
