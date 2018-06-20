<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Ease\FuelUX;

/**
 * Description of Loader
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 * @link http://getfuelux.com/javascript.html#loader Usage
 */
class Loader extends \Ease\Html\DivTag
{

    public function __construct($id = null)
    {
        parent::__construct(null,
            ['class' => 'loader', 'data-initialize' => 'loader', 'id' => $id]);
        Part::fuelUXize();
    }

    public function finalize()
    {
        \Ease\Shared::webPage()->addJavascript("$('#".$this->getTagID()."').loader();");
        \Ease\Shared::webPage()->addCSS('
#'.$this->getTagID().'{
    position: absolute;
    top: 50%;
    left: 50%;
    margin-top: -50px;
    margin-left: -50px;
    width: 100px;
    height: 100px;
    visibility: hidden;S
}​
            ');
    }
}
