<?php

namespace Hitechra\Admin\Form\Field;

use Hitechra\Admin\Form\Field;

class Trix extends Field
{
    public static $css = ['/vendor/laravel-admin/trix/trix.css'];

    public static $js = ['/vendor/laravel-admin/trix/trix.js'];

    protected $view = 'admin::form.trix';

    public function render()
    {
        return parent::render();
    }
}
