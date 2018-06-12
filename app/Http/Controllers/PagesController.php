<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class PagesController extends Controller
{
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

        return view('pages.index')->with('chartjs',$chartjs);
    }
    public function about()
    {
        $title = 'About us';
        return view('pages.about')->with('title',$title);;
    }
    public function services()
    {
        $data= array(
            'title'=>'Servicesx',
            'services'=>['web design','seo','prog']
        );
        return view('pages.services')->with($data);
    }
}
