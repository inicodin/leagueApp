<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use App\Post;
use DB;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$players= DB::select('SELECT * FROM players join posts on idteam=id');
        $players = Player::join('posts','idteam','=','id')
        ->where('posts.idsport','=','1')
        ->orderBy('posts.nume', 'asc')
        ->get();
        $playersb = Player::join('posts','idteam','=','id')
        ->where('posts.idsport','=','2')
        ->orderBy('posts.nume', 'asc')
        ->get();
        $playersh = Player::join('posts','idteam','=','id')
        ->where('posts.idsport','=','3')
        ->orderBy('posts.nume', 'asc')
        ->get();

        return view('players.index')->with(compact('players',$players,'playersb',$playersb,'playersh',$playersh));

 /*       $posts= Post::orderBy('title')->paginate(10);
        return view('posts.index')->with('posts',$posts);
 */
    }

    public function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
  
      if($query != '')
      {
         $data = Player::join('posts','idteam','=','id')
       // ->where('age','like','%'.$query.'%')
        ->whereRaw("(posts.idsport=1 and (name like '%$query%' or posts.nume like '%$query%' or rol like '%$query%' 
        or TIMESTAMPDIFF(YEAR, birth, CURDATE()) like '%$query%'   ))")
        ->orderBy('posts.nume', 'asc')
        ->get();
            
      }
      else
      {
        $data = Player::join('posts','idteam','=','id')
        ->where('posts.idsport','=','1')
        ->orderBy('posts.nume', 'asc')
        ->get();
      }
     $counter=0;
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {
        $counter++;
        $output .= '
        <tr>
        <td>'.$counter.'</td>
         <td>'.$row->name.'</td>
         <td>'.$row->player['nume'].'</td>
         <td>'.$row->rol.'</td>
         <td>'.$row->age.'</td>
         
        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">Nu exista nici un jucator</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request  $request)
    {   
        $id = $request->input('id');
        $post = Post::find($id);
        return view('players.create')->with('post',$post);
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
            'name' =>'required',
            'birth' => 'required' ,
            'idteam'=> 'required' 
           ]);
           $player= new Player;
           $player->name=$request->input('name');
           $player->birth =$request->input('birth');
           $player->idteam =$request->input('idteam');
           $player->rol =$request->input('rol');
           $player->save();
           
           return redirect('/players')->with('success','Jucator adaugat');
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
        $player = Player::find($id);
        return view('players.edit')->with('player',$player);
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
            'name' =>'required',
            'birth' => 'required' ,
            'idteam'=> 'required' 
           ]);
           $player= Player::find($id);
           $player->name=$request->input('name');
           $player->birth =$request->input('birth');
           $player->idteam =$request->input('idteam');
           $player->rol =$request->input('rol');
           $player->save();
           
           return redirect('/players')->with('success','Jucator actualizat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $player= Player::find($id);
        $player->delete();
        return redirect('/players')->with('success','Player Deleted');
    }
}
