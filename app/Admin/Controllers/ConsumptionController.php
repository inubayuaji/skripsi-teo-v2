<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Consumption;
use App\Models\Feed;

class ConsumptionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Consumption';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Consumption());

        $grid->actions(function ($actions) {
            $actions->disableEdit();
            $actions->disableDelete();
        });
        $grid->batchActions(function ($batch) {
            $batch->disableDelete();
        });

        $grid->column('feed_id', 'Product')->display(function () {
            return $this->feed->name . ' ' . $this->feed->qty . ' ' . $this->feed->unit;
        });
        $grid->column('quantity', __('Quantity'));
        $grid->column('note', __('Note'));
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
        $show = new Show(Consumption::findOrFail($id));

        $show->panel()
            ->tools(function ($tools) {
                $tools->disableEdit();
                $tools->disableDelete();
            });

        $show->field('feed_id', __('Product'))->as(function () {
            return $this->feed->name . ' ' . $this->feed->qty . ' ' . $this->feed->unit;
        });
        $show->field('quantity', __('Quantity'));
        $show->field('note', __('Note'));
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
        $form = new Form(new Consumption());

        $form->select('feed_id', __("Product"))
            ->required()
            ->options(Feed::all()->map(function ($feed) {
                return $feed->name . ' ' . $feed->qty . ' ' . $feed->unit;
            })->toArray());
        $form->number('quantity', __('Quantity'))
            ->required()
            ->min(0);
        $form->textarea('note', __('Note'));

        $form->saving(function (Form $form) {
            $feed = Feed::find($form->feed_id);
            $feed->stock = (int)$feed->stock - (int)$form->quantity;
            $feed->save();
        });

        return $form;
    }
}
