<?php
require_once __DIR__ . '/../../config/connectDB.php';

class InstituicaoDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function inserir(Instituicao $instituicao) {
        $sql = "INSERT INTO instituicoes (id_usuario, razao, nome_fantasia, cnpj, telefone, cep, endereco, cidade, uf) VALUES (:id_usuario, :razao, :nome_fantasia, :cnpj, :telefone, :cep, :endereco, :cidade, :uf)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id_usuario' => $instituicao->getIdUsuario(),
            ':razao' => $instituicao->getRazaoSocial(),
            ':nome_fantasia' => $instituicao->getNomeFantasia(),
            ':cnpj' => $instituicao->getCnpj(),
            ':telefone' => $instituicao->getTelefone(),
            ':cep' => $instituicao->getCep(),
            ':endereco' => $instituicao->getEndereco(),
            ':cidade' => $instituicao->getCidade(),
            ':uf' => $instituicao->getUf()
        ]);
    }

    public function listarInstituicoes() {
        $sql = "SELECT * FROM instituicoes";
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function consultarPorId($id) {
        $sql = "SELECT * FROM instituicoes WHERE id_usuario = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
