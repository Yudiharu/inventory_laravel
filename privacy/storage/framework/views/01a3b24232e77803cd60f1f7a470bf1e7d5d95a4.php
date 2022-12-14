

<?php $__env->startSection('adminlte_css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('vendor/adminlte/plugins/iCheck/square/blue.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('vendor/adminlte/css/auth.css')); ?>">
    <link rel="icon" type="image/png" href="/gui_inventory_laravel/css/logo_gui.png" sizes="16x16">
    <link rel="icon" type="image/png" href="/gui_inventory_laravel/css/logo_gui.png" sizes="32x32">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <?php echo $__env->yieldContent('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body_class', 'login-page'); ?>

<?php $__env->startSection('body'); ?>
<style>
.body_class, .login-page, .content {
    background: url("warehouse.jpg");
    background-size:cover;
    overflow: hidden;
}
</style>
<br><br>
<?php echo $__env->make('sweet::alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body onLoad="panggil()">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?php echo e(url(config('adminlte.dashboard_url', 'home'))); ?>"><?php echo config('adminlte.logo', '<b>Admin</b>LTE'); ?></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
             <?php echo Form::open(['id'=>'ADD']); ?>

                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <?php echo e(Form::label('tanggal_awal', 'Tutup Periode:')); ?>

                                        <?php echo e(Form::select('tanggal_awal',$tanggal,null, ['class'=> 'form-control','id'=>'tanggal1','onchange'=>'load();'])); ?>

                                    </div>
                                    <div class="col-sm-6">
                                        <?php echo e(Form::label('tanggal_akhir', 'Buka Periode:')); ?>

                                        <?php echo e(Form::text('tanggal_akhir',null, ['class'=> 'form-control','id'=>'tanggal2','placeholder'=>'Periode Baru','readonly'])); ?>

                                    </div>
                                </div>   
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <button type="button" class="tombol1 btn btn-success btn-md" id="button1">Submit</button>
                                <?php echo e(Form::button('Close', ['class' => 'btn btn-danger','data-dismiss'=>'modal'])); ?>&nbsp;
                            </div>
                        </div>
                    <?php echo Form::close(); ?>

        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->
</body>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('adminlte_js'); ?>
    <script src="<?php echo e(asset('vendor/adminlte/plugins/iCheck/icheck.min.js')); ?>"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });

        function panggil(){
            load();
            var registerForm = $("#ADD");
            var formData = registerForm.serialize();

            swal({
                title: "<b>Proses Sedang Berlangsung</b>",
                type: "warning",
                showCancelButton: false,
                showConfirmButton: false
            })

            $.ajax({
                url: '<?php echo route('start.change'); ?>',
                type: 'POST',
                data:formData,
                success: function(data) {
                    console.log(data);
                    if (data.success === true) {
                        swal("Done!", data.message, "success");
                    } else {
                        swal("Error!", data.message, "error");
                    }
                },
            });
        }

        function load(){
            var open = $("#tanggal1").val();
            
            if(open == null){
                swal("Gagal!", "Silahkan Re-Open Close Terlebih Dahulu");
                button1.disabled = true;
            }
            else{
                 var newdate = new Date(open);
                 var dd = newdate.getDate();
                 var mm = newdate.getMonth() + 1;
                 var y = newdate.getFullYear();

                 var dd_new = '01';

                 if(mm<12){
                     var mm_new = mm+1;

                     var someFormattedDate = y + '-' + mm_new + '-' + dd_new;
                     console.log(someFormattedDate)
                     document.getElementById('tanggal2').value = someFormattedDate;
                 }
                 else if(mm==12){
                     var mm_new = '01';
                     var y_new = y+1;

                     var someFormattedDate = y_new + '-' + mm_new + '-' + dd_new;
                     console.log(someFormattedDate)
                     document.getElementById('tanggal2').value = someFormattedDate;
                 }
            }  
        }

        // $('#button1').click( function () {
        //     var registerForm = $("#ADD");
        //     var formData = registerForm.serialize();

        //     swal({
        //             title: "<b>Proses Sedang Berlangsung</b>",
        //             type: "warning",
        //             showCancelButton: false,
        //             showConfirmButton: false
        //         })

        //                 $.ajax({
        //                     url: '<?php echo route('start.change'); ?>',
        //                     type: 'POST',
        //                     data:formData,
        //                     success: function(data) {
        //                         console.log(data);
        //                         if (data.success === true) {
        //                     swal("Done!", data.message, "success");
        //                 } else {
        //                     swal("Error!", data.message, "error");
        //                 }
        //             },
        //         });
        //     }
        // );

    </script>
    <?php echo $__env->yieldContent('js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>