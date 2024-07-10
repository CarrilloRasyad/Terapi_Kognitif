  <div class="container">
    <div class="row pt-4">
      <div class="col-md-6">
        <h2>Edit Akun</h2>
        <?php if ($this->session->flashdata('message')) : ?>
                <?= $this->session->flashdata('message'); ?>
        <?php endif; ?>
        <?= form_open_multipart('profile/update');?>
		  <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email" value="<?= $users['email']; ?>" readonly>
      </div>
      <div class="form-group">
        <label for="name">Nama Lengkap</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $users['name']; ?>" placeholder="Masukan nama lengkap baru">
        <?= form_error('name','<small class="text-danger pl-3">', '</small>'); ?>
      </div>
          <button type="submit" class="btn btn-dark">Update</button>
          <?= form_close(); ?>
      </div>
    </div>
  </div>