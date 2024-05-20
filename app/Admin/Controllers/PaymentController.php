<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Payment;

class PaymentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Payment';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Payment());

        $grid->column('id', __('Id'));
        $grid->column('payment_id', __('Payment id'));
        $grid->column('payer_id', __('Payer id'));
        $grid->column('payer_email', __('Payer email'));
        $grid->column('amount', __('Amount'));
        $grid->column('currency', __('Currency'));
        $grid->column('payment_status', __('Payment status'));
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
        $show = new Show(Payment::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('payment_id', __('Payment id'));
        $show->field('payer_id', __('Payer id'));
        $show->field('payer_email', __('Payer email'));
        $show->field('amount', __('Amount'));
        $show->field('currency', __('Currency'));
        $show->field('payment_status', __('Payment status'));
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
        $form = new Form(new Payment());

        $form->text('payment_id', __('Payment id'));
        $form->text('payer_id', __('Payer id'));
        $form->text('payer_email', __('Payer email'));
        $form->decimal('amount', __('Amount'));
        $form->text('currency', __('Currency'));
        $form->text('payment_status', __('Payment status'));

        return $form;
    }
}
