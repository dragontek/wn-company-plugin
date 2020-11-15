<?php namespace Dragontek\Company;

use Backend;
use Backend\Facades\BackendAuth;
use System\Classes\PluginBase;

/**
 * Employees Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'dragontek.company::lang.plugin.name',
            'description' => 'dragontek.company::lang.plugin.description',
            'author' => 'Dragontek Software',
            'icon' => 'icon-building',
        ];
    }

    public function registerNavigation()
    {
        return [
            'company' => [
                'label' => 'dragontek.company::lang.plugin.name',
                'url' => Backend::url('dragontek/company/' . $this->startPage()),
                'icon' => 'icon-building',
                'permissions' => ['dragontek.company.*'],
                'order' => 500,
                'sideMenu' => [
                    'employees' => [
                        'label' => 'dragontek.company::lang.employees.menu_label',
                        'icon' => 'icon-user',
                        'url' => Backend::url('dragontek/company/employees'),
                        'permissions' => ['dragontek.company.access_employees'],
                    ],
                    'roles' => [
                        'label' => 'dragontek.company::lang.roles.menu_label',
                        'icon' => 'icon-briefcase',
                        'url' => Backend::url('dragontek/company/roles'),
                        'permissions' => ['dragontek.company.access_employees'],
                    ],
                    'projects' => [
                        'label' => 'dragontek.company::lang.projects.menu_label',
                        'icon' => 'icon-wrench',
                        'url' => Backend::url('dragontek/company/projects'),
                        'permissions' => ['dragontek.company.access_projects'],
                    ],
                    'services' => [
                        'label' => 'dragontek.company::lang.services.menu_label',
                        'icon' => 'icon-certificate',
                        'url' => Backend::url('dragontek/company/services'),
                        'permissions' => ['dragontek.company.access_services'],
                    ],
                    'galleries' => [
                        'label' => 'dragontek.company::lang.galleries.menu_label',
                        'icon' => 'icon-photo',
                        'url' => Backend::url('dragontek/company/galleries'),
                        'permissions' => ['dragontek.company.access_galleries'],
                    ],
                    'testimonials' => [
                        'label' => 'dragontek.company::lang.testimonials.menu_label',
                        'icon' => 'icon-comment',
                        'url' => Backend::url('dragontek/company/testimonials'),
                        'permissions' => ['dragontek.company.access_testimonials'],
                    ],
                    'links' => [
                        'label' => 'dragontek.company::lang.links.menu_label',
                        'icon' => 'icon-link',
                        'url' => Backend::url('dragontek/company/links'),
                        'permissions' => ['dragontek.company.access_links'],
                    ],
                    'tags' => [
                        'label' => 'dragontek.company::lang.tags.menu_label',
                        'icon' => 'icon-tag',
                        'url' => Backend::url('dragontek/company/tags'),
                        'permissions' => ['dragontek.company.access_tags'],
                    ],
                ],
            ],
        ];
    }

    public function startPage($page = 'projects')
    {
        $user = BackendAuth::getUser();
        $permissions = array_reverse(array_keys($this->registerPermissions()));
        if (!isset($user->permissions['superuser']) && $user->hasAccess('dragontek.company.*')) {
            foreach ($permissions as $access) {
                if ($user->hasAccess($access)) {
                    $page = explode('_', $access)[1];
                }
            }
        }
        return $page;
    }

    public function registerPermissions()
    {
        return [
            'dragontek.company.access_employees' => [
                'label' => 'dragontek.company::lang.employee.list_title',
                'tab' => 'dragontek.company::lang.plugin.name',
            ],
            'dragontek.company.access_projects' => [
                'label' => 'dragontek.company::lang.project.list_title',
                'tab' => 'dragontek.company::lang.plugin.name',
            ],
            'dragontek.company.access_services' => [
                'label' => 'dragontek.company::lang.service.list_title',
                'tab' => 'dragontek.company::lang.plugin.name',
            ],
            'dragontek.company.access_galleries' => [
                'label' => 'dragontek.company::lang.gallery.list_title',
                'tab' => 'dragontek.company::lang.plugin.name',
            ],
            'dragontek.company.access_links' => [
                'label' => 'dragontek.company::lang.link.list_title',
                'tab' => 'dragontek.company::lang.plugin.name',
            ],
            'dragontek.company.access_testimonials' => [
                'label' => 'dragontek.company::lang.testimonial.list_title',
                'tab' => 'dragontek.company::lang.plugin.name',
            ],
            'dragontek.company.access_tags' => [
                'label' => 'dragontek.company::lang.tag.list_title',
                'tab' => 'dragontek.company::lang.plugin.name',
            ],
            'dragontek.company.access_company' => [
                'label' => 'dragontek.company::lang.company.list_title',
                'tab' => 'dragontek.company::lang.plugin.name',
            ],
        ];
    }

    public function registerComponents()
    {
        return [
            'Dragontek\Company\Components\Employees' => 'Employees',
            'Dragontek\Company\Components\Roles' => 'Roles',
            'Dragontek\Company\Components\Projects' => 'Projects',
            'Dragontek\Company\Components\Services' => 'Services',
            'Dragontek\Company\Components\Galleries' => 'Galleries',
            'Dragontek\Company\Components\Company' => 'Company',
            'Dragontek\Company\Components\Testimonials' => 'Testimonials',
            'Dragontek\Company\Components\Links' => 'Links',
            'Dragontek\Company\Components\Tags' => 'Tags',
        ];
    }

    public function registerSettings()
    {
        return [
            'company' => [
                'label' => 'dragontek.company::lang.plugin.name',
                'description' => 'dragontek.company::lang.settings.description',
                'category' => 'system::lang.system.categories.system',
                'icon' => 'icon-building-o',
                'class' => 'Dragontek\Company\Models\Company',
                'order' => 500,
                'keywords' => 'dragontek.company::lang.settings.label',
                'permissions' => ['dragontek.company.access_company'],
            ],
        ];
    }

    public function register()
    {
        set_exception_handler([$this, 'handleException']);
    }

    public function handleException($e)
    {
        if (!$e instanceof Exception) {
            $e = new \Symfony\Component\Debug\Exception\FatalThrowableError($e);
        }
        $handler = $this->app->make('Illuminate\Contracts\Debug\ExceptionHandler');
        $handler->report($e);
        if ($this->app->runningInConsole()) {
            $handler->renderForConsole(new ConsoleOutput, $e);
        } else {
            $handler->render($this->app['request'], $e)->send();
        }
    }
}
