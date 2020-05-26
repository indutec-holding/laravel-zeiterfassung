<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TimeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TimeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TimeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Time');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/time');
        $this->crud->setEntityNameStrings('time', 'times');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'personalnummer', // The db column name
            'label' => "Personalnummer", // Table column heading
            'type' => 'Text'
            
          ]);

          $this->crud->addColumn([
            'name' => 'location', // The db column name
            'label' => "Einsatzort", // Table column heading
            'type' => 'Text'
            
          ]);

          $this->crud->addColumn([
            'name' => 'start', // The db column name
            'label' => "Check-In", // Table column heading
            'type' => 'datetime'
            
          ]);

          $this->crud->addColumn([
            'name' => 'end', // The db column name
            'label' => "Check-Out", // Table column heading
            'type' => 'datetime'
            
          ]);

          $this->crud->addColumn([
            'name'  => 'start_foto', // The db column name
            'label' => 'Check-In Foto', // Table column heading
            'type'  => 'image',
        ]);


        $this->crud->addColumn([
            'name'  => 'end_foto', // The db column name
            'label' => 'Check-Out Foto', // Table column heading
            'type'  => 'image',
        ]);
          
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(TimeRequest::class);

        $this->crud->setFromDb();

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
