

<?php $__env->startSection('title', 'Assembling Detail'); ?>

<?php $__env->startSection('content_header'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <a href="<?php echo e($list_url); ?>" class="btn btn-info btn-xs"><i class="fa fa-arrow-left"></i> Kembali</a>
    <button type="button" class="btn btn-default btn-xs" onclick="refreshTable()"><i class="fa fa-refresh"></i> Refresh</button>
    <span class="pull-right">
        <font style="font-size: 16px;"> Detail Assembling <b><?php echo e($assembling->produk->nama_produk); ?></b></font>
    </span>
<?php echo $__env->make('sweet::alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body onLoad="load()">
    <div class="box box-info">
        <div class="box-body"> 
                <div class="addform">
                    <?php echo $__env->make('errors.validation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo Form::open(['id'=>'ADD_DETAIL']); ?>

                    <center><kbd>ADD FORM</kbd></center><br>
                    <div class="row">
                        <?php echo e(Form::hidden('id',$assembling->id, ['class'=> 'form-control','readonly','id'=>'id_dis'])); ?>


                        <div class="col-md-4">
                            <div class="form-group">
                                <?php echo e(Form::label('kode_produk', 'Produk:')); ?>

                                <?php echo e(Form::select('kode_produk',$Produk->sort(),null,
                                ['class'=> 'form-control select2','style'=>'width: 100%','placeholder' => '','required'=>'required','onchange'=>'stock();',
                                'id'=>'kode_produks'])); ?>

                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <?php echo e(Form::label('partnumber', 'Part Number:')); ?>

                                <?php echo e(Form::select('partnumber',[], null, ['class'=> 'form-control','id'=>'Parts','style'=>'width: 100%','autocomplete'=>'off','onchange'=>'getharga();'])); ?>

                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <?php echo e(Form::label('qty_stock', 'Ending Stock:')); ?>

                                <?php echo e(Form::text('qty_stock', null, ['class'=> 'form-control','readonly','id'=>'Stock'])); ?>

                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <?php echo e(Form::label('qty', 'Qty:')); ?>

                                <?php echo e(Form::text('qty', null, ['class'=>'form-control','required'=>'required','id'=>'QTY','autocomplete'=>'off','onkeyup'=>'check();'])); ?>

                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <?php echo e(Form::label('hpp', 'HPP:')); ?>

                                <?php echo e(Form::text('hpp', null, ['class'=>'form-control','required'=>'required','id'=>'hpp','autocomplete'=>'off','readonly'])); ?>

                            </div>
                        </div>
                    </div> 
                    <span class="pull-right">
                        <?php echo e(Form::submit('Add Item', ['class' => 'btn btn-success btn-sm','id'=>'submit'])); ?>

                    </span>
                    <?php echo Form::close(); ?>

                </div>
            <div class="editform">
                <?php echo $__env->make('errors.validation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo Form::open(['id'=>'UPDATE_DETAIL']); ?>

                 <center><kbd>EDIT FORM</kbd></center><br>
                    <div class="row">   
                            <?php echo e(Form::hidden('id',$assembling->id, ['class'=> 'form-control','readonly','id'=>'id_dis1'])); ?>

                            <?php echo e(Form::hidden('id_detail',null, ['class'=> 'form-control','readonly','id'=>'id_detail1'])); ?>

                            
                            <?php echo e(Form::hidden('kode_produk',null, ['class'=> 'form-control','id'=>'Produk_e','required'=>'required','readonly'])); ?>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo e(Form::label('nama_produk', 'Nama Produk:')); ?>

                                    <?php echo e(Form::text('nama_produk',null, ['class'=> 'form-control','id'=>'Namaproduk_e','readonly'])); ?>

                                </div>
                            </div>
                
                            <div class="col-md-2">
                                <div class="form-group">
                                    <?php echo e(Form::label('partnumber', 'Partnumber:')); ?>

                                    <?php echo e(Form::text('partnumber',null, ['class'=> 'form-control','id'=>'Partnumber_e','readonly'])); ?>

                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <?php echo e(Form::label('qty_stock', 'Ending Stock:')); ?>

                                    <?php echo e(Form::text('qty_stock', null, ['class'=> 'form-control','readonly','id'=>'Stock_e'])); ?>

                                </div>
                            </div>
                
                            <div class="col-md-2">
                                <div class="form-group">
                                    <?php echo e(Form::label('qty', 'Qty:')); ?>

                                    <?php echo e(Form::text('qty', null, ['class'=> 'form-control','id'=>'QTY_e','required','autocomplete'=>'off','onkeyup'=>'cek_qty2();'])); ?>

                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <?php echo e(Form::label('hpp', 'HPP:')); ?>

                                    <?php echo e(Form::text('hpp',null, ['class'=> 'form-control','id'=>'Harga_e','required','readonly'])); ?>

                                </div>
                            </div>
                        </div> 
                            <div class="row-md-2">
                                <span class="pull-right"> 
                                    <?php echo e(Form::submit('Update', ['class' => 'btn btn-success btn-sm','id'=>'submit2'])); ?>

                                    <button type="button" class="btn btn-danger btn-sm" onclick="cancel_edit()">Cancel</button>&nbsp;
                                </span>
                            </div>
                <?php echo Form::close(); ?>  
      </div>
      
    </div>
</div>

    <div class="box box-info">
        <div class="box-body"> 
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="data2-table" width="100%" style="font-size: 12px;">
                    <thead>
                    <tr class="bg-info">
                        <th>Id Detail</th>
                        <th>Id</th>
                        <th>Produk</th>
                        <th>Part Number</th>
                        <th>Qty</th>
                        <th>HPP</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                     </tr>
                    </thead>
                </table>
            </div>
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

<?php $__env->stopPush(); ?>
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
            $('.editform').hide();
            $('.addform').show();
            $('.back2Top').show();
            $('.form-group7').show();
            $('.form-group8').hide();
        }

        function formatRupiah(angka, prefix='Rp'){
           
            var rupiah = angka.toLocaleString(
                undefined, // leave undefined to use the browser's locale,
                // or use a string like 'en-US' to override it.
                { minimumFractionDigits: 0 }
            );
            return rupiah;
           
        }
        
        $(function(){
        var id = $('#id_dis').val();

            $('#data2-table').DataTable({
                
            processing: true,
            serverSide: true,
            ajax:'https://aplikasi.gui-group.co.id/gui_inventory_laravel/admin/assemblingdetail/getDatabyID?id='+id,
            data:{'id':id},
    
            columns: [
                { data: 'id_detail', name: 'id_detail', visible: false },
                { data: 'id', name: 'id', visible: false },
                { data: 'produk.nama_produk', name: 'produk.nama_produk' },
                { data: 'partnumber', name: 'partnumber' },
                { data: 'qty', name: 'qty' },
                { data: 'hpp', 
                    render: function( data, type, full ) {
                    return formatNumber(data); }
                },
                { data: 'subtotal', 
                    render: function( data, type, full ) {
                    return formatNumber(data); }
                },
                { data: 'action', name: 'action' }
            ]
            
            });
        });

        function formatNumber(n) {
            if(n == 0){
                return 0;
            }else{
                return n.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            }
        }

  </script>
  <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table=$('#data-table').DataTable({
                scrollY: true,
                scrollX: true,
            
            });

        function check(){
            var stok = $('#Stock').val();
            var qty = $('#QTY').val();
            
            if(parseInt(qty) > parseInt(stok)){
                submit.disabled = true;
                swal("Gagal!", "Stok Tidak Cukup");
            }else{
                submit.disabled = false;
            }        
        }

        function cek_qty2(){
            var kode_produk= $('#Produk_e').val();
            var qty = $('#QTY_e').val();

             $.ajax({
                url:'<?php echo route('assemblingdetail.qtyproduk2'); ?>',
                type:'POST',
                data : {
                        'kode_produk': kode_produk,
                    },

                success: function(result) {
                        var qty = $('#QTY_e').val();
                        $('#Stock_e').val(result);
                        if(result < qty){
                            submit2.disabled = true;
                            swal("Gagal!", "Stok Tidak Cukup");
                        }else{
                            submit2.disabled = false;
                        }
                    },
            });
        }

        function stock(){
            editpart();
            $('#Stock').val('');
            $('#Harga').val('');
        }

        function getharga(){
            var partnumber= $('#Parts').val();
            var kode_produk= $('#kode_produks').val();
            var submit = document.getElementById("submit");
            $.ajax({
                url:'<?php echo route('assemblingdetail.getharga'); ?>',
                type:'POST',
                data : {
                    'id': kode_produk,
                    'part': partnumber,
                },
                success: function(result) {
                    $('#hpp').val(result.hpp);
                    $('#Amount').val(result.ending_amount);
                    $('#Stock').val(result.stok);
                },
            });
        }

        function editpart(){
            $('#Parts').prop("disabled", false);
            var kode_produk = $("#kode_produks").val();

            var token = $("input[name='_token']").val();
            $.ajax({
                url: "<?php echo route('assemblingdetail.selectpart'); ?>",
                method: 'POST',
                data: {kode_produk:kode_produk, _token:token},
                success: function(data) {
                    $("#Parts").html('');
                        // $("select[name='kode_satuan'").html(data.options);
                        $.each(data.options, function(key, value){

                            $('#Parts').val('');
                            $('#Parts').append('<option value="'+ key +'">' + value + '</option>');
                            $('#Parts').val('');

                        });
                    }
                });
        }

        $('.select2').select2({
            placeholder: "Pilih",
            allowClear: true,
        });

        function refreshTable() {
          $('#data2-table').DataTable().ajax.reload(null,false);
        }

        function pulsar(e,obj) {
            tecla = (document.all) ? e.keyCode : e.which;
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

        $('#ADD_DETAIL').submit(function (e) {
            swal({
                    title: "<b>Proses Sedang Berlangsung</b>",
                    type: "warning",
                    showCancelButton: false,
                    showConfirmButton: false
            })
            e.preventDefault();
            var registerForm = $("#ADD_DETAIL");
            var formData = registerForm.serialize();

            // Check if empty of not
            $.ajax({
                    url:'<?php echo route('assemblingdetail.store'); ?>',
                    type:'POST',
                    data:formData,
                    success:function(data) {
                        $('#kode_produks').val('').trigger('change');
                        $('#Satuan').val('').trigger('change');
                        $('#QTY').val('');
                        $('#Partsx').val('');
                        $('#Harga').val('');
                        $('#Stock').val('');
                        $('#hpp').val('');
                        $('#Amount').val('');
                        $('#Satuan_produk').val('');
                        
                        refreshTable();
                        // window.location.reload();
                        if (data.success === true) {
                            swal("Berhasil!", data.message, "success");
                            
                        } else {
                            swal("Gagal!", data.message, "error");
                        }
                    },
                });
            
        });


        $('#UPDATE_DETAIL').submit(function (e) {
            swal({
                    title: "<b>Proses Sedang Berlangsung</b>",
                    type: "warning",
                    showCancelButton: false,
                    showConfirmButton: false
            })
            e.preventDefault();
            
            var registerForm = $("#UPDATE_DETAIL");
            var formData = registerForm.serialize();
            var id = $('#id').val();
            // Check if empty of not
                $.ajax({
                    url:'<?php echo route('assemblingdetail.updateajax'); ?>',
                    type:'POST',
                    data:formData,
                    success:function(data) {

                        if(data.success === true) {
                            swal("Berhasil!", data.message, "success");
                        }else{
                            swal("Gagal!", data.message, "error");
                        }
                        refreshTable();
                        $(".addform").show();
                        $(".editform").hide();
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
                        $('#id_detail1').val(results.id_detail);
                        $('#Produk_e').val(results.kode_produk);
                        $('#Namaproduk_e').val(results.nama_produk);
                        $('#Partnumber_e').val(results.partnumber);
                        $('#QTY_e').val(results.qty);
                        $('#Harga_e').val(results.hpp);
                        $(".addform").hide();
                        $(".editform").show();
                        },
                        error : function() {
                        alert("Nothing Data");
                    }
                });
               
        }

        function cancel_edit(){
            $(".addform").show();
            $("#Satuan_e").html('');
            $(".editform").hide();
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
                        refreshTable();
                            if (results.success === true) {
                                swal("Berhasil!", results.message, "success");
                                
                            } else {
                                swal("Gagal!", results.message, "error");
                            }
                        }
                });
            }
            });
        }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>