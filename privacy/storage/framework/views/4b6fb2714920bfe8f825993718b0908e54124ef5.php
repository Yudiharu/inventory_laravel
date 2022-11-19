<?php $__env->startSection('title', 'Kategori'); ?>

<?php $__env->startSection('content_header'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<?php echo $__env->make('sweet::alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<body onLoad="load()">
    <div class="box box-solid">
        <div class="box-body">
            <div class="box ">
                <div class="box-body">
                    <?php if (app('laratrust')->can('create-kategori')) : ?>
                    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#addform">
                        <i class="fa fa-plus"></i> New Kategori</button>
                    <?php endif; // app('laratrust')->can ?>

                    <span class="pull-right">  
                        <font style="font-size: 16px;"><b>KATEGORI</b></font>
                    </span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="kategori-table" width="100%" style="font-size: 12px;">
                    <thead>
                    <tr class="bg-blue">
                        <th>Kode Kategori</th>
                        <th>Nama Kategori</th>
                        <th>Status</th>
                        <th>COA Persediaan</th>
                     </tr>
                    </thead>
                </table>
            </div>
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo e(Form::label('kode', 'Kode:')); ?>

                                    <?php echo e(Form::text('kode_kategori', null, ['class'=> 'form-control','id'=>'Kode1', 'placeholder'=>'Kode Kategori','required'=>'required','autocomplete'=>'off','data-toggle'=>"tooltip",'data-placement'=>"bottom",'title'=>"Maksimal 6 Karakter", 'maxlength'=>'6', 'onkeypress'=>"return pulsar(event,this)"] )); ?>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('Nama Kategori', 'Nama Kategori:')); ?>

                                    <?php echo e(Form::text('nama_kategori', null, ['class'=> 'form-control','id'=>'Nama1','required'=>'required', 'placeholder'=>'Nama Kategori', 'onkeypress'=>"return pulsar(event,this)",'autocomplete'=>'off'])); ?>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo e(Form::label('status', 'Status:')); ?>

                                    <?php echo e(Form::select('status', ['Aktif' => 'Aktif', 'NonAktif' => 'NonAktif'], null, ['class'=> 'form-control select2','style'=>'width: 100%','placeholder' => '','id'=>'Status1','required'=>'required'])); ?>

                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <?php echo e(Form::label('status', 'COA:')); ?>

                                    <?php echo e(Form::select('coa', $Coa->sort(), null, ['class'=> 'form-control select2','style'=>'width: 100%','placeholder' => '','id'=>'Coa1','onchange'=>"getcoa()"])); ?>

                                </div>
                            </div>
                            <?php echo e(Form::hidden('user', Auth()->user()->kode_company, ['class'=> 'form-control','id'=>'User1','readonly'])); ?>


                            <?php echo e(Form::hidden('coa_gut', null, ['class'=> 'form-control','id'=>'coagut1','readonly'])); ?>

                            <?php echo e(Form::hidden('coa_emkl', null, ['class'=> 'form-control','id'=>'coaemkl1','readonly'])); ?>

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

    <div class="modal fade" id="editform" role="dialog">
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
                        <?php echo e(Form::hidden('company_user', auth()->user()->kode_company, ['class'=> 'form-control','id'=>'company1','readonly'])); ?>

                        <?php echo e(Form::hidden('kode_kategori', null, ['class'=> 'form-control','id'=>'Kode2','readonly'])); ?>

                        
                        <div class="col-md-9">
                            <div class="form-group">
                                <?php echo e(Form::label('Nama Kategori', 'Nama Kategori:')); ?>

                                <?php echo e(Form::text('nama_kategori', null, ['class'=> 'form-control','id'=>'Nama2','autocomplete'=>'off', 'onkeypress'=>"return pulsar(event,this)",'readonly'])); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo e(Form::label('status', 'Status:')); ?>

                                <?php echo e(Form::select('status', ['Aktif' => 'Aktif', 'NonAktif' => 'NonAktif'], null, ['class'=> 'form-control select2','style'=>'width: 100%','id'=>'Status2'])); ?>

                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group22">
                                <?php echo e(Form::label('coa_gut', 'COA:')); ?>

                                <?php echo e(Form::select('coa_gut', $Coa->sort(), null, ['class'=> 'form-control select2','style'=>'width: 100%','placeholder' => '','id'=>'coagut2'])); ?>

                            </div>

                            <div class="form-group23">
                                <?php echo e(Form::label('coa_emkl', 'COA:')); ?>

                                <?php echo e(Form::select('coa_emkl', $Coa->sort(), null, ['class'=> 'form-control select2','style'=>'width: 100%','placeholder' => '','id'=>'coaemkl2'])); ?>

                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <?php echo e(Form::submit('Update data', ['class' => 'btn btn-success'])); ?>

                    <?php echo e(Form::button('Close', ['class' => 'btn btn-danger','data-dismiss'=>'modal'])); ?>&nbsp;
                </div>
            </div>
            <?php echo Form::close(); ?>

          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

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

            /* Button used to open the contact form - fixed at the bottom of the page */
            .hapus-button {
                background-color: #F63F3F;
                bottom: 186px;
            }

            .edit-button {
                background-color: #FDA900;
                bottom: 216px;
            }

            #mySidenav button {
              position: fixed;
              right: -30px;
              transition: 0.3s;
              padding: 4px 8px;
              width: 70px;
              text-decoration: none;
              font-size: 12px;
              color: white;
              border-radius: 5px 0 0 5px ;
              opacity: 0.8;
              cursor: pointer;
              text-align: left;
            }

            #mySidenav button:hover {
              right: 0;
            }

            #about {
              top: 70px;
              background-color: #4CAF50;
            }

            #blog {
              top: 130px;
              background-color: #2196F3;
            }

            #projects {
              top: 190px;
              background-color: #f44336;
            }

            #contact {
              top: 250px;
              background-color: #555
            }
        </style>

        <div id="mySidenav" class="sidenav">
            <?php if (app('laratrust')->can('update-kategori')) : ?>
            <button type="button" class="btn btn-warning btn-xs edit-button" id="editkategori" data-toggle="modal" data-target="">EDIT <i class="fa fa-edit"></i></button>
            <?php endif; // app('laratrust')->can ?>

            <?php if (app('laratrust')->can('delete-kategori')) : ?>
            <button type="button" class="btn btn-danger btn-xs hapus-button" id="hapuskategori" data-toggle="modal" data-target="">HAPUS <i class="fa fa-times-circle"></i></button>
            <?php endif; // app('laratrust')->can ?>
        </div>
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

        function load(){
            startTime();
            comp1();
            $('.hapus-button').hide();
            $('.edit-button').hide();
            $('.back2Top').show();
        }

        function comp1(){
            var compan = $("#company1").val();
            if (compan == '04'){
                $('.form-group22').show();
                $('.form-group23').hide();
            }else{
                $('.form-group22').hide();
                $('.form-group23').show();
            }
        }

        function getcoa() {
            var coa = $("#Coa1").val();
            var user = $("#User1").val();
            if (user == '03') {
                $('#coaemkl1').val(coa);
            }else if (user == '04'){
                $('#coagut1').val(coa);
            }
        }

        $(function() {
            $('#kategori-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?php echo route('kategoriproduk.data'); ?>',
            columns: [
                { data: 'kode_kategori', name: 'kode_kategori', visible: false },
                { data: 'nama_kategori', name: 'nama_kategori' },
                { data: 'status', name: 'status' },
            <?php if (auth()->user()->kode_company == '04'){ ?>
                { data: 'coa.account', name: 'coa.account', "defaultContent": "<i>Not set</i>", searchable: false },
            <?php } else if (auth()->user()->kode_company == '03'){ ?>
                { data: 'coa1.account', name: 'coa1.account', "defaultContent": "<i>Not set</i>", searchable: false },
            <?php } else { ?>
                { data: 'coa1.account', name: 'coa1.account', "defaultContent": "<i>Not set</i>", searchable: false },
            <?php } ?>
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

        function hanyaAngka(e, decimal) {
            var key;
            var keychar;
             if (window.event) {
                 key = window.event.keyCode;
             } else
             if (e) {
                 key = e.which;
             } else return true;
          
            keychar = String.fromCharCode(key);
            if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
                return true;
            } else
            if ((("0123456789").indexOf(keychar) > -1)) {
                return true;
            } else
            if (decimal && (keychar == ".")) {
                return true;
            } else return false;
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

        $(document).ready(function(){
            $("#back2Top").click(function(event) {
                event.preventDefault();
                $("html, body").animate({ scrollTop: 0 }, "slow");
                return false;
            });

            $('[data-toggle="tooltip"]').tooltip();   
            var table = $('#kategori-table').DataTable();
            $('#kategori-table tbody').on( 'click', 'tr', function () {
                if ( $(this).hasClass('selected bg-gray text-bold') ) {
                    $(this).removeClass('selected bg-gray text-bold');
                    $('.hapus-button').hide();
                    $('.edit-button').hide();
                }
                else {
                    table.$('tr.selected').removeClass('selected bg-gray text-bold');
                    $(this).addClass('selected bg-gray text-bold');
                    var select = $('.selected').closest('tr');
                    var kode_kategori = select.find('td:eq(0)').text();
                    $('.hapus-button').show();
                    $('.edit-button').show();
                }
            });

            $('#editkategori').click( function () {
                var select = $('.selected').closest('tr');
                var data = $('#kategori-table').DataTable().row(select).data();
                var kode_kategori = data['kode_kategori'];
                var row = table.row( select );
                $.ajax({
                    url: '<?php echo route('kategoriproduk.edit_kategori'); ?>',
                    type: 'POST',
                    data : {
                        'id': kode_kategori
                    },
                    success: function(results) {
                        console.log(results);
                            $('#Kode2').val(results.kode_kategori);
                            $('#Nama2').val(results.nama_kategori);
                            $('#coagut2').val(results.coa_gut).trigger('change');
                            $('#coaemkl2').val(results.coa_emkl).trigger('change');
                            $('#Status2').val(results.status).trigger('change');
                            $('#editform').modal('show');
                    }
                });
            });

            $('#hapuskategori').click( function () {
                var select = $('.selected').closest('tr');
                var data = $('#kategori-table').DataTable().row(select).data();
                var kode_kategori = data['kode_kategori'];
                var row = table.row( select );
                swal({
                    title: "Hapus?",
                    text: "Pastikan dahulu item yang akan di hapus",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Batal!",
                    reverseButtons: !0
                }).then(function (e) {
                    if (e.value === true) {
                        $.ajax({
                            url: '<?php echo route('kategoriproduk.hapus_kategori'); ?>',
                            type: 'POST',
                            data : {
                                'id': kode_kategori
                            },

                            success: function (results) {
                                if (results.success === true) {
                                    swal("Berhasil!", results.message, "success");
                                } else {
                                    swal("Gagal!", results.message, "error");
                                }
                                refreshTable();
                            }
                        });
                    }
                });
            });
        });

        function refreshTable() {
             $('#kategori-table').DataTable().ajax.reload(null,false);;
        }

        $('.modal-dialog').draggable({
            handle: ".modal-header"
        });

        $('.modal-dialog').resizable({
    
        });

        $('#ADD').submit(function (e) {
            e.preventDefault();
            var registerForm = $("#ADD");
            var formData = registerForm.serialize();

                $.ajax({
                    url:'<?php echo route('kategoriproduk.store'); ?>',
                    type:'POST',
                    data:formData,
                    success:function(data) {
                        console.log(data);
                        $('#Kode1').val('');
                        $('#Nama1').val('');
                        $('#Status1').val('').trigger('change');
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
            var registerForm = $("#EDIT");
            var formData = registerForm.serialize();

                $.ajax({
                    url:'<?php echo route('kategoriproduk.ajaxupdate'); ?>',
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
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>