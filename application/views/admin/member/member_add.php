<?php
$this->load->view('admin/tinymce_init');
$this->load->view('admin/datepicker');
if (isset($member)) {
    $id = $member['member_id'];
    $inputUserName = $member['username'];
    $inputFullName = $member['member_full_name'];
    $inputSex = $member['member_sex'];
    $inputBirthPlace = $member['member_birth_place'];
    $inputBirthDate = $member['member_birth_date'];
    $inputSchool = $member['member_school'];
    $inputPhone = $member['member_phone'];
    $inputAddress = $member['member_address'];
    $inputMentor = $member['member_mentor'];
    $inputDivison = $member['member_division'];
    $inputStatus = $member['member_status'];
    $inputEntry = $member['member_entry_date'];
    $inputEnd = $member['member_end_date'];
    $inputScore = $member['member_score'];
} else {
    $inputUserName = set_value('username');
    $inputFullName = set_value('member_full_name');
    $inputSex = set_value('member_sex');
    $inputBirthPlace = set_value('member_birth_place');
    $inputBirthDate = set_value('member_birth_date');
    $inputSchool = set_value('member_school');
    $inputPhone = set_value('member_phone');
    $inputAddress = set_value('member_address');
    $inputMentor = set_value('member_mentor');
    $inputDivison = set_value('member_division');
    $inputStatus = set_value('member_status');
    $inputEntry = set_value('member_entry_date');
    $inputEnd = set_value('member_end_date');
    $inputScore = set_value('member_score');
}
?>
<?php echo isset($alert) ? ' ' . $alert : null; ?>
<?php echo validation_errors(); ?>
<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <div class="col-lg-12">
            <h3><?php echo $operation ?> Peserta (Super User)</h3>
            <br>
        </div>
        <!-- /.col-lg-12 -->

        <?php echo form_open_multipart(current_url()); ?>
        <div class="col-md-12">
            <div class="col-sm-12 col-md-9">
                <?php if (isset($member)): ?>
                    <input type="hidden" name="member_id" value="<?php echo $member['member_id'] ?>" />
                    <input type="hidden" name="member_input_date" value="<?php echo $member['member_input_date'] ?>" />
                    <input type="hidden" name="member_nip" value="<?php echo $member['member_nip'] ?>" />
                <?php endif; ?>                
                <label >Nama Lengkap *</label>
                <input type="text" name="member_full_name" placeholder="Nama Lengkap" class="form-control" value="<?php echo $inputFullName; ?>"><br>
                <label >Username *</label>
                <input name="username" type="text" <?php echo (isset($member)) ? '' : '' ?> placeholder="Username" class="form-control" value="<?php echo $inputUserName; ?>"><br>
                <?php if (!isset($member)): ?>
                    <label >Password *</label>
                    <input type="password" placeholder="Password" name="password" class="form-control"><br>
                    <label >Konfirmasi Password *</label>
                    <input type="password" placeholder="Konfirmasi Password" name="passconf" class="form-control">
                    <p style="color:#9C9C9C;margin-top: 5px"><i>Password minimal 6 karakter</i></p>
                <?php endif; ?>
                <label>Jenis Kelamin *</label>
                <div class="radio">
                    <label>
                        <input type="radio" name="member_sex" value="MALE" <?php echo ($inputSex == 'MALE') ? 'checked' : ''; ?>> Laki-laki
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="member_sex" value="FEMALE" <?php echo ($inputSex == 'FEMALE') ? 'checked' : ''; ?>> Perempuan
                    </label>
                </div>
                <label >Tempat Lahir *</label>
                <input type="text" name="member_birth_place" placeholder="Tempat Lahir" class="form-control" value="<?php echo $inputBirthPlace; ?>"><br>
                <label >Tanggal Lahir *</label>
                <input type="text" name="member_birth_date" placeholder="Tanggal Lahir" class="form-control datepicker" value="<?php echo $inputBirthDate; ?>"><br>
                <label >Asal Sekolah *</label>
                <input type="text" name="member_school" placeholder="Asal Sekolah" class="form-control" value="<?php echo $inputSchool; ?>"><br>
                <label >Pembimbing *</label>
                <input type="text" name="member_mentor" placeholder="Pembimbing" class="form-control" value="<?php echo $inputMentor; ?>"><br>
                <label >No. Telepon *</label>
                <input type="text" name="member_phone" placeholder="No. Telepon" class="form-control" value="<?php echo $inputPhone; ?>"><br>
                <label >Alamat </label>
                <textarea name="member_address" placeholder="Alamat" class="form-control"><?php echo $inputAddress; ?></textarea><br>
                <label >Departement </label>
                <input type="text" name="member_division" placeholder="Dept" class="form-control" value="<?php echo $inputDivison; ?>"><br>
                <label >Mulai Prakerin </label>
                <input type="text" name="member_entry_date" placeholder="Tanggal Masuk" class="form-control datepicker" value="<?php echo $inputEntry; ?>"><br>
                <label >Selesai Prakerin </label>
                <input type="text" name="member_end_date" placeholder="Tanggal Selesai" class="form-control datepicker" value="<?php echo $inputEnd; ?>"><br>
                <label >Penilaian Predikat </label>
                <input type="text" name="member_score" placeholder="Akhir Penilaian" class="form-control" value="<?php echo $inputScore; ?>"><br>

                <p style="color:#9C9C9C;margin-top: 5px"><i>*) Wajib diisi</i></p>
            </div>
            <div class="col-sm-12 col-xs-12 col-md-3">
                <div class="form-group">
                    <label >Upload Photo </label>
                    <input type="file" name="member_image" class="form-control" ><br>
                    <?php if (isset($member) AND $member['member_image'] != NULL) { ?>
                    <img src="<?php echo upload_url('member_photo/' . pretty_date($member['member_input_date'],'Y/m/d/', FALSE).$member['member_image']) ?>" class="img-responsive ava-detail"><br>
                    <?php } ?>    
                    <label>Status *</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="member_status" value="0" <?php echo ($inputStatus == '0') ? 'checked' : ''; ?>> Non-Aktif
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="member_status" value="1" <?php echo ($inputStatus == '1') ? 'checked' : ''; ?>> Aktif
                        </label>
                    </div>
                    <hr>
                    <button name="action" type="submit" value="save" class="btn btn-success btn-form"><i class="fa fa-check"></i> Simpan</button><br>
                    <a href="<?php echo site_url('admin/member'); ?>" class="btn btn-info btn-form"><i class="fa fa-arrow-left"></i> Batal</a><br>
                    <?php if (isset($member)): ?>
                        <?php if ($this->session->userdata('member_id') != $id) {
                            ?>
                            <a href="<?php echo site_url('admin/member/delete/' . $member['member_id']); ?>" class="btn btn-danger btn-form"><i class="fa fa-trash"></i> Hapus</a><br>
                        <?php } ?>
                        <?php if ($this->session->userdata('member_id') == $id) {
                            ?>
                            <a href="<?php echo site_url('admin/profile/cpw') ?>" class="btn btn-primary btn-form"><i class="fa fa-refresh"></i> Ubah Password</a><br>
                        <?php } elseif ($this->session->userdata('member_id') != $id) { ?>
                            <a class="btn btn-primary btn-form" href="<?php echo site_url('admin/member/rpw/' . $member['member_id']); ?>" ><i class="fa fa-key"></i> Reset Password</a><br>
                        <?php } ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<?php if (isset($member)): ?>
    <!-- Delete Confirmation -->
    <div class="modal fade" id="confirm-del">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><b>Konfirmasi Penghapusan</b></h4>
                </div>
                <div class="modal-body">
                    <p>Data yang dipilih akan dihapus oleh sistem, apakah anda yakin?;</p>
                </div>
                <?php echo form_open('admin/member/delete/' . $member['member_id']); ?>
                <div class="modal-footer">
                    <a><button style="float: right;margin-left: 10px" type="button" class="btn btn-default" data-dismiss="modal">Tidak</button></a>
                    <input type="hidden" name="del_id" value="<?php echo $member['member_id'] ?>" />
                    <input type="hidden" name="del_name" value="<?php echo $member['member_full_name'] ?>" />
                    <button type="submit" class="btn btn-primary">Ya</button>
                </div>
                <?php echo form_close(); ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <?php if ($this->session->flashdata('delete')) { ?>
        <script type = "text/javascript">
            $(window).load(function() {
                $('#confirm-del').modal('show');
            });
        </script>
    <?php }
    ?>
<?php endif; ?>