<?php

namespace Hitechra\Admin\Grid\Tools;

use Hitechra\Admin\Grid;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator as PaginationPaginator;

class Paginator extends AbstractTool
{
    /**
     * @var \Illuminate\Pagination\LengthAwarePaginator
     */
    protected $paginator = null;

    /**
     * @var bool
     */
    protected $perPageSelector = true;

    /**
     * @var bool
     */
    protected $useSimple = true;

    /**
     * Create a new Paginator instance.
     *
     * @param  Grid  $grid
     */
    public function __construct(Grid $grid, $perPageSelector = true, $useSimple = false)
    {
        $this->grid = $grid;
        $this->perPageSelector = $perPageSelector;
        $this->useSimple = $useSimple;

        $this->initPaginator();
    }

    /**
     * Initialize work for Paginator.
     *
     * @return void
     */
    protected function initPaginator()
    {
        $this->paginator = $this->grid->model()->eloquent();

        if ($this->paginator instanceof LengthAwarePaginator || $this->paginator instanceof PaginationPaginator) {
            $this->paginator->appends(request()->all());
        }
    }

    /**
     * Get Pagination links.
     *
     * @return string
     */
    protected function paginationLinks()
    {
        if ($this->useSimple) {
            return $this->paginator->render('admin::simplePagination');
        }

        return $this->paginator->render('admin::pagination');
    }

    /**
     * Get per-page selector.
     *
     * @return PerPageSelector
     */
    protected function perPageSelector()
    {
        if (!$this->perPageSelector) {
            return;
        }

        return new PerPageSelector($this->grid);
    }

    /**
     * Get range infomation of paginator.
     *
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    protected function paginationRanger()
    {
        $parameters = [
            'first' => $this->paginator->firstItem(),
            'last' => $this->paginator->lastItem(),
        ];

        if (!$this->useSimple) {
            $parameters['total'] = $this->paginator->total();
        }

        $parameters = collect($parameters)->flatMap(function ($parameter, $key) {
            return [$key => "<b>$parameter</b>"];
        });

        return trans('admin.pagination.range', $parameters->all());
    }

    /**
     * Render Paginator.
     *
     * @return string
     */
    public function render()
    {
        if (!$this->grid->showPagination()) {
            return '';
        }

        if ($this->useSimple) {
            return $this->paginationLinks().$this->perPageSelector();
        }

        return $this->paginationRanger().
            $this->paginationLinks().
            $this->perPageSelector();
    }
}
