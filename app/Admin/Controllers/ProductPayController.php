<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\ProductPay;

class ProductPayController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ProductPay';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ProductPay());

        $grid->column('id', __('Id'));
        $grid->column('nameProduct', __('NameProduct'));
        $grid->column('quantity', __('Quantity'));
        $grid->column('amount', __('Amount'));
        $grid->column('payment_id', __('Payment id'));
        $grid->column('status', __('Status'));
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
        $show = new Show(ProductPay::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nameProduct', __('NameProduct'));
        $show->field('quantity', __('Quantity'));
        $show->field('amount', __('Amount'));
        $show->field('payment_id', __('Payment id'));
        $show->field('status', __('Status'));
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
        $form = new Form(new ProductPay());

        $form->text('nameProduct', __('NameProduct'));
        $form->number('quantity', __('Quantity'));
        $form->decimal('amount', __('Amount'));
        $form->text('payment_id', __('Payment id'));
        $form->text('status', __('Status'));

        return $form;
    }
}
