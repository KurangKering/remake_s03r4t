
<div class="row" >
  <div class="col-lg-12">
    <div class="ibox ">
      <div class="ibox-content">
        <form id="frm_tambah_surat_keluar" data-parsley-validate class="form-horizontal" method="POST"  enctype="multipart/form-data">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_surat_keluar">No. Surat Keluar
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input data-parsley-type="number" value="<?php echo set_value('no_surat_keluar'); ?>" id="no_surat_keluar" class="form-control col-md-7 col-xs-12" name="no_surat_keluar"  required="required" type="text">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_surat">Tanggal Masuk
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input  
              value="<?php echo set_value('tgl_surat') ? set_value('tgl_surat') : date('Y-m-d'); ?>" 
              id="tgl_surat"  
              class="form-control col-md-7 col-xs-12" 
              name="tgl_surat"  
              required="required" 
              type="date">
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
         <!-- <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pembuat_surat_id">ID Pembuat Surat
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input  value="<?php echo set_value('pembuat_surat_id'); ?>" id="pembuat_surat_id" name="pembuat_surat_id"  class="form-control col-md-7 col-xs-12" required="required" type="text">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pembuat_surat_text">Pembuat Surat
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input  value="<?php echo set_value('pembuat_surat_text'); ?>" id="pembuat_surat_text" name="pembuat_surat_text"  class="form-control col-md-7 col-xs-12" required="required" type="text">
          </div>
        </div> -->
        
        <div class="form-group">
          <label for="perihal" class="control-label col-md-3 col-sm-3 col-xs-12">Perihal</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input  value="<?php echo set_value('perihal'); ?>" id="perihal" name="perihal"  class="form-control col-md-7 col-xs-12"  required="required" type="text">
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
            <input  value="<?php echo set_value('no_resi_pengiriman'); ?>" id="no_resi_pengiriman" class="form-control col-md-7 col-xs-12" name="no_resi_pengiriman"  required="required" type="text" data-parsley-type="number">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal_pengiriman">Tanggal Pengiriman
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input  
            value="<?php echo set_value('tanggal_pengiriman') ? set_value('tanggal_pengiriman') : date('Y-m-d'); ?>" 
            id="tanggal_pengiriman" 
            class="form-control col-md-7 col-xs-12" 
            name="tanggal_pengiriman"  
            required="required" 
            type="date">
          </div>
        </div>


        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="path_file">Path File
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
          <input  value="<?php echo set_value('path_file'); ?>" id="path_file" class="form-control col-md-7 col-xs-12" name="path_file"  type="text">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file">File
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="file" accept="application/pdf" name="file"  class=" col-md-7 col-xs-12" type="file">
          </div>
        </div>
        


        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="catatan_tambahan_keluar">Catatan
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea id="catatan_tambahan_keluar" name="catatan_tambahan_keluar"  class="form-control col-md-7 col-xs-12"> </textarea>
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

<script>
  $(document).ready(function () {
    $('.i-checks').iCheck({
      checkboxClass: 'icheckbox_square-green',
      radioClass: 'iradio_square-green',
    });


    $('#frm_tambah_surat_keluar').parsley({

    });
  });
</script>


