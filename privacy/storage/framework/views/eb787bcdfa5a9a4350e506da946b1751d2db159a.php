<?php $__env->startSection('title', 'Calculate Monthly'); ?>

<?php $__env->startSection('content_header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<?php echo $__env->make('sweet::alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body onLoad="panggil()">
    <div class="box box-solid">

        <div class="modal fade" id="button4"  role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Calculate <b>Monthly</b></h4>
                </div>
                <?php echo $__env->make('errors.validation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo Form::open(['id'=>'ADD']); ?>

                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                       <?php echo e(Form::selectMonth('month', null, ['class'=> 'form-control select2','id'=>'bulan_akhir','placeholder'=>'','style'=>'width: 100%'])); ?>

                                    </div>
                                    <div class="col-sm-6">
                                       <?php echo e(Form::selectYear('year', 2000, 2040, null, ['class'=> 'form-control select3','id'=>'tahun_awal','placeholder'=>'','style'=>'width: 100%'])); ?>

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

              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div>

</body>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startPush('js'); ?>
  
    <script type="text/javascript">
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

        function load(){
            $('#button4').modal('show');
        }

        function panggil(){
            load();
            startTime();
        }


        $('#button1').click( function () {
            var registerForm = $("#ADD");
            var month= $('#bulan_akhir').val();
            var year= $('#tahun_awal').val();
            var index = 1;
            var formData = registerForm.serialize();

            swal({
                    title: "<b>Check Monthly 1/3.</b>",
                    text: "Mohon Tunggu Hingga Proses Selesai.",
                    type: "warning",
                    showCancelButton: false,
                    showConfirmButton: false
                })

            $.ajax({
              url: '<?php echo route('checkmonthly.change'); ?>',
              type: 'POST',
              data:{
                  'index': index,
                  'month': month,
                  'year': year,
              },
              success: function(data) {
                console.log(data);
                if (data.success === true) {
                  changenext();
                }else {
                  swal("Error!", data.message, "error");
                }
              },
            });
          }
        );

        function changenext(){
          var registerForm = $("#ADD");
          var month= $('#bulan_akhir').val();
          var year= $('#tahun_awal').val();
          var index = 2;
          var formData = registerForm.serialize();
          swal({
            title: "<b>Check Monthly 2/3.</b>",
            text: "Mohon Tunggu Hingga Proses Selesai.",
            type: "warning",
            showCancelButton: false,
            showConfirmButton: false
          })

              $.ajax({
                url: '<?php echo route('checkmonthly.change'); ?>',
                type: 'POST',
                data:{
                  'index': index,
                  'month': month,
                  'year': year,
                },
                success: function(data) {
                  console.log(data);
                  if (data.success === true) {
                    changenext2();
                  }else {
                    swal("Error!", data.message, "error");
                  }
                },
              });
            }
         

        function changenext2(){
          var registerForm = $("#ADD");
          var month= $('#bulan_akhir').val();
          var year= $('#tahun_awal').val();
          var index = 3;
          var formData = registerForm.serialize();
          swal({
            title: "<b>Check Monthly 3/3.</b>",
            text: "Mohon Tunggu Hingga Proses Selesai.",
            type: "warning",
            showCancelButton: false,
            showConfirmButton: false
          })

              $.ajax({
                url: '<?php echo route('checkmonthly.change'); ?>',
                type: 'POST',
                data:{
                  'index': index,
                  'month': month,
                  'year': year,
                },
                success: function(data) {
                  console.log(data);
                  if (data.success === true) {
                    swal("Done!", data.message, "success");
                  }else {
                    swal("Error!", data.message, "error");
                  }
                },
              });
            }
          

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