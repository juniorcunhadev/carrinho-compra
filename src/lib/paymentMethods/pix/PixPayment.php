<?php

namespace src\lib\paymentMethods\pix;

use Exception;
use src\lib\paymentMethods\GenericPayment;

/**
 * Classe para representar um pagamento PIX.
 *
 * @package lib\paymentMethods\pix
 */
class PixPayment extends GenericPayment
{
    /**
     * Gera um pagamento PIX com desconto aplicado.
     *
     * @param float $amount O valor do pagamento PIX
     * @return self Uma instância de PixPayment com o desconto aplicado
     * @throws Exception Se ocorrer um erro durante a geração do pagamento
     */
    public static function generate(float $amount): self
    {
        try {

            $obPixPayment = new self();

            $obPixPayment->setAmount($amount);
            $obPixPayment->setDiscountPercentage();
            $obPixPayment->setAmountFinal(self::calculateTotalDiscount($amount));

            return $obPixPayment;

        } catch (Exception $e) {

            $error = $e->getMessage();
            throw new Exception("Erro ao gerar pagamento PIX: $error");
        }
    }
}
