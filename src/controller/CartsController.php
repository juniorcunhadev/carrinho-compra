<?php

namespace src\controller;

use Exception;

/**
 * Class CartsController
 *
 * Controlador para criar um carrinho de compras.
 *
 * @package controller
 */
class CartsController
{
    /**
     * @var CartItemsController[] $items Array de itens no carrinho.
     */
    private array $items;

    /**
     * @var float $subtotal Subtotal do carrinho.
     */
    private float $subtotal = 0;

    /**
     * Obtém os itens no carrinho.
     *
     * @return CartItemsController[] Array de objetos CartItemsController
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Adiciona um item ao carrinho.
     *
     * @param CartItemsController $item Item a ser adicionado ao carrinho.
     */
    public function setItems(CartItemsController $item): void
    {
        $this->items[] = $item;
    }

    /**
     * Obtém o subtotal atual do carrinho.
     *
     * @return float Subtotal do carrinho.
     */
    public function getSubtotal(): float
    {
        return $this->subtotal;
    }

    /**
     * Define o subtotal do carrinho.
     *
     * @param float $subtotal Novo subtotal do carrinho.
     * @throws Exception Se o subtotal fornecido for negativo.
     */
    private function setSubtotal(float $subtotal): void
    {
        if ($subtotal < 0) {

            throw new Exception('O subtotal do carrinho não pode ser negativo.');
        }

        $this->subtotal = $subtotal;
    }

    /**
     * Calcula o subtotal do carrinho com base nos itens adicionados.
     *
     * @return $this Instância atual do objeto CartsController.
     * @throws Exception
     */
    public function generateSubtotal(): self
    {
        $subtotal = 0;

        foreach ($this->getItems() as $item) {

            $subtotal +=  $item->getQuantity() * $item->getPrice();
        }

        $this->setSubtotal($subtotal);

        return $this;
    }
}
