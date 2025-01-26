$(document).ready(function () {
    // Funkce pro uložení stavu včetně viditelnosti sloupců
    function saveState(settings, data) {
        const columnVisibility = $('#example')
            .DataTable()
            .columns()
            .visible()
            .toArray();
        data.columnVisibility = columnVisibility; // Přidáme viditelnost sloupců do uloženého stavu
        localStorage.setItem('myDataTableState', JSON.stringify(data));
    }

    // Funkce pro načtení stavu včetně viditelnosti sloupců
    function loadState(settings) {
        const state = localStorage.getItem('myDataTableState');
        if (state) {
            const parsedState = JSON.parse(state);
            if (parsedState.columnVisibility) {
                parsedState.columnVisibility.forEach((isVisible, index) => {
                    const table = $('#example').DataTable();
                    table.column(index).visible(isVisible, false); // Nastaví viditelnost bez přenačtení
                });
            }
            return parsedState;
        }
        return null; // Pokud není uložený stav, vrátíme null
    }

    // Inicializace DataTables s tlačítkem colvis
    const table = $('#example').DataTable({
        processing: true,
        serverSide: true,
        colReorder: true,
        stateSave: true, // Ukládání stavu
        dom: 'Bfrtip', // Přidáme sekci pro tlačítka
        buttons: [
            {
                extend: 'colvis',
                text: 'Zobrazit/Skrýt sloupce', // Text tlačítka
                columns: ':not(:first-child)' // Zabrání skrytí prvního sloupce (ID)
            }
        ],
        stateSaveCallback: saveState,
        stateLoadCallback: loadState,
        ajax: {
            url: '/test.php',
            type: 'GET'
        }
    });

    // Tlačítko pro resetování pořadí a viditelnosti
    $('#reset-order').on('click', function () {
        table.colReorder.reset(); // Reset pořadí sloupců
        table.columns().visible(true); // Nastaví všechny sloupce jako viditelné
        table.column(0).visible(true); // Zajistí, že první sloupec (ID) je vždy viditelný
        table.state.clear(); // Vymazání uloženého stavu
        table.ajax.reload(); // Znovunačtení tabulky
    });

    // Přegenerování dat
    $('#reset-data').on('click', function () {
        $.ajax({
            url: '/test.php?reset=1',
            success: function () {
                table.state.clear();
                table.ajax.reload();
            }
        });
    });

});
