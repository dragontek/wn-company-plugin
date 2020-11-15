<?php namespace Dragontek\Company\Models;

/**
 * Tag Model
 */
class Tag extends Model
{
    use \October\Rain\Database\Traits\Sluggable;

    /**
     * @var array Generate slugs for these attributes.
     */
    protected $slugs = ['slug' => 'name'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'dragontek_company_tags';
    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [
        'projects' => [
            'Dragontek\Company\Models\Project',
            'table' => 'dragontek_company_pivots',
        ],
        'services' => [
            'Dragontek\Company\Models\Service',
            'table' => 'dragontek_company_pivots',
        ],
        'galleries' => [
            'Dragontek\Company\Models\Gallery',
            'table' => 'dragontek_company_pivots',
        ],
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'picture' => ['System\Models\File'],
    ];
    public $attachMany = [
        'pictures' => ['System\Models\File'],
    ];

    public function afterDelete()
    {
        parent::afterDelete();
        $this->projects()->detach();
        $this->services()->detach();
        $this->galleries()->detach();
    }

}
