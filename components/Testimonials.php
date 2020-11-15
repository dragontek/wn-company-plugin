<?php namespace Dragontek\Company\Components;

use Dragontek\Company\Models\Testimonial;

class Testimonials extends Component
{
    public $table = 'dragontek_company_testimonials';

    public function componentDetails()
    {
        return [
            'name' => 'dragontek.company::lang.components.testimonials.name',
            'description' => 'dragontek.company::lang.components.testimonials.description',
        ];
    }

    public function onRun()
    {
        $this->page['testimonial'] = $this->testimonial();
        $this->page['testimonials'] = $this->testimonials();
    }

    public function testimonial()
    {
        if (!empty($this->property('itemId'))) {
            if ($this->item) return $this->item;
            return $this->item = Testimonial::where($this->property('modelIdentifier', 'id'), $this->property('itemId'))
                ->with('picture')
                ->first();
        }
    }

    public function testimonials()
    {
        if (empty($this->property('itemId'))) {
            if ($this->list) return $this->list;
            $testimonials = Testimonial::published()
                ->with('picture')
                ->orderBy($this->property('orderBy', 'id'), $this->property('sort', 'desc'))
                ->take($this->property('maxItems'));

            return $this->list = $this->property('paginate') ?
                $testimonials->paginate($this->property('perPage'), $this->property('page')) :
                $testimonials->get();
        }
    }

    public function defineProperties()
    {
        $properties = parent::defineProperties();

        $properties['modelIdentifier'] = [
            'title' => 'dragontek.company::lang.misc.model_identifier',
            'description' => 'dragontek.company::lang.descriptions.model_identifier',
            'type' => 'dropdown',
            'options' => ['id' => 'id'],
            'default' => 'id',
        ];

        return $properties;
    }
}
