<div class="row" >
  <div class="col-lg-12">
    <div class="ibox ">
      <div class="ibox-content">
        <form id="frm_tambah_surat_masuk" data-parsley-validate class="form-horizontal" method="POST"  enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $arsip['id']; ?>">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomor_arsip">No. Arsip
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input value="<?php echo $arsip['nomor_arsip']; ?>" id="nomor_arsip" class="form-control" name="nomor_arsip"  required="required" type="text">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal_masuk_arsip">Tanggal Masuk Arsip
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input 
              pattern="\d{1,2}/\d{1,2}/\d{4}"
              placeholder="dd/mm/YYYY" 
              value="<?php echo date_converter($arsip['tanggal_masuk_arsip']); ?>" 
              id="tanggal_masuk_arsip"  
              class="form-control" 
              name="tanggal_masuk_arsip"  
              required="required" 
              type="date">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_ruang">Ruang
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="no_ruang" class="form-control">
                <?php foreach ($ref_eselon as $key => $ese): ?>
                  <?php if ($ese['id'] == $arsip['no_ruang']): ?>
                    <?php $selected = 'selected'; ?>
                  <?php else: ?>
                    <?php $selected = ''; ?>
                  <?php endif ?>
                  <option <?php echo $selected ?> value="<?php echo $ese['id']; ?>" ><?php echo $ese['nama']; ?></option>   
                <?php endforeach ?>


              </select>
            </div>
          </div>


          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_lemari">Nomor Lemari
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="no_lemari" class="form-control">
                <?php foreach ($this->config->item('surat_arsip')['no_lemari'] as $key => $no_lemari): ?>
                  <?php if ($key == $arsip['no_lemari']): ?>
                    <?php $selected = 'selected'; ?>
                  <?php else: ?>
                    <?php $selected = ''; ?>
                  <?php endif ?>
                  <option <?php echo $selected ?>  value="<?php echo $key ?>" ><?php echo $no_lemari ?></option>             
                <?php endforeach ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_rak">Nomor Rak
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="no_rak" class="form-control">
                <?php foreach ($this->config->item('surat_arsip')['no_rak'] as $key => $no_rak): ?>
                 <?php if ($key == $arsip['no_rak']): ?>
                  <?php $selected = 'selected'; ?>
                <?php else: ?>
                  <?php $selected = ''; ?>
                <?php endif ?>
                <option value="<?php echo $key ?>" <?php echo $selected ?> ><?php echo $no_rak ?></option>             
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_berkas">Berkas
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="no_berkas" class="form-control">
              <?php foreach ($nomor_berkas as $key => $no_berkas): ?>
                <?php if ($no_berkas['id'] == $arsip['no_berkas']): ?>
                  <?php $selected = 'selected'; ?>
                <?php else: ?>
                  <?php $selected = ''; ?>
                <?php endif ?>
                <option value="<?php echo $no_berkas['id']; ?>" <?php echo $selected ?> ><?php echo $no_berkas['nama_box']; ?></option>             
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_penyerah">Nama Penyerah
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input  value="<?php echo $arsip['nama_penyerah']; ?>" id="nama_penyerah" name="nama_penyerah"  class="form-control" required="required" type="text">
          </div>
        </div>
        <div class="form-group">
          <label for="lengkap" class="control-label col-md-3 col-sm-3 col-xs-12">Lengkap </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="radio">
              <div class="col-md-3">
                <input type="radio"  class="i-checks" name="lengkap" id="lengkap_1"  value="Y" <?php echo $arsip['lengkap'] == 'Y' ? 'checked' : '' ?> > Ya
              </div>
              <div class="col-md-3">
                <input type="radio"  class="i-checks" name="lengkap" id="lengkap_2" value="N" <?php echo $arsip['lengkap'] == 'N' ? 'checked' : '' ?> >  Tidak
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Status
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="status" class="form-control">
              <?php foreach ($this->config->item('surat_arsip')['status'] as $key => $status): ?>
                <?php if ($key == $arsip['status']): ?>
                  <?php $selected = 'selected'; ?>
                <?php else: ?>
                  <?php $selected = ''; ?>
                <?php endif ?>
                <option value="<?php echo $key ?>" <?php echo $selected ?> ><?php echo $status ?></option>             
              <?php endforeach ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keterangan">Keterangan</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea id="keterangan" name="keterangan"  class="form-control"><?php echo $arsip['keterangan']; ?></textarea>
          </div>
        </div>
        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-6 col-md-offset-3">
            <a href="<?php echo base_url('arsip/lihat') ?>" class="btn btn-primary">Cancel</a>
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