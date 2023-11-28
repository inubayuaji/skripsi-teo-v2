<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;

class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Order';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order());

        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            $actions->disableEdit();
        });
        $grid->batchActions(function ($batch) {
            $batch->disableEdit();
        });

        $grid->column('no_invoice', __('No invoice'));
        $grid->column('costumer_id', __('Costumer id'));
        $grid->column('amount_total', __('Amount total'));
        $grid->column('shipment_address', __('Shipment address'));
        $grid->column('status', __('Status'));
        $grid->column('created_at', __('Created at'));

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
        $show = new Show(Order::findOrFail($id));

        $show->panel()
            ->tools(function ($tools) {
                $tools->disableEdit();
            });

        $show->field('no_invoice', __('No invoice'));
        $show->field('costumer_id', __('Costumer id'));
        $show->field('amount_total', __('Amount total'));
        $show->field('shipment_total', __('Shipment total'));
        $show->field('shipment_address', __('Shipment address'));
        $show->field('status', __('Status'));
        $show->field('created_at', __('Created at'));

        return $show;
    }
}
