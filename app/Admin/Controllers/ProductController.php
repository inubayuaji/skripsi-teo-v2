<?php

namespace App\Admin\Controllers;

use App\Models\Product;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;

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

        $grid->actions(function ($actions) {
            $actions->disableDelete();
        });
        $grid->batchActions(function ($batch) {
            $batch->disableDelete();
        });

        $grid->column('name', __('Name'));
        $grid->column('price', __('Price'));
        $grid->column('stock', __('Stock'));
        $grid->column('is_active', __('Is active'))
            ->display(function ($isActive) {
                return $isActive ? 'Iya' : 'Tidak';
            });

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

        $show->panel()
            ->tools(function ($tools) {
                $tools->disableDelete();
            });

        $show->field('featured_image', __('Featured image'))
            ->image($base_url = '', $width = 200, $height = 200);
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('price', __('Price'));
        $show->field('stock', __('Stock'));
        $show->field('is_active', __('Is active'))
            ->as(function($isActive) {
                return $isActive ? 'Iya' : 'Tidak';
            });
        $show->field('created_at', __('Created at'))
            ->dateFormat('Y-m-d H:i');
        $show->field('updated_at', __('Updated at'))
            ->dateFormat('Y-m-d H:i');

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

        $form->tools(function ($tools) {
            $tools->disableDelete();
        });

        $form->image('featured_image', __('Featured image'))
            ->move('/images/products');
        $form->multipleImage('images', __('Image'))
            ->move('/images/products/images')
            ->removable();
        $form->text('name', __('Name'))
            ->required();
        $form->textarea('description', __('Description'))
            ->rows(3)
            ->required();
        $form->currency('price', __('Price'))
            ->required()
            ->symbol('Rp');
        $form->number('stock', __('Stock'))
            ->required()
            ->min(0);
        $form->switch('is_active', __('Is active'))->default(1);

        return $form;
    }
}
