<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Ease\FuelUX;

/**
 * Description of Pillbox
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 * @link http://getfuelux.com/javascript.html#pillbox Usage
 */
class Pillbox extends \Ease\Html\DivTag
{
    /**
     *
     * @var array 
     */
    public $pillsAvailble = [];

    /**
     *
     * @var array 
     */
    public $pillsEnabled = [];

    /**
     * Nest for Pills
     * 
     * @var \Ease\Html\UlTag
     */
    public $pillGroup = null;

    /**
     *
     * @var type 
     */
    public $options = ['edit' => true];

    /**
     * 
     * @param type $enabled
     * @param type $availble
     * @param array $properties
     */
    public function __construct($enabled, $availble = [], $properties = [])
    {
        $this->pillsAvailble           = $availble;
        $this->pillsEnabled            = $enabled;
        $properties['data-initialize'] = 'pillbox';
        parent::__construct(null, $properties);
        $this->pillGroup               = $this->addItem(new \Ease\Html\UlTag(null,
            ['class' => 'clearfix pill-group']));
        foreach ($enabled as $pill) {
            $this->addPill(is_array($pill) ? $pill : ['name' => $pill, 'code' => $pill,
                    'type' => 'success']);
        }

        foreach ($availble as $pill) {
            $this->addPill(is_array($pill) ? $pill : ['name' => $pill, 'code' => $pill,
                    'type' => 'default']);
        }

        $this->addTagClass('pillbox');
        Part::fuelUXize();
    }

    /**
     * 
     * @param array $pillInfo
     */
    public function addPill($pillInfo)
    {
        $this->pillGroup->addItem(self::pill($pillInfo));
    }

    /**
     * 
     * @param array $pillInfo
     * 
     * @return \Ease\Html\LiTag
     */
    public static function pill($pillInfo)
    {
        return new \Ease\Html\LiTag([new \Ease\Html\Span($pillInfo['name']), new \Ease\Html\Span(new \Ease\Html\Span(_('Remove'),
                ['class' => 'sr-only']),
                ['class' => 'glyphicon glyphicon-close'])],
            ['class' => 'btn btn-'.$pillInfo['type'].' pill', 'data-value' => $pillInfo['code']]);
    }

    /**
     * 
     * @return \Ease\Html\LiTag
     */
    public static function inputDropdown()
    {
        return new \Ease\Html\LiTag([new \Ease\Html\ATag(null,
                [' '._('and').' ', new \Ease\Html\SpanTag(null,
                    ['class' => 'pillbox-more-count']), ' '._('more ...')],
                ['class' => 'pillbox-more']),
            new \Ease\Html\InputTextTag(null, null,
                ['class' => 'form-control dropdown-toggle pillbox-add-item', 'placeholder' => _('add item')]),
            new \Ease\Html\ButtonTag([new \Ease\Html\SpanTag(null,
                    ['class' => 'caret']),
                new \Ease\Html\SpanTag(_('Toggle dropdown'),
                    ['class' => 'sr-only'])],
                ['class' => 'dropdown-toggle sr-only']),
            new \Ease\Html\UlTag("<li data-value='options'>options</li>",
                ['class' => 'suggest dropdown-menu', 'role' => 'menu', 'data-toggle' => 'dropdown',
                'data-flip' => 'auto'])
            ], ['class' => 'pillbox-input-wrap btn-group']);
    }

    public function finalize()
    {
        $this->addJavaScript("$('#".$this->getTagID()."').pillbox({
           ,

           });");

        $this->includeJavaScript('//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.7.0/underscore-min.js');
        $this->includeJavaScript('https://www.fuelcdn.com/fuelux-utilities/1.0.0/js/fuelux-utilities.min.js');
        parent::finalize();
    }

    static function prepareListing($options)
    {
        foreach ($options as $code => $name) {
            $opts[] = "     text: '".$name."',\n     value: '".$code."'\n";
        }
        return "[{ \n".implode("}, {\n", $opts).' }]';
    }
}
