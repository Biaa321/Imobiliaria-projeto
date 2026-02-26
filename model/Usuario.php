<?php
    require_once(__DIR__."/../config/conexao.php");

    class Usuario{
        private int $id;
        private string $nome;
        private string $email;
        private string $senhaHash;
        private int $idperfil;
        private bool $ativo;
        

        public function __construct(?int $id = 0, string $nome, string $email, string $senhaHash, bool $ativo, int $idperfil,){
            
            $this->id = $id;
            $this->nome = $nome;
            $this->email = $email;
            $this->senhaHash = $senhaHash;
            $this->idperfil = $idperfil
            $this->ativo = $ativo;
            

        }

        public function __get(string $prop){
            
            if(property_exists($this, $prop)){
                return $this->$prop;
            }
                throw new Exception("Propriedade {$prop} não existe");
            
        }
    
        public function __set(string $prop, $valor){
            switch($prop){
                case "id":
                    $this->id = (int)$valor;
                    break;
                case "nome":
                    $this->nome = trim($valor);
                    break;
                case "email":
                    if(!filter_var($valor, FILTER_VALIDATE_EMAIL))
                    {
                        throw new Exception("E-mail inválido");
                    }
                    $this->email = $valor;
                    break;
                case "senhaHash":
                    $this->senhaHash = password_hash($valor, PASSWORD_DEFAULT);
                    break;
                case "idperfil":
                    $this->idperfil = $valor;
                    break;
                case "ativo":
                    $this->ativo = (bool)$valor;
                    break;
                default:
                throw new Exception("Propriedade {$prop} não permitida");
            }
    
        }
    
            private static function getConection(){
                return (new conexao())->conexao();
            }

            public function inserir(){
                $pdo = self::getConexao();

                $sql = "INSERT INTO `usuarios` (`nome`, `email`, `senha`, `ativo`, `idperfil`) VALUES (:nome, :email, :senha, :ativo, :idperfil)";

                $stmt = $pdo->prepare($sql);

                $stmt->execute([
                    ':nome' => $this->nome,
                    ':email' => $this->email,
                    ':senha' => $this->senha,
                    ':ativo' => $this->ativo,
                    ':idperfil' => $this->idperfil,
                ]);

                $ultimoId = $pdo->lastInsertId();
            }
    }

    

    $usuario1 = new Usuario(nome:"Apollo", email:"apollo@gmail.com", idperfil:1, senhaHash:123, ativo:false);

    $usuario1-> nome = "Apollo David";
    echo $usuario1->nome;
    echo $usuario1->senhaHash;

?>