<?php $__env->startSection('title', 'Manages Role'); ?>

<?php $__env->startSection('content_header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <link rel="icon" type="image/png" href="/gui_inventory_laravel/css/logo_gui.png" sizes="16x16" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<?php echo $__env->make('sweet::alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body onLoad="load()">
    <div class="box box-solid">
        <div class="box-body">
            <div class="box">
                <div class="box-body">
                    <?php if (app('laratrust')->can('read-roles')) : ?>
                    <a href="<?php echo e($create_url); ?>" class="btn btn-info btn-xs"><i class="fa fa-plus"></i> New role</a>
                    <?php endif; // app('laratrust')->can ?>
                    <span class="pull-right">
                        <?php if (app('laratrust')->can('read-users')) : ?>
                        <a href="<?php echo e(route('users.index')); ?>" class="btn btn-success btn-xs">Manages User</a>
                        <?php endif; // app('laratrust')->can ?>
                        <?php if (app('laratrust')->can('read-permissions')) : ?>
                        <a href="<?php echo e(route('permissions.index')); ?>" class="btn btn-primary btn-xs" onclick="refreshTable()">Manages Permission</a>
                        <?php endif; // app('laratrust')->can ?>
                    </span>
                </div>
            </div>
            <?php echo $dataTable->table(['class' => 'table table-bordered', 'style' => "font-size: 14px;"], true); ?>

        </div>
    </div>

    <button type="button" class="back2Top btn btn-warning btn-xs" id="back2Top"><i class="fa fa-arrow-up" style="color: #fff"></i> <i><?php echo e($nama_company); ?></i> <b>(<?php echo e($nama_lokasi); ?>)</b></button>

        <style type="text/css">
            #back2Top {
                width: 400px;
                line-height: 27px;
                overflow: hidden;
                z-index: 999;
                display: none;
                cursor: pointer;
                position: fixed;
                bottom: 0;
                text-align: left;
                font-size: 15px;
                color: #000000;
                text-decoration: none;
            }
            #back2Top:hover {
                color: #fff;
            }
        </style>
</body>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('js'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <?php echo $dataTable->scripts(); ?>


    <script>
        $(window).scroll(function() {
            var height = $(window).scrollTop();
            if (height > 1) {
                $('#back2Top').show();
            } else {
                $('#back2Top').show();
            }
        });
        
        $(document).ready(function() {
            $("#back2Top").click(function(event) {
                event.preventDefault();
                $("html, body").animate({ scrollTop: 0 }, "slow");
                return false;
            });

        });

        function load(){
            startTime();
            $('.back2Top').show();
        }
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function refreshTable() {
             $('#dataTableBuilder').DataTable().ajax.reload();;
        }
        function del(id, url) {
            swal({
            title: "Hapus?",
            text: "Pastikan dahulu role yang akan di hapus",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                swal({
                    title: "<b>Proses Sedang Berlangsung</b>",
                    type: "warning",
                    showCancelButton: false,
                    showConfirmButton: false
                })

                $.ajax({
                    type: 'DELETE',
                    url: url,
                    
                    success: function (results) {
                    console.log(results);
                        if (results.success === true) {
                            swal("Berhasil!", results.message, "success");
                        } else {
                            swal("Role gagal di hapus.");
                        }
                          
                        refreshTable();
                    }
                });
            }
            });
        }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>