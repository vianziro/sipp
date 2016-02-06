<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <div class="col-md-12 main">
            <h3>
                Detail Profil
                <span class=" pull-right">
                    <a href="<?php echo site_url('member/profile/edit/') ?>" class="btn btn-success btn-sm"><span class="fa fa-edit"></span>&nbsp; Edit</a> 
                </span>
            </h3><br>
        </div>
        <div class="col-md-2">
            <?php if (!empty($member['member_image'])) { ?>
            <img src="<?php echo upload_url('member_photo/'.  pretty_date($member['member_input_date'], 'Y/m/d/', FALSE).$member['member_image']) ?>" class="img-responsive ava-detail">
            <?php } else { ?>
                <img src="<?php echo base_url('media/image/missing-image.png') ?>" class="img-responsive ava-detail">
            <?php } ?>
        </div>
        <div class="col-md-10">
            <table class="table table-striped">
                <tbody>
                   <tr>
                        <td>NIPM</td>
                        <td>:</td>
                        <td><?php echo $member['member_nip'] ?></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>:</td>
                        <td><?php echo $member['username'] ?></td>
                    </tr>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>:</td>
                        <td><?php echo $member['member_full_name'] ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td><?php echo ($member['member_sex'] == 'MALE') ? 'Laki-laki' : 'Perempuan' ?></td>
                    </tr>
                    <tr>
                        <td>Tempat/Tanggal Lahir</td>
                        <td>:</td>
                        <td><?php echo $member['member_birth_place'] . ', ' . pretty_date($member['member_birth_date'], 'd F Y', FALSE) ?></td>
                    </tr>
                    <tr>
                        <td>Asal Sekolah</td>
                        <td>:</td>
                        <td><?php echo $member['member_school'] ?></td>
                    </tr>
                    <tr>
                        <td>Pembimbing Prakerin</td>
                        <td>:</td>
                        <td><?php echo $member['member_mentor'] ?></td>
                    </tr>
                    <tr>
                        <td>No. Telepon</td>
                        <td>:</td>
                        <td><?php echo $member['member_phone'] ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><?php echo ($member['member_address'] == NULL) ? '-' : $member['member_address'] ?></td>
                    </tr>
                    <tr>
                        <td>Departement</td>
                        <td>:</td>
                        <td><?php echo $member['member_division'] ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td><?php echo ($member['member_status'] == 0) ? 'Non-Aktif' : 'Aktif' ?></td>
                    </tr>
                    <tr>
                        <td>Mulai Prakerin</td>
                        <td>:</td>
                        <td><?php echo pretty_date($member['member_entry_date'], 'l, d F Y', FALSE) ?></td>
                    </tr>
                    <tr>
                        <td>Selesai Prakerin</td>
                        <td>:</td>
                        <td><?php echo pretty_date($member['member_end_date'], 'l, d F Y', FALSE == NULL ) ? '-' : pretty_date($member['member_end_date'], 'l, d M Y', FALSE) ?></td>
                    </tr>
                    <tr>
                        <td>Penilaian Predikat</td>
                        <td>:</td>
                        <td><?php echo ($member['member_score'] == NULL) ? '-' : $member['member_score']?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
