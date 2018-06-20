<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Ease\FuelUX;

/**
 * Description of Part
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 */
class Part extends \Ease\TWB\Part
{

    public function __construct()
    {
        parent::__construct();
        self::fuelUXize();
    }

    public static function fuelUXize()
    {
        \Ease\TWB\Part::twBootstrapize();
        $wp = \Ease\Shared::webPage();
        $wp->includeCss('https://cdnjs.cloudflare.com/ajax/libs/fuelux/3.16.7/css/fuelux.css');
        $wp->includeJavascript('https://cdnjs.cloudflare.com/ajax/libs/fuelux/3.16.7/js/fuelux.js');
        $wp->body->addTagClass('fuelux');
    }
}
