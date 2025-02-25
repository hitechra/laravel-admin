<?php

namespace Hitechra\Admin\Grid\Concerns;

use Closure;
use Hitechra\Admin\Grid\Tools\Footer;

trait HasFooter
{
    /**
     * @var Closure
     */
    protected $footer;

    /**
     * Set grid footer.
     *
     * @param  Closure|null  $closure
     * @return $this|Closure
     */
    public function footer(Closure $closure = null)
    {
        if (!$closure) {
            return $this->footer;
        }

        $this->footer = $closure;

        return $this;
    }

    /**
     * Render grid footer.
     *
     * @return string
     */
    public function renderFooter()
    {
        if (!$this->footer) {
            return '';
        }

        return (new Footer($this))->render();
    }
}
