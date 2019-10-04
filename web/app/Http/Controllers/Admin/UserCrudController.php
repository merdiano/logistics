<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\User');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/user');
        $this->crud->setEntityNameStrings('user', 'users');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setColumns([
            ['name'=>'name', 'type'=>'text', 'label' => 'Name'],
            ['name'=>'phone', 'type'=>'text', 'label' => 'Phone'],
            ['name'=>'is_admin', 'type'=>'boolean', 'label' => 'Admin'],
            ['name'=>'firebase_id', 'type'=>'text', 'label' => 'Firebase Id']
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(UserRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->addFields([
            ['name'=>'name', 'type'=>'text', 'label' => 'Name'],
            ['name'=>'phone', 'type'=>'text', 'label' => 'Phone'],
            ['name'=>'is_admin', 'type'=>'boolean', 'label' => 'Admin'],
            ['name'=>'firebase_id', 'type'=>'text', 'label' => 'Firebase Id']
        ]);

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
