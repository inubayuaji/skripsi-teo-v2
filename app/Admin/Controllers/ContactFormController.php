<?php

namespace App\Admin\Controllers;

use App\Models\ContactForm;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;

class ContactFormController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ContactForm';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ContactForm());

        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            $actions->disableEdit();
        });
        $grid->batchActions(function ($batch) {
            $batch->disableEdit();
        });

        $grid->column('name', __('Name'));
        $grid->column('phone_number', __('Phone number'));
        $grid->column('messages', __('Messages'))
            ->limit(50);
        $grid->column('created_at', __('Created at'))
            ->dateFormat('Y-m-d H:i');

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
        $show = new Show(ContactForm::findOrFail($id));

        $show->panel()
            ->tools(function ($tools) {
                $tools->disableEdit();
            });

        $show->field('name', __('Name'));
        $show->field('phone_number', __('Phone number'));
        $show->field('messages', __('Messages'));
        $show->field('created_at', __('Created at'))
            ->dateFormat('Y-m-d H:i');

        return $show;
    }
}
