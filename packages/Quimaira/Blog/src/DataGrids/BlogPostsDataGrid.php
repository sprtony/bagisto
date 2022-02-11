<?php

namespace Quimaira\Blog\DataGrids;

use Illuminate\Support\Facades\DB;
use Webkul\Ui\DataGrid\DataGrid;

class BlogPostsDataGrid extends DataGrid
{

    protected $index = 'bp_id';

    protected $sortOrder = 'desc';

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('blog_posts as bp')
            ->select('bp.id as bp_id', 'bp.titulo as bp_titulo', 'bp.vistas as bp_vistas', 'bp.fecha as bp_fecha', 'bc.name as bc_name')
            ->leftJoin('blog_categories as bc', 'bp.category_id', '=', 'bc.id')
            ->orderBy('bp.id', 'DESC');


        $this->addFilter('bp_id', 'bp.id');
        $this->addFilter('bp_titulo', 'bp.titulo');
        $this->addFilter('bp_vistas', 'bp.vistas');
        $this->addFilter('bp_fecha', 'bp.fecha');
        $this->addFilter('bc_name', 'bc.name');

        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
    {
        $this->addColumn([
            'index'      => 'bp_id',
            'label'      => trans('admin::app.datagrid.id'),
            'type'       => 'number',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'bp_titulo',
            'label'      => 'Titulo',
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'bp_vistas',
            'label'      => 'Vistas',
            'type'       => 'number',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'bp_fecha',
            'label'      => 'Fecha',
            'type'       => 'date',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'bc_name',
            'label'      => 'Categoria',
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
            'route'  => 'admin.blog.posts.edit',
            'icon'   => 'icon pencil-lg-icon',
        ]);

        $this->addAction([
            'title'        => trans('admin::app.datagrid.delete'),
            'method'       => 'POST',
            'route'        => 'admin.blog.posts.delete',
            'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => 'blog posts']),
            'icon'         => 'icon trash-icon',
        ]);
    }
}
