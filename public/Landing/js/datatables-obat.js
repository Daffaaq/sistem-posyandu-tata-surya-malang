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
            paginate: {
                next: '➡️',
                previous: '⬅️'
            }
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
