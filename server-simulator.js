$(document).ready(function () {
    // Uložení stavu do localStorage včetně viditelnosti sloupců
    function saveState(settings, data) {
        // Uložení aktuální viditelnosti sloupců
        const columnVisibility = $('#example')
            .DataTable()
            .columns()
            .visible()
            .toArray();

        data.columnVisibility = columnVisibility; // Přidáme viditelnost sloupců do uloženého stavu
        localStorage.setItem('myDataTableState', JSON.stringify(data));
    }

    // Načtení stavu z localStorage včetně viditelnosti sloupců
    function loadState(settings) {
        const state = localStorage.getItem('myDataTableState');
        if (state) {
            const parsedState = JSON.parse(state);

            // Pokud je uložená viditelnost, aplikujeme ji
            if (parsedState.columnVisibility) {
                parsedState.columnVisibility.forEach((isVisible, index) => {
                    const table = $('#example').DataTable();
                    table.column(index).visible(isVisible, false); // Změní viditelnost sloupce bez přenačtení

                    // Aktualizace stavu checkboxů v #column-toggles
                    $(`#column-toggles .toggle-column[data-column="${index}"]`).prop('checked', isVisible);
                });
            }

            return parsedState;
        }
        return null; // Pokud není uložený stav, vrátíme null
    }

    // Inicializace DataTables
    const table = $('#example').DataTable({
        processing: true,
        serverSide: true,
        colReorder: true,
        stateSave: true, // Povolit DataTables správu stavu
        stateSaveCallback: saveState, // Vlastní funkce pro ukládání stavu
        stateLoadCallback: loadState, // Vlastní funkce pro načtení stavu
        ajax: {
            url: '/test.php',
            type: 'GET'
        }
    });

    // Při změně viditelnosti sloupců aktualizujeme stav
    $('#column-toggles').on('change', '.toggle-column', function () {
        const columnIndex = $(this).data('column');
        if (columnIndex === 0) return; // Sloupec 0 nelze skrýt

        const isVisible = this.checked;
        table.column(columnIndex).visible(isVisible);

        // Aktualizujeme stav v localStorage
        const state = table.state();
        state.columnVisibility = table.columns().visible().toArray();
        localStorage.setItem('myDataTableState', JSON.stringify(state));
    });

    // Přegenerování dat a reset stavu
    $('#reset-data').on('click', function () {
        $.ajax({
            url: '/test.php?reset=1',
            success: function () {
                table.state.clear(); // Vymazání uloženého stavu tabulky
                table.ajax.reload(); // Znovunačtení dat
            }
        });
    });

    $('#reset-order').on('click', function () {
        const table = $('#example').DataTable();

        // Reset pořadí sloupců na výchozí
        table.colReorder.reset();

        // Obnovit viditelnost sloupců na výchozí (všechny kromě ID viditelné)
        table.columns().visible(true); // Nastaví všechny sloupce viditelné
        table.column(0).visible(true); // Ujistíme se, že ID (sloupec 0) zůstává viditelné

        // Aktualizace checkboxů
        $('#column-toggles .toggle-column').each(function () {
            const columnIndex = $(this).data('column');
            $(this).prop('checked', columnIndex === 0 || true);
        });

        // Vymazat uložený stav z localStorage
        table.state.clear();
        localStorage.removeItem('myDataTableState'); // Vymazání vlastního uloženého stavu

        table.ajax.reload(); // Volitelně lze znovu načíst data
    });

});
