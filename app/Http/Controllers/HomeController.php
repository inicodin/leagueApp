<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Player;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
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


        $user_id = auth()->user()->id;

        $idarray=DB::table('posts')->select('id')
        ->where('user_id','=',$user_id)
        ->take(1)
        ->first('id');
 // dd($idarray);
        if(empty($idarray))
        {$idarray[0]=0;
        }

        $id=reset($idarray);

       
        if(!(is_int($id)))
        {$id=0;
        }
 
        $chartdata=DB::table('games')
        ->select('p.nume as echipa1','t.nume as echipa2','games.result1','games.result2',
                 DB::raw("(CASE WHEN p.id =$id THEN result1 ELSE result2 END) AS goluri_marcate"),
                 DB::raw("(CASE WHEN t.id =$id THEN result1 ELSE result2 END) AS goluri_primite"),
                 DB::raw("(CASE WHEN p.id =$id THEN concat('Vs ',t.nume,' ',data) ELSE concat('Vs ',p.nume,' ',data) END) AS date_meci"))
        ->join('posts as p', 'p.id', '=', 'games.idteam1')
        ->join('posts as t', 't.id', '=', 'games.idteam2')
        ->whereRaw("(p.id=$id or t.id=$id) and games.result2 is not null" )
        ->orderby('games.data','desc')
        ->get()
        ->take(3)
        ->toArray();
        //dd($chartdata);
        $date_meci = array_column($chartdata, 'date_meci');
        $goluri_marcate = array_column($chartdata, 'goluri_marcate');
        $goluri_primite = array_column($chartdata, 'goluri_primite');

        $chartjss = app()->chartjs
                ->name('GoluriPrimiteMarcate')
                ->type('bar','google')
                // ->scales(['yAxes'=>['ticks'=>['min'=> 0]]])
                ->size(['width' => 10, 'height' => 3])
                ->labels($date_meci)
                ->datasets([
                    [
                        "label" => "Goluri marcate",
                        'backgroundColor' => '#4da6ff',
                        'data' => $goluri_marcate
                    ],
                    [
                        "label" => "Goluri primite",
                        'backgroundColor' => '#ff3333',
                        'data' => $goluri_primite
                    ]
                ])
                ->options(['scales' => [
                    'yAxes' => [
                        ['ticks'=>[  
                            'suggestedMin' => 0,
                           'suggestedMax' =>6
                            
                            ]
                        ]
                    ]
                ] ] );



        

        $post = Post::find($id);
        $player = Player::where('idteam',$id)
        ->orderBy('name', 'asc')
        ->get();
        $game=   DB::table('games')
        ->select('p.nume as echipa1','t.nume as echipa2','games.ora as hour','games.*')
        ->join('posts as p', 'p.id', '=', 'games.idteam1')
        ->join('posts as t', 't.id', '=', 'games.idteam2')
        ->whereRaw("(p.id='$id' or t.id='$id') and games.result2 is not null")
        ->take(5)
        ->orderby('games.data','desc')
        ->get();

        return view('home')->with(compact('post',$post,'player',$player,'game',$game,'chartjss','chartjs'));
    }
}
