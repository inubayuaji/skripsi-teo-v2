<?php

namespace App\Admin\Controllers;

use App\Models\Feed;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;

class FeedController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Feed';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Feed());

        $grid->actions(function ($actions) {
            // $actions->disableEdit();
            $actions->disableDelete();
        });

        $grid->column('name', 'Name');
        $grid->column('qty', 'Qty');
        $grid->column('unit', 'Unit');
        $grid->column('price', __('Price'));
        $grid->column('stock', __('Stock'));

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
        $show = new Show(Feed::findOrFail($id));

        $show->panel()
            ->tools(function ($tools) {
                $tools->disableDelete();
            });

        $show->field('name', __('Name'));
        $show->field('qty', __('Qty'));
        $show->field('unit', __('Unit'));
        $show->field('price', __('Price'));
        $show->field('stock', __('Stock'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Feed());

        $form->tools(function ($tools) {
            $tools->disableDelete();
        });

        $form->text('name', __('Name'))
            ->required();
        $form->number('qty', __('Qty'))
            ->required();
        $form->select('unit', __('Unit'))
            ->options([
                'Kg' => 'Kg',
                'Gram' => 'Gram',
                'Gelas' => 'Gelas',
                'Liter' => 'Liter',
                'Mili' => 'Mili',
            ])
            ->required();
        $form->currency('price', __('Price'))
            ->required()
            ->symbol('Rp');
        $form->number('stock', __('Stock'))
            ->required()
            ->min(0);

        return $form;
    }
}
