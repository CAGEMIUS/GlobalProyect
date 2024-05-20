<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Estado;

class EstadoController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Estado';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Estado());

        $grid->column('id', __('Id'));
        $grid->column('Pendiente', __('Pendiente'));
        $grid->column('enviado', __('Enviado'));
        $grid->column('entregado', __('Entregado'));
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
        $show = new Show(Estado::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('Pendiente', __('Pendiente'));
        $show->field('enviado', __('Enviado'));
        $show->field('entregado', __('Entregado'));
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
        $form = new Form(new Estado());

        $form->text('Pendiente', __('Pendiente'));
        $form->text('enviado', __('Enviado'));
        $form->text('entregado', __('Entregado'));

        return $form;
    }
}
