<?php

namespace Quimaira\Contactos\DataGrids;

use Illuminate\Support\Facades\DB;
use Webkul\Ui\DataGrid\DataGrid;

class ContactosDataGrid extends DataGrid
{

  protected $index = 'con_id';

  protected $sortOrder = 'desc';

  public function prepareQueryBuilder()
  {
    $queryBuilder = DB::table('contactos as con')
      ->select('con.id as con_id', 'con.nombre as con_name', 'con.telefono as con_telefono')
      ->orderBy('con_id', 'DESC');


    $this->addFilter('con_id', 'con.id');

    $this->setQueryBuilder($queryBuilder);
  }

  public function addColumns()
  {
    $this->addColumn([
      'index'      => 'con_id',
      'label'      => trans('admin::app.datagrid.id'),
      'type'       => 'number',
      'searchable' => false,
      'sortable'   => true,
      'filterable' => true,
    ]);

    $this->addColumn([
      'index'      => 'con_name',
      'label'      => trans('admin::app.datagrid.name'),
      'type'       => 'string',
      'searchable' => true,
      'sortable'   => true,
      'filterable' => true,
    ]);

    $this->addColumn([
      'index'      => 'con_telefono',
      'label'      => 'Telefono',
      'type'       => 'number',
      'searchable' => false,
      'sortable'   => true,
      'filterable' => true,
    ]);
  }

  public function prepareActions()
  {
    $this->addAction([
      'title'  => trans('admin::app.datagrid.view'),
      'method' => 'GET',
      'route'  => 'admin.customers.contactos.view',
      'icon'   => 'icon eye-icon',
      //            'icon'   => 'fas fa-eye',
    ]);
  }
}
