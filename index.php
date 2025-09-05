<?php

class Loja
{
    public array $produtos;
    public array $carrinho;

    public function __construct()
    {
        $this->produtos = [
            ['id' => 1, 'nome' => 'Camisa', 'preco' => 18.40, 'estoque' => 10],
            ['id' => 2, 'nome' => 'Blusa', 'preco' => 32.70, 'estoque' => 15],
            ['id' => 3, 'nome' => 'Tênis', 'preco' => 23.50, 'estoque' => 12],
        ];

        $this->carrinho = [];
    }

    private function buscarProduto(int $id): ?array
    {
        foreach ($this->produtos as $index => $produto) {
            if ($produto['id'] === $id) {
                return ['index' => $index, 'produto' => $produto];
            }
        }
        return null;
    }

    public function adicionarAoCarrinho(int $id, int $quantidade): void
    {
        $busca = $this->buscarProduto($id);

        if (!$busca) {
            echo "<p>Produto ID {$id} não encontrado.</p>";
            return;
        }

        $index = $busca['index'];
        $produto = $busca['produto'];

        if ($quantidade > $produto['estoque']) {
            echo "<p>Estoque insuficiente para {$produto['nome']}. Estoque atual: {$produto['estoque']}.</p>";
            return;
        }

        $this->produtos[$index]['estoque'] -= $quantidade;
        $subtotal = $produto['preco'] * $quantidade;

        $this->carrinho[] = [
            'id_produto' => $id,
            'nome' => $produto['nome'],
            'quantidade' => $quantidade,
            'subtotal' => $subtotal
        ];

        echo "<p>Produto adicionado: {$produto['nome']} (ID: {$id}) | Quantidade: {$quantidade}<br>
              Subtotal do item: R$ " . number_format($subtotal, 2, ',', '.') . "<br>
              Estoque restante: {$this->produtos[$index]['estoque']}</p>";

        $this->mostrarResumo();
    }

    public function removerDoCarrinho(int $id): void
    {
        foreach ($this->carrinho as $i => $item) {
            if ($item['id_produto'] === $id) {
                $busca = $this->buscarProduto($id);
                if ($busca) {
                    $this->produtos[$busca['index']]['estoque'] += $item['quantidade'];
                }
                unset($this->carrinho[$i]);

                echo "<p>Produto removido do carrinho: {$item['nome']} (ID: {$id})<br>
                      Estoque restaurado: {$this->produtos[$busca['index']]['estoque']}</p>";

                $this->mostrarResumo();
                return;
            }
        }
        echo "<p>Produto ID {$id} não encontrado no carrinho.</p>";
    }

    public function mostrarResumo(): void
    {
        if (empty($this->carrinho)) {
            echo "<p>Carrinho está vazio.</p>";
            return;
        }

        echo "<h3>Carrinho Atual</h3>";
        echo "<table border='1' cellspacing='0' cellpadding='6' style='border-collapse:collapse;'>
                <tr>
                  <th>ID</th><th>Produto</th><th>Qtd</th><th>Subtotal</th>
                </tr>";

        foreach ($this->carrinho as $item) {
            echo "<tr>
                    <td>{$item['id_produto']}</td>
                    <td>{$item['nome']}</td>
                    <td>{$item['quantidade']}</td>
                    <td>R$ " . number_format($item['subtotal'], 2, ',', '.') . "</td>
                  </tr>";
        }

        echo "</table>";
        echo "<p>Total parcial: R$ " . number_format($this->calcularTotal(), 2, ',', '.') . "</p>";
        echo "<hr>";
    }

    public function calcularTotal(): float
    {
        $total = 0;
        foreach ($this->carrinho as $item) {
            $total += $item['subtotal'];
        }
        return $total;
    }

    public function aplicarDesconto(string $cupom): void
    {
        $total = $this->calcularTotal();

        if (strtoupper($cupom) === 'DESCONTO10') {
            $novoTotal = $total * 0.9;
            echo "<p>Cupom aplicado: {$cupom}<br>
                  Total com desconto: R$ " . number_format($novoTotal, 2, ',', '.') . "</p>";
        } else {
            echo "<p>Cupom inválido.</p>";
        }
    }
}

//(TESTES)
$loja = new Loja();

$loja->adicionarAoCarrinho(1, 2);   // Adiciona Camisa
$loja->adicionarAoCarrinho(3, 20);  // Erro: estoque insuficiente
$loja->adicionarAoCarrinho(2, 1);   // Adiciona Blusa
$loja->removerDoCarrinho(1);        // Remove Camisa
$loja->aplicarDesconto("DESCONTO10"); // Aplica cupom
?>
