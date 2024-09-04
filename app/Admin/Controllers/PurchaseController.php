<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Product;
use \App\Models\Purchase;

class PurchaseController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Purchase';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Purchase());

        $grid->actions(function ($actions) {
            $actions->disableEdit();
            $actions->disableDelete();
        });
        $grid->batchActions(function ($batch) {
            $batch->disableDelete();
        });

        $grid->column('vendor', 'Vendor');
        $grid->column('product_id', 'Product')->display(function () {
            return $this->product->name;
        });
        $grid->column('quantity', 'Quantity');
        $grid->column('amount_total', 'Amount total');
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
        $show = new Show(Purchase::findOrFail($id));

        $show->panel()
            ->tools(function ($tools) {
                $tools->disableEdit();
                $tools->disableDelete();
            });

        $show->field('vendor', 'Vendor');
        $show->field('product_id', 'Product')->as(function () {
            return $this->product->name;
        });
        $show->field('quantity', 'Quantity');
        $show->field('amount_total', 'Amount total');
        $show->field('created_at', __('Created at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Purchase());

        $form->tools(function ($tools) {
            $tools->disableDelete();
        });

        $form->text('vendor', 'Vendor')
            ->required();
        $form->select('product_id', __("Product"))
            ->required()
            ->options(Product::all()
            ->pluck('name', 'id'));
        $form->number('quantity', __('Quantity'))
            ->required()
            ->min(0);
        $form->currency('amount_total', __('Amount total'))
            ->required()
            ->symbol('Rp');

        $form->saving(function (Form $form) {
            $product = Product::find($form->product_id);
            $product->stock = $product->stock + $form->quantity;
            $product->save();
        });

        return $form;
    }
}
