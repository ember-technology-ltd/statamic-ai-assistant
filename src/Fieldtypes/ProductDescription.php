<?php

namespace Jezzdk\StatamicAiFields\Fieldtypes;

use Statamic\Facades\Addon;
use Statamic\Fields\Fieldtype;

class ProductDescription extends Fieldtype
{
    protected $icon = 'earth';

    protected $categories = ['text'];

    /**
     * @return string
     */
    public static function title()
    {
        return 'Product Description';
    }

    function icon()
    {
        return file_get_contents(__DIR__ . '/../../resources/svg/openai.svg');
    }

    public function preload()
    {
        return ['url' => route('statamic.cp.jezzdk.statamic-ai-fields.product.description')];
    }

    protected function configFieldItems(): array
    {
        return [
            // 'temperature' => [
            //     'display' => 'Temperature',
            //     'instructions' => 'Min 0, max 2',
            //     'type' => 'text',
            //     'default' => '1',
            //     'width' => 50,
            //     'min' => 0,
            //     'max' => 2,
            //     'step' => 0.1
            // ],
        ];
    }
}
