<?php $__env->startSection('title', 'Opname'); ?>

<?php $__env->startSection('content_header'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('sweet::alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body onLoad="load()">
    <div class="box box-solid">
        <div class="box-header with-border">
            <font style="font-size: 16px;">Manages <b>Opname</b></font>
        </div>
        <div class="box-body">
            <div class="box">
                <div class="box-body">
                    
                    <button type="button" class="btn btn-default btn-xs" onclick="refreshTable()" >
                            <i class="fa fa-refresh"></i> Refresh</button>
                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#addform"><i class="fa fa-plus">
                        </i> New Opname</button>
                    <span class="pull-right"> 
                            <button type="button" class="tombol1 btn btn-success btn-xs" id="button1"><i class="fa fa-bullhorn"></i> POST</button>
                            <button type="button" class="tombol2 btn btn-warning btn-xs" id="button2"><i class="fa fa-undo"></i> UNPOST</button>
                            
                            <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#button4">
                            <i class="fa fa-print"></i> PRINT MONTHLY STOCK</button>
                            
                    </span>
                    
                </div>
            </div>
             <table class="table table-bordered table-striped table-hover" id="data-table" width="100%" style="font-size: 12px;">
                <thead>
                <tr class="bg-primary">
                    <th>No Opname</th>
                    <th>Tanggal Opname</th>
                    <th>Status</th>
                    <th>Total Item</th>
                    
                    <th>Created At</th>
                    
                    <th>Action</th>
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
            <?php echo Form::open(['id'=>'ADD']); ?>

            
                    <div class="modal-body">
                        <div class="row">
                            

                            

                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo e(Form::label('Tanggal Opname', 'Tanggal Opname:')); ?>

                                    <?php echo e(Form::date('tanggal_opname', \Carbon\Carbon::now(),['class'=> 'form-control','id'=>'Tanggal1','required'=>'required'])); ?>

                                    
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
                <?php echo Form::open(['id'=>'EDIT']); ?>

                
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('No Opname', 'No Opname:')); ?>

                                        <?php echo e(Form::text('no_opname', null, ['class'=> 'form-control','id'=>'Opname','readonly'])); ?>

                                    </div>
                                </div> 

                                

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('Tanggal Opname', 'Tanggal Opname:')); ?>

                                        <?php echo e(Form::date('tanggal_opname', null,['class'=> 'form-control','id'=>'Tanggal'])); ?>

                                        
                                    </div>
                                </div>

                                

                                
    
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <?php echo e(Form::submit('Update data', ['class' => 'btn btn-success crud-submit'])); ?>

                                <?php echo e(Form::button('Close', ['class' => 'btn btn-danger','data-dismiss'=>'modal'])); ?>&nbsp;
                            </div>
                        </div>
                    <?php echo Form::close(); ?>

              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



    <div class="modal fade" id="button4"  role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Pilih Bulan</h4>
                </div>
                <?php echo $__env->make('errors.validation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo Form::open(['route' => ['opname.export'],'method' => 'get','id'=>'form', 'target'=>"_blank"]); ?>

                        <div class="modal-body">
                            <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo e(Form::label('bulan', 'Bulan:')); ?>

                                    <?php echo e(Form::selectMonth('month', null, ['class'=> 'form-control','id'=>'namabulan','required'=>'required'])); ?>

                                    <span class="text-danger">
                                        <strong class="name-error" id="name-error"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo e(Form::label('tahun', 'Tahun:')); ?>

                                    <?php echo e(Form::selectYear('year', 2000, 2030, null, ['class'=> 'form-control','id'=>'namatahun','required'=>'required'])); ?>

                                    <span class="text-danger">
                                        <strong class="name-error" id="name-error"></strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <?php echo e(Form::submit('Cetak PDF', ['class' => 'btn btn-success crud-submit'])); ?>

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
  
    <script>
        function load(){
            $('.tombol1').hide();
            $('.tombol2').hide();
        }

        $(function() {
            $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?php echo route('opname.data'); ?>',
            // scrollY: true,
            columns: [
                { data: 'no_opname', name: 'no_opname' },
                { data: 'tanggal_opname', name: 'tanggal_opname' },
                { data: 'status', name: 'status' },
                { data: 'opnamedetail_count', name: 'opnamedetail_count' },
                // { data: 'company.nama_company', name: 'company.nama_company' },
                { data: 'created_at', name: 'created_at' },
                // { data: 'updated_at', name: 'updated_at' },
                // { data: 'created_by', name: 'created_by' },
                // { data: 'updated_by', name: 'updated_by' },
                { data: 'action', name: 'action' }
            ]
            });
        });

        $(document).ready(function() {
            var table = $('#data-table').DataTable();
            var post = document.getElementById("button1");
            var unpost = document.getElementById("button2");

            $('#data-table tbody').on( 'click', 'tr', function () {
                if ( $(this).hasClass('selected bg-gray') ) {
                    $(this).removeClass('selected bg-gray');
                }
                else {
                    table.$('tr.selected').removeClass('selected bg-gray');
                    $(this).addClass('selected bg-gray');
                    var select = $('.selected').closest('tr');
                    var colom = select.find('td:eq(2)').text();
                    var colom2 = select.find('td:eq(3)').text();
                    var no_pembelian = select.find('td:eq(0)').text();
                    var status = colom;
                    var item = colom2;
                    var print = $("#button3").attr("href","https://aplikasi.gui-group.co.id/inventory_baru/admin/pembelian/cetakPDF?id="+no_pembelian);
                    // var print = $("#button3").attr("href","<?php echo e(route('permintaan.cetak', ['id' =>"+colom2"])); ?>");
                    if(status == 'POSTED' && item > 0){
                        $('.tombol1').hide();
                        $('.tombol2').show();
                    }else if(status =='UNPOSTED' && item > 0){
                        $('.tombol1').show();
                        $('.tombol2').hide();
                    }else if(item == 0){
                        $('.tombol1').hide();
                        $('.tombol2').hide();
                    }else{
                        $('.tombol1').show();
                        $('.tombol2').hide();
                    }
                }
            } );
        
           $('#button1').click( function () {
                var select = $('.selected').closest('tr');
                var colom = select.find('td:eq(0)').text();
                var no_opname = colom;
                console.log(no_opname);
                swal({
                    title: "Post?",
                    text: colom,
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Yes, post it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: !0
                    }).then(function (e) {
                        if (e.value === true) {
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                // alert( table.rows('.selected').data().length +' row(s) selected' );
                        $.ajax({
                            url: '<?php echo route('opname.posting'); ?>',
                            type: 'POST',
                            data : {
                                'id': no_opname
                            },
                            success: function(result) {
                                console.log(result);
                                if (result.success === true) {
                                    swal(
                                    'Posted!',
                                    'Your file has been posted.',
                                    'success'
                                    )
                                    refreshTable();
                                }
                                else{
                                  swal({
                                      title: 'Error',
                                      text: result.message,
                                      type: 'error',
                                  })
                                }
                            },
                            error : function () {
                              swal({
                                  title: 'Oops...',
                                  text: data.message,
                                  type: 'error',
                                  timer: '1500'
                              })
                            }
                        });
                    } else {
                        e.dismiss;
                    }

                }, function (dismiss) {
                    return false;
                })
            });

            $('#button2').click( function () {
                var select = $('.selected').closest('tr');
                var colom = select.find('td:eq(0)').text();
                var no_opname = colom;
                console.log(no_opname);
                swal({
                    title: "Unpost?",
                    text: colom,
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Yes, unpost it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: !0
                    }).then(function (e) {
                        if (e.value === true) {
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                // alert( table.rows('.selected').data().length +' row(s) selected' );
                        $.ajax({
                            url: '<?php echo route('opname.unposting'); ?>',
                            type: 'POST',
                            data : {
                                'id': no_opname
                            },
                            success: function(result) {
                                console.log(result);
                                if (result.success === true) {
                                    swal(
                                    'Unposted!',
                                    'Your file has been unposted.',
                                    'success'
                                    )
                                    refreshTable();
                                }
                                else{
                                  swal({
                                      title: 'Error',
                                      text: result.message,
                                      type: 'error',
                                  })
                                }
                            },
                            error : function () {
                              swal({
                                  title: 'Oops...',
                                  text: data.message,
                                  type: 'error',
                                  timer: '1500'
                              })
                            }
                        });
                    } else {
                        e.dismiss;
                    }

                }, function (dismiss) {
                    return false;
                })
            });
        });

        $('.select2').select2({
            placeholder: " Pilih",
            allowClear: true,
        });

        // var myselect = $('.select2').select2({
        //     placeholder: " Pilih No Permintaan",
        //     allowClear: true,
        // });

        // myselect.on('change', function(e){
        //         var selected_element = $(e.currentTarget);
        //         var select_val = selected_element.val();
        //         // var _token = $("input[name='_token']").val();
        //         console.log(select_val);
        //             $.ajax({        // Memulai ajax
        //                 method: "GET",      
        //                 url: "<?php echo route('opname.cari'); ?>",    // file PHP yang akan merespon ajax
        //                 data: { id: select_val}   // data POST yang akan dikirim
        //               })
        //             .done(function(hasilajax) {   // KETIKA PROSES Ajax Request Selesai
                    
        //                 $('.select2').val(hasilajax.no_permintaan);
        //             });
        //          })

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function refreshTable() {
             $('#data-table').DataTable().ajax.reload(null,false);
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
            var tanggal = $.trim($('#Tanggal1').val());
            var registerForm = $("#ADD");
            var formData = registerForm.serialize();

            // Check if empty of not
            if (tanggal == '') {
                    // if(kode === ''){
                    //     $( '.kode-error' ).html('Mohon di Isi');
                    // }
                    if(tanggal == ''){
                        $( '.tanggal-error' ).html('Mohon di Isi');
                    }
                // alert('Mohon Lengkapi Form Isian');
                // return false;
            }else{
                $.ajax({
                    url:'<?php echo route('opname.store'); ?>',
                    type:'POST',
                    data:formData,
                    success:function(data) {
                        console.log(data);
                        // $('#Kode1').val('');
                        $('#Tanggal1').val('');
                        $( '.kode-error' ).html('');
                        $( '.name-error' ).html('');
                        $('#addform').modal('hide');
                        refreshTable();
                        if (data.success === true) {
                            swal("Done!", data.message, "success");
                        } else {
                            swal("Error!", data.message, "error");
                        }
                    },
                });
            }
        });

        $('#EDIT').submit(function (e) {
            e.preventDefault();
            // Get the Login Name value and trim it
            var opname = $.trim($('#Opname').val());
            var tanggal = $.trim($('#Tanggal').val());
            var registerForm = $("#EDIT");
            var formData = registerForm.serialize();

            // Check if empty of not
            if (opname === '' || tanggal === '') {
                alert('Mohon Lengkapi Form Isian');
                return false;
            }else{
                $.ajax({
                    url:'<?php echo route('opname.updateajax'); ?>',
                    type:'POST',
                    data:formData,
                    success:function(data) {
                        console.log(data);
                        $('#editform').modal('hide');
                        refreshTable();
                        if (data.success === true) {
                            swal("Done!", data.message, "success");
                        } else {
                            swal("Error!", data.message, "error");
                        }
                    },
                });
            }
        });

        function edit(id, url) {
            swal({
            title: "Edit?",
            text: "Please ensure and then confirm!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, edit it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {_token: CSRF_TOKEN},
                    dataType: 'JSON',
                    success: function (results) {
                        // $('#Memo').val(result.no_memo);
                        $('#editform').modal('show');
                        $('#Opname').val(results.no_opname);
                        $('#Tanggal').val(results.tanggal_opname);
                        $('#Status').val(results.status);
                    },
                        error : function() {
                        swal("GAGAL!<br><b>Status POSTED/CLOSED</b>");
                    }
                });

            } else {
                e.dismiss;
            }

        }, function (dismiss) {
            return false;
        })

        }

        function del(id, url) {
            swal({
            title: "Delete?",
            text: "Please ensure and then confirm!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                

                $.ajax({
                    type: 'DELETE',
                    url: url,
                    
                    success: function (results) {
                    // console.log(results);
                        if (results.success === true) {
                            swal("Done!", results.message, "success");
                        } else {
                            swal("GAGAL!<br><b>Status POSTED/Periode CLOSED/Detail Belum Kosong</b>");
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