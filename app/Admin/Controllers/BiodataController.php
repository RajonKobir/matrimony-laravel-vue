<?php

namespace App\Admin\Controllers;

use App\Models\Biodata;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;

class BiodataController extends AdminController
{
    protected $title ='Biodatas';

    protected function grid()
    {
        $grid = new Grid(new Biodata());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User ID'));
        $grid->column('gender', __('Gender'));
        $grid->column('running_tab', __('Running Tab'));
        $grid->column('birth_date', __('Birth Date'));
        $grid->column('skin_color', __('Skin Color'));
        $grid->column('height', __('Height'));
        $grid->column('weight', __('Weight'));
        $grid->column('blood_group', __('Blood Group'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(Biodata::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User ID'));
        $show->field('gender', __('Gender'));
        $show->field('running_tab', __('Running Tab'));
        $show->field('birth_date', __('Birth Date'));
        $show->field('skin_color', __('Skin Color'));
        $show->field('height', __('Height'));
        $show->field('weight', __('Weight'));
        $show->field('blood_group', __('Blood Group'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Biodata());

        $form->text('gender', __('Gender'));
        $form->number('running_tab', __('Running Tab'));
        $form->date('birth_date', __('Birth Date'));
        $form->text('skin_color', __('Skin Color'));
        $form->text('height', __('Height'));
        $form->text('weight', __('Weight'));
        $form->text('blood_group', __('Blood Group'));

        return $form;
    }
}
