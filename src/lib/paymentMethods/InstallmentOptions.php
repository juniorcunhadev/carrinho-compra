<?php

namespace src\lib\paymentMethods;

/**
 * Enumeração para opções de parcelamento.
 */
enum InstallmentOptions : int {
    case PARCELA_01 = 1; // Primeira parcela
    case PARCELA_02 = 2; // Segunda parcela
    case PARCELA_03 = 3; // Terceira parcela
    case PARCELA_04 = 4; // Quarta parcela
    case PARCELA_05 = 5; // Quinta parcela
    case PARCELA_06 = 6; // Sexta parcela
    case PARCELA_07 = 7; // Sétima parcela
    case PARCELA_08 = 8; // Oitava parcela
    case PARCELA_09 = 9; // Nona parcela
    case PARCELA_10 = 10; // Décima parcela
    case PARCELA_11 = 11; // Décima primeira parcela
    case PARCELA_12 = 12; // Décima segunda parcela
}