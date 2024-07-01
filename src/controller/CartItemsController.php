<?php

namespace src\controller;

use Exception;

/**
 * Classe CartItemsController.
 *
 * Esta classe representa um controlador para itens de carrinho de compras.
 * Cada item do carrinho possui nome, preço e quantidade.
 *
 * @package controller
 */
class CartItemsController
{
    private string $name;
    private float $price;
    private int $quantity;

    /**
     * Construtor da classe CartItemsController.
     *
     * @param string $name Nome do item (padrão: 'SEM DESCRIÇÃO')
     * @param float $price Preço do item (padrão: 0)
     * @param int $quantity Quantidade do item (padrão: 1)
     * @throws Exception
     */
    public function __construct(string $name = 'SEM DESCRIÇÃO', float $price = 0, int $quantity = 1)
    {
        $this->setName($name);
        $this->setPrice($price);
        $this->setQuantity($quantity);
    }

    /**
     * Obtém o nome do item.
     *
     * @return string O nome do item
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Define o nome do item.
     *
     * @param string $name Novo nome do item
     * @throws Exception Se o nome fornecido for vazio
     */
    private function setName(string $name): void
    {
        if (empty($name)) {

            throw new Exception('O nome do item não pode ser vazio.');
        }

        $this->name = $name;
    }

    /**
     * Obtém o preço do item.
     *
     * @return float O preço do item
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Define o preço do item.
     *
     * @param float $price Novo preço do item
     * @throws Exception Se o preço fornecido for negativo
     */
    private function setPrice(float $price): void
    {
        if ($price < 0) {

            throw new Exception('O preço do item não pode ser negativo.');
        }

        $this->price = $price;
    }

    /**
     * Obtém a quantidade do item.
     *
     * @return int A quantidade do item
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * Define a quantidade do item.
     *
     * @param int $quantity Nova quantidade do item
     * @throws Exception Se a quantidade fornecida for menor ou igual a zero
     */
    private function setQuantity(int $quantity): void
    {
        if ($quantity <= 0) {

            throw new Exception('A quantidade do item deve ser maior que zero.');
        }

        $this->quantity = $quantity;
    }
}
