<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Charts\SampleChart;
use App\User;
use App\Post;
use App\Game;
use App\Player;


class BetController extends Controller
{
    public function index()
    {
        $games= DB::select('SELECT p1.nume as echipa1,left(g.ora,5) as hour,
        p2.nume as echipa2,g.*
         FROM games g  join posts p1 on g.idteam1=p1.id 
         join posts p2 on g.idteam2=p2.id where result2 is null order by data asc');
     return view('bets.index')->with('games',$games);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bets.create');
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
           
           return redirect('/bets')->with('success','Meci adaugat');
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
        return view('bets.edit')->with('game',$game);
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
           
           return redirect('/bets')->with('success','Meci modificat');

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
        return redirect('/bets')->with('success','Eveniment anulat!');
    }
}
