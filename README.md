# Carrinho de Compras

## Requisitos

- PHP = 8.1
- PHPUnit = 9.0

## Instalação

1. Clone o repositório.
2. Instale as dependências usando o Composer.

```terminal
composer install
```

## Como Usar

Basta chamar o projeto em um navegador web ou rodar o mesmo pelo terminal.

## Observações

- No arquivo index.php, estão sendo gerados os objetos do carrinho de compras e dos pagamentos PIX e Cartão de Crédito, 
a fim de exemplificar todos os recursos disponíveis.


- Caso não queira que retorno o objeto e sim uma determinada informação, como o valor final da venda, basta seguir o exemplo
a seguir.

```php
PixPayment::generate($obCartsController->getSubtotal())->getAmountFinal();
```
