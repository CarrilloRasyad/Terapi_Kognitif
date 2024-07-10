<div class="container pb-5">
  <div class="row pt-6 pb-5 align-items-center">
    <div class="col-lg-6 mb-3">
      <img src="<?= base_url('assets/') ?>img1/couple.png" alt="" class="w-100 rounded">
    </div>
    <div class="col-lg-5">
      <div class="card o-hidden border-0 shadow-lg my-5">
            </div>
            <?= $this->session->flashdata('message'); ?>
            <form class="user" method="post" action="<?= base_url('auth/changepassword'); ?>">
              <div class="form-group">
                <input type="password" class="form-control form-control-user"
                  id="password1" name="password1" placeholder="Masukkan Password Baru Anda">
                  <?= form_error('password1','<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="form-group">
                <input type="password" class="form-control form-control-user"
                  id="password2" name="password2" placeholder="Ulangi Password Anda">
                  <?= form_error('password2','<small class="text-danger pl-3">', '</small>'); ?>
              </div>      
              <button type="submit" class="btn btn-dark btn-user btn-block">
                Ganti Password
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
