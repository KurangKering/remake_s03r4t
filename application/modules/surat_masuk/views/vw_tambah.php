<div class="row" >
  <div class="col-lg-12">
    <div class="ibox ">
          <div class="ibox-content">
            <form id="frm_tambah_surat_masuk" data-parsley-validate class="form-horizontal" method="POST"  enctype="multipart/form-data">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_lembar_disposisi">No. Lembar Disposisi
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input value="<?php echo set_value('no_lembar_disposisi'); ?>" id="no_lembar_disposisi" class="form-control" name="no_lembar_disposisi"  required="required" data-parsley-type="number">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal_masuk">Tanggal Masuk
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input 
                  
                  placeholder="dd/mm/YYYY" 
                  value="<?php echo set_value('tanggal_masuk') ? set_value('tanggal_masuk') : date('Y-m-d') ?>" 
                  id="tanggal_masuk"  
                  class="form-control" 
                  name="tanggal_masuk"  
                  required="required" 
                  type="date">
                </div>
              </div>
              <div class="form-group">
                <label for="tujuan_id" class="control-label col-md-3 col-sm-3 col-xs-12">Tujuan </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="radio">
                    <div class="col-md-3">
                      <input type="radio"  class="i-checks" name="tujuan_id" id="tujuan_id_1"  value="1" checked> Utama
                    </div>
                    <div class="col-md-3">
                      <input type="radio"  class="i-checks" name="tujuan_id" id="tujuan_id_2" value="2"> Tembusan
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pengirim">Pengirim
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input  value="<?php echo set_value('pengirim'); ?>" id="pengirim" name="pengirim"  class="form-control" required="required" type="text">
                </div>
              </div>
              
              <div class="form-group">
                <label for="perihal" class="control-label col-md-3 col-sm-3 col-xs-12">Perihal</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input  value="<?php echo set_value('perihal'); ?>" id="perihal" name="perihal"  class="form-control"  required="required" type="text">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="disposisi_tujuan_id">Tujuan Disposisi
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="disposisi_tujuan_id" class="form-control">
                    <?php foreach ($tujuan_disposisi as $key => $tujuan): ?>
                      <option value="<?php echo $tujuan['id'] ?>"><?php echo $tujuan['nama'] ?></option>             
                    <?php endforeach ?>
                  </select>
                  <!--  <input id="diposisi_tujuan" name="diposisi_tujuan"   class="form-control" type="text"> -->
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file">File</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="file" accept="application/pdf" name="file"  class=" col-md-7 col-xs-12" type="file">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="catatan_tambahan">Catatan</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea id="catatan_tambahan" name="catatan_tambahan"  class="form-control"> </textarea>
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

    <!-- iCheck -->
    
    <script>
      $(document).ready(function () {
        $('.i-checks').iCheck({
          checkboxClass: 'icheckbox_square-green',
          radioClass: 'iradio_square-green',
        });


        $('#frm_tambah_surat_masuk').parsley({

        });
      });
    </script>