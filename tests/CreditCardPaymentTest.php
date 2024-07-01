<?php

namespace tests;

use Exception;
use src\lib\paymentMethods\creditCard\CreditCardData;
use src\lib\paymentMethods\creditCard\CreditCardPayment;
use src\lib\paymentMethods\InstallmentOptions;
use PHPUnit\Framework\TestCase;

/**
 * Testes unitários para verificar o funcionamento correto da classe CreditCardPayment.
 *
 * Esta classe contém métodos de teste para garantir que a geração de pagamentos com cartão de crédito,
 * tanto à vista quanto parcelado, esteja funcionando conforme esperado. Utiliza-se o PHPUnit para
 * realizar as asserções e verificar o comportamento dos métodos da classe CreditCardPayment.
 *
 * @package tests
 */
class CreditCardPaymentTest extends TestCase
{
    private const TITULAR_NAME = 'Fulano de Tal';
    private const CARD_NUMBER = '1111 2222 3333 4444';
    private const EXPIRATION_DATA = '12/25';
    private const CVV_CODE = '123';

    /**
     * Testa a geração de um pagamento à vista com cartão de crédito.
     *
     * Este teste verifica se um desconto de 10% foi aplicado corretamente ao gerar um pagamento à vista
     * com cartão de crédito usando a opção de parcela única (à vista).
     *
     * @throws Exception Se ocorrer um erro durante a geração do pagamento.
     */
    public function testGenerateSingleInstallment(): void
    {
        // Dados do cartão de crédito
        $creditCardData = new CreditCardData(self::TITULAR_NAME, self::CARD_NUMBER, self::EXPIRATION_DATA, self::CVV_CODE);

        // Gerando um pagamento à vista
        $payment = CreditCardPayment::generate(100.00, InstallmentOptions::PARCELA_01, $creditCardData);

        // Verificando se o desconto foi aplicado corretamente
        $this->assertEquals(90.00, $payment->getAmountFinal());
    }

    /**
     * Testa a geração de um pagamento parcelado com cartão de crédito.
     *
     * Este teste verifica se o sistema gera corretamente um pagamento parcelado em 3 vezes
     * com cartão de crédito, e se o valor final com juros é calculado adequadamente.
     *
     * @throws Exception Se ocorrer um erro durante a geração do pagamento.
     */
    public function testGenerateMultipleInstallments(): void
    {
        // Dados do cartão de crédito
        $creditCardData = new CreditCardData(self::TITULAR_NAME, self::CARD_NUMBER, self::EXPIRATION_DATA, self::CVV_CODE);

        // Gerando um pagamento parcelado em 3 vezes
        $payment = CreditCardPayment::generate(300.00, InstallmentOptions::PARCELA_03, $creditCardData);

        // Verificando o número total de parcelas
        $this->assertEquals(3, $payment->getTotalInstallments());

        // Verificando o valor final com juros
        $this->assertEqualsWithDelta(309.09, $payment->getAmountFinal(), 0.01);
    }
}
