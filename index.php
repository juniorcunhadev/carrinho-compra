<?php

require_once "vendor/autoload.php";

use src\lib\paymentMethods\pix\PixPayment;
use src\lib\paymentMethods\creditCard\CreditCardPayment;
use src\lib\paymentMethods\creditCard\CreditCardData;
use src\lib\paymentMethods\InstallmentOptions;
use src\controller\CartsController;
use src\controller\CartItemsController;

echo '<pre>';

try {

    // Criando os itens para inserir no carrinho.
    $item01 = new CartItemsController('Produto 01', 1.99, 2);
    $item02 = new CartItemsController('Produto 02', 2.99, 3);
    $item03 = new CartItemsController(price: 5.39, quantity: 1);

} catch (Exception $e) {

    echo 'Tratamento de erros...';
    echo PHP_EOL;
}

$obCartsController = new CartsController();

// Inserindo itens no carrinho de compra.
$obCartsController->setItems($item01);
$obCartsController->setItems($item02);
$obCartsController->setItems($item03);

try {

    // Finalizando carrinho de compra e apresentado objeto do mesmo com seus itens e subtotal.
    print_r($obCartsController->generateSubtotal());
    echo PHP_EOL;

} catch (Exception $e) {

    echo 'Tratamento de erros...';
    echo PHP_EOL;
}

try {

    // Gerando pagamento PIX com base no valor final do carrinho.
    print_r(PixPayment::generate($obCartsController->getSubtotal()));
    echo PHP_EOL;

} catch (Exception $e) {

    echo 'Tratamento de erros...';
    echo PHP_EOL;
}

try {

    // Gerando dados do cartão de crédito.
    $obCreditCardData = new CreditCardData(
        'Junior Cunha',
        '1111 2222 3333 4444',
        '18/32',
        '123'
    );

    // Gerando pagamento Cartão Crédito com base no valor final do carrinho.
    // Número de parcela é obrigatório utilizar o ENUM InstallmentOptions.
    print_r(CreditCardPayment::generate($obCartsController->getSubtotal(), InstallmentOptions::PARCELA_03, $obCreditCardData));
    echo PHP_EOL;

} catch (Exception $e) {

    echo 'Tratamento de erros...';
    echo PHP_EOL;
}
