<?php
    class Conexao{
        //Variaveis de conexao
        private $host = '10.91.45.57';
        private $bd = 'imobiliaria';
        private $user = 'admin';
        private $pass = '123456';
    
        public function conexao(){
            try{
                $strCon = "mysql::host={$this->host}; dbname={$this->bd}; charset=utf8";
                $pdo = new PDO($strCon, $this->$user, $this->$pass);

                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $err){
                die("Erro na conexão". $err->getMessage());
                return null;
            }
        }
    }





?>