<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\MercadoPago;

class MercadoPagoController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'MercadoPago';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MercadoPago());

        $grid->column('id', __('Id'));
        $grid->column('payment_id', __('Payment id'));
        $grid->column('payer_id', __('Payer id'));
        $grid->column('status', __('Status'));
        $grid->column('payment_type', __('Payment type'));
        $grid->column('merchant_order_id', __('Merchant order id'));
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
        $show = new Show(MercadoPago::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('payment_id', __('Payment id'));
        $show->field('payer_id', __('Payer id'));
        $show->field('status', __('Status'));
        $show->field('payment_type', __('Payment type'));
        $show->field('merchant_order_id', __('Merchant order id'));
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
        $form = new Form(new MercadoPago());

        $form->text('payment_id', __('Payment id'));
        $form->text('payer_id', __('Payer id'));
        $form->text('status', __('Status'));
        $form->text('payment_type', __('Payment type'));
        $form->text('merchant_order_id', __('Merchant order id'));

        return $form;
    }
}
