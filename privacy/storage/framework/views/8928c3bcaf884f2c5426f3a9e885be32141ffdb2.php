

<?php $__env->startSection('title', 'Memo'); ?>

<?php $__env->startSection('content_header'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <link rel="icon" type="image/png" href="/gui_inventory_laravel/css/logo_gui.png" sizes="16x16">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<?php echo $__env->make('sweet::alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<style>
    #canvasDiv{
        position: relative;
        border: 2px solid grey;
        height:300px;
        width: 550px;
    }
    
    @media  only screen and (max-width: 640px) {
      #canvasDiv {
        position: relative;
        border: 2px solid grey;
        height:275px;
        width: 350px;
      }
    }
</style>
<body onLoad="load()">
    <div class="box box-solid">
        <div class="box-body">
            <div class="box">
                <div class="box-body">
                    <button type="button" class="btn btn-default btn-xs" onclick="refreshTable()" >
                            <i class="fa fa-refresh"></i> Refresh</button>
                    <?php if (app('laratrust')->can('create-pembelian')) : ?>
                    <button type="button" class="btn btn-danger btn-xs" id="new-button" data-toggle="modal" data-target="#addform"><i class="fa fa-plus"></i> New Memo</button>
                    <i>&nbsp;ALT+1 = New Memo (shortcut)</i>
                    <?php endif; // app('laratrust')->can ?>

                    <?php if (app('laratrust')->can('post-getkode')) : ?>
                    <button type="button" class="btn btn-primary btn-xs" onclick="getkode()">
                        <i class="fa fa-bullhorn"></i> Get New Kode</button>
                    <?php endif; // app('laratrust')->can ?>

                    <span class="pull-right"> 
                    <?php if (stripos($_SERVER['HTTP_USER_AGENT'], 'Windows') === FALSE){ ?>
                        <button type="button" class="btn bg-orange btn-xs preview-button" data-toggle="modal" data-target="#previewpo"><i class="fa fa-print"></i> Preview PO</button>
                        <button type="button" class="btn bg-black btn-xs ttdigi-button" id="addttd" data-toggle="modal" data-target="#ttdform"><i class="fa fa-edit"></i> TTD DIGITAL</button>
                    <?php } ?>
                        <font style="font-size: 16px;"><b>MEMO</b></font>
                    </span>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="data-table" style="font-size: 12px; width: 100%;">
                    <thead>
                    <tr class="bg-primary">
                        <th>No Memo</th>
                        <th>Tanggal Memo</th>
                        <th>Total Item</th>
                        <th style="width: 230px;">Keterangan</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="col-md-12">
            </div>
            <div class="col-sm-2">
                <?php echo e(Form::label('texx', 'Created By:')); ?>

                <?php echo e(Form::text('created_by', null, ['class'=> 'form-control','id'=>'CreateBy1','readonly'])); ?>

            </div>
            <div class="col-md-2">
                <?php echo e(Form::label('texx', 'Created At:')); ?>

                <?php echo e(Form::text('created_at', null, ['class'=> 'form-control','id'=>'CreateAt1','readonly'])); ?>

            </div>
            <div class="col-md-2">
                <?php echo e(Form::label('texx', 'Updated By:')); ?>

                <?php echo e(Form::text('updated_by', null, ['class'=> 'form-control','id'=>'UpdateBy1','readonly'])); ?>

            </div>
            <div class="col-md-2">
                <?php echo e(Form::label('texx', 'Updated At:')); ?>

                <?php echo e(Form::text('updated_at', null, ['class'=> 'form-control','id'=>'UpdateAt1','readonly'])); ?>

            </div>
            <div class="col-md-2">
                <?php echo e(Form::label('texx', 'Posted By:')); ?>

                <?php echo e(Form::text('posted_by', null, ['class'=> 'form-control','id'=>'PostedBy1','readonly'])); ?>

            </div>
            <div class="col-md-2">
                <?php echo e(Form::label('texx', 'Unpost By:')); ?>

                <?php echo e(Form::text('unpost_by', null, ['class'=> 'form-control','id'=>'UnpostBy1','readonly'])); ?>

            </div>
        </div>
    </div>
    
<?php echo e(Form::hidden('nama_user', Auth()->user()->name, ['class'=> 'form-control','style'=>'width: 100%','id'=>'NamaUser1','readonly'])); ?>


<?php echo e(Form::hidden('n1', null, ['class'=> 'form-control','id'=>'nama','readonly'])); ?>

<?php echo e(Form::hidden('n1x', null, ['class'=> 'form-control','id'=>'nama2','readonly'])); ?>

<?php echo e(Form::hidden('n1z', null, ['class'=> 'form-control','id'=>'nama3','readonly'])); ?>


<?php echo e(Form::hidden('n2', null, ['class'=> 'form-control','id'=>'namara','readonly'])); ?>

<?php echo e(Form::hidden('n2x', null, ['class'=> 'form-control','id'=>'namara2','readonly'])); ?>

<?php echo e(Form::hidden('n2z', null, ['class'=> 'form-control','id'=>'namara3','readonly'])); ?>


<?php echo e(Form::hidden('n3', null, ['class'=> 'form-control','id'=>'namaga','readonly'])); ?>

<?php echo e(Form::hidden('n3x', null, ['class'=> 'form-control','id'=>'namaga2','readonly'])); ?>

<?php echo e(Form::hidden('n3z', null, ['class'=> 'form-control','id'=>'namaga3','readonly'])); ?>


<?php echo e(Form::hidden('n4', null, ['class'=> 'form-control','id'=>'grand1','readonly'])); ?>

<?php echo e(Form::hidden('n5', null, ['class'=> 'form-control','id'=>'grand2','readonly'])); ?>

<?php echo e(Form::hidden('n6', null, ['class'=> 'form-control','id'=>'grandara1','readonly'])); ?>

<?php echo e(Form::hidden('n7', null, ['class'=> 'form-control','id'=>'grandara2','readonly'])); ?>

<?php echo e(Form::hidden('n8', null, ['class'=> 'form-control','id'=>'grandaga1','readonly'])); ?>

