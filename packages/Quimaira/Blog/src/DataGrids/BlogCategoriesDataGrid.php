<?php

namespace Quimaira\Blog\DataGrids;

use Illuminate\Support\Facades\DB;
use Webkul\Ui\DataGrid\DataGrid;

class BlogCategoriesDataGrid extends DataGrid
{

    protected $index = 'id';

    protected $sortOrder = 'desc';

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('blog_categories')
            ->select('id', 'order', 'name')
            ->orderBy('order', 'DESC');


        $this->addFilter('id', 'id');
        $this->addFilter('order', 'order');
        $this->addFilter('name', 'name');

        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => trans('admin::app.datagrid.id'),
            'type'       => 'number',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'order',
            'label'      => 'orden',
            'type'       => 'number',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'name',
            'label'      => trans('admin::app.datagrid.name'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);
    }

    public function prepareActions()
    {
        $this->addAction([
            'title'  => trans('admin::app.datagrid.edit'),
            'method' => 'GET',
            'route'  => 'admin.blog.categories.edit',
            'icon'   => 'icon pencil-lg-icon',
        ]);

        $this->addAction([
            'title'        => trans('admin::app.datagrid.delete'),
            'method'       => 'POST',
            'route'        => 'admin.blog.categories.delete',
            'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => 'blog categoria']),
            'icon'         => 'icon trash-icon',
        ]);
    }
}
