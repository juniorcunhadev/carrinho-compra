<?php

namespace src\lib\paymentMethods;

use Exception;

/**
 * Classe abstrata GenericPayment para métodos de pagamento genéricos.
 *
 * @package lib\paymentMethods
 */
abstract class GenericPayment
{
    protected const DISCOUNT_PERCENTAGE = 0.1;

    protected float $amount;
    protected float $amountFinal;
    protected float $discountPercentage;

    /**
     * Obtém o valor original.
     *
     * @return float O valor original
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * Define o valor original.
     *
     * @param float $amount O valor original
     * @throws Exception Se o valor fornecido for negativo
     */
    protected function setAmount(float $amount): void
    {
        if ($amount < 0) {

            throw new Exception('O valor não pode ser negativo.');
        }

        $this->amount = $amount;
    }

    /**
     * Obtém o valor final.
     *
     * @return float O valor final
     */
    public function getAmountFinal(): float
    {
        return $this->amountFinal;
    }

    /**
     * Define o valor final.
     *
     * @param float $amountFinal O valor final
     * @throws Exception Se o valor final for negativo
     */
    protected function setAmountFinal(float $amountFinal): void
    {
        if ($amountFinal < 0) {

            throw new Exception('O valor final não pode ser negativo.');
        }

        $this->amountFinal = $amountFinal;
    }

    /**
     * Obtém o percentual de desconto.
     *
     * @return float O percentual de desconto
     */
    public function getDiscountPercentage(): float
    {
        return $this->discountPercentage;
    }

    /**
     * Define o percentual de desconto padrão.
     */
    protected function setDiscountPercentage(): void
    {
        $this->discountPercentage = self::DISCOUNT_PERCENTAGE;
    }

    /**
     * Calcula o valor total com desconto aplicado.
     *
     * @param float $amount O montante original
     * @return float O montante com desconto aplicado
     */
    protected static function calculateTotalDiscount(float $amount): float
    {
        return $amount - ($amount * self::DISCOUNT_PERCENTAGE);
    }
}
