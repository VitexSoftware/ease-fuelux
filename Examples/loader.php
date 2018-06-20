<?php

namespace Ease;

require_once '../vendor/autoload.php';

$oPage = new TWB\WebPage('Loader');

if($oPage->getRequestValue('load') == 'dealyed'){
    sleep(5);
}

$oPage->addItem(new FuelUX\Loader('Preloader'));

$oPage->addItem(new TWB\LinkButton('?load=dealyed', _('Show'), 'success',
        ['onClick' => "$('#Preloader').css('visibility', 'visible');"]));

$oPage->draw();
