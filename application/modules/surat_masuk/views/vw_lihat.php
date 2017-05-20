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
            <div class="col-lg-12">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1"> Data Surat Masuk</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-2">Form Disposisi</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <form id="frm_disposisi" data-parsley-validate class="form-horizontal">
                                            <caption>Disposisi Tahap 1</caption>
                                            <hr>
                                            <input type="hidden" name="id_surat_masuk">
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pemberi_disposisi_id">Dari
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input id="pemberi_disposisi_id" class="form-control" name="pemberi_disposisi_id" disabled type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="isi_disposisi">Isi Disposisi</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                  <textarea id="isi_disposisi" name="isi_disposisi"  required class="form-control"> </textarea>
                                              </div>
                                          </div>
                                          <div class="ln_solid"></div>
                                          <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                              <button id="send" type="submit" class="btn btn-default">Submit</button>
                                          </div>
                                      </div>
                                  </form>
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
            // {"data": "tujuan_text"},
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
        // /*add button tambah*/
        // $('<button id="tambah" class="btn btn-default">Tambah</button>').click(function(event) {
        //      Act on the event 
        //     location.href = '<?php echo base_url('surat_masuk/tambah'); ?>'
        // }).appendTo('div.dataTables_filter');
        /*show modal when deleting data*/
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('id', $(e.relatedTarget).data('id_surat_masuk'));
        });
        $('.btn-ok').click(function(event) {
            var id = $(this).attr('id');
            doDelete(id);
            $('#confirm-delete').modal('hide');
        });
    });
//Tampilkan Modal 
function showDetails(id)
{
    $.ajax({
        url: '<?php echo base_url('surat_masuk/ajax_detail'); ?>',
        type: 'POST',
        data: {id_surat_masuk : id},
        cache: false,
        dataType: 'html',
//processData: false, // Don't process the files
//contentType: false, // Set content type to false as jQuery will tell the server its a query string request
success: function(data, textStatus, jqXHR)
{
    $('#modal_detail  .modal-body').html('');
    $('#modal_detail  .modal-body').html(data);
    $("#modal_detail").modal("show");
},
error: function(jqXHR, textStatus, errorThrown)
{
// Handle errors here
console.log('ERRORS: ' + textStatus);
// STOP LOADING SPINNER
}
});
}




function doDelete(id)
{
    $.ajax({
        url: 'surat_masuk/ajax_delete_surat_masuk',
        type: 'POST',
        data: {id_surat_masuk : id},
//processData: false, // Don't process the files
//contentType: false, // Set content type to false as jQuery will tell the server its a query string request
success: function(data, textStatus, jqXHR)
{
    t.api().ajax.reload();
},
error: function(jqXHR, textStatus, errorThrown)
{
// Handle errors here
console.log('ERRORS: ' + textStatus);
// STOP LOADING SPINNER
}
});
}



function loadAnoterPage(id)
{
    // location.href = '<?php echo base_url('disposisi/cetak/'); ?>'+id;
     $("<iframe>")                             // create a new iframe element
        .hide()                               // make it invisible
        .attr("src", "<?php echo base_url('disposisi/cetak/') ?>" + id) // point the iframe to the page you want to print
        .appendTo("body");                    // add iframe to the DOM to cause it to load the page
        return false;
    }



//Tampilkan Modal 
function showDisposisi(id)
{
    $.ajax({
        url: '<?php echo base_url('disposisi/modalDisposisi'); ?>',
        type: 'POST',
        data: {id_surat_masuk : id},
        cache: false,
        dataType: 'json',
//processData: false, // Don't process the files
//contentType: false, // Set content type to false as jQuery will tell the server its a query string request
success: function(data, textStatus, jqXHR)
{
   $('#modal_disposisi  .modal-body #tab-1 .panel-body').html('');
   $('#modal_disposisi .modal-body #tab-1 .panel-body').html(data.table);
   $('#modal_disposisi .modal-body #tab-2 .panel-body #pemberi_disposisi_id').val(data.pemberi_disposisi.fullname);
   $("#modal_disposisi").modal("show");
},
error: function(jqXHR, textStatus, errorThrown)
{
// Handle errors here
console.log('ERRORS: ' + textStatus);
// STOP LOADING SPINNER
}
});
}



function addDisposisi() 
{

}




</script>