

<?php $__env->startSection('title', 'User Edit'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<body onLoad="load()">
    <div class="box">
        <div class="box-header with-border">
            <a href="<?php echo e($list_url); ?>" class="btn btn-light btn-xs pull-left"> <i class="fa fa-arrow-circle-left"></i> Kembali</a>
        </div>

        <div class="box-body">

            <?php echo Form::model($user, ['route' => ['users.update', $user->id],'method' => 'put']); ?>


                <div class="form-group">
                    <?php echo e(Form::label('name', 'Full Name:')); ?>

                    <?php echo e(Form::text('name', null, ['class'=> 'form-control'])); ?>

                </div>

                <div class="form-group">
                    <?php echo e(Form::label('username', 'Username:')); ?>

                    <?php echo e(Form::text('username', null, ['class'=> 'form-control'])); ?>

                </div>

                <div class="form-group">
                    <?php echo e(Form::label('email', 'Email:')); ?>

                    <?php echo e(Form::text('email', null, ['class'=> 'form-control','readonly'])); ?>

                </div>

                <div class="form-group">
                    <?php echo e(Form::label('password', 'Password:')); ?>

                    <?php echo e(Form::password('password', ['class'=> 'form-control'])); ?>

                </div>

                <div class="form-group">
                    <?php echo e(Form::label('password_confirmation', 'Password Confirmation:')); ?>

                    <?php echo e(Form::password('password_confirmation', ['class'=> 'form-control'])); ?>

                </div>

                <div class="box-footer">
                    <div class="row pull-right">
                        <div class="col-md-12 ">
                            <?php echo e(Form::submit('Update', ['class' => 'btn btn-success btn-sm'])); ?>

                        </div>
                    </div>
                </div>

            <?php echo Form::close(); ?>


        </div>

    </div>

    <button type="button" class="back2Top btn btn-warning btn-xs" id="back2Top"><i class="fa fa-map-marker" style="color: #fff"></i> <i>PT. SELARAS UNGGUL BERSAMA</i> <b>(<?php echo e($nama_lokasi); ?>)</b></button>

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

<?php $__env->startPush('js'); ?>
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
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>