<?php

namespace App\Services;

use Yajra\Datatables\Datatables;

class Services
{
    /**
     * Generate Flash Session
     * For Notification
     */
    public function notif($message, $type)
    {
        session()->flash('message', $message);
        session()->flash('type', $type);
    }

    public function dataTable($model)
    {
        return Datatables::of($model);
    }
}
