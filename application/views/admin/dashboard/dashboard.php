<?php $this->load->view('admin/datepicker'); ?>
<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <h3 class="">
            List Absensi
            <a  data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" ><span class="glyphicon glyphicon-plus-sign"></span></a>
        </h3>
        <div class="collapse" id="collapseExample">
            <?php echo form_open(current_url()) ?>
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="member_nip" placeholder="Nip" class="form-control">
                </div>
                <div class="col-md-4">
                    <input type="text" name="present_date" placeholder="Tanggal" value="<?php echo date('Y-m-d') ?>" class="form-control datepicker">
                </div>
                <div class="col-md-2">
                    <select name="present_desc" class="form-control">
                        <option value="Sakit">Sakit</option>
                        <option value="Izin">Izin</option>
                        <option value="Alfa">Alfa</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="submit" class="btn btn-success">
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
        <?php echo validation_errors() ?>
        <br>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="gradient">
                    <tr>
                       <tr>
                                    <th class="col-no">No.</th>
                                    <th>Tanggal</th>
                                    <th class="col-name">Nama</th>
                                    <th class="col-ket">Datang</th>
                                    <th class="col-ket">Pulang</th>
                                    <th>Kehadiran</th>
                                    <th class="col-ket">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i= 1; foreach ($present as $row): ?>
                                    <tr>
                                        <td  class="col-no"><?php echo $i ?></td>
                                        <td><?php echo pretty_date($row['present_date'], 'l, d m Y', FALSE) ?></td>
                                        <td class="col-name"><?php echo $row['member_full_name'] ?></td>
                                        <td class="col-ket"><?php echo ($row['present_entry_time'] == NULL) ? '-' : $row['present_entry_time'] ?></td>
                                        <td class="col-ket"><?php echo ($row['present_out_time'] == NULL) ? '-' : $row['present_out_time'] ?></td>
                                        <td><?php echo $row['present_desc'] ?></td>
                                        <td class="col-ket"><?php echo ($row['present_is_late'] == 1) ? 'Telat' : '-' ?></td>
                                    </tr>
                                <?php $i++; endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>