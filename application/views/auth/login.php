<div class="container pb-5">
  <div class="row pt-6 pb-5 align-items-center">
    <div class="col-lg-6 mb-3">
      <img src="assets/img1/couple.png" alt="" class="w-100 rounded">
    </div>
    <div class="col-lg-5">
      <div class="card o-hidden border-0 shadow-lg my-5">
            </div>
            <?= $this->session->flashdata('message'); ?>
            <form class="user" method="post" action="<?= base_url('auth'); ?>">
              <div class="form-group">
                <input type="text" class="form-control form-control-user"
                  id="email" name="email" placeholder="Masukkan Email Anda" value="<?= set_value('email');?>">
                  <?= form_error('email','<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="form-group">
                <input type="password" class="form-control form-control-user"
                  id="password" name="password" placeholder="Password">
                  <?= form_error('password','<small class="text-danger pl-3">', '</small>'); ?>
              </div>      
              <button type="submit" class="btn btn-dark btn-user btn-block">
                Masuk
              </button>
            </form>
            <hr>
            <div class="text-center">
              <a class="text-dark small" href="<?= base_url('auth/forgotpassword') ?>">Lupa Password?</a>
            </div>
            <div class="text-center">
              <a class="text-dark small" href="<?= base_url('auth/registration'); ?>">Buat Akun Anda!</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
