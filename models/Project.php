<?php namespace Dragontek\Company\Models;

/**
 * Project Model
 */
class Project extends Model
{
    use \October\Rain\Database\Traits\Sluggable;

    /**
     * @var array Generate slugs for these attributes.
     */
    protected $slugs = ['slug' => 'name'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'dragontek_company_projects';
    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [
        'services' => [
            'Dragontek\Company\Models\Service',
            'table' => 'dragontek_company_pivots',
        ],
        'tags' => [
            'Dragontek\Company\Models\Tag',
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
        'files' => ['System\Models\File'],
    ];

    public function afterDelete()
    {
        parent::afterDelete();
        $this->services()->detach();
    }

}
