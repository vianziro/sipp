<?php $this->load->view('admin/datepicker'); ?>

<?php
if (isset($sk)) {
    $inputNumber = $sk['sk_number']; 
    $inputMemberNip = $sk['sk_member_nip'];
    $inputMemberName = $sk['sk_member_full_name'];
    $inputMemberDiv = $sk['sk_member_division'];
    $inputMemberSc = $sk['sk_member_score'];
    $inputMemberIn = $sk['sk_member_entry_date'];
    $inputMemberOut = $sk['sk_member_end_date'];
} else {
    $inputNumber = set_value('sk_number');
    $inputMemberNip = set_value('member_nip');
    $inputMemberName = set_value('member_full_name');
    $inputMemberDiv = set_value('member_division');
    $inputMemberSc = set_value('member_score');
    $inputMemberIn = set_value('member_entry_date');
    $inputMemberOut = set_value('member_end_date');
}
?>
<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <?php if (!isset($sk)) echo validation_errors(); ?>
        <?php echo form_open_multipart(current_url()); ?>
        <div>
            <h3><?php echo $operation; ?> Surat Keterangan Prakerin</h3><br>
        </div>

        <div class="row">
            <div class="col-sm-9 col-md-9">
                <?php if (isset($sk)): ?>
                    <input type="hidden" name="sk_id" value="<?php echo $sk['sk_id']; ?>" />
                <?php endif; ?>
                <label >Karyawan *</label>
                <input name="member_nip" id="field_id" type="hidden" class="form-control"  value="<?php echo $inputMemberNip ?>">
                <input name="member_full_name" id="field_name" type="hidden" class="form-control"  value="<?php echo $inputMemberName ?>">
                <input name="member_division" id="field_div" type="hidden" class="form-control"  value="<?php echo $inputMemberDiv ?>">
                <input name="member_score" id="field_scr" type="hidden" class="form-control"  value="<?php echo $inputMemberSc ?>">
                <input name="member_entry_date" id="field_in" type="hidden" class="form-control"  value="<?php echo $inputMemberIn ?>">
                <input name="member_end_date" id="field_out" type="hidden" class="form-control"  value="<?php echo $inputMemberOut ?>">
                <input id="field" type="text" class="form-control" placeholder="Ketik NIPM atau Nama Prakerin.." value="<?php echo (isset($sk)) ? $sk['sk_member_full_name'] : '' ?>">
                <br>       
                <label >Tanggal </label>
                <input type="text" name="sk_input_date" placeholder="Tanggal Selesai" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>"><br>        
                <p style="color:#9C9C9C;margin-top: 5px"><i>*) Field Wajib Diisi</i></p>
            </div>
            <div class="col-sm-9 col-md-3">
                <div class="form-group">
                    <button name="action" type="submit" value="save" class="btn btn-success btn-form"><i class="fa fa-check"></i> Simpan</button>
                    <a href="<?php echo site_url('admin/sk'); ?>" class="btn btn-info btn-form"><i class="fa fa-arrow-left"></i> Batal</a>
                    <?php if (isset($sk)): ?>
                        <a href="<?php echo site_url('admin/sk/delete/' . $sk['sk_id']); ?>" class="btn btn-danger btn-form" ><i class="fa fa-trash"></i> Hapus</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<?php if (isset($sk)): ?>
    <!-- Delete Confirmation -->
    <div class="modal fade" id="confirm-del">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><b><span class="fa fa-warning"></span> Konfirmasi Penghapusan</b></h4>
                </div>
                <div class="modal-body">
                    <p>Data yang dipilih akan dihapus oleh sistem, apakah anda yakin?;</p>
                </div>
                <?php echo form_open('admin/sk/delete/' . $sk['sk_id']); ?>
                <div class="modal-footer">
                    <a><button style="float: right;margin-left: 10px" type="button" class="btn btn-default" data-dismiss="modal">Tidak</button></a>
                    <input type="hidden" name="del_id" value="<?php echo $sk['sk_id'] ?>" />
                    <input type="hidden" name="del_name" value="<?php echo $sk['sk_number'] ?>" />
                    <button type="submit" class="btn btn-danger"> Ya</button>
                </div>
                <?php echo form_close(); ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <?php if ($this->session->flashdata('delete')) { ?>
    <script type="text/javascript">
        $(window).load(function() {
            $('#confirm-del').modal('show');
        });
    </script>
    <?php }
    ?>
<?php endif; ?>

<script>
    $(function() {

        var member_list = [
        <?php foreach ($member as $row): ?>
        {
            "id": "<?php echo $row['member_division'] ?>",
            "div": "<?php echo $row['member_division'] ?>",
            "value": "<?php echo $row['member_full_name'] ?>",
            "label": "<?php echo $row['member_full_name'] ?>",
            "scr": "<?php echo $row['member_score'] ?>",
            "in": "<?php echo $row['member_entry_date'] ?>",
            "out": "<?php echo $row['member_end_date'] ?>",
            "label_nip": "<?php echo $row['member_nip'] ?>"
                       
        },
    <?php endforeach; ?>
    ];
    function custom_source(request, response) {
        var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
        response($.grep(member_list, function(value) {
            return matcher.test(value.label)
            || matcher.test(value.label_nip);
        }));
    }

    $("#field").autocomplete({
        source: custom_source,
        minLength: 1,
        select: function(event, ui) {
                // feed hidden id field                
                $("#field_id").val(ui.item.label_nip);  
                $("#field_name").val(ui.item.value);
                $("#field_in").val(ui.item.in);
                $("#field_out").val(ui.item.out);
                $("#field_scr").val(ui.item.scr);
                $("#field_div").val(ui.item.div);
                                  

                // update number of returned rows
            },
            open: function(event, ui) {
                // update number of returned rows
                var len = $('.ui-autocomplete > li').length;
            },
            close: function(event, ui) {
                // update number of returned rows
            },
            // mustMatch implementation
            change: function(event, ui) {
                if (ui.item === null) {
                    $(this).val('');
                    $('#field_id').val('');
                }
            }
        });

        // mustMatch (no value) implementation
        $("#field").focusout(function() {
            if ($("#field").val() === '') {
                $('#field_id').val('');
            }
        });
    });
</script>