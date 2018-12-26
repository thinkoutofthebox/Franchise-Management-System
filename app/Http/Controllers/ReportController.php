<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FranchiseStudent;

class ReportController extends Controller
{
    public function reportForm(Request $request)
    {
    	return view('franchise.reports.default.report_main');
    }

    public function generateReport(Request $request)
    {
    	$user = $request->user();
    	$post_data = $request->all();
    	$students = FranchiseStudent::where('user_id', $user->id)
    									->whereDate('created_at', '>=', $post_data['start_date'])
    									->whereDate('created_at', '<=', $post_data['end_date'])
    									->paginate(20);
    	return view('franchise.reports.default.load_report',['students' => $students]);
    }


}
