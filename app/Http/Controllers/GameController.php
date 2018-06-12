<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use App\Post;
use App\Game;
use DB;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games= DB::select('SELECT p1.nume as echipa1,left(g.ora,5) as hour,
        p2.nume as echipa2,g.*
         FROM games g  join posts p1 on g.idteam1=p1.id 
         join posts p2 on g.idteam2=p2.id where result2 is null order by data asc');

        $results=  DB::table('games')
        ->select('p.nume as echipa1','t.nume as echipa2','games.ora as hour','games.*')
        ->join('posts as p', 'p.id', '=', 'games.idteam1')
        ->join('posts as t', 't.id', '=', 'games.idteam2')
        ->where('p.idsport','=','1')
        ->where('t.idsport','=','1')
        ->whereNotNull('games.result2')
        ->orderBy('games.data','desc','games.ora','desc')
        ->paginate(5);
        $resultsb=  DB::table('games')
        ->select('p.nume as echipa1','t.nume as echipa2','games.ora as hour','games.*')
        ->join('posts as p', 'p.id', '=', 'games.idteam1')
        ->join('posts as t', 't.id', '=', 'games.idteam2')
        ->where('p.idsport','=','2')
        ->where('t.idsport','=','2')
        ->whereNotNull('games.result2')
        ->orderBy('games.data','desc','games.ora','desc')
        ->paginate(5);
        $resultsh=  DB::table('games')
        ->select('p.nume as echipa1','t.nume as echipa2','games.ora as hour','games.*')
        ->join('posts as p', 'p.id', '=', 'games.idteam1')
        ->join('posts as t', 't.id', '=', 'games.idteam2')
        ->where('p.idsport','=','3')
        ->where('t.idsport','=','3')
        ->whereNotNull('games.result2')
        ->orderBy('games.data','desc','games.ora','desc')
        ->paginate(5);
        return view('games.index')->with(compact('games',$games,'results',$results,'resultsb',$resultsb,'resultsh',$resultsh));

    }
   
   
    function fetch(Request $request)
    {
     $select = $request->get('select');
     $value = $request->get('value');
     $dependent = $request->get('dependent');
     $data = Post::join('sports','posts.idsport','=','sports.idsport')
        ->where($select,'!=',$value)
        //->where('posts.idsport','=',"select max(idsport) from posts where id='$value'")
       // ->where('posts.id','!=',$dependent)
       ->get();
       
       $output = '<option>-Select-</option>';
            foreach($data as $row)
     {
      $output .= '<option value="'.$row->id.'">'.$row->nume.'</option>';
     }
     echo $output;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('games.create');
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
            'idteam1' =>'required|integer',
            'idteam2' => 'required|integer',
            'idsport' => 'required|integer',
            'data' => 'required',
            'ora' => 'required',
           ]);
           $game= new Game;
           $game->idteam1=$request->input('idteam1');
           $game->result1 =$request->input('result1');
           $game->idteam2=$request->input('idteam2');
           $game->result2 =$request->input('result2');
           $game->idsport =$request->input('idsport'); 

           $game->cota1 =$request->input('cota1');
           $game->cotax=$request->input('cotax');
           $game->cota2 =$request->input('cota2');
           $game->data=$request->input('data');
           $game->ora=$request->input('ora');
           $game->save();
           
           return redirect('/games')->with('success','Meci adaugat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $game = Game::find($id);
        return view('games.edit')->with('game',$game);
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
            'idteam1' =>'required|integer',
            'idteam2' => 'required|integer',
            'idsport' => 'required|integer',
            'data' => 'required',
            'ora' => 'required'
           ]);           


           $game= Game::find($id);
           $game->idteam1=$request->input('idteam1');
           $game->result1 =$request->input('result1');
           $game->idteam2=$request->input('idteam2');
           $game->result2 =$request->input('result2');
           $game->idsport =$request->input('idsport'); 

           $game->cota1 =$request->input('cota1');
           $game->cotax=$request->input('cotax');
           $game->cota2 =$request->input('cota2');
           $game->data=$request->input('data');
           $game->ora=$request->input('ora');
           
           $game->save();
           
           return redirect('/games')->with('success','Meci modificat');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $game = Game::find($id);
        $game->delete();
        return redirect('/games')->with('success','Eveniment anulat!');
    }
}
