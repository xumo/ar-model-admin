<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Object3dRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Illuminate\Support\Facades\Auth;

/**
 * Class Object3dCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class Object3dCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation { show as traitShow; }

   
    public function setup()
    {
        CRUD::setModel(\App\Models\Object3d::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/object3d');
        CRUD::setEntityNameStrings('object3d', 'object3ds');
    }

   
    protected function setupListOperation()
    {
        CRUD::column('name')->type('text');
        CRUD::column('object_url')->label('3D Model');
        CRUD::column('download')->label('Downloads');
        
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(Object3dRequest::class);
        
        CRUD::field('name');
        $this->crud->addField([   // Browse
            'name'  => 'object_url',
            'label' => '3D model',
            'type'  => 'browse'
        ]);
             
    }

    
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function store()
    {
        $this->crud->setOperationSetting('saveAllInputsExcept', ['_token', '_method', 'http_referrer', 'current_tab', 'save_action']);
        $this->crud->getRequest()->request->add(['user_id'=> backpack_user()->id]);
        $this->crud->getRequest()->request->set('user_id', backpack_user()->id);

        $response = $this->traitStore();
        
        return $response;
    }

    protected function setupShowOperation()
    {
        $current = $this->crud->getCurrentEntry();
        $this->crud->set('show.setFromDb', false);

        //$this->crud->addColumn('name');
        $this->crud->removeColumn('Actions');
        Widget::add([
            'type'     => 'object3d',
            'viewNamespace' => 'widgets',
            'view'     => 'widgets',
            'name' => $current->name,
            'download' => $current->download,
            'object_url'=> $current->object_url,
        ]);
        $this->crud->removeColumn('extras');
    //CRUD::removeButton('action');
    //$this->crud->removeColumn('actions');
    }
}
