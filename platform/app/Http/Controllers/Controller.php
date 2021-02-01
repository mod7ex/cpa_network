<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    

    
    /**
     * @param mixed $id
     * 
     * @return MongoDB\BSON\ObjectId
     */
    protected function mongoId($id)
    {
        return new \MongoDB\BSON\ObjectId($id);
    }
    

    /**
     * @param mixed $date
     * 
     * @return \MongoDB\BSON\UTCDateTime
     */
    protected function mongoDate($date)
    {
        return new \MongoDB\BSON\UTCDateTime(strtotime($date) * 1000);
    }
}