<?php

namespace App\Helpers;

use Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\LogActivity as LogActivityModel;
use App\Models\ApplicationLog as ApplicationLogModel;
use App\Models\AddStudent;

class ApplicationLogHelper
{
    public static function addToLog($subject, $student_id){
        $log = [];
        $log['subject'] = $subject;
    	$log['url'] = Request::fullUrl();
    	$log['method'] = Request::method();
    	$log['ip'] = Request::ip();
    	$log['agent'] = Request::header('user-agent');
    	$log['user_id'] = auth()->check() ? auth()->user()->id : 1;
        $log['student_id'] = $student_id;
    	ApplicationLogModel::create($log);
    }
    public static function logActivityLists($student_id)
    {
        $student_id = $student_id;
    	return ApplicationLogModel::where('student_id', $student_id)->latest()->get();
    }
	public static function paginate($items, $perPage = 9, $page = null){
		$page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($items);
        $currentpage = $page;
        $offset = ($currentpage * $perPage) - $perPage ;
        $itemstoshow = array_slice($items , $offset , $perPage);
        return new LengthAwarePaginator($itemstoshow ,$total   ,$perPage);
	}
}
