<div class="row" >
  <div class="col-lg-12">
    <div class="ibox ">
   <!--        <div class="ibox-title">
            <h5>Drag&amp;Drop</h5>
            <div class="ibox-tools">
              <label class="label label-primary">You can drag and drop me to other box.</label>
            </div>
          </div> -->
          <div class="ibox-content">
            <form id="frm_ubah_surat_masuk" data-parsley-validate class="form-horizontal" method="POST" enctype="multipart/form-data">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_lembar_disposisi">No. Lembar Disposisi
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input value="<?php echo $surat_masuk['no_lembar_disposisi']; ?>" id="no_lembar_disposisi" class="form-control" name="no_lembar_disposisi"  required="required" data-parsley-type="number">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal_masuk">Tanggal Masuk
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input 
                  value="<?php echo date_converter($surat_masuk['tgl_masuk']); ?>"
                  pattern="\d{1,2}/\d{1,2}/\d{4}"
                  placeholder="dd/mm/YYYY"  
                  id="tanggal_masuk"  
                  class="form-control" 
                  name="tanggal_masuk"  
                  required="required" 
                  type="text">
                </div>
              </div>
              <div class="form-group">
                <label for="tujuan_id" class="control-label col-md-3 col-sm-3 col-xs-12">Tujuan </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="radio">
                    <div class="col-md-3">
                      <input type="radio"  class="i-checks" name="tujuan_id" id="tujuan_id_1"  value="1" <?php echo $surat_masuk['tujuan_id'] == '1'  ? 'checked' : ''; ?>> Utama
                    </div>
                    <div class="col-md-3">
                      <input type="radio"  class="i-checks" name="tujuan_id" id="tujuan_id_2" value="2" <?php echo $surat_masuk['tujuan_id'] == '2'  ? 'checked' : ''; ?>> Tembusan
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pengirim">Pengirim
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input  value="<?php echo $surat_masuk['pengirim']; ?>" id="pengirim" name="pengirim"  class="form-control" required="required" type="text">
                </div>
              </div>
              
              <div class="form-group">
                <label for="perihal" class="control-label col-md-3 col-sm-3 col-xs-12">Perihal</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input  value="<?php echo $surat_masuk['perihal']; ?>" id="perihal" name="perihal"  class="form-control"  required="required" type="text">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="disposisi_tujuan_id">Tujuan Disposisi
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="disposisi_tujuan_id" class="form-control">
                    <?php foreach ($tujuan_disposisi as $key => $value): ?>
                      <?php if ($value['id'] == $surat_masuk['disposisi_tujuan_id']): ?>
                        <?php $selected = 'selected'; ?>
                      <?php else: ?>
                        <?php $selected = ''; ?>
                      <?php endif ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo $selected ?>><?php echo $value['nama']?></option>             
                    <?php endforeach ?>
                  </select>
                  <!--  <input id="diposisi_tujuan" name="diposisi_tujuan"   class="form-control" type="text"> -->
                </div>
              </div>
              <div class="form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file">File
               </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                 <div id="option_file">
                   <?php if ($surat_masuk['file']) { ?>
                   <div id="aksi_file">
                     <a href="<?php echo base_url('uploads/surat_masuk/' . $surat_masuk['file']) ?>" class="btn btn-info btn-xs" target="_blank">Lihat</a> <button id="btn_hapus" type="button" class="btn btn-danger btn-xs" onclick="showDeleteFile('<?php echo $surat_masuk['file'] ?>')" >Hapus</button>
                   </div>
                   <?php }
                   else { ?>
                   <div id="file_upload">
                     <input id="file" accept="application/pdf" name="file"  class=" col-md-7 col-xs-12" type="file">
                   </div>
                   <?php } ?>
                   <!-- <input id="file" accept="application/pdf" name="file"  class=" col-md-7 col-xs-12" type="file"> -->
                 </div>
               </div>
             </div>

             
             <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="catatan_tambahan">Catatan</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea id="catatan_tambahan" name="catatan_tambahan"  class="form-control"><?php echo $surat_masuk['catatan_tambahan']; ?></textarea>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-3">
                <a href="<?php echo base_url('surat_masuk/lihat') ?>" class="btn btn-primary">Cancel</a>
                <button class="btn btn-primary" type="reset">Reset</button>
                <button id="send" type="submit" class="btn btn-success">Submit</button>
              </div>
            </div>


          </form>
        </div>
      </div>
    </div>
  </div>






  <!-- Modal untuk delete file -->
  <div class="modal fade bs-example-modal-sm"  id="modal_delete_file" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <h5 class="modal-title" id="myModalLabel2">Yakin Ingin Menghapus File  Ini ? </h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning btn-ok btn-xs">Delete</button>
        </div>
      </div>
    </div>
  </div>
  <script>

   // <!-- iCheck -->

   $(document).ready(function () {
    $('.i-checks').iCheck({
      checkboxClass: 'icheckbox_square-green',
      radioClass: 'iradio_square-green',
    });

    $('#frm_ubah_surat_masuk').parsley({

    });
  });

   function showDeleteFile(file){
    var x= $('#modal_delete_file');
    x.modal('show');
    $('.btn-ok').click(function() {
      $.ajax({
        url: '<?php echo base_url('surat_masuk/ajax_delete_file') ?>',
        type: 'POST',
        data: {file:file,id_surat_masuk: '<?php echo $surat_masuk['id_surat_masuk'] ?>'},
    //processData: false, // Don't process the files
    //contentType: false, // Set content type to false as jQuery will tell the server its a query string request
    success: function(data, textStatus, jqXHR)
    {
      if (data == 'OK') {
        $('#option_file').html('');
        $('#option_file').html("<div id='file_upload'> <input id='file' accept='application/pdf' name='file'  class=' col-md-7 col-xs-12' type='file'></div>");
      }
      x.modal('hide');
    },
    error: function(jqXHR, textStatus, errorThrown)
    {
    // Handle errors here
    console.log('ERRORS: ' + textStatus);
    // STOP LOADING SPINNER
  }
});
    });
  }
  function deleteFile()
  {
  }
  $(document).ready(function() {
   $('#modal_delete_file').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').click(function() {
    });
  });
 });
</script>