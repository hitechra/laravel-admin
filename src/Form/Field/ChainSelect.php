<?php

namespace Hitechra\Admin\Form\Field;

use Hitechra\Admin\Facades\Admin;
use Hitechra\Admin\Form\Field\Select as FieldSelect;
use Illuminate\Support\Str;

class ChainSelect extends FieldSelect
{
    protected $view = 'admin::form.select';

    /**
     * Load options for other select on change.
     *
     * @param string $field
     * @param string $sourceUrl
     * @param string $idField
     * @param string $textField
     *
     * @return $this
     */
    public function load($field, $sourceUrl, $idField = 'id', $textField = 'text', bool $allowClear = true)
    {
        if (Str::contains($field, '.')) {
            $field = $this->formatName($field);
            $class = str_replace(['[', ']'], '_', $field);
        } else {
            $class = $field;
        }

        $placeholder = json_encode([
            'id'   => '',
            'text' => trans('admin.choose'),
        ]);

        $strAllowClear = var_export($allowClear, true);

        $script = <<<EOT
$(document).off('change', "{$this->getElementClassSelector()}");
$(document).on('change', "{$this->getElementClassSelector()}", function () {
    var target = $(this).closest('.fields-group').find(".$class");
    $.get("$sourceUrl",{q : this.value}, function (data) {
        target.find("option").remove();
        $(target).select2({
            placeholder: $placeholder,
            allowClear: $strAllowClear,
            data: $.map(data, function (d) {
                d.id = d.$idField;
                d.text = d.$textField;
                return d;
            })
        });
        if (target.data('value')) {
            $(target).val(target.data('value'));
        }
        $(target).trigger('change');
    });
});
var el = $("{$this->getElementClassSelector()}");
var target = el.closest('.fields-group').find(".$class");
$.get("$sourceUrl",{q : el.val()}, function (data) {
    target.find("option").remove();
    $(target).select2({
        placeholder: $placeholder,
        allowClear: $strAllowClear,
        data: $.map(data, function (d) {
            d.id = d.$idField;
            d.text = d.$textField;
            return d;
        })
    });
    if (target.data('value')) {
        $(target).val(target.data('value'));
    }
    $(target).trigger('change');
});
EOT;

        Admin::script($script);

        return $this;
    }
}
