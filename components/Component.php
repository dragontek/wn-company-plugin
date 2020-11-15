<?php namespace Dragontek\Company\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Schema;
use Dragontek\Company\Models\Tag;
use Dragontek\Company\Models\Role;

class Component extends ComponentBase
{

    public $item;
    public $list;
    public $table;

    public function componentDetails()
    {
    }

    public function defineProperties()
    {
        return [
            'itemId' => [
                'title' => 'dragontek.company::lang.labels.item_id',
                'description' => 'dragontek.company::lang.descriptions.item_id',
                'default' => '{{ :model }}',
            ],
            'modelIdentifier' => [
                'title' => 'dragontek.company::lang.misc.model_identifier',
                'description' => 'dragontek.company::lang.descriptions.model_identifier',
                'type' => 'dropdown',
                'options' => ['id' => 'id', 'slug' => 'slug'],
                'default' => 'id',
            ],
            'maxItems' => [
                'title' => 'dragontek.company::lang.labels.max_items',
                'description' => 'dragontek.company::lang.descriptions.max_items',
                'default' => 36,
                'type' => 'string',
                'validationPattern' => '^[0-9]+$',
            ],
            'orderBy' => [
                'title' => 'dragontek.company::lang.labels.order_by',
                'description' => 'dragontek.company::lang.descriptions.order_by',
                'type' => 'dropdown',
                'default' => 'id',
                'group' => 'dragontek.company::lang.labels.order',
            ],
            'sort' => [
                'title' => 'dragontek.company::lang.labels.sort',
                'description' => 'dragontek.company::lang.descriptions.sort',
                'type' => 'dropdown',
                'default' => 'desc',
                'group' => 'dragontek.company::lang.labels.order',
            ],
            'paginate' => [
                'title' => 'dragontek.company::lang.labels.paginate',
                'description' => 'dragontek.company::lang.descriptions.paginate',
                'type' => 'checkbox',
                'default' => false,
                'group' => 'dragontek.company::lang.labels.paginate',
            ],
            'page' => [
                'title' => 'dragontek.company::lang.labels.page',
                'description' => 'dragontek.company::lang.descriptions.page',
                'type' => 'string',
                'default' => '1',
                'validationPattern' => '^[0-9]+$',
                'group' => 'dragontek.company::lang.labels.paginate',
            ],
            'perPage' => [
                'title' => 'dragontek.company::lang.labels.per_page',
                'description' => 'dragontek.company::lang.descriptions.per_page',
                'type' => 'string',
                'default' => '12',
                'validationPattern' => '^[0-9]+$',
                'group' => 'dragontek.company::lang.labels.paginate',
            ],
        ];
    }

    public function getSortOptions()
    {
        return [
            'desc' => Lang::get('dragontek.company::lang.labels.descending'),
            'asc' => Lang::get('dragontek.company::lang.labels.ascending'),
        ];
    }

    public function getOrderByOptions()
    {
        $schema = Schema::getColumnListing($this->table);
        foreach ($schema as $column) {
            $options[$column] = ucwords(str_replace('_', ' ', $column));
        }
        return $options;
    }

}
