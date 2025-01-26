<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTables s pořadím a viditelností</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="text-center">DataTables <span class="badge">(1.10.12)</span> (JSON, uložení pořadí a sloupců)</h1>

    <!-- Ovládání sloupců -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Ovládání sloupců</h4>
        </div>
        <div class="panel-body">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/colreorder/1.5.2/js/dataTables.colReorder.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="server-simulator.js"></script>
</body>
</html>
