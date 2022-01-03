<?php

namespace Sunarc\ImportExcel;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Sunarc\ImportExcel\Skeleton\SkeletonClass
 */
class ImportExcelFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ImportExcel';
    }
}
