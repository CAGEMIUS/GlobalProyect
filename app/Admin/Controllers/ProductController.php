<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Product;
use App\Models\Empresa;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Product';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('slug', __('Slug'));
        $grid->column('details', __('Details'));
        $grid->column('price', __('Price'));
        $grid->column('shipping_cost', __('Shipping cost'));
        $grid->column('description', __('Description'));
        $grid->column('stock', __('Stock'));
        //$grid->column('image', __('Image'));
        $grid->column('image')->image();
        $grid->column('empresa.name', __('Empresa')); // Accede al nombre de la empresa relacionada
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Product::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('slug', __('Slug'));
        $show->field('details', __('Details'));
        $show->field('price', __('Price'));
        $show->field('shipping_cost', __('Shipping cost'));
        $show->field('description', __('Description'));
        $show->field('stock', __('Stock'));
        $show->field('image', __('Image'));
        $show->field('empresa.name', __('Empresa')); // Accede al nombre de la empresa relacionada
        $show->field('empresa.NIT', __('Empresa NIT')); // Accede al NIT de la empresa relacionada
        // Agrega cualquier otro campo de la empresa que desees mostrar
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product());

        $form->text('name', __('Name'));
        $form->text('slug', __('Slug'));
        $form->text('details', __('Details'));
        $form->decimal('price', __('Price'));
        $form->decimal('shipping_cost', __('Shipping cost'));
        $form->textarea('description', __('Description'));
        $form->number('stock', __('Stock'));
        $form->image('image', __('Image')); // Si deseas cargar imágenes desde el formulario

        // Relaciona el producto con una empresa
        $form->select('empresa_id', __('Empresa'))->options(Empresa::pluck('name', 'id'));

        return $form;
    }
}
