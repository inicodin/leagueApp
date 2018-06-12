<!DOCTYPE html>
<html>
<head>
<style>
#tabel {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width:99%;
}

#tabel td{
    border: 1px solid #ddd;
    padding: 8px;
}

#tabel tr:nth-child(even){background-color: #f2f2f2;}

#tabel th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #rgb(170,225, 255);
    color: black;
}
h1,h3,th,td,tr {
    text-align:center;
}
</style>
</head>
<body>

       <h1>Clasament</h1>
       <h3>{{ date('Y-m-d') }}</h3><br><br>
       <table id="tabel">
        <tr class="table-info">
            <th></th>
            <th>Echipa</th>
            <th>Meciuri</th>
            <th>Victorii</th>
            <th>Egaluri</th>
            <th>Infrangeri</th>
            <th>Golaveraj</th>
            <th>Puncte</th>
        </tr>
        @forelse($table as $team)
            <tr>
                <td>{{ $loop->iteration }}.</td>
                
                <td>{{ $team->team }}</td>
                <td>{{ $team->game }}</td>
                <td>{{ $team->won }}</td>
                <td>{{ $team->tied }}</td>
                <td>{{ $team->lost }}</td>
                <td>{{ $team->gol_marcat }} : {{ $team->gol_primit }}</td>
                <td>{{ $team->points }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6">No teams.</td>
            </tr>
        @endforelse
    </table>
    </body>
    </html>