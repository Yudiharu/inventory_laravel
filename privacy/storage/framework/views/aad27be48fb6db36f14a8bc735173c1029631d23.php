<?php $__env->startSection('title', 'Penerimaan Create'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Penerimaan</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Create Penerimaan</h3>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <a href="<?php echo e($list_url); ?>" class="btn btn-default btn-sm">Lihat Data</a>
        </div>
    </div>
    <div class="box box-success">
        <div class="box-body">
            <?php echo $__env->make('errors.validation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo Form::open(['route' => ['penerimaan.store'],'method' => 'post','id'=>'form']); ?>

                        <div class="col-md-4">
                            <div class="form-group">
                                <?php echo e(Form::label('No Penerimaan', 'No Penerimaan:')); ?>

                                <?php echo e(Form::text('no_penerimaan', null, ['class'=> 'form-control'])); ?>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?php echo e(Form::label('No Pembelian', 'No Pembelian:')); ?>

                                <?php echo e(Form::text('no_pembelian', null, ['class'=> 'form-control'])); ?>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <?php echo e(Form::label('Tanggal Penerimaan', 'Tanggal Penerimaan:')); ?>

                                <?php echo e(Form::date('tanggal_penerimaan', \Carbon\Carbon::now(),['class'=> 'form-control'])); ?>

                                
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <?php echo e(Form::label('status', 'Status:')); ?>

                                <?php echo e(Form::text('status', null, ['class'=> 'form-control'])); ?>

                            </div>
                        </div>
                       
        </div>
        <div class=" box-footer">
                    <div class="pull-right">
                    <?php echo e(Form::submit('Create data', ['class' => 'btn btn-success'])); ?>

                    </div>
        </div>

        <?php echo Form::close(); ?>

        </div>

    </div>
    <!-- /.box -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
<script>
//   $("[name='status']").bootstrapSwitch({
//   on: 'Aktif',
//   off: 'NonAktif',
//   onLabel: '&nbsp;&nbsp;&nbsp;',
//   offLabel: '&nbsp;&nbsp;&nbsp;',
// //   same: false,//same labels for on/off states
//   state: true,
//   size: 'md',
//   onClass: 'primary',
//   offClass: 'danger'
// });

// var s = $('#status').val();
// $("#status").change(function(){
//     if(this.checked == true)
//     {
//         s = '1';
//     }
//     else
//     {
//         s = '0';        
//     }
//     //alert(s);
//     let status = $('#status');
//     status.val(s);
//     console.log(status);
// });
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>