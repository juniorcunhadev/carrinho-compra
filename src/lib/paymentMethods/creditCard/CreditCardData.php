<?php

namespace src\lib\paymentMethods\creditCard;

use Exception;

/**
 * Classe para armazenar dados de cartão de crédito.
 *
 * @package lib\paymentMethods\creditCard
 */
class CreditCardData
{
    private string $titularName;
    private string $cardNumber;
    private string $expirationDate;
    private string $cvvCode;

    /**
     * Construtor da classe CreditCardData.
     *
     * @param string $titularName Nome do titular do cartão
     * @param string $cardNumber Número do cartão de crédito
     * @param string $expirationDate Data de validade do cartão (formato MM/YY)
     * @param string $cvvCode Código de segurança CVV do cartão
     */
    public function __construct(string $titularName, string $cardNumber, string $expirationDate, string $cvvCode)
    {
        $this->setTitularName($titularName);
        $this->setCardNumber($cardNumber);
        $this->setExpirationDate($expirationDate);
        $this->setCvvCode($cvvCode);

        return $this;
    }

    /**
     * Obtém o nome do titular do cartão.
     *
     * @return string O nome do titular do cartão
     */
    public function getTitularName(): string
    {
        return $this->titularName;
    }

    /**
     * Define o nome do titular do cartão.
     *
     * @param string $titularName O nome do titular do cartão
     * @throws Exception Se o nome do titular for vazio ou inválido
     */
    private function setTitularName(string $titularName): void
    {
        if (empty($titularName)) {

            throw new Exception('O nome do titular do cartão não pode ser vazio.');
        }

        $this->titularName = $titularName;
    }

    /**
     * Obtém o número do cartão de crédito.
     *
     * @return string O número do cartão de crédito
     */
    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    /**
     * Define o número do cartão de crédito.
     *
     * @param string $cardNumber O número do cartão de crédito
     */
    private function setCardNumber(string $cardNumber): void
    {
        $this->cardNumber = $cardNumber;
    }

    /**
     * Obtém a data de validade do cartão.
     *
     * @return string A data de validade do cartão (formato MM/YY)
     */
    public function getExpirationDate(): string
    {
        return $this->expirationDate;
    }

    /**
     * Define a data de validade do cartão.
     *
     * @param string $expirationDate A data de validade do cartão (formato MM/YY)
     */
    private function setExpirationDate(string $expirationDate): void
    {
        $this->expirationDate = $expirationDate;
    }

    /**
     * Obtém o código de segurança CVV do cartão.
     *
     * @return string O código de segurança CVV do cartão
     */
    public function getCvvCode(): string
    {
        return $this->cvvCode;
    }

    /**
     * Define o código de segurança CVV do cartão.
     *
     * @param string $cvvCode O código de segurança CVV do cartão
     */
    private function setCvvCode(string $cvvCode): void
    {
        $this->cvvCode = $cvvCode;
    }
}
