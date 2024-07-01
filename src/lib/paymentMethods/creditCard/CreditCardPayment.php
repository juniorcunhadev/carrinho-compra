<?php

namespace src\lib\paymentMethods\creditCard;

use Exception;
use src\lib\paymentMethods\GenericPayment;
use src\lib\paymentMethods\InstallmentOptions;

/**
 * Classe para representar um pagamento com cartão de crédito.
 *
 * @package lib\paymentMethods\creditCard
 */
class CreditCardPayment extends GenericPayment
{
    private const INTEREST_MONTH = 0.01;

    private float $interestMonth;
    private int $totalInstallments;
    private CreditCardData $creditCardData;
    private array $creditCardInstallment;

    /**
     * Obtém a taxa de juros por mês para pagamentos parcelados.
     *
     * @return float A taxa de juros por mês
     */
    public function getInterestMonth(): float
    {
        return $this->interestMonth;
    }

    /**
     * Define a taxa de juros por mês para pagamentos parcelados.
     */
    private function setInterestMonth(): void
    {
        $this->interestMonth = self::INTEREST_MONTH;
    }

    /**
     * Obtém o número total de parcelas do pagamento.
     *
     * @return int O número total de parcelas
     */
    public function getTotalInstallments(): int
    {
        return $this->totalInstallments;
    }

    /**
     * Define o número total de parcelas do pagamento.
     *
     * @param int $totalInstallments O número total de parcelas
     */
    private function setTotalInstallment(int $totalInstallments): void
    {
        $this->totalInstallments = $totalInstallments;
    }

    /**
     * Obtém os dados do cartão de crédito associados ao pagamento.
     *
     * @return CreditCardData Os dados do cartão de crédito
     */
    public function getCreditCardData(): CreditCardData
    {
        return $this->creditCardData;
    }

    /**
     * Define os dados do cartão de crédito associados ao pagamento.
     *
     * @param CreditCardData $creditCardData Os dados do cartão de crédito
     */
    private function setCreditCardData(CreditCardData $creditCardData): void
    {
        $this->creditCardData = $creditCardData;
    }

    /**
     * Obtém as informações sobre as parcelas do pagamento parcelado com cartão de crédito.
     *
     * @return array As informações das parcelas do pagamento
     */
    public function getCreditCardInstallment(): array
    {
        return $this->creditCardInstallment;
    }

    /**
     * Define as informações sobre as parcelas do pagamento parcelado com cartão de crédito.
     *
     * @param array $creditCardInstallment As informações das parcelas do pagamento
     */
    private function setCreditCardInstallment(array $creditCardInstallment): void
    {
        $this->creditCardInstallment = $creditCardInstallment;
    }

    /**
     * Gera um pagamento com cartão de crédito com base no valor total, opções de parcelamento e dados do cartão.
     *
     * @param float $amount O valor do pagamento
     * @param InstallmentOptions $installment Opções de parcelamento do pagamento
     * @param CreditCardData $creditCardData Os dados do cartão de crédito para o pagamento
     * @return self Uma instância de CreditCardPayment representando o pagamento
     * @throws Exception Se o número de parcelas for inválido
     */
    public static function generate(float $amount, InstallmentOptions $installment, CreditCardData $creditCardData): self
    {
        $obCreditCardPayment = new self();

        $obCreditCardPayment->setAmount($amount);
        $obCreditCardPayment->setTotalInstallment($installment->value);
        $obCreditCardPayment->setCreditCardData($creditCardData);

        if ($installment === InstallmentOptions::PARCELA_01) {

            $obCreditCardPayment->setDiscountPercentage();
            $obCreditCardPayment->setAmountFinal(self::calculateTotalDiscount($amount));

            return $obCreditCardPayment;
        }

        $amountFinal = self::calculateInterest($amount, $installment->value);

        $obCreditCardPayment->setInterestMonth();
        $obCreditCardPayment->setAmountFinal($amountFinal);
        $obCreditCardPayment->setCreditCardInstallment(self::generateInstallments($amountFinal, $installment->value));

        return $obCreditCardPayment;
    }

    /**
     * Calcula o valor final com juros para um pagamento parcelado.
     *
     * @param float $amount O valor inicial do pagamento
     * @param int $installments O número de parcelas do pagamento
     * @return float O valor final com juros aplicados
     */
    private static function calculateInterest(float $amount, int $installments): float
    {
        return $amount * pow((1 + self::INTEREST_MONTH), $installments);
    }

    /**
     * Gera as informações das parcelas para um pagamento parcelado.
     *
     * @param float $amount O valor total do pagamento parcelado
     * @param int $installments O número de parcelas do pagamento
     * @return array Um array contendo as informações das parcelas
     */
    private static function generateInstallments(float $amount, int $installments): array
    {
        $res = [];

        $installmentValue = $amount / $installments;

        for ($i = 1; $i <= $installments; $i++) {

            $installmentName = "parcela_$i";
            $res[$installmentName] = $installmentValue;
        }

        return $res;
    }
}
