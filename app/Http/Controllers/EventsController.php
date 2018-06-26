<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Charts\SampleChart;
use App\User;
use App\Post;
use App\Game;
use App\Player;


class EventsController extends Controller
{
    public function index()
    {
       
        $event=  DB::table('games')
        ->select('p.nume as echipa1','t.nume as echipa2','games.ora as hour','games.*')
        ->join('posts as p', 'p.id', '=', 'games.idteam1')
        ->join('posts as t', 't.id', '=', 'games.idteam2')
        ->where('p.idsport','=','1')
        ->where('t.idsport','=','1')

        ->whereNull('games.result2')
        ->orderBy('games.data','desc','games.ora','desc')
        ->paginate(5);
        $eventb=  DB::table('games')
        ->select('p.nume as echipa1','t.nume as echipa2','games.ora as hour','games.*')
        ->join('posts as p', 'p.id', '=', 'games.idteam1')
        ->join('posts as t', 't.id', '=', 'games.idteam2')
        ->where('p.idsport','=','2')
        ->where('t.idsport','=','2')

        ->whereNull('games.result2')
        ->orderBy('games.data','desc','games.ora','desc')
        ->paginate(5);
        $eventh=  DB::table('games')
        ->select('p.nume as echipa1','t.nume as echipa2','games.ora as hour','games.*')
        ->join('posts as p', 'p.id', '=', 'games.idteam1')
        ->join('posts as t', 't.id', '=', 'games.idteam2')
        ->where('p.idsport','=','3')
        ->where('t.idsport','=','3')
      
        ->whereNull('games.result2')
        ->orderBy('games.data','desc','games.ora','desc')
        ->paginate(5);
        return view('events.index')->with(compact('event',$event,'eventb',$eventb,'eventh',$eventh));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
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
           
           return redirect('/events')->with('success','Meci adaugat');
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
        return view('events.edit')->with('game',$game);
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
           
           return redirect('/events')->with('success','Meci modificat');

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
        return redirect('/events')->with('success','Eveniment anulat!');
    }
}
