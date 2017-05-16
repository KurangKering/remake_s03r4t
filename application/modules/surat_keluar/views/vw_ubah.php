
<div class="row" >
  <div class="col-lg-12">
    <div class="ibox ">
      <div class="ibox-content">
      <form id="frm_ubah_surat_keluar" data-parsley-validate class="form-horizontal" method="POST"  enctype="multipart/form-data">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_surat_keluar">No. Surat Keluar
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input data-parsley-type="number" value="<?php echo $surat_keluar['no_surat_keluar']; ?>" id="no_surat_keluar" class="form-control col-md-7 col-xs-12" name="no_surat_keluar"  required="required" type="text">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_surat">Tanggal Masuk
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input  
              pattern="\d{1,2}/\d{1,2}/\d{4}"
              placeholder="dd/mm/YYYY" 
              value="<?php echo date_converter($surat_keluar['tgl_surat']); ?>" 
              id="tgl_surat"  
              class="form-control col-md-7 col-xs-12" 
              name="tgl_surat"  
              required="required" 
              type="text">
            </div>
          </div>
          <div class="form-group">
            <label for="jenis_surat_keluar_id" class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Surat</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="radio">
                <?php $check = 'checked' ; foreach ($jenis_surat as $key => $value): ?>
                <div class="col-md-4"> 
                 <input type="radio" class="i-checks" name="jenis_surat_keluar_id"   value="<?php echo $key ?>" <?php echo $check ?>> <?php echo $value ?></div>
                 <?php $check = '' ; endforeach ?>


               </div>
             </div>
           </div>
           <div class="form-group">
            <label for="tujuan_id" class="control-label col-md-3 col-sm-3 col-xs-12">Tujuan </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="radio">
                <?php $check = 'checked' ; foreach ($tujuan_id as $key => $value): ?>
                <div class="col-md-4">
                 <input <?php echo $check; ?> type="radio" class="i-checks" name="tujuan_id"   value="<?php echo $key; ?>" > <?php echo $value; ?>
               </div>
               <?php $check = ''; endforeach ?>

             </div>
           </div>
         </div>
         <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pembuat_surat_id">ID Pembuat Surat
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input  value="<?php echo $surat_keluar['pembuat_surat_id']; ?>" id="pembuat_surat_id" name="pembuat_surat_id"  class="form-control col-md-7 col-xs-12" required="required" type="text">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pembuat_surat_text">Pembuat Surat
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input  value="<?php echo $surat_keluar['pembuat_surat_text']; ?>" id="pembuat_surat_text" name="pembuat_surat_text"  class="form-control col-md-7 col-xs-12" required="required" type="text">
          </div>
        </div>
        
        <div class="form-group">
          <label for="perihal" class="control-label col-md-3 col-sm-3 col-xs-12">Perihal</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input  value="<?php echo $surat_keluar['perihal']; ?>" id="perihal" name="perihal"  class="form-control col-md-7 col-xs-12"  required="required" type="text">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dikirim_via">Dikirim Via
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">

            <select name="dikirim_via" class="form-control col-md-7 col-xs-12">
              <?php foreach ($dikirim_via as $key => $value): ?>
                <option value="<?php echo $key ?>"><?php echo $value ?></option>             
              <?php endforeach ?>
            </select>
            <!--  <input id="diposisi_tujuan" name="diposisi_tujuan"   class="form-control col-md-7 col-xs-12" type="text"> -->
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_resi_pengiriman">No Resi Pengiriman
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input  value="<?php echo $surat_keluar['no_resi_pengiriman']; ?>" id="no_resi_pengiriman" class="form-control col-md-7 col-xs-12" name="no_resi_pengiriman"  required="required" type="text" data-parsley-type="number">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal_pengiriman">Tanggal Pengiriman
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input  
            pattern="\d{1,2}/\d{1,2}/\d{4}"
            placeholder="dd/mm/YYYY"  
            value="<?php echo date_converter($surat_keluar['tanggal_pengiriman']); ?>" 
            id="tanggal_pengiriman" 
            class="form-control col-md-7 col-xs-12" 
            name="tanggal_pengiriman"  
            required="required" 
            type="text">
          </div>
        </div>


        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="path_file">Path File
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input  value="<?php set_value('path_file'); ?>" id="path_file" class="form-control col-md-7 col-xs-12" name="path_file"  type="text">
          </div>
        </div>
        <div class="form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file">File
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
           <div id="option_file">
             <?php if ($surat_keluar['file']) { ?>
             <div id="aksi_file">
               <a href="<?php echo base_url('uploads/surat_keluar/' . $surat_keluar['file']) ?>" class="btn btn-info btn-xs" target="_blank">Lihat</a> <button id="btn_hapus" type="button" class="btn btn-danger btn-xs" onclick="showDeleteFile('<?php echo $surat_keluar['file'] ?>')" >Hapus</button>
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
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="catatan_tambahan_keluar">Catatan
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <textarea id="catatan_tambahan_keluar" name="catatan_tambahan_keluar"  class="form-control col-md-7 col-xs-12"><?php echo $surat_keluar['catatan_tambahan']; ?></textarea>
        </div>
      </div>
      <div class="ln_solid"></div>
      <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
          <a href="<?php echo base_url('surat_keluar/lihat') ?>" class="btn btn-primary">Cancel</a>
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

    $('#frm_ubah_surat_keluar').parsley({

    });
  });

   function showDeleteFile(file){
    var x= $('#modal_delete_file');
    x.modal('show');
    $('.btn-ok').click(function() {
      $.ajax({
        url: '<?php echo base_url('surat_keluar/ajax_delete_file') ?>',
        type: 'POST',
        data: {file:file,id_surat_keluar: '<?php echo $surat_keluar['id_surat_keluar'] ?>'},
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

