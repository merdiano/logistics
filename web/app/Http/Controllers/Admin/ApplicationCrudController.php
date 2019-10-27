<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ApplicationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ApplicationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ApplicationCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Application');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/application');
        $this->crud->setEntityNameStrings('application', 'applications');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
//        $this->crud->setFromDb();
        $this->crud->setColumns([
            ['name'=>'owner_id', 'type'=>'select', 'entity'=>'owner','attribute'=>'phone', 'label' => 'Owner'],
//            ['name'=>'title', 'type'=>'text','label'=>'Title'],
            ['name'=>'description', 'type'=>'text','label'=>'Description'],
            ['name'=>'estimated_cost', 'type'=>'text', 'label' => 'Estimated cost'],
            ['name'=>'estimated_time', 'type'=>'text', 'label' => 'Estimated time'],
            ['name'=>'estimated_time_unit', 'type'=>'text', 'label' => 'Estimated time unit'],
            ['name'=>'pickup_location_id', 'type'=>'select','label'=>'Pickup location','entity'=>'pickup_location','attribute'=>'title_tk'],
            ['name'=>'pickup_address', 'type'=>'text','label'=>'Pickup address'],
            ['name'=>'destination_location_id', 'type'=>'select','label'=>'Pickup location','entity'=>'destination_location','attribute'=>'title_tk'],
            ['name'=>'destination_address', 'type'=>'text','label'=>'Destination address'],
            ['name'=>'bidding_ends_at','type'=>'datetime','label'=>'Bidding ends at'],
            ['name'=>'approved', 'type'=>'check','label'=>'Approved'],
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ApplicationRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->addFields([
            ['name'=>'owner_id', 'type'=>'select', 'entity'=>'owner','attribute'=>'phone', 'label' => 'Owner'],
            ['name'=>'account_id', 'type'=>'select', 'entity'=>'account','attribute'=>'name', 'label' => 'Owner Account'],
//            ['name'=>'title', 'type'=>'text','label'=>'Title'],
            ['name'=>'description', 'type'=>'text','label'=>'Description'],
            ['name'=>'estimated_cost', 'type'=>'number', 'label' => 'Estimated cost'],
            ['name'=>'estimated_time', 'type'=>'number', 'label' => 'Estimated time'],
            ['name'=>'estimated_time_unit', 'type'=>'enum', 'label' => 'Estimated time unit'],
            ['name'=>'pickup_location_id', 'type'=>'select','label'=>'Pickup location','entity'=>'pickup_location','attribute'=>'title_tk'],
            ['name'=>'pickup_address', 'type'=>'text','label'=>'Pickup address'],
            ['name'=>'destination_location_id', 'type'=>'select','label'=>'Pickup location','entity'=>'destination_location','attribute'=>'title_tk'],
            ['name'=>'destination_address', 'type'=>'text','label'=>'Destination address'],
            ['name'=>'bidding_ends_at','type'=>'datetime','label'=>'Bidding ends at'],
            ['name'=>'approved', 'type'=>'boolean','label'=>'Approved']
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