<?php echo e(Form::hidden('n9', null, ['class'=> 'form-control','id'=>'grandaga2','readonly'])); ?>

    
<div class="modal fade" id="ttdform" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <br>
                        <h2>TTD Digital: <?php echo e(Form::label('nomoor', null,['id'=>'NomorTTD'])); ?></h2>
                        <hr>
                        <div id="canvasDiv"></div>
                        <br>
                        <button type="button" class="btn btn-danger" id="reset-btn">Clear</button>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="button" class="btn bg-blue" id="btn-save">Simpan (Dibuat Oleh)</button>
                        &nbsp;&nbsp;
                        <button type="button" class="btn bg-green" id="btn-periksa">Simpan (Diperiksa Oleh)</button>
                        <br><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn bg-yellow" id="btn-setuju">Simpan (Disetujui Oleh)</button>
                        &nbsp;&nbsp;
                        <button type="button" class="btn bg-purple" id="btn-tahu">Simpan (Diketahui Oleh)</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="previewpo" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" style="text-align: center;">Preview Detail PO</h4>
            </div>
            <div class="modal-body">
                <div class="row" style="font-size: 8pt;">
                    <b>
                    <div class="col-md-8">
                        <div class="form-group">
                            Vendor : <?php echo e(Form::label('nomoor', null,['id'=>'PreviewVendor'])); ?><br>
                            Alamat : <?php echo e(Form::label('nomoor', null,['id'=>'PreviewAlamat'])); ?><br>
                            Kontak : <?php echo e(Form::label('nomoor', null,['id'=>'PreviewKontak'])); ?><br>
                            NPWP&nbsp;&nbsp;&nbsp;: <?php echo e(Form::label('nomoor', null,['id'=>'PreviewNpwp'])); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            No. PO : <?php echo e(Form::label('nomoor', null,['id'=>'PreviewNomor'])); ?><br>
                            Tgl. PO : <?php echo e(Form::label('nomoor', null,['id'=>'PreviewTanggal'])); ?><br>
                            No. Penawaran : <?php echo e(Form::label('nomoor', null,['id'=>'PreviewPenawaran'])); ?>

                        </div>
                    </div>
                    </b>
                </div>
            </div>
            <div class="container-fluid table-responsive">
                <table class="table table-bordered table-striped table-hover" id="preview-table" width="100%" style="font-size: 12px;">
                    <thead>
                        <tr class="bg-warning">
                            <th>Produk</th>
                            <th>Keterangan</th>
                            <th>Satuan</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                </table>
                <div class="modal-footer">
                    <div class="col-md-6">
                        <span class="pull-left">
                            Note: <?php echo e(Form::label('0', null,['id'=>'PreviewNote'])); ?>

                        </span>
                    </div>
                    <div class="col-md-6">
                        <span class="pull-right">
                            <table width="100%" style="font-size:10pt; font-weight: bold; text-align:right;padding:0px; margin:0px; border-collapse:collapse" border="0">
                                <tr>
                                    <td>Subtotal</td>
                                    <td>&nbsp;:&nbsp;</td>
                                    <td><?php echo e(Form::label('0', null,['id'=>'PreviewSubtotal'])); ?></td>
                                </tr>
                                <tr>
                                    <td>Diskon</td>
                                    <td>&nbsp;:&nbsp;</td>
                                    <td><?php echo e(Form::label('0', null,['id'=>'PreviewDiskon'])); ?></td>
                                </tr>
                                <tr>
                                    <td>PPN</td>
                                    <td>&nbsp;:&nbsp;</td>
                                    <td><?php echo e(Form::label('0', null,['id'=>'PreviewPPN'])); ?></td>
                                </tr>
                            <?php if (Auth()->user()->kode_company == '02') { ?>
                                <tr>
                                    <td>PBBKB</td>
                                    <td>&nbsp;:&nbsp;</td>
                                    <td><?php echo e(Form::label('0', null,['id'=>'PreviewPBBKB'])); ?></td>
                                </tr>
                            <?php } ?>
                                <tr>
                                    <td>Grand Total</td>
                                    <td>&nbsp;:&nbsp;</td>
                                    <td><?php echo e(Form::label('0', null,['id'=>'PreviewGrandtotal'])); ?></td>
                                </tr>
                            </table>
                        </span>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="addform" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Create Data <i>&nbsp;ENTER = Simpan</i></h4>
            </div>
            <?php echo $__env->make('errors.validation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo Form::open(['id'=>'ADD']); ?>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo e(Form::label('Tanggal Memo', 'Tanggal Memo:')); ?>

                                    <?php echo e(Form::date('tgl_memo', \Carbon\Carbon::now(),['class'=> 'form-control','id'=>'Tanggal1' ,'required'=>'required'])); ?>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php echo e(Form::label('keterangan', 'Keterangan:')); ?>

                                    <?php echo e(Form::textarea('keterangan', null, ['class'=> 'form-control','rows'=>'2','id'=>'Keterangan1', 'placeholder'=>'Keterangan', 'autocomplete'=>'off','required', 'onkeypress'=>"return pulsar(event,this)"])); ?>

                                 </div>
                            </div>                        
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <?php echo e(Form::submit('Create data', ['class' => 'btn btn-success crud-submit','id'=>'create-button'])); ?>

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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('No Memo', 'No Memo:')); ?>

                                        <?php echo e(Form::text('no_memo', null, ['class'=> 'form-control','id'=>'Pembelian','readonly'])); ?>

                                    </div>
                                </div> 

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('Tanggal Memo', 'Tanggal Memo:')); ?>

                                        <?php echo e(Form::date('tgl_memo', null,['class'=> 'form-control','id'=>'Tanggal'])); ?>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <?php echo e(Form::label('keterangan', 'Keterangan:')); ?>

                                        <?php echo e(Form::textarea('keterangan_cetak', null, ['class'=> 'form-control','rows'=>'2','id'=>'Keterangan', 'placeholder'=>'Keterangan', 'autocomplete'=>'off', 'onkeypress'=>"return pulsar(event,this)"])); ?>

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

    <!--<button type="button" class="back2Top btn btn-warning btn-xs" id="back2Top"><i class="fa fa-arrow-up" style="color: #fff"></i> <i><?php echo e($nama_company); ?></i> <b>(<?php echo e($nama_lokasi); ?>)</b></button>-->

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
            .add-button {
                background-color: #00E0FF;
                bottom: 56px;
            }

            .hapus-button {
                background-color: #F63F3F;
                bottom: 86px;
            }

            .edit-button {
                background-color: #FDA900;
                bottom: 116px;
            }

            .tombol1 {
                background-color: #149933;
                bottom: 156px;
            }

            .tombol2 {
                background-color: #ff9900;
                bottom: 156px;
            }

            .view-button {
                background-color: #1674c7;
                bottom: 186px;
            }

            .tombol7 {
                background-color: #149933;
                bottom: 156px;
            }

            .tombol8 {
                background-color: #ff9900;
                bottom: 156px;
            }

            .print-button {
                background-color: #F63F3F;
                bottom: 216px;
            }
            
            .void-button {
                bottom: 246px;
            }
            
            .tombol3 {
                background-color: #09b2eb;
                bottom: 276px;
            }
            
            /*.ttdigi-button {*/
            /*    bottom: 276px;*/
            /*}*/

            #mySidenav button {
              position: fixed;
              right: -60px;
              transition: 0.3s;
              padding: 4px 8px;
              width: 110px;
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
            <?php if (app('laratrust')->can('update-pembelian')) : ?>
            <button type="button" class="btn btn-warning btn-xs edit-button" id="editpembelian" data-toggle="modal" data-target="">EDIT <i class="fa fa-edit"></i></button>
            <?php endif; // app('laratrust')->can ?>

            <?php if (app('laratrust')->can('delete-pembelian')) : ?>
            <button type="button" class="btn bg-purple btn-xs void-button" id="voidpembelian" data-toggle="modal" data-target="">VOID <i class="fa fa-times-circle"></i></button>
            <button type="button" class="btn btn-danger btn-xs hapus-button" id="hapuspembelian" data-toggle="modal" data-target="">HAPUS <i class="fa fa-times-circle"></i></button>
            <?php endif; // app('laratrust')->can ?>

            <?php if (app('laratrust')->can('add-pembelian')) : ?>
            <a href="#" id="addpembelian"><button type="button" class="btn btn-info btn-xs add-button" data-toggle="modal" data-target="">ADD <i class="fa fa-plus"></i></button></a>
            <?php endif; // app('laratrust')->can ?>

            <?php if (app('laratrust')->can('post-pembelian')) : ?>
            <button type="button" class="btn btn-success btn-xs tombol1" id="button1">POST <i class="fa fa-bullhorn"></i></button>
            <?php endif; // app('laratrust')->can ?>

            <?php if (app('laratrust')->can('unpost-pembelian')) : ?>
            <button type="button" class="btn btn-warning btn-xs tombol2" id="button2">UNPOST <i class="fa fa-undo"></i></button>
            <?php endif; // app('laratrust')->can ?>
            
            <?php if (app('laratrust')->can('unpost-pembelian')) : ?>
            <button type="button" class="btn btn-warning btn-xs tombol3" id="button3">CLOSING</button>
            <?php endif; // app('laratrust')->can ?>

            <?php if (app('laratrust')->can('view-pembelian')) : ?>
            <button type="button" class="btn btn-primary btn-xs view-button" id="button5">VIEW <i class="fa fa-eye"></i></button>
            <?php endif; // app('laratrust')->can ?>

            <?php if (app('laratrust')->can('approve-pembelian')) : ?>
            <button type="button" class="btn btn-success btn-xs tombol7" id="button7">APPROVE <i class="fa fa-check"></i></button>
            <?php endif; // app('laratrust')->can ?>

            <?php if (app('laratrust')->can('approve-pembelian')) : ?>
            <button type="button" class="btn btn-warning btn-xs tombol8" id="button8">DISAPPROVE <i class="fa fa-check"></i></button>
            <?php endif; // app('laratrust')->can ?>

            <?php if (app('laratrust')->can('print-pembelian')) : ?>
            <a href="#" target="_blank" id="printpembelian"><button type="button" class="btn btn-danger btn-xs print-button" id="button6">PRINT <i class="fa fa-print"></i></button></a>
            
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
        
        var x = 0;
        function showTime(){
            x = x + 1;
            if (x >= 60000){
                x = 0;
                refreshTable();
            }
        }
        // setInterval(showTime, 1);
        
        document.onkeyup = function () {
              var e = e || window.event; // for IE to cover IEs window event-object
              if(e.altKey && e.which == 49) {
                $("#new-button").click();
              }
              
              if(e.which == 13) {
                $("#create-button").click();
              }
        }

        function load(){
            limiter();
            startTime();
            $('.tombol1').hide();
            $('.tombol2').hide();
            $('.tombol3').hide();
            $('.tombol7').hide();
            $('.tombol8').hide();
            $('.add-button').hide();
            $('.hapus-button').hide();
            $('.edit-button').hide();
            $('.preview-button').hide();
            $('.print-button').hide();
            $('.ttdigi-button').hide();
            $('.view-button').hide();
            $('.void-button').hide();
            $('.back2Top').show();
        }
        
        function getnama(){
            var jenis = $("#Jenis1").val();
            if (jenis == 'Non-Stock') {
                document.getElementById("Alat1").readOnly = false;
            }else {
                document.getElementById("Alat1").readOnly = true;
            }
        }

        $(function() {
            $("#data-table").DataTable({
                processing: true,
                serverSide: true,
                "bPaginate": true,
                "bFilter": true,
                "scrollY": 280,
                "scrollX": 400,
                "pageLength":100,
                ajax: '<?php echo route('memo.data'); ?>',
                data:[],
                fnRowCallback: function (row, data, iDisplayIndex, iDisplayIndexFull) {
                    if (data['status'] == "OPEN") {
                        $('td', row).css('background-color', '#ffdbd3');
                    }
                },

                columns: [
                    { data: 'no_memo', name: 'no_memo' },
                    { data: 'tgl_memo', name: 'tgl_memo' },
                    { data: 'total_item', name: 'total_item' },
                    { data: 'keterangan', name: 'keterangan' },
                    { data: 'status', name: 'status' },
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
        
        function limiter() {
            $.ajax({
                url: '<?php echo route('memo.limitos'); ?>',
                type: 'GET',
                data : {
                },
                success: function(results) {
                    $('#nama').val(results.nama);
                    $('#nama2').val(results.nama2);
                    $('#nama3').val(results.nama3);
                    $('#grand1').val(results.grand1);
                    $('#grand2').val(results.grand2);
                    $('#namara').val(results.namara);
                    $('#namara2').val(results.namara2);
                    $('#namara3').val(results.namara3);
                    $('#grandara1').val(results.grandara1);
                    $('#grandara2').val(results.grandara2);
                    $('#namaga').val(results.namaga);
                    $('#namaga2').val(results.namaga2);
                    $('#namaga3').val(results.namaga3);
                    $('#grandaga1').val(results.grandaga1);
                    $('#grandaga2').val(results.grandaga2);
                }
            });
        }

        function formatNumber(m) {
            if(m == null){
                return '';
            }else{
                return m.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            }
        }

        function formatStatus(n) {
            if(n == 'OPEN'){
                return n;
            }else if(n == 'POSTED'){
                var stat = "<span style='color:#0eab25'><b>POSTED</b></span>";
                return n.replace(/POSTED/, stat);
            }else if(n == 'CLOSED'){
                var stat = "<span style='color:#c91a1a'><b>CLOSED</b></span>";
                return n.replace(/CLOSED/, stat);
            }else if(n == 'APPROVED'){
                var stat = "<span style='color:#FF5733'><b>APPROVED</b></span>";
                return n.replace(/APPROVED/, stat);
            }else if(n == 'INVOICED'){
                var stat = "<span style='color:#2a59a3'><b>INVOICED</b></span>";
                return n.replace(/INVOICED/, stat);
            }else if(n == 'VOID'){
                var stat = "<span style='color:#9439e3'><b>VOID</b></span>";
                return n.replace(/VOID/, stat);
            }else{
                var stat = "<span style='color:#1a80c9'><b>RECEIVED</b></span>";
                return n.replace(/RECEIVED/, stat);
            }
        }

        function formatRupiah(angka, prefix='Rp'){
           
            var rupiah = angka.toLocaleString(
                undefined, // leave undefined to use the browser's locale,
                // or use a string like 'en-US' to override it.
                { minimumFractionDigits: 0 }
            );
            return rupiah;
           
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

        function createTable(result){

        var total_qty = 0;
        var total_qty_received = 0;
        var total_pakai = 0;
        var total_harga = 0;
        var grand_total = 0;

        $.each( result, function( key, row ) {
            total_qty += row.qty;
            total_qty_received += row.qty_received;
            harga = row.harga;
            qty = row.qty;
            total_pakai = harga * qty;
            total_harga += total_pakai;
            grand_total = formatRupiah(Math.round(total_harga));

        });

        var my_table = "";

        $.each( result, function( key, row ) {
                    my_table += "<tr>";
                    my_table += "<td>"+row.produk+"</td>";
                    my_table += "<td>"+row.qty+"</td>";
                    my_table += "<td>"+row.qty_to+"</td>";
                    my_table += "</tr>";
            });

            my_table = '<table id="table-fixed" class="table table-bordered table-hover" cellpadding="5" cellspacing="0" border="1" style="padding-left:50px; font-size:12px">'+ 
                        '<thead>'+
                           ' <tr class="bg-info">'+
                                '<th>Produk</th>'+
                                '<th>Qty</th>'+
                                '<th>Qty TO</th>'+
                            '</tr>'+
                        '</thead>'+
                        '<tbody>' + my_table + '</tbody>'+
                        '</table>';

                    // $(document).append(my_table);
            
            return my_table;
            // mytable.appendTo("#box");           
        
        }

        $(document).ready(function() {
            var table = $('#data-table').DataTable();
            var post = document.getElementById("button1");
            var unpost = document.getElementById("button2");

            $('#data-table tbody').on( 'click', 'tr', function () {
                if ( $(this).hasClass('selected bg-gray text-bold') ) {
                    $(this).removeClass('selected bg-gray text-bold');
                    $('.tombol1').hide();
                    $('.tombol2').hide();
                    $('.tombol3').hide();
                    $('.tombol7').hide();
                    $('.tombol8').hide();
                    $('.add-button').hide();
                    $('.hapus-button').hide();
                    $('.edit-button').hide();
                    $('.print-button').hide();
                    $('.preview-button').hide();
                    $('.ttdigi-button').hide();
                    $('.view-button').hide();
                    $('.void-button').hide();
                    
                    $('#CreateBy1').val('');
                    $('#CreateAt1').val('');
                    $('#UpdateBy1').val('');
                    $('#UpdateAt1').val('');
                    $('#PostedBy1').val('');
                    $('#UnpostBy1').val('');
                }
                else {
                    table.$('tr.selected').removeClass('selected bg-gray text-bold');
                    $(this).addClass('selected bg-gray text-bold');
                    var select = $('.selected').closest('tr');
                    
                    closeOpenedRows(table, select);
                    
                    var data = $('#data-table').DataTable().row(select).data();
                    var grand_total = data['grand_total'];
                    var status = data['status'];
                    var item = data['total_item'];
                    var no_memo = data['no_memo'];
                    
                    var add = $("#addpembelian").attr("href",window.location.href+"/"+no_memo+"/detail");
                    var print = $("#printpembelian").attr("href",window.location.href+"/exportpdf?no_memo="+no_memo);
                    // var print = $("#printpreview").attr("href",window.location.href+"/printpreview?no_memo="+no_memo);

                    document.getElementById("NomorTTD").innerHTML = no_memo;
                    
                    $.ajax({
                        url: '<?php echo route('memo.previewpo'); ?>',
                        type: 'GET',
                        data : {
                            'id': no_memo
                        },
                        success: function(result) {
                            document.getElementById("PreviewVendor").innerHTML = result.vendor;
                            document.getElementById("PreviewNomor").innerHTML = result.no_po;
                            document.getElementById("PreviewAlamat").innerHTML = result.alamat;
                            document.getElementById("PreviewTanggal").innerHTML = result.tgl_po;
                            document.getElementById("PreviewKontak").innerHTML = result.kontak;
                            document.getElementById("PreviewPenawaran").innerHTML = result.no_penawaran;
                            document.getElementById("PreviewNpwp").innerHTML = result.npwp;

                            document.getElementById("PreviewSubtotal").innerHTML = result.subtotal;
                            document.getElementById("PreviewDiskon").innerHTML = result.diskon;
                            document.getElementById("PreviewPPN").innerHTML = result.ppn;

                            if (result.kode_company == '02') {
                                document.getElementById("PreviewPBBKB").innerHTML = result.pbbkb;
                            }
                            
                            document.getElementById("PreviewGrandtotal").innerHTML = result.grand_total;
                            document.getElementById("PreviewNote").innerHTML = result.note;

                            tablepreview(no_memo);
                        }
                    });
                    
                    $('#CreateBy1').val(data['created_by']);
                    $('#CreateAt1').val(data['created_at']);
                    $('#UpdateBy1').val(data['updated_by']);
                    $('#UpdateAt1').val(data['updated_at']);
                    $.ajax({
                        url: '<?php echo route('memo.historia'); ?>',
                        type: 'GET',
                        data : {
                            'id': no_memo
                        },
                        success: function(result) {
                            $('#PostedBy1').val(result.post);
                            $('#UnpostBy1').val(result.unpost);
                        }
                    });
                    
                    var pengguna = $('#NamaUser1').val();
                    
                    if(status == 'POSTED' && item > 0){
                        $('.tombol1').hide();
                        $('.tombol7').hide();
                        $('.tombol8').hide();
                        $('.add-button').hide();
                        $('.hapus-button').hide();
                        $('.edit-button').hide();
                        $('.print-button').show();
                        $('.preview-button').show();
                        $('.ttdigi-button').show();
                        $('.view-button').show();
                        $('.void-button').show();
                        $('.tombol2').show();
                    }else if(status =='OPEN' && item > 0){
                        $('.tombol1').show();
                        $('.tombol2').hide();
                        $('.tombol7').hide();
                        $('.tombol8').hide();
                        $('.add-button').show();
                        $('.hapus-button').hide();
                        $('.edit-button').show();
                        $('.print-button').hide();
                        $('.preview-button').hide();
                        $('.ttdigi-button').hide();
                        $('.view-button').show();
                        $('.void-button').show();
                    }else if(status =='OPEN' && item == 0){
                        $('.tombol1').hide();
                        $('.tombol2').hide();
                        $('.tombol7').hide();
                        $('.tombol8').hide();
                        $('.add-button').show();
                        $('.hapus-button').show();
                        $('.edit-button').show();
                        $('.print-button').hide();
                        $('.preview-button').hide();
                        $('.ttdigi-button').hide();
                        $('.view-button').hide();
                        $('.void-button').show();
                    }else if(status =='REQUESTED'){
                        $('.tombol1').hide();
                        $('.tombol2').hide();
                        $('.tombol3').show();
                        $('.tombol7').hide();
                        $('.tombol8').hide();
                        $('.add-button').hide();
                        $('.hapus-button').hide();
                        $('.edit-button').hide();
                        $('.print-button').show();
                        $('.preview-button').show();
                        $('.ttdigi-button').show();
                        $('.view-button').show();
                        $('.void-button').hide();
                    }                
                }
            } );            
        
            $('#button1').click( function () {
                var select = $('.selected').closest('tr');
                var colom = select.find('td:eq(0)').text();
                var no_memo = colom;
                swal({
                    title: "Post?",
                    text: colom,
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Ya, Posting!",
                    cancelButtonText: "Batal",
                    reverseButtons: !0
                    }).then(function (e) {
                        
                        if (e.value === true) {
                            swal({
                            title: "<b>Proses Sedang Berlangsung</b>",
                            type: "warning",
                            showCancelButton: false,
                            showConfirmButton: false,
                            allowOutsideClick: false
                            })
                            
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                // alert( table.rows('.selected').data().length +' row(s) selected' );
                        $.ajax({
                            url: '<?php echo route('memo.post'); ?>',
                            type: 'POST',
                            data : {
                                'id': no_memo
                            },
                            success: function(result) {
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
                                    refreshTable();
                                }
                            },
                            error : function () {
                              swal({
                                  title: 'Oops...',
                                  text: 'Gagal',
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
                var no_memo = colom;
                swal({
                    title: "Unpost?",
                    text: colom,
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Ya, Unpost!",
                    cancelButtonText: "Batal",
                    reverseButtons: !0
                    }).then(function (e) {
                        if (e.value === true) {
                            swal({
                            title: "<b>Proses Sedang Berlangsung</b>",
                            type: "warning",
                            showCancelButton: false,
                            showConfirmButton: false,
                            allowOutsideClick: false
                            })
                            
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: '<?php echo route('memo.unpost'); ?>',
                            type: 'POST',
                            data : {
                                'id': no_memo
                            },
                            success: function(result) {
                                if (result.success === true) {
                                    swal(
                                    'Unposted!',
                                    'Data berhasil di Unpost.',
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
                                    refreshTable();
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
            
            $('#button3').click( function () {
                var select = $('.selected').closest('tr');
                var colom = select.find('td:eq(0)').text();
                var no_memo = colom;
                swal({
                    title: "Close Manual?",
                    text: colom,
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Ya, Close!",
                    cancelButtonText: "Batal",
                    reverseButtons: !0
                    }).then(function (e) {
                        if (e.value === true) {
                            swal({
                            title: "<b>Proses Sedang Berlangsung</b>",
                            type: "warning",
                            showCancelButton: false,
                            showConfirmButton: false,
                            allowOutsideClick: false
                            })
                            
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: '<?php echo route('memo.closing'); ?>',
                            type: 'POST',
                            data : {
                                'id': no_memo
                            },
                            success: function(result) {
                                if (result.success === true) {
                                    swal(
                                    'Unposted!',
                                    'Data berhasil di Close.',
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
                                    refreshTable();
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

            $('#button7').click( function () {
                var select = $('.selected').closest('tr');
                var colom = select.find('td:eq(0)').text();
                var no_memo = colom;
                swal({
                    title: "Approve?",
                    text: colom,
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Ya, Approve!",
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
                            
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                // alert( table.rows('.selected').data().length +' row(s) selected' );
                        $.ajax({
                            url: '<?php echo route('memo.approve'); ?>',
                            type: 'POST',
                            data : {
                                'id': no_memo
                            },
                            success: function(result) {
                                if (result.success === true) {
                                    swal(
                                    'Approved!',
                                    'Your file has been approve.',
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
                                    refreshTable();
                                }
                            },
                            error : function () {
                              swal({
                                  title: 'Oops...',
                                  text: 'Gagal',
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

            $('#button8').click( function () {
                var select = $('.selected').closest('tr');
                var colom = select.find('td:eq(0)').text();
                var no_memo = colom;
                swal({
                    title: "Disapprove?",
                    text: colom,
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Ya, Disapprove!",
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
                            
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                // alert( table.rows('.selected').data().length +' row(s) selected' );
                        $.ajax({
                            url: '<?php echo route('memo.disapprove'); ?>',
                            type: 'POST',
                            data : {
                                'id': no_memo
                            },
                            success: function(result) {
                                if (result.success === true) {
                                    swal(
                                    'Disapproved!',
                                    'Your file has been disapprove.',
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
                                    refreshTable();
                                }
                            },
                            error : function () {
                              swal({
                                  title: 'Oops...',
                                  text: 'Gagal',
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
            
            var openRows = new Array();

            function closeOpenedRows(table, selectedRow) {
                $.each(openRows, function (index, openRow) {
                    // not the selected row!
                    if ($.data(selectedRow) !== $.data(openRow)) {
                        var rowToCollapse = table.row(openRow);
                        rowToCollapse.child.hide();
                        openRow.removeClass('shown');
                        var index = $.inArray(selectedRow, openRows);                        
                        openRows.splice(index, 1);
                    }
                });
            }
            
            //TTD DIGITAL
            var canvasDiv = document.getElementById('canvasDiv');
            var canvas = document.createElement('canvas');
            canvas.setAttribute('id', 'canvas');

            canvasDiv.appendChild(canvas);
            $("#canvas").attr('height', $("#canvasDiv").outerHeight());
            $("#canvas").attr('width', $("#canvasDiv").width());
            if (typeof G_vmlCanvasManager != 'undefined') {
                canvas = G_vmlCanvasManager.initElement(canvas);
            }

            context = canvas.getContext("2d");
            $('#canvas').mousedown(function(e) {
                var offset = $(this).offset()
                var mouseX = e.pageX - this.offsetLeft;
                var mouseY = e.pageY - this.offsetTop;

                paint = true;
                addClick(e.pageX - offset.left, e.pageY - offset.top);
                redraw();
            });

            $('#canvas').mousemove(function(e) {
                if (paint) {
                    var offset = $(this).offset()
                    //addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
                    addClick(e.pageX - offset.left, e.pageY - offset.top, true);
                    console.log(e.pageX, offset.left, e.pageY, offset.top);
                    redraw();
                }
            });

            $('#canvas').mouseup(function(e) {
                paint = false;
            });

            $('#canvas').mouseleave(function(e) {
                paint = false;
            });

            var clickX = new Array();
            var clickY = new Array();
            var clickDrag = new Array();
            var paint;

            function addClick(x, y, dragging) {
                clickX.push(x);
                clickY.push(y);
                clickDrag.push(dragging);
            }

            $("#reset-btn").click(function() {
                context.clearRect(0, 0, window.innerWidth, window.innerWidth);
                clickX = [];
                clickY = [];
                clickDrag = [];
            });

            $(document).on('click', '#btn-save', function() {
                var mycanvas = document.getElementById('canvas');
                var img = mycanvas.toDataURL("image/png");

                var select = $('.selected').closest('tr');
                var data = $('#data-table').DataTable().row(select).data();
                var no_memo = data['no_memo'];
                $.ajax({
                    url: '<?php echo route('memo.ttd_buat'); ?>',
                    type: 'POST',
                    data : {
                        'no': no_memo,
                        'img': img,
                    },
                    success: function(results) {
                        context.clearRect(0, 0, window.innerWidth, window.innerWidth);
                        clickX = [];
                        clickY = [];
                        clickDrag = [];
                        if (results.success == true) {
                            swal("Berhasil!", results.message, "success");
                        }
                    }
                });
            });

            $(document).on('click', '#btn-periksa', function() {
                var mycanvas = document.getElementById('canvas');
                var img = mycanvas.toDataURL("image/png");

                var select = $('.selected').closest('tr');
                var data = $('#data-table').DataTable().row(select).data();
                var no_memo = data['no_memo'];
                $.ajax({
                    url: '<?php echo route('memo.ttd_periksa'); ?>',
                    type: 'POST',
                    data : {
                        'no': no_memo,
                        'img': img,
                    },
                    success: function(results) {
                        context.clearRect(0, 0, window.innerWidth, window.innerWidth);
                        clickX = [];
                        clickY = [];
                        clickDrag = [];
                        if (results.success == true) {
                            swal("Berhasil!", results.message, "success");
                        }
                    }
                });
            });
            
            $(document).on('click', '#btn-setuju', function() {
                var mycanvas = document.getElementById('canvas');
                var img = mycanvas.toDataURL("image/png");

                var select = $('.selected').closest('tr');
                var data = $('#data-table').DataTable().row(select).data();
                var no_memo = data['no_memo'];
                $.ajax({
                    url: '<?php echo route('memo.ttd_setuju'); ?>',
                    type: 'POST',
                    data : {
                        'no': no_memo,
                        'img': img,
                    },
                    success: function(results) {
                        context.clearRect(0, 0, window.innerWidth, window.innerWidth);
                        clickX = [];
                        clickY = [];
                        clickDrag = [];
                        if (results.success == true) {
                            swal("Berhasil!", results.message, "success");
                        }
                    }
                });
            });
            
            $(document).on('click', '#btn-tahu', function() {
                var mycanvas = document.getElementById('canvas');
                var img = mycanvas.toDataURL("image/png");

                var select = $('.selected').closest('tr');
                var data = $('#data-table').DataTable().row(select).data();
                var no_memo = data['no_memo'];
                $.ajax({
                    url: '<?php echo route('memo.ttd_tahu'); ?>',
                    type: 'POST',
                    data : {
                        'no': no_memo,
                        'img': img,
                    },
                    success: function(results) {
                        context.clearRect(0, 0, window.innerWidth, window.innerWidth);
                        clickX = [];
                        clickY = [];
                        clickDrag = [];
                        if (results.success == true) {
                            swal("Berhasil!", results.message, "success");
                        }
                    }
                });
            });

            var drawing = false;
            var mousePos = {
                x: 0,
                y: 0
            };
            var lastPos = mousePos;

            canvas.addEventListener("touchstart", function(e) {
                mousePos = getTouchPos(canvas, e);
                var touch = e.touches[0];
                var mouseEvent = new MouseEvent("mousedown", {
                    clientX: touch.clientX,
                    clientY: touch.clientY
                });
                canvas.dispatchEvent(mouseEvent);
            }, false);

            canvas.addEventListener("touchend", function(e) {
                var mouseEvent = new MouseEvent("mouseup", {});
                canvas.dispatchEvent(mouseEvent);
            }, false);

            canvas.addEventListener("touchmove", function(e) {
                var touch = e.touches[0];
                var offset = $('#canvas').offset();
                var mouseEvent = new MouseEvent("mousemove", {
                    clientX: touch.clientX,
                    clientY: touch.clientY
                });
                canvas.dispatchEvent(mouseEvent);
            }, false);

            // Get the position of a touch relative to the canvas
            function getTouchPos(canvasDiv, touchEvent) {
                var rect = canvasDiv.getBoundingClientRect();
                return {
                    x: touchEvent.touches[0].clientX - rect.left,
                    y: touchEvent.touches[0].clientY - rect.top
                };
            }

            var elem = document.getElementById("canvas");

            var defaultPrevent = function(e) {
                e.preventDefault();
            }
            elem.addEventListener("touchstart", defaultPrevent);
            elem.addEventListener("touchmove", defaultPrevent);

            function redraw() {
                //
                lastPos = mousePos;
                for (var i = 0; i < clickX.length; i++) {
                    context.beginPath();
                    if (clickDrag[i] && i) {
                        context.moveTo(clickX[i - 1], clickY[i - 1]);
                    } else {
                        context.moveTo(clickX[i] - 1, clickY[i]);
                    }
                    context.lineTo(clickX[i], clickY[i]);
                    context.lineWidth = 5;
                    context.closePath();
                    context.stroke();
                }
            }

            $('#button5').click( function () {
                var select = $('.selected').closest('tr');
                var no_memo = select.find('td:eq(0)').text();
                var row = table.row( select );
                $.ajax({
                    url: '<?php echo route('memo.showdetail'); ?>',
                    type: 'POST',
                    data : {
                        'id': no_memo
                    },
                    success: function(result) {
                        if(result.title == 'Gagal'){
                            $.notify(result.message);
                        }else{
                            if ( row.child.isShown() ) {
                                row.child.hide();
                                select.removeClass('shown');
                            }
                            else {
                                closeOpenedRows(table, select);

                                row.child( createTable(result) ).show();
                                select.addClass('shown');

                                openRows.push(select);
                            }
                        }
                    }
                });
            });

            $('#editpembelian').click( function () {
                var select = $('.selected').closest('tr');
                var no_memo = select.find('td:eq(0)').text();
                var row = table.row( select );
                $.ajax({
                    url: '<?php echo route('memo.edit_pembelian'); ?>',
                    type: 'POST',
                    data : {
                        'id': no_memo
                    },
                    success: function(results) {
                        $('#editform').modal('show');
                        $('#Pembelian').val(results.no_memo);
                        $('#Vendor').val(results.kode_vendor).trigger('change');
                        $('#Tanggal').val(results.tanggal_pembelian);
                        $('#Ref').val(results.no_penawaran);
                        $('#TOP').val(results.top);
                        $('#Due').val(results.due_date);
                        $('#Diskon').val(results.diskon_persen);
                        $('#Diskonrp').val(results.diskon_rp);
                        $('#PPN').val(results.ppn);
                        $('#pbbkb').val(results.pbbkb);
                        $('#pbbkbrp').val(results.pbbkb_rp);
                        $('#ongkosangkut').val(results.ongkos_angkut);
                        $('#Deskripsi').val(results.deskripsi);
                        $('#Cost2').val(results.cost_center).trigger('change');
                        $('#Status').val(results.status);
                        $('#Jenis').val(results.jenis_po).trigger('change');
                    }
                });
            });

            $('#hapuspembelian').click( function () {
                var select = $('.selected').closest('tr');
                var no_memo = select.find('td:eq(0)').text();
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
                            url: '<?php echo route('memo.hapus_pembelian'); ?>',
                            type: 'POST',
                            data : {
                                'id': no_memo
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
            
            $('#voidpembelian').click( function () {
                var select = $('.selected').closest('tr');
                var no_memo = select.find('td:eq(0)').text();
                var row = table.row( select );
                swal({
                    title: "Hapus?",
                    text: "Pastikan dahulu item yang akan di void",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Ya, Void!",
                    cancelButtonText: "Batal!",
                    reverseButtons: !0
                }).then(function (e) {
                    if (e.value === true) {
                        $.ajax({
                            url: '<?php echo route('memo.void_pembelian'); ?>',
                            type: 'POST',
                            data : {
                                'id': no_memo
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
            $('#data-table').DataTable().ajax.reload(null,false);
            $('.tombol1').hide();
            $('.tombol2').hide();
            $('.tombol7').hide();
            $('.tombol8').hide();
            $('.add-button').hide();
            $('.ttdigi-button').hide();
            $('.hapus-button').hide();
            $('.edit-button').hide();
            $('.print-button').hide();
            $('.preview-button').hide();
            $('.view-button').hide();
        }

        $('.modal-dialog').draggable({
            handle: ".modal-header"
        });

        $('.modal-dialog').resizable({
    
        });

        function hitung() {
             var tgl_awal = $('#Tanggal1').val();
             var hari = $('#TOP1').val();

             var hasil = new Date(new Date().getTime()+(hari*24*60*60*1000)); 

             var newdate = new Date(hasil);
             var dd = newdate.getDate();
             var mm = newdate.getMonth() + 1;
             var y = newdate.getFullYear();

             var someFormattedDate = y + '-' + mm + '-' + dd;
             document.getElementById('Due1').value = someFormattedDate;
        }

        function hitung2() {
             var tgl_awal = $('#Tanggal').val();
             var hari = $('#TOP').val();

             var hasil = new Date(new Date().getTime()+(hari*24*60*60*1000)); 

             var newdate = new Date(hasil);
             var dd = newdate.getDate();
             var mm = newdate.getMonth() + 1;
             var y = newdate.getFullYear();

             var someFormattedDate = y + '-' + mm + '-' + dd;
             document.getElementById('Due').value = someFormattedDate;
        }
        
        function get_ppn(){
            var kode_vendor = $('#Vendor1').val();
            $.ajax({
                url:'<?php echo route('memo.get_ppn'); ?>',
                type:'POST',
                data : {
                    'kode_vendor': kode_vendor,
                },
                success: function(result) {
                    $('#PPN1').val(result.ppn);
                },
            });
        }

        function get_ppn2(){
            var kode_vendor = $('#Vendor').val();
            $.ajax({
                url:'<?php echo route('memo.get_ppn'); ?>',
                type:'POST',
                data : {
                    'kode_vendor': kode_vendor,
                },
                success: function(result) {
                    $('#PPN').val(result.ppn);
                },
            });
        }

        function cekdiskon(){
            var diskonpersen = $('#Diskon1').val();
            var diskonrp = $('#Diskonrp1').val();
            if (diskonpersen > 0){
                $('#Diskonrp1').val('0');
                // document.getElementById('Diskonrp1').disabled = true;
            }
        }

        function cekdiskon2(){
            var diskonpersen = $('#Diskon1').val();
            var diskonrp = $('#Diskonrp1').val();
            if (diskonrp > 0){
                $('#Diskon1').val('0');
                // document.getElementById('Diskon1').disabled = true;
            }
        }

        function cekdiskon3(){
            var pbbkbpersen = $('#pbbkb1').val();
            var pbbkbrp = $('#pbbkbrp1').val();
            if (pbbkbrp > 0){
                $('#pbbkbrp1').val('0');
                // document.getElementById('Diskon1').disabled = true;
            }
        }

        function cekdiskon4(){
            var pbbkbpersen = $('#pbbkb1').val();
            var pbbkbrp = $('#pbbkbrp1').val();
            if (pbbkbpersen > 0){
                $('#pbbkb1').val('0');
                // document.getElementById('Diskon1').disabled = true;
            }
        }


        function cekdiskone(){
            var diskonpersen = $('#Diskon').val();
            var diskonrp = $('#Diskonrp').val();
            if (diskonpersen > 0){
                $('#Diskonrp').val('0');
                // document.getElementById('Diskonrp1').disabled = true;
            }
        }

        function cekdiskon2e(){
            var diskonpersen = $('#Diskon').val();
            var diskonrp = $('#Diskonrp').val();
            if (diskonrp > 0){
                $('#Diskon').val('0');
                // document.getElementById('Diskon1').disabled = true;
            }
        }

        function cekdiskon3e(){
            var pbbkbpersen = $('#pbbkb').val();
            var pbbkbrp = $('#pbbkbrp').val();
            if (pbbkbrp > 0){
                $('#pbbkbrp').val('0');
                // document.getElementById('Diskon1').disabled = true;
            }
        }

        function cekdiskon4e(){
            var pbbkbpersen = $('#pbbkb').val();
            var pbbkbrp = $('#pbbkbrp').val();
            if (pbbkbpersen > 0){
                $('#pbbkb').val('0');
                // document.getElementById('Diskon1').disabled = true;
            }
        }
             

        $('#ADD').submit(function (e) {
            swal({
                    title: "<b>Proses Sedang Berlangsung</b>",
                    type: "warning",
                    showCancelButton: false,
                    showConfirmButton: false,
                    allowOutsideClick: false
            })
            e.preventDefault();
            var registerForm = $("#ADD");
            var formData = registerForm.serialize();
            
            var now = new Date();
            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

                $.ajax({
                    url:'<?php echo route('memo.store'); ?>',
                    type:'POST',
                    data:formData,
                    success:function(data) {
                        // $('#Kode1').val('');
                        $('#addform').modal('show');
                        $('#Tanggal1').val(today);
                        $('#Jenis1').val('').trigger('change');
                        $('#Vendor1').val('').trigger('change');
                        $('#Ref1').val('');
                        $('#TOP1').val('');
                        $('#Due1').val('');
                        $('#Diskon1').val('0');
                        $('#Diskonrp1').val('0');
                        $('#PPN1').val('0');
                        $('#pbbkb1').val('0');
                        $('#pbbkbrp1').val('0');
                        $('#ongkosangkut1').val('0');
                        $('#Deskripsi1').val('');
                        $('#Cost1').val('').trigger('change');
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
            swal({
                    title: "<b>Proses Sedang Berlangsung</b>",
                    type: "warning",
                    showCancelButton: false,
                    showConfirmButton: false
            })
            e.preventDefault();
            var registerForm = $("#EDIT");
            var formData = registerForm.serialize();

                $.ajax({
                    url:'<?php echo route('memo.updateajax'); ?>',
                    type:'POST',
                    data:formData,
                    success:function(data) {
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