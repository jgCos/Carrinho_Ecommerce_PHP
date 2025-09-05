# Simulador de Carrinho de Compras

## Integrantes
- Nome: Jhuan Gustavo — RA: 1993392

---

## Instruções de Execução (XAMPP)
1. Instale e inicie o XAMPP (com o Apache ativo).  
2. Copie o projeto para a pasta `htdocs` do XAMPP.  
   - Estrutura recomendada:  
     ```
     htdocs/
       carrinho/
         src/
           Loja.php
           index.php
         docs/
           projeto-1-carrinho-prd.pdf
         README.md
     ```
3. Abra no navegador:  
   ```
   http://localhost/carrinho/src/index.php
   ```

---

## Documentação

### Funcionalidades
- Adicionar item ao carrinho  
  Verifica se o produto existe, valida estoque, atualiza carrinho e reduz estoque.  

- Remover item  
  Remove produto do carrinho e restaura estoque do produto.  

- Listar itens do carrinho  
  Mostra produtos adicionados, quantidade, subtotal e total.  

- Calcular total  
  Soma todos os subtotais do carrinho.  

- Aplicar cupom de desconto  
  O cupom `DESCONTO10` concede 10% de desconto sobre o total.

### Regras de Negócio
- O produto só pode ser adicionado se existir e houver estoque suficiente.  
- Ao remover um item, o estoque é devolvido.  
- O carrinho mostra subtotal por produto e total parcial.  
- Apenas o cupom `DESCONTO10` é aceito.

### Limitação
- Não há banco de dados, apenas arrays em memória.  
- Não há sistema de login de usuário.  
- Não há formulários dinâmicos, os valores podem estar fixos no código.  
- Utiliza apenas PHP puro, rodando no XAMPP.

---

## Estrutura da Pastas
```
carrinho/
│── src/
│   ├── Loja.php       # Classe principal da loja
│   ├── index.php      # Script de teste/exemplo
│
│── docs/
│   └── projeto-1-carrinho-prd.pdf   # Documento do projeto
│
└── README.md          # Este arquivo
```
---

## Exemplo do Uso
- Adicionar produto válido: o item é incluído no carrinho, subtotal exibido e estoque atualizado.  
- Tentar adicionar além do estoque: mensagem de erro exibida.  
- Remover produto: o item é retirado do carrinho e o estoque é restaurado.  
- Aplicar o cupom `DESCONTO10`: desconto de 10% aplicado sobre o total do carrinho.  
