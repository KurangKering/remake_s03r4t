<div class="row" >
  <div class="col-lg-12">
    <div class="ibox ">

      <div class="ibox-content">
        <form id="frm_edit_user" data-parsley-validate class="form-horizontal" method="POST"  enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input value="<?php echo $user['username']; ?>" id="username" class="form-control" name="username"  disabled type="text">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fullname">Nama Lengkap
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input value="<?php echo set_value('fullname') ? set_value('fullname') : $user['fullname']; ?>" id="fullname" class="form-control" name="fullname"  required="required" type="text">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input value="<?php echo set_value('email') ? set_value('email') : $user['email']; ?>" id="email" class="form-control" name="email"  required="required" type="email">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Nomor HP
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input value="<?php echo set_value('phone') ? set_value('phone') : $user['phone']; ?>" id="phone" class="form-control" name="phone"  required="required" type="text">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input value="" id="password" class="form-control" name="password"  placeholder="Kosongkan jika tidak ingin merubah password"  type="password">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password_conf">Password Confirmation
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input data-parsley-equalto="#password" value="" id="password_conf"  placeholder="Kosongkan jika tidak ingin merubah password" class="form-control" name="password_conf"   type="password">
            </div>
          </div>

          <br>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-4 col-md-offset-4">
              <button id="send" type="submit" class="btn btn-success">Simpan</button>
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


    $('#frm_edit_user').parsley({

    });
  });
</script>