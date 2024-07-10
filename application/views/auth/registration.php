<div class="container pb-5">
  <div class="row pt-6 pb-5 align-items-center">
    <div class="col-lg-6 mb-3">
      <img src="<?= base_url('assets/')?>img1/couple.png" alt="" class="w-100 rounded">
    </div>
    <div class="col-lg-6 ">
        <div class="card-body p-0">
          <div class="p-5">
            <form class="user" method="post" action="<?= base_url('auth/registration');?>">
              <div class="form-group">
                <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Nama Lengkap" value="<?= set_value('name'); ?>">
                <?= form_error('name','<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="form-group">
                <input type="text" class="form-control form-control-user" id="name" name="email" placeholder="Email Anda" value="<?= set_value('email'); ?>">
                <?= form_error('email','<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="form-group">
                <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                <?= form_error('password1','<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="form-group">
                <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Konfirmasi Password">
              </div>
              <button type="submit" class="btn btn-dark btn-user btn-block">
                Buat Akun
              </button>
            </form>
            <hr>
            <div class="text-center">
              <a class="text-dark small" href="<?= base_url('auth'); ?>">Sudah punya akun? Masuk disini!</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
