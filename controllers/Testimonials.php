<?php namespace Dragontek\Company\Controllers;

use BackendMenu;
use Flash;
use Dragontek\Company\Models\Testimonial;
use Lang;

/**
 * Testimonials Back-end Controller
 */
class Testimonials extends Controller
{

    public $requiredPermissions = ['dragontek.company.access_testimonials'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Dragontek.Company', 'company', 'testimonials');
    }

    /**
     * Deleted checked testimonials.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $testimonialId) {
                if (!$testimonial = Testimonial::find($testimonialId)) {
                    continue;
                }

                $testimonial->delete();
            }

            Flash::success(Lang::get('dragontek.company::lang.testimonials.delete_selected_success'));
        } else {
            Flash::error(Lang::get('dragontek.company::lang.testimonials.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}
