<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use DB;
use PDF;

class PdfController extends Controller
{
    public function index()
    {
                $table= DB::select('SELECT team as id,max(nume) as team,(sum(win)+SUM(Loss)+sum(draw))as game,
                SUM(Win) As won, SUM(Loss) as lost, sum(draw) as tied,
                SUM(gol_marcat) as gol_marcat,
                SUM(gol_primit) as gol_primit,
                3*SUM(Win)+1*sum(draw) as points
                FROM
                ( SELECT idteam1 as team, 
                    CASE WHEN result1 > result2 THEN 1 ELSE 0 END as Win, 
                    CASE WHEN result1 = result2 THEN 1 ELSE 0 END as draw, 
                    CASE WHEN result1 < result2 THEN 1 ELSE 0 END as Loss,
                        result1 as gol_marcat,
                        result2 as gol_primit
                FROM games
                where idteam1 in (select id from posts where idsport=1)
                and idteam2 in (select id from posts where idsport=1)
                UNION ALL
                SELECT idteam2 as team,
                    CASE WHEN result2 > result1 THEN 1 ELSE 0 END as Win, 
                    CASE WHEN result1 = result2 THEN 1 ELSE 0 END as draw, 
                    CASE WHEN result2 < result1 THEN 1 ELSE 0 END as Loss,
                        result2 as gol_marcat,
                        result1 as gol_primit
                FROM games
                where idteam1 in (select id from posts where idsport=1)
                and idteam2 in (select id from posts where idsport=1)
                ) t
                join posts on team=id
                where idsport=1
                GROUP BY team
                union all
                select id as id,nume as team,0 as game,
                0 As won, 0 as lost, 0 as tied,
                0 as gol_marcat,
                0 as gol_primit,
                0 as points
                from posts where id not in (select idteam1 from games ) and
                id not in (select idteam2 from games )
                and idsport=1
                GROUP BY id,nume
                ORDER By points desc,gol_marcat desc,team
                ');
        $tableb= DB::select('SELECT team as id,max(nume) as team,(sum(win)+SUM(Loss)+sum(draw))as game,
        SUM(Win) As won, SUM(Loss) as lost, sum(draw) as tied,
        SUM(gol_marcat) as gol_marcat,
        SUM(gol_primit) as gol_primit,
        3*SUM(Win)+1*sum(draw) as points
        FROM
        ( SELECT idteam1 as team, 
            CASE WHEN result1 > result2 THEN 1 ELSE 0 END as Win, 
            CASE WHEN result1 = result2 THEN 1 ELSE 0 END as draw, 
            CASE WHEN result1 < result2 THEN 1 ELSE 0 END as Loss,
                result1 as gol_marcat,
                result2 as gol_primit
        FROM games
        where idteam1 in (select id from posts where idsport=2)
        and idteam2 in (select id from posts where idsport=2)
        UNION ALL
        SELECT idteam2 as team,
            CASE WHEN result2 > result1 THEN 1 ELSE 0 END as Win, 
            CASE WHEN result1 = result2 THEN 1 ELSE 0 END as draw, 
            CASE WHEN result2 < result1 THEN 1 ELSE 0 END as Loss,
                result2 as gol_marcat,
                result1 as gol_primit
        FROM games
        where idteam1 in (select id from posts where idsport=2)
        and idteam2 in (select id from posts where idsport=2)
        ) t
        join posts on team=id
        where idsport=2
        GROUP BY team
        union all
        select id as id,nume as team,0 as game,
        0 As won, 0 as lost, 0 as tied,
        0 as gol_marcat,
        0 as gol_primit,
        0 as points
        from posts where id not in (select idteam1 from games ) and
        id not in (select idteam2 from games )
        and idsport=2
        GROUP BY id,nume
        ORDER By points desc,gol_marcat desc,team
        ');


        $tableh=DB::select('SELECT team as id,max(nume) as team,(sum(win)+SUM(Loss)+sum(draw))as game,
        SUM(Win) As won, SUM(Loss) as lost, sum(draw) as tied,
        SUM(gol_marcat) as gol_marcat,
        SUM(gol_primit) as gol_primit,
        2*SUM(Win)+1*sum(draw) as points
        FROM
        ( SELECT idteam1 as team, 
        CASE WHEN result1 > result2 THEN 1 ELSE 0 END as Win, 
        CASE WHEN result1 = result2 THEN 1 ELSE 0 END as draw, 
        CASE WHEN result1 < result2 THEN 1 ELSE 0 END as Loss,
            result1 as gol_marcat,
            result2 as gol_primit
        FROM games
        where idteam1 in (select id from posts where idsport=3)
        and idteam2 in (select id from posts where idsport=3)
        UNION ALL
        SELECT idteam2 as team,
        CASE WHEN result2 > result1 THEN 1 ELSE 0 END as Win, 
        CASE WHEN result1 = result2 THEN 1 ELSE 0 END as draw, 
        CASE WHEN result2 < result1 THEN 1 ELSE 0 END as Loss,
            result2 as gol_marcat,
            result1 as gol_primit
        FROM games
        where idteam1 in (select id from posts where idsport=3)
        and idteam2 in (select id from posts where idsport=3)
        ) t
        join posts on team=id
        where idsport=3
        GROUP BY team
        union all
        select id as id,nume as team,0 as game,
        0 As won, 0 as lost, 0 as tied,
        0 as gol_marcat,
        0 as gol_primit,
        0 as points
        from posts where id not in (select idteam1 from games ) and
        id not in (select idteam2 from games )
        and idsport=3
        GROUP BY id,nume
        ORDER By points desc,gol_marcat desc,team
        ');


        $pdf = PDF::loadView('tables.pdf',compact('table'));
        return $pdf->download('clasament.pdf');
    }
}
