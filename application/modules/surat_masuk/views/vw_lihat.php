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
<div class="modal fade surat-keluar" aria-hidden="true" id="modal_disposisi">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab-1"> Data Surat Masuk</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-2">Form Disposisi</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">
                                        <div id="tab_surat_masuk">
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-2" class="tab-pane">
                                    <div class="panel-body">

                                        <div id="semua_disposisi">

                                        </div>

                                        <div id="body_disposisi">
                                           <div class="row">
                                               <div class="col-md-12">
                                                <form id="frm_disposisi" data-parsley-validate class="form-horizontal">
                                                    <fieldset>
                                                        <legend id="label_tahap_disposisi"></legend>
                                                        <input type="hidden" name="id_surat_masuk" id="id_surat_masuk"> 
                                                        <input type="hidden" name="disposisi_dari_id" id="disposisi_dari_id"> 
                                                        <input type="hidden" name="tahapan_disposisi" id="tahapan_disposisi"> 
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="disposisi_dari_text">Dari
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input id="disposisi_dari_text" class="form-control" name="disposisi_dari_text" readonly="" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="isi_disposisi">Isi Disposisi</label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <textarea id="isi_disposisi" name="isi_disposisi"   required="" class="form-control"> </textarea>
                                                            </div>
                                                        </div>
                                                        <div class="ln_solid"></div>
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-md-offset-3">
                                                                <button id="send" type="submit" onclick="doDisposisi()"  class="btn btn-primay">Disposisi</button>
                                                            </div>
                                                        </div>

                                                    </fieldset>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </div>
    </div>
</div>
</div>
<!-- Modal details surat masuk -->
<div class="modal fade surat-keluar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_bersama">
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
            {"data": "status", "orderable" : false},
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
                $('#modal_bersama  .modal-body').html('');
                $('#modal_bersama  .modal-body').html(data);
                $("#modal_bersama").modal("show");
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
            url: '<?php echo base_url('surat_masuk/ajax_delete_surat_masuk'); ?>',
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
        .attr("src", "<?php echo base_url('surat_masuk/cetak_disposisi/'); ?>" + id) 
        .appendTo("body");                 
        return false;
    }
    function showDisposisi(id)
    {
     $.ajax({
        url: '<?php echo base_url('surat_masuk/modalDisposisi'); ?>',
        type: 'POST',
        data: {id_surat_masuk : id},
        cache: false,
        dataType: 'json',
        success: function(data, textStatus, jqXHR)
        {
            $('#tab_surat_masuk').html('');
            $('#semua_disposisi ').html('');
            $('#body_disposisi #id_surat_masuk').val('');
            $('#body_disposisi #disposisi_dari_id').val('');
            $('#body_disposisi #disposisi_dari_text').val('');
            $('#body_disposisi #isi_disposisi').val('');
            $('#body_disposisi #tahapan_disposisi').val('');
            $('#body_disposisi #label_tahap_disposisi').text('');

            console.log(data.itemDisposisi);
            $('#tab_surat_masuk').html(data.table);
            $('#semua_disposisi ').html(data.itemDisposisi);
            $('#body_disposisi #id_surat_masuk').val(data.id_surat_masuk);
            $('#body_disposisi #disposisi_dari_id').val(data.pemberi_disposisi);
            $('#body_disposisi #disposisi_dari_text').val(data.disposisi_dari_text);
            $('#body_disposisi #tahapan_disposisi').val(data.tahapan_disposisi);
            $('#body_disposisi #label_tahap_disposisi').text('Disposisi Tahap ' + data.tahapan_disposisi);

            $("#modal_disposisi").modal("show");
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            console.log('ERRORS: ' + textStatus);
        }
    });
 }

 function doDisposisi() {
    $('#frm_disposisi').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url('surat_masuk/doDisposisi'); ?>', 
            type: 'POST',
            data: $('#frm_disposisi').serialize(),
            success: function(data){
                alert(data);
            }
        });
    });
}

function showStatusDisposisi(id)
{
 $.ajax({
    url: '<?php echo base_url('surat_masuk/showStatusDisposisi/'); ?>',
    type: 'POST',
    data: {id_surat_masuk : id},
    cache: false,
    dataType: 'html',
    success: function(data, textStatus, jqXHR)
    {
       $('#modal_bersama  .modal-body').html('');
       $('#modal_bersama  .modal-body').html(data);
       $("#modal_bersama").modal("show");
   },
   error: function(jqXHR, textStatus, errorThrown)
   {
    console.log('ERRORS: ' + textStatus);
}
});
}
</script>