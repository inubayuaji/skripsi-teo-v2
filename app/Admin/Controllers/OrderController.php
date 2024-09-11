<?php

namespace App\Admin\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
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
            // $actions->disableEdit();
            $actions->disableDelete();
        });
        $grid->batchActions(function ($batch) {
            $batch->disableEdit();
        });

        $grid->column('no_invoice', __('No invoice'));
        $grid->column('costumer_id', __('Costumer id'))->display(function () {
            return $this->customer->name;
        });
        $grid->column('amount_total', __('Amount total'));
        $grid->column('shipment_address', __('Shipment address'));
        $grid->column('status', __('Status'))->display(function () {
            switch($this->status) {
                case 'N':
                    return 'Baru';
                break;
                case 'S':
                    return 'Pengiriman';
                break;
                case 'D':
                    return 'Selesai';
                break;
                case 'C':
                    return 'Batal';
                break;
            }
        });
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
                // $tools->disableEdit();
                $tools->disableDelete();
            });

        $show->field('no_invoice', __('No invoice'));
        $show->field('costumer_id', __('Costumer id'))->as(function () {
            return $this->customer->name;
        });
        $show->field('amount_total', __('Amount total'));
        $show->field('shipment_total', __('Shipment total'));
        $show->field('shipment_address', __('Shipment address'));
        $show->field('status', __('Status'))
            ->as(function () {
                switch($this->status) {
                    case 'N':
                        return 'Baru';
                    break;
                    case 'S':
                        return 'Pengiriman';
                    break;
                    case 'D':
                        return 'Selesai';
                    break;
                    case 'C':
                        return 'Batal';
                    break;
                }
            });
        $show->field('payment_proof', __('Payment proof'))
            ->image($base_url = '', $width = 200, $height = 200);
        $show->field('created_at', __('Created at'));

        $show->lines('Order line', function ($line) {
            $line->product_id()->display(function () {
                return $this->product->name;
            });
            $line->quantity();
            $line->price();
            $line->amount_total();

            $line->disableCreateButton();
            $line->actions(function ($actions) {
                $actions->disableEdit();
                $actions->disableDelete();
                $actions->disableView();
            });
            $line->batchActions(function ($batch) {
                $batch->disableEdit();
            });
            $line->disableFilter();
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Order());

        $form->tools(function ($tools) {
            $tools->disableDelete();
        });

        $form->select('status', __('Status'))
            ->options([
                'N' => 'Baru', // new
                'S' => 'Pengirimian', // shipment
                'D' => 'Selesai', // done
                'C' => 'Batal', // cancle
            ]);

        return $form;
    }
}
