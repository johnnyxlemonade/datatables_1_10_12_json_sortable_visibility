<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTables s resetem - Bootstrap 3</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.5.2/css/colReorder.dataTables.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h1 class="text-center">DataTables <span class="badge">(1.10.12)</span> (JSON, uložení pořadí a sloupců)</h1>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Ovládání sloupců</h4>
        </div>
        <div class="panel-body">
            <div id="column-toggles" class="row">
                <div class="col-xs-12">
                    <label class="checkbox-inline">
                        <input type="checkbox" class="toggle-column" data-column="0" checked disabled> ID
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" class="toggle-column" data-column="1" checked> Jméno
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" class="toggle-column" data-column="2" checked> Email
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" class="toggle-column" data-column="3" checked> Věk
                    </label>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-6">
                    <button id="reset-data" class="btn btn-danger btn-sm">Přegenerovat data</button>
                </div>
                <div class="col-xs-6 text-right">
                    <button id="reset-order" class="btn btn-primary btn-sm">Resetovat pořadí a zobrazení</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabulka -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Tabulka</h4>
        </div>
        <div class="panel-body">
            <table id="example" class="table table-striped table-bordered" width="100%">
                <thead>
                <tr>
                    <th data-data="id">ID</th>
                    <th data-data="name">Jméno</th>
                    <th data-data="email">Email</th>
                    <th data-data="age">Věk</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/colreorder/1.5.2/js/dataTables.colReorder.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="server-simulator.js"></script>
</body>
</html>
