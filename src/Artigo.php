<?php

class Artigo
{
    
    private $mysql;

    public function __construct(mysqli $mysql)
    {
        $this->mysql = $mysql;
    }

    /** adiciona novo post ao banco */
    public function adicionarArtigo(string $titulo, string $conteudo): void
    {
        $stmt = $this->mysql->prepare('INSERT INTO artigos (titulo, conteudo) VALUES (?, ?);');
        $stmt->bind_param('ss', $titulo, $conteudo);
        $stmt->execute();
    }

    /** remove o post a partir do id */
    public function excluirArtigo(string $id): void
    {
        $stmt = $this->mysql->prepare('DELETE FROM artigos WHERE id = ?;');
        $stmt->bind_param('s', $id);
        $stmt->execute();
    }

    /** Busca todos os artigos */
    public function exibirTodos(): array
    {
        $resultado =$this->mysql->query('SELECT id, titulo, conteudo FROM artigos');
        $artigos = $resultado->fetch_all(MYSQLI_ASSOC);
        
        return $artigos;
    }

    // Update nos dados do artigo 
    public function editar(string $id, string $titulo, $conteudo): void
    {
        $updateAticle = $this->mysql->prepare('UPDATE artigos SET titulo = ?, conteudo = ? WHERE id = ?');
        $updateAticle->bind_param('sss', $titulo, $conteudo, $id);
        $updateAticle->execute();
    }

    /** Busca artigo pelo ID */
    public function encontrarPorId(string $id): array
    {
        $selecionaArtigo =$this->mysql->prepare('SELECT id, titulo, conteudo FROM artigos WHERE id = ?');
        $selecionaArtigo->bind_param('s', $id);
        $selecionaArtigo->execute();
        $artigo = $selecionaArtigo->get_result()->fetch_assoc();
        
        return $artigo;
    }
}
