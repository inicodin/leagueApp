<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Player;
use DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $posts= DB::select('SELECT id, count(idplayer) as nr , max(nume)as nume,max(detalii) as detalii,max(image) as img
        FROM posts
        left join players on id=idteam
        where idsport=1
         group by id 
         order by nume asc');
       // $posts= Post::orderBy('title')->paginate(4);
       $postsb= DB::select('SELECT id, count(idplayer) as nr , max(nume)as nume,max(detalii) as detalii,max(image) as img
       FROM posts
       left join players on id=idteam
       where idsport=2
        group by id 
        order by nume asc');

        $postsh= DB::select('SELECT id, count(idplayer) as nr , max(nume)as nume,max(detalii) as detalii,max(image) as img
        FROM posts
        left join players on id=idteam
        where idsport=3
        group by id 
        order by nume asc');

        return view('posts.index')->with(compact('posts',$posts,'postsb',$postsb,'postsh',$postsh));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
         'nume' =>'required',
         'idsport' => 'required|integer',
         'image' =>'image|nullable|max:1999'
        ]);
            if($request->hasFile('image'))
            {
            $filenameWithExt=$request->file('image')->getClientOriginalName(); 
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $extension =$request->file('image')->getClientOriginalExtension();
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            $path=$request->file('image')->storeAs('public/image',$fileNameToStore);
            }else
            {$fileNameToStore='noimage.jpg';
            }

        $post= new Post;
        $post->nume=$request->input('nume');
        $post->detalii =$request->input('detalii');
        $post->user_id=auth()->user()->id;
        $post->idsport=$request->input('idsport');
        $post->image=$fileNameToStore;
        $post->save();
        
        return redirect('/posts')->with('success','Echipa adaugata');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        ->take(4)
        ->toArray();
        //dd($chartdata);
        $date_meci = array_column($chartdata, 'date_meci');
        $goluri_marcate = array_column($chartdata, 'goluri_marcate');
        $goluri_primite = array_column($chartdata, 'goluri_primite');

        $chartjs = app()->chartjs
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
        return view('posts.show')->with('post',$post)
                                ->with('player', $player)
                                ->with('game',$game)
                                ->with('chartjs',$chartjs);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nume' =>'required',
            'idsport' => 'required|integer',
            'image' =>'image|nullable|max:1999'
           ]);
           if($request->hasFile('image'))
           {
           $filenameWithExt=$request->file('image')->getClientOriginalName(); 
           $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
           $extension =$request->file('image')->getClientOriginalExtension();
           $fileNameToStore=$filename.'_'.time().'.'.$extension;
           $path=$request->file('image')->storeAs('public/image',$fileNameToStore);
           }


           $post= Post::find($id);
           $post->nume=$request->input('nume');
           $post->detalii =$request->input('detalii');
           $post->idsport=$request->input('idsport');
           if($request->hasFile('image'))
           {
            $post->image=$fileNameToStore; 
           }
           $post->save();
           
           return redirect('/posts')->with('success','Echipa actualizata');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $post = Post::find($id);
        if($post->image != 'noimage.jpg'){
            // Delete Image
            Storage::delete('public/image/'.$post->image);
        }

        $post->delete();
        return redirect('/posts')->with('success','Post Deleted');
    }
}
