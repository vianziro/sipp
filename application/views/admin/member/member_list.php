<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <h3 class="">
            Daftar Peserta
            <a href="<?php echo site_url('admin/member/add'); ?>" ><span class="glyphicon glyphicon-plus-sign"></span></a>
        </h3><br>
		 
		 <a class="btn btn-sm btn-success" href="<?php echo site_url('admin/member/export')?>"> <span class="glyphicon glyphicon-print"></span></a>
			
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="gradient">
                    <tr>
                        <th>NIPM</th>
                        <th>Nama Lengkap</th>
                        <th>Asal Sekolah</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <?php				
                if (!empty($member)) {
                    foreach ($member as $row) {
                        ?>
                        <tbody>
                            <tr>
                                <td ><?php echo $row['member_nip']; ?></td>
                                <td ><?php echo $row['member_full_name']; ?></td>
                                <td ><?php echo $row['member_school']; ?></td>
                                <td ><?php echo ($row['member_status'] == 0)? 'Non-Aktif' : 'Aktif'; ?></td>
                                <td>
                                    <a class="btn btn-warning btn-xs" href="<?php echo site_url('admin/member/detail/' . $row['member_id']); ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>
                                    <a class="btn btn-success btn-xs" href="<?php echo site_url('admin/member/edit/' . $row['member_id']); ?>" ><span class="glyphicon glyphicon-edit"></span></a>
                                    <?php if ($this->session->userdata('member_id') != $row['member_id']) { ?>
                                        <a class="btn btn-primary btn-xs" href="<?php echo site_url('admin/member/rpw/' . $row['member_id']); ?>" ><span class="glyphicon glyphicon-lock"></span> Reset Password</a>
                                    <?php } else {
                                        ?>
                                        <a class = "btn btn-primary btn-xs" href = "<?php echo site_url('admin/profile/cpw/'); ?>" ><span class = "glyphicon glyphicon-repeat"></span> Ubah Password</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        </tbody>
                        <?php
                    }
                } else {
                    ?>
                    <tbody>
                        <tr id="row">
                            <td colspan="5" align="center">Data Kosong</td>
                        </tr>
                    </tbody>
                    <?php
                }
                ?>   
            </table>
        </div>
        <div >
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
</div>