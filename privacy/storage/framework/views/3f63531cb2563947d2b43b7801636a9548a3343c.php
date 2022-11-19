<?php $__env->startSection('title', 'Laporan QTY Pemakaian'); ?>

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
                  <h4 class="modal-title">Laporan <b>Pemakaian</b></h4>
                </div>
                <?php echo $__env->make('errors.validation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo Form::open(['route' => ['laporanpemakaianqty.export'],'method' => 'get','id'=>'form', 'target'=>"_blank"]); ?>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">  
                                        <?php echo e(Form::label('show', 'Produk / Kategori:')); ?>              
                                        <?php echo e(Form::select('show', ['Produk' => 'Produk', 'Kategori' => 'Kategori'], null, ['class'=> 'form-control','style'=>'width: 100%','id'=>'history','required'=>'required','onchange'=>"pilih();"])); ?>

                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('tanggal_awal', 'Dari Tanggal:')); ?>

                                        <?php echo e(Form::date('tanggal_awal',\Carbon\Carbon::now(), ['class'=> 'form-control','id'=>'tanggal1'])); ?>

                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('tanggal_akhir', 'Sampai Tanggal:')); ?>

                                        <?php echo e(Form::date('tanggal_akhir',\Carbon\Carbon::now(), ['class'=> 'form-control','id'=>'tanggal2','placeholder'=>'Periode Baru'])); ?>

                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group1">
                                        <?php echo e(Form::label('Produk', 'Pilih Produk:')); ?>

                                        <?php echo e(Form::select('kode_produk',$Produk,null, ['class'=> 'form-control select2','id'=>'produk1','style'=>'width: 100%','placeholder' => ''])); ?>

                                    </div>   

                                    <div class="form-group2">
                                        <?php echo e(Form::label('Kategori', 'Pilih Kategori:')); ?>

                                        <?php echo e(Form::select('kategori',['SEMUA'=>'SEMUA',$kategori],null, ['class'=> 'form-control select2','id'=>'kategori1','style'=>'width: 100%','placeholder' => ''])); ?>

                                    </div>   
                                </div> 
                                
                                <div class="col-sm-3">
                                    <div class="form-group"> 
                                        <?php echo e(Form::label('pilih', 'Format Laporan:')); ?>              
                                        <?php echo e(Form::select('jenis_report', ['PDF' => 'PDF', 'excel' => 'Excel'], null, ['class'=> 'form-control select2','style'=>'width: 100%','placeholder' => '','id'=>'report1','required'=>'required'])); ?>

                                    </div>
                                </div>
                            <?php if (Auth()->user()->kode_lokasi == 'HO') { ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('lokasi', 'Pilih Kode Lokasi:')); ?>

                                        <?php echo e(Form::select('lokasi',['SEMUA' => 'SEMUA','Lokasi'=>$lokasi],null, ['class'=> 'form-control select2','id'=>'lokasi1','style'=>'width: 100%','placeholder' => '','required'])); ?>

                                    </div>
                                </div>
                            <?php } ?>
                                    <div class="col-sm-6">  
                                        <input type="checkbox" name="ttd" value="1"/>&nbsp;Cetak TTD di halaman baru<br>
                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <?php echo e(Form::submit('Cetak', ['class' => 'btn btn-success crud-submit'])); ?>

                                <?php echo e(Form::button('Close', ['class' => 'btn btn-danger','data-dismiss'=>'modal'])); ?>&nbsp;
                            </div>
                        </div>
                    <?php echo Form::close(); ?>

              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>

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
            placeholder: "Pilih",
            allowClear: true,
        });

        function cetakpdf() {
            var registerForm = $("#ADD");
            var formData = registerForm.serialize();

            swal({
            title: "Cetak PDF?",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Ya, Cetak!",
            cancelButtonText: "Batal",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url:'<?php echo route('laporanpemakaianqty.export'); ?>',
                    type:'GET',
                    data:formData,
                    success:function(result) {
                            swal("Berhasil!<br><b>PDF berhasil dicetak</b>");
                    },
                error : function() {
                        swal("GAGAL!<br><b>PDF gagal dicetak</b>");
                    }
                });

            } else {
                e.dismiss;
            }

        }, function (dismiss) {
            return false;
        })

        }

        function pilih() {
            var pilih = $("#history").val();

            if (pilih == 'Produk') {
                $('.form-group1').show();
                $('.form-group2').hide();
                document.getElementById("produk1").required = true; 
                document.getElementById("kategori1").required = false; 
            }else{
                $('.form-group2').show();
                $('.form-group1').hide();
                document.getElementById("produk1").required = false; 
                document.getElementById("kategori1").required = true; 
            }
        }

        function load(){
            $('#button4').modal('show');
            $('.form-group2').hide();
        }

        function panggil(){
            load();
            startTime();
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