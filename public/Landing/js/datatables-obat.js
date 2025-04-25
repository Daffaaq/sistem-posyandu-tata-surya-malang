$(document).ready(function () {
    var table = $('#tableObat').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/landingPage-listObat',
            type: 'POST',
            data: function (d) {
                d._token = $('meta[name="csrf-token"]').attr('content');
                d.tipe_filter = $('#tipe_filter').val();
            }
        },
        dom: '<"top mb-3 flex justify-between items-center"lf>rt<"bottom mt-3 flex justify-between items-center"ip>',
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data",
            // paginate: {
            //     next: '➡️',
            //     previous: '⬅️'
            // }
        },
        lengthMenu: [10, 25, 50, 100], // Tentukan pilihan untuk jumlah data per halaman
        initComplete: function () {
            // Styling untuk dropdown lengthMenu
            $(".dataTables_length select")
                .addClass("form-select py-2 px-4 border border-gray-300 rounded-md")
                .css("width", "60px");  // Menambahkan lebar auto
            // Ganti w-32 dengan ukuran yang lebih tepat sesuai kebutuhan

            // Styling untuk dropdown filter tipe
            $("#tipe_filter").addClass("form-select py-2 px-4 border border-gray-300 rounded-md text-sm");

            // Styling untuk pagination buttons
            // Reset style class pagination agar tidak ketiban Tailwind spacing
            $(".dataTables_paginate").removeClass().addClass("dataTables_paginate");

        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama_obat_vitamin', name: 'nama_obat_vitamin' },
            { data: 'tipe', name: 'tipe' },
            { data: 'stok', name: 'stok' },
            { data: 'tanggal_kadaluarsa', name: 'tanggal_kadaluarsa' }
        ]
    });

    // Filter dropdown trigger reload
    $('#tipe_filter').on('change', function () {
        table.ajax.reload();
    });
});
