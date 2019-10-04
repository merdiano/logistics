<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LocationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class LocationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class LocationCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Location');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/location');
        $this->crud->setEntityNameStrings('location', 'locations');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setColumns([
            ['name'=>'title_tk', 'type'=>'text', 'label' => 'Title Turkmen'],
            ['name'=>'title_ru', 'type'=>'text', 'label' => 'Title Russian']
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(LocationRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->addFields([
            ['name'=>'title_tk', 'type'=>'text', 'label' => 'Title Turkmen'],
            ['name'=>'title_ru', 'type'=>'text', 'label' => 'Title Russian']
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupReorderOperation()
    {
        // define which model attribute will be shown on draggable elements
        $this->crud->set('reorder.label', 'title_tk');
        // define how deep the admin is allowed to nest the items
        // for infinite levels, set it to 0
        $this->crud->set('reorder.max_level', 3);
    }
}
