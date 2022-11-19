

<?php $__env->startSection('title', 'Non-Stock'); ?>

<?php $__env->startSection('content_header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<?php echo $__env->make('sweet::alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body onLoad="startTime()">
    <div class="box box-solid">
        <!-- <div class="box-header with-border">
            <font style="font-size: 16px;">Manages <b>Jasa / Non-Stock</b></font>
        </div> -->
        <div class="box-body">
             <table class="table table-bordered table-striped table-hover" id="nonstock-table" width="100%" style="font-size: 12px;">
                <thead>
                <tr class="bg-blue">
                    <th>Kode Produk</th>
                    <!-- <th>Jenis Item</th> -->
                    <th>Nama Item</th>
                    <th>Satuan Item</th>
                    <th>Keterangan</th>
                 </tr>
                </thead>
            </table>

        </div>
    </div>

    <div class="modal fade" id="addform" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Create Data</h4>
            </div>
            <?php echo $__env->make('errors.validation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!--  -->
            <?php echo Form::open(['id'=>'ADD']); ?>

                    <div class="modal-body">
                        <div class="row">
                            <!--  -->

                               <!--  <div class="col-md-3">
                                    <div class="form-group">
                                        <?php echo e(Form::label('jenis_item', 'Jenis Item:')); ?>

                                        <?php echo e(Form::select('jenis_item', ['Jasa' => 'Jasa', 'Non-Stock' => 'Non-Stock'], null, ['class'=> 'form-control select2','style'=>'width: 100%','placeholder' => '','id'=>'Jenis1','required'=>'required'])); ?>

                                    </div>
                                </div> -->

                            <div class="col-md-5">
                                <div class="form-group">
                                    <?php echo e(Form::label('nama_item', 'Nama Item:')); ?>

                                    <?php echo e(Form::text('nama_item', null, ['class'=> 'form-control','id'=>'Nama1','required'=>'required', 'placeholder'=>'Nama Non-Stock', 'autocomplete'=>'off','onkeypress'=>"return pulsar(event,this)"])); ?>

                                    <span class="text-danger">
                                        <strong class="name-error" id="name-error"></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo e(Form::label('satuan_item', 'Satuan Item:')); ?>

                                    <?php echo e(Form::select('satuan_item', $Satuan, null, ['class'=> 'form-control select2','id'=>'Satuan1','required'=>'required', 'autocomplete'=>'off','style'=>'width: 100%','placeholder' => ''])); ?>

                                    <span class="text-danger">
                                        <strong class="name-error" id="name-error"></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php echo e(Form::label('keterangan', 'Deskripsi:')); ?>

                                    <?php echo e(Form::textArea('keterangan', null, ['class'=> 'form-control','id'=>'Nama2','rows'=>'4', 'placeholder'=>'Deskripsi', 'autocomplete'=>'off','onkeypress'=>"return pulsar(event,this)"])); ?>

                                    <span class="text-danger">
                                        <strong class="name-error" id="name-error"></strong>
                                    </span>
                                </div>
                            </div>
                            
                    </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <?php echo e(Form::submit('Create data', ['class' => 'btn btn-success crud-submit'])); ?>

                            <?php echo e(Form::button('Close', ['class' => 'btn btn-danger','data-dismiss'=>'modal'])); ?>&nbsp;
                        </div>
                    </div>
                <?php echo Form::close(); ?>

          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="modal fade" id="editform" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Edit Data</h4>
            </div>
            <?php echo $__env->make('errors.validation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!--  -->
            <?php echo Form::open(['id'=>'EDIT']); ?>

            <div class="modal-body">
                <div class="row">
                    <div class="form-group">
                                    <!--  -->
                                    <?php echo e(Form::hidden('kode_produk', null, ['class'=> 'form-control','id'=>'Kode','readonly'])); ?>

                    </div>

                                <!-- <div class="col-md-3">
                                    <div class="form-group">
                                        <?php echo e(Form::label('jenis_item', 'Jenis Item:')); ?>

                                        <?php echo e(Form::select('jenis_item', ['Jasa' => 'Jasa', 'Non-Stock' => 'Non-Stock'], null, ['class'=> 'form-control','style'=>'width: 100%','id'=>'Jenis'])); ?>

                                    </div>
                                </div> -->

                    <div class="col-md-5">
                        <div class="form-group">
                            <?php echo e(Form::label('nama_item', 'Nama Non-Stock:')); ?>

                            <?php echo e(Form::text('nama_item', null, ['class'=> 'form-control','id'=>'Nama', 'autocomplete'=>'off'])); ?>

                        </div>
                    </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo e(Form::label('satuan_item', 'Satuan Item:')); ?>

                                    <?php echo e(Form::select('satuan_item', $Satuan, null, ['class'=> 'form-control','id'=>'Satuan'])); ?>

                                    <span class="text-danger">
                                        <strong class="name-error" id="name-error"></strong>
                                    </span>
                                </div>
                            </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo e(Form::label('keterangan', 'Deskripsi:')); ?>

                            <?php echo e(Form::textArea('keterangan', null, ['class'=> 'form-control','id'=>'Keterangan', 'autocomplete'=>'off','rows'=>'4', 'placeholder'=>'Deskripsi'])); ?>

                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <?php echo e(Form::submit('Update data', ['class' => 'btn btn-success'])); ?>

                    <!--  -->
                    <?php echo e(Form::button('Close', ['class' => 'btn btn-danger','data-dismiss'=>'modal'])); ?>&nbsp;
                </div>
            </div>
            <?php echo Form::close(); ?>

          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
</body>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startPush('js'); ?>
  
    <script type="text/javascript">
        $(function() {
            $('#nonstock-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?php echo route('nonstock.data'); ?>',
            columns: [
                { data: 'kode_produk', name: 'kode_produk' },
                // { data: 'jenis_item', name: 'jenis_item' },
                { data: 'nama_item', name: 'nama_item' },
                { data: 'satuan_item', name: 'satuan_item' },
                { data: 'keterangan', name: 'keterangan' },
            ]
            });
        });


        function pulsar(e,obj) {
              tecla = (document.all) ? e.keyCode : e.which;
              //alert(tecla);
              if (tecla!="8" && tecla!="0"){
                obj.value += String.fromCharCode(tecla).toUpperCase();
                return false;
              }else{
                return true;
              }
        }

        $('.select2').select2({
            placeholder: "Pilih",
            allowClear: true,
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        function refreshTable() {
             $('#nonstock-table').DataTable().ajax.reload(null,false);;
        }

        $('.modal-dialog').draggable({
            handle: ".modal-header"
        });

        $('.modal-dialog').resizable({
    
        });

        $('#ADD').submit(function (e) {
            e.preventDefault();
            // Get the Login Name value and trim it
            // var kode = $.trim($('#Kode1').val());
            // var name = $.trim($('#Jenis1').val());
            var name = $.trim($('#Nama1').val());
            var ket = $.trim($('#Nama2').val());
            var registerForm = $("#ADD");
            var formData = registerForm.serialize();

                $.ajax({
                    url:'<?php echo route('nonstock.store'); ?>',
                    type:'POST',
                    data:formData,
                    success:function(data) {
                        console.log(data);
                        // $('#Kode1').val('');
                        // $('#Jenis1').val('').trigger('change');
                        $('#Nama1').val('');
                        $('#Nama2').val('');
                        $('#Satuan1').val('').trigger('change');
                        $( '.kode-error' ).html('');
                        $( '.name-error' ).html('');
                        $('#addform').modal('hide');
                        refreshTable();
                        if (data.success === true) {
                            swal("Berhasil!", data.message, "success");
                        } else {
                            swal("Gagal!", data.message, "error");
                        }
                    },
                });
        });

        $('#EDIT').submit(function (e) {
            e.preventDefault();
            // Get the Login Name value and trim it
            var kode = $.trim($('#Kode').val());
            // var name = $.trim($('#Jenis').val());
            var name = $.trim($('#Nama').val());
            var name = $.trim($('#Satuan').val());
            var ket = $.trim($('#Keterangan').val());
            var registerForm = $("#EDIT");
            var formData = registerForm.serialize();

                $.ajax({
                    url:'<?php echo route('nonstock.ajaxupdate'); ?>',
                    type:'POST',
                    data:formData,
                    success:function(data) {
                        console.log(data);
                        $('#editform').modal('hide');
                        refreshTable();
                        if (data.success === true) {
                            swal("Berhasil!", data.message, "success");
                        } else {
                            swal("Gagal!", data.message, "error");
                        }
                    },
                });
        });

        function edit(id, url) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

               $.ajax({
                    type: 'GET',
                    url: url,
                    data: {_token: CSRF_TOKEN},
                    dataType: 'JSON',
                    success: function (results) {
                        // console.log(result);
                        $('#editform').modal('show');
                        $('#Kode').val(results.kode_produk);
                        // $('#Jenis').val(results.jenis_item);
                        $('#Nama').val(results.nama_item);
                        $('#Satuan').val(results.satuan_item);
                        $('#Keterangan').val(results.keterangan);
                        // $('#Update').attr('action','satuan.ajaxupdate'+','+'result.kode_satuan')
                        },
                        error : function() {
                        alert("Tak ada Data");
                    }
                });
        }

        function update() {
         e.preventDefault();
         var form_action = $("#editform").find("form").attr("action");
                $.ajax({
                    
                    url: form_action,
                    type: 'POST',
                    data:$('#Update').serialize(),
                    success: function(data) {
                        console.log(data);
                        $('#editform').modal('hide');
                        $.notify(data.message, "success");
                        refreshTable();
                    }
                });
        }

        function del(id, url) {
            swal({
            title: "Hapus?",
            text: "Pastikan dahulu item yang akan di hapus",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                

                $.ajax({
                    type: 'DELETE',
                    url: url,
                    
                    success: function (results) {
                    // console.log(results);
                        if (results.success === true) {
                            swal("Berhasil!", results.message, "success");
                        } else {
                            swal("Gagal!", results.message, "error");
                        }
                          
                        // $.notify(result.message, "success");
                        refreshTable();
                    }
                });
            }
            });
        }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>