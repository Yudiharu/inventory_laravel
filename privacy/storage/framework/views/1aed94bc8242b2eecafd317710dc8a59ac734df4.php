<?php $__env->startSection('title', 'Reopen'); ?>

<?php $__env->startSection('content_header'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<?php echo $__env->make('sweet::alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body onLoad="load()">
  <div class="box-body">
        
            <?php echo $__env->make('errors.validation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo Form::open(['route'=>'reopen.change','method' => 'post']); ?>


            <div class="row">
                <div class="col-md-6">
                   <div class="box">
                       <div class="box-header">
                           <h3 class="box-title">Re-<b>Open</b></h3>
                       </div>
                       <div class="box-body">
                           <div class="form-group">
                               <label class="col-sm-8">
                                   <?php echo e(Form::selectMonth('month', null, ['class'=> 'form-control select2','id'=>'namabulan','placeholder'=>'','style'=>'width: 100%'])); ?>

                               </label>
                           </div>
                           <div class="form-group">
                               <label class="col-sm-8">
                                   <?php echo e(Form::selectYear('year', 2000, 2040, null, ['class'=> 'form-control select3','id'=>'namatahun','placeholder'=>'','style'=>'width: 100%'])); ?>

                               </label>
                           </div>
                           <div class="form-group">
                               <label class="col-sm-4">
                                   <?php echo e(Form::submit('Submit', ['class' => 'btn btn-success btn-sm','id'=>'submit','style'=>'width: 100%'])); ?>

               
                                    <?php echo Form::close(); ?>

                               </label>
                           </div>
                       </div>
                   </div>
                </div>
        
                <?php echo Form::open(['route'=>'reopen.change2','method' => 'post']); ?>

                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Re-Open <b>Close</b></h3>
                        </div>
                        <div class="box-body">
                                <div class="form-group">
                               <label class="col-sm-8">
                                   <?php echo e(Form::selectMonth('month2', $info_bulan, ['class'=> 'form-control select2','id'=>'namabulan2','placeholder'=>'','style'=>'width: 100%'])); ?>

                               </label>
                           </div>
                           <div class="form-group">
                               <label class="col-sm-8">
                                   <?php echo e(Form::selectYear('year2', 2000, 2040, $info_tahun, ['class'=> 'form-control select3','id'=>'namatahun2','placeholder'=>'','style'=>'width: 100%'])); ?>

                               </label>
                           </div>
                           <div class="form-group">
                               <label class="col-sm-4">
                                   <?php echo e(Form::submit('Submit', ['class' => 'btn btn-success btn-sm','id'=>'submit','style'=>'width: 100%'])); ?>

               
                                    <?php echo Form::close(); ?>

                               </label>
                           </div>
                        </div>
                    </div>
                </div>
            
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

<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startPush('js'); ?>
  
    <script type="text/javascript">
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
            $('.tombol1').hide();
            $('.back2Top').show();
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.select2').select2({
            placeholder: "Pilih Bulan",
            allowClear: true,
        });

        $('.select3').select2({
            placeholder: "Pilih Tahun",
            allowClear: true,
        });

        function refreshTable() {
             $('#data-table').DataTable().ajax.reload(null,false);;
        }

        $('.modal-dialog').draggable({
            handle: ".modal-header"
        });

        $('.modal-dialog').resizable({
    
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>