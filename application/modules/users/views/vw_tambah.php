<div class="row" >
  <div class="col-lg-12">
    <div class="ibox ">

      <div class="ibox-content">
        <form id="frm_tambah_users" data-parsley-validate class="form-horizontal" method="POST"  enctype="multipart/form-data">

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input value="<?php echo set_value('username'); ?>" id="username" class="form-control" name="username"  required="required" type="text">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fullname">Nama Lengkap
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input value="<?php echo set_value('fullname'); ?>" id="fullname" class="form-control" name="fullname"  required="required" type="text">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
            <input value="<?php echo set_value('email'); ?>" id="email" class="form-control" name="email"  required="required" type="email">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Nomor HP
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input value="<?php echo set_value('phone'); ?>" id="phone" class="form-control" name="phone"  required="required" type="text">
            </div>
          </div>

          <div class="form-group">
            <label for="active" class="control-label col-md-3 col-sm-3 col-xs-12">Active </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="radio">
                <div class="col-md-3">
                  <input type="radio"  class="i-checks" name="active" id="active_1"  value="1" checked> Ya
                </div>
                <div class="col-md-3">
                  <input type="radio"  class="i-checks" name="active" id="active_2" value="2"> Tidak
                </div>
              </div>
            </div>
          </div>


          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input value="<?php echo set_value('password'); ?>" id="password" class="form-control" name="password"  required="required" type="password">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password_conf">Password Confirmation
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input data-parsley-equalto="#password" value="<?php echo set_value('password_conf'); ?>" id="password_conf" class="form-control" name="password_conf"  required="required" type="password">
            </div>
          </div>
          <div class="form-group">
            <div class="col-lg-10 col-lg-offset-1">
              <div class="ibox float-e-margins">
                <div class="ibox-title">
                  <h5>Groups</h5>
                  <div class="ibox-tools">
                    <a class="collapse-link">
                      <i class="fa fa-chevron-up"></i>
                    </a>

                  </div>
                </div>
                <div class="ibox-content">
                  <div>
                    <div>
                    </div>
                    <?php foreach ($groups as $group):?>
                      <div class="col-md-6">

                        <label class="checkbox">
                          <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>" >
                          <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
                        </label>
                      </div>
                      
                    <?php endforeach?>

                  </div>
                </div>
              </div>

            </div>
          </div>



          <br>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-4 col-md-offset-4">
              <a href="<?php echo base_url('users/lihat') ?>" class="btn btn-primary">Cancel</a>
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