<?php $this->load->view('admin/datepicker'); ?>
<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <h3 class="">
            Report Presensi
            <span class="pull-right">
                <a class="btn btn-sm btn-default" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" ><span class="glyphicon glyphicon-align-justify"></span></a>
                <a class="btn btn-sm btn-success" href="<?php echo site_url('admin/present/export_excel' . '/?' . http_build_query($q)) ?>" ><span class="glyphicon glyphicon-print"></span></a>
				
            </span>
        </h3>
        <div class="collapse" id="collapseExample">
            <?php echo form_open(current_url(), array('method'=>'get')) ?>
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="n" placeholder="Nip" class="form-control">
                </div>
                <div class="col-md-3">
                    <input type="text" name="ds" placeholder="Tanggal Mulai" value="" class="form-control datepicker">
                </div>
                <div class="col-md-3">
                    <input type="text" name="de" placeholder="Tanggal Akhir" value="" class="form-control datepicker">
                </div>
                <div class="col-md-2">
                    <input type="submit" class="btn btn-success" value="Filter">
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
        <div class="pagination">
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
</div>