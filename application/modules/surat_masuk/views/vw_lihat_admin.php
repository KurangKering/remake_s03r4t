<div class="row" >
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-content">
                <table id="tbl_masuk" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No Disposisi</th>
                            <th>Tanggal Masuk</th>
                            <th>Pengirim</th>
                            <th>Perihal</th>
                            <!-- <th>Tujuan</th> -->
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal details surat masuk -->
<div class="modal fade surat-keluar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_detail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal untuk delete -->
<div class="modal fade bs-example-modal-sm"  id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h5 class="modal-title" id="myModalLabel2">Yakin Ingin Menghapus Data  Ini ? </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning btn-ok btn-xs">Delete</button>
            </div>
        </div>
    </div>
</div>
<script>
    var t;
    $(function() {
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
        {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        t = $("#tbl_masuk").dataTable({
            initComplete: function() {
                var api = this.api();
                $('#tbl_masuk_filter input')
                .off('.DT')
                .on('keyup.DT', function(e) {
                    if (e.keyCode == 13) {
                        api.search(this.value).draw();
                    }
                });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            ajax: {"url": "<?php echo base_url('surat_masuk/ajax_lihat'); ?>", "type": "POST"},
            columns: [
            {"data" : "nomor_urut" ,
            "orderable": false},
            {"data": "no_lembar_disposisi"},
            {"data": "tgl_masuk"},
            {"data": "pengirim"},
            {"data": "detail_perihal", "orderable" : false},
            {"data": "status_nama"},
            {"data": "view", "orderable" : false},
            ],
            order: [[1, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
                if(row.cells[7]) row.cells[7].noWrap = true;
            }
        });
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('id', $(e.relatedTarget).data('id_surat_masuk'));
        });
        $('.btn-ok').click(function(event) {
            var id = $(this).attr('id');
            doDelete(id);
            $('#confirm-delete').modal('hide');
        });
    });


    function showDetails(id)
    {
        $.ajax({
            url: '<?php echo base_url('surat_masuk/ajax_detail'); ?>',
            type: 'POST',
            data: {id_surat_masuk : id},
            cache: false,
            dataType: 'html',
            success: function(data, textStatus, jqXHR)
            {
                $('#modal_detail  .modal-body').html('');
                $('#modal_detail  .modal-body').html(data);
                $("#modal_detail").modal("show");
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                console.log('ERRORS: ' + textStatus);
            }
        });
    }
    function doDelete(id)
    {
        $.ajax({
            url: 'surat_masuk/ajax_delete_surat_masuk',
            type: 'POST',
            data: {id_surat_masuk : id},
            success: function(data, textStatus, jqXHR)
            {
                t.api().ajax.reload();
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                console.log('ERRORS: ' + textStatus);
            }
        });
    }
    function loadAnoterPage(id)
    {
        $("<iframe>")                           
        .hide()                             
        .attr("src", "<?php echo base_url('disposisi/cetak/') ?>" + id) 
        .appendTo("body");                 
        return false;
    }
</script>