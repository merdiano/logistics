<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BidRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BidCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class BidCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Bid');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/bid');
        $this->crud->setEntityNameStrings('bid', 'bids');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setColumns([
            ['name'=>'owner_id', 'type'=>'select', 'entity'=>'user','attribute'=>'phone', 'label' => 'Bidder'],
            ['name'=>'proposed_cost', 'type'=>'number', 'label' => 'Proposed cost'],
            ['name'=>'estimated_time', 'type'=>'text', 'label' => 'Proposed time'],
            ['name'=>'estimated_time_unit', 'type'=>'text', 'label' => 'Proposed time unit'],
            ['name'=>'application_id', 'type'=>'select','label'=>'Application','entity'=>'application','attribute'=>'title'],
            ['name'=>'created_at','type'=>'dateTime','label'=>'Bidded at']
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(BidRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->addFields([
            ['name'=>'owner_id', 'type'=>'select', 'entity'=>'user','attribute'=>'phone', 'label' => 'Bidder'],
            ['name'=>'proposed_cost', 'type'=>'number', 'label' => 'Proposed cost'],
            ['name'=>'estimated_time', 'type'=>'number', 'label' => 'Proposed time'],
            ['name'=>'estimated_time_unit', 'type'=>'enum', 'label' => 'Proposed time unit'],
            ['name'=>'application_id', 'type'=>'select','label'=>'Application','entity'=>'application','attribute'=>'title'],

        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
