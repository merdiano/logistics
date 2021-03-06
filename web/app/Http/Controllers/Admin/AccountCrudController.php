<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AccountRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AccountCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class AccountCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Account');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/account');
        $this->crud->setEntityNameStrings('account', 'accounts');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setColumns([
            ['name'=>'user_id','type'=>'select','entity'=>'user','attribute'=>'phone','label'=>'User'],
            ['name'=>'name','type'=>'text','label'=>'Name'],
            ['name'=>'about','type'=>'text','label'=>'About'],
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(AccountRequest::class);

        // TODO: remove setFromDb() and manually define Fields
//        $this->crud->setFromDb();
        $this->crud->addFields([
            ['name'=>'user_id','type'=>'select','entity'=>'user','attribute'=>'phone','label'=>'User'],
            ['name'=>'name','type'=>'text','label'=>'Name'],
            ['name'=>'about','type'=>'text','label'=>'About'],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
