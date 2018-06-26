<?php

namespace App\Http\Controllers;
use DB;
use App\User;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function _construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $chartdata= DB::table('posts')
        ->select(DB::raw('count(posts.id) as no'))

        ->rightjoin('sports','sports.idsport','=','posts.idsport')
        ->groupBy('sports.idsport')
        ->orderBy('sports.idsport')
        ->get()
        ->toArray();
        $viewer = array_column($chartdata, 'no');


        $chartjs = app()->chartjs
        ->name('ChartTeam')
        ->type('pie')
        ->size(['width' => 700, 'height' => 350])
        ->labels(['Fotbal', 'Baschet','Handbal'])
        ->datasets([
            [
                'backgroundColor' => ['#33cc33', '#ff751a','#36A2EB'],
                'hoverBackgroundColor' => ['#33cc33', '#ff751a','#36A2EB'],
                'data' =>$viewer
            ]
        ])
        ->options([]);

        //  $user_id = auth()->user()->id;
        //  $user = User::find($user_id);
        return view('pages.index')->with(compact('chartjs',$chartjs));

    }

}
