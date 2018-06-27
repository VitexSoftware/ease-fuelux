<?php
/**
 * Ease\FuelUX - Unit Test bootstrap
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 * @copyright (c) 2018, Vítězslav Dvořák
 */

namespace Ease;

if (file_exists('../vendor/autoload.php')) {
    require_once '../vendor/autoload.php'; //Test Run
} else {
    require_once 'vendor/autoload.php'; //Create Test
}

$oPage = new TWB\WebPage();
\Ease\Shared::webPage( $oPage );
