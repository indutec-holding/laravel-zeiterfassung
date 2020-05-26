<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EmployeeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class EmployeeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EmployeeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Employee');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/employee');
        $this->crud->setEntityNameStrings('employee', 'employees');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'name'     => 'personalnummer',
                'label'    => 'Personalnummer',
                'type'  =>  'text',
            ],
            [
                'name'     => 'vorname',
                'label'    => 'Vorname',
                'type'  =>  'text',
            ],

            [
                'name'     => 'nachname',
                'label'    => 'Nachname',
                'type'  =>  'text',
            ],
            [
                'name'     => 'geburtsdatum',
                'label'    => 'Geburtsdatum',
                'type'  =>  'text',
            ],
            [   // select_multiple: n-n relationship (with pivot table)
                'label'     => 'Standorte', // Table column heading
                'type'      => 'select_multiple',
                'name'      => 'locations', // the method that defines the relationship in your Model
                'entity'    => 'locations', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => "app\Models\Location", // foreign key model
            ],
        ]);


        $this->crud->enableExportButtons();
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(EmployeeRequest::class);

        $this->crud->addField([
            'name' => 'personalnummer',
            'type' => 'text',
            'label' => 'Personalnummer',
         ]);

         $this->crud->addField([
            'name' => 'vorname',
            'type' => 'text',
            'label' => 'Vorname',
         ]);

         $this->crud->addField([
            'name' => 'nachname',
            'type' => 'text',
            'label' => 'Nachname',
         ]);

        $this->crud->addField([
            'name' => 'geburtsdatum',
            'type' => 'date_picker',
            'label' => 'Geburtsdatum',
            // optional:
            'date_picker_options' => [
               'todayBtn' => 'linked',
               'format' => 'dd-mm-yyyy',
               'language' => 'de'
            ],
         ]);

         $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
            'label'             => 'Einsatzort(e)',
            'type'              => 'select2_multiple',
            'name'              => 'locations', // the method that defines the relationship in your Model
            'entity'            => 'locations', // the method that defines the relationship in your Model
            'attribute'         => 'name', // foreign key attribute that is shown to user
            'model'             => "App\Models\Location", // foreign key model
            'pivot'             => true, // on create&update, do you need to add/delete pivot table entries?
        ],);



    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
