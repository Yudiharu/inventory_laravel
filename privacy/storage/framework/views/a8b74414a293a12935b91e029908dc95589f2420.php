<?php $__env->startSection('title', 'Pembelian'); ?>

<?php $__env->startSection('content_header'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <link rel="icon" type="image/png" href="/gui_inventory_laravel/css/logo_gui.png" sizes="16x16">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<?php echo $__env->make('sweet::alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body onLoad="load()">
    <div class="box box-solid">
        <div class="box-body">
            <div class="box">
                <div class="box-body">
                    <button type="button" class="btn btn-default btn-xs" onclick="refreshTable()" >
                            <i class="fa fa-refresh"></i> Refresh</button>
                    <?php if (app('laratrust')->can('create-pembelian')) : ?>
                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#addform"><i class="fa fa-plus"></i> New Pembelian</button>
                    <?php endif; // app('laratrust')->can ?>

                    <?php if (app('laratrust')->can('post-getkode')) : ?>
                    <button type="button" class="btn btn-primary btn-xs" onclick="getkode()">
                        <i class="fa fa-bullhorn"></i> Get New Kode</button>
                    <?php endif; // app('laratrust')->can ?>

                    <span class="pull-right"> 
                        <font style="font-size: 16px;"><b>PEMBELIAN</b></font>
                    </span>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="data-table" width="100%" style="font-size: 12px;">
                    <thead>
                    <tr class="bg-primary">
                        <th>No Pembelian</th>
                        <th>Tanggal Pembelian</th>
                        <th>Vendor</th>
                        <th>Jenis PO</th>
                        <th>Total Item</th>
                        <th>Diskon(%)</th>
                        <th>Diskon(Rp)</th>
                        <th>PPN</th>
                        <th>PBBKB(%)</th>
                        <th>PBBKB(Rp)</th>
                        <th>Ongkos Angkut</th>
                        <th>Grand Total</th>
                        <th>No AP</th>
                        <th>Status</th>
                        <th>Created</th>
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo e(Form::label('Tanggal Pembelian', 'Tanggal Pembelian:')); ?>

                                    <?php echo e(Form::date('tanggal_pembelian', \Carbon\Carbon::now(),['class'=> 'form-control','id'=>'Tanggal1' ,'required'=>'required'])); ?>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo e(Form::label('jenis_po', 'Jenis PO:')); ?>

                                    <?php echo e(Form::select('jenis_po', ['Stock' => 'Stock','Jasa' => 'Jasa','Non-Stock' => 'Non-Stock'], null, ['class'=> 'form-control select2','style'=>'width: 100%','placeholder' => '','id'=>'Jenis1','required'=>'required'])); ?>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo e(Form::label('Kode Vendor', 'Vendor:')); ?>

                                    <?php echo e(Form::select('kode_vendor',$Vendor->sort(),null, ['class'=> 'form-control select2','style'=>'width: 100%','placeholder' => '','id'=>'Vendor1','required'=>'required','onchange'=>"get_ppn();"])); ?>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo e(Form::label('No Penawaran', 'No Ref. Penawaran:')); ?>

                                    <?php echo e(Form::text('no_penawaran', null, ['class'=> 'form-control','id'=>'Ref1', 'placeholder'=>'No. Penawaran', 'autocomplete'=>'off','required'])); ?>

                                 </div>
                            </div> 

                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo e(Form::label('TOP', 'TOP:')); ?>

                                    <?php echo e(Form::text('top', null, ['class'=> 'form-control','id'=>'TOP1','onchange'=>"hitung();",'required'=>'required', 'placeholder'=>'Term Of Payment', 'autocomplete'=>'off','onkeypress'=>"return hanyaAngka(event)"])); ?>

                                 </div>
                            </div> 

                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo e(Form::label('Due Date', 'Due Date:')); ?>

                                    <?php echo e(Form::text('due_date', null, ['class'=> 'form-control','id'=>'Due1','required'=>'required', 'placeholder'=>'Tanggal Tenggat','readonly'])); ?>

                                 </div>
                            </div> 

                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo e(Form::label('Diskon', 'Diskon(%):')); ?>

                                    <?php echo e(Form::text('diskon_persen', 0, ['class'=> 'form-control','id'=>'Diskon1','placeholder'=>'%', 'autocomplete'=>'off','required','onkeyup'=>'cekdiskon()'])); ?>

                                 </div>
                            </div> 

                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo e(Form::label('Diskons', 'Diskon(Rp):')); ?>

                                    <?php echo e(Form::text('diskon_rp', 0, ['class'=> 'form-control','id'=>'Diskonrp1','placeholder'=>'Rp.', 'autocomplete'=>'off','required','onkeyup'=>'cekdiskon2()'])); ?>

                                 </div>
                            </div> 

                             <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo e(Form::label('PPN', 'PPN(%):')); ?>

                                    <?php echo e(Form::text('ppn', 0, ['class'=> 'form-control','id'=>'PPN1','placeholder'=>'%', 'autocomplete'=>'off','required'])); ?>

                                 </div>
                            </div> 

                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo e(Form::label('pbbkb', 'PBBKB(%):')); ?>

                                    <?php echo e(Form::text('pbbkb', 0, ['class'=> 'form-control','id'=>'pbbkb1', 'autocomplete'=>'off','required','onkeyup'=>'cekdiskon3()'])); ?>

                                </div>
                            </div> 

                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo e(Form::label('pbbkb_rp', 'PBBKB(Rp):')); ?>

                                    <?php echo e(Form::text('pbbkb_rp', 0, ['class'=> 'form-control','id'=>'pbbkbrp1', 'autocomplete'=>'off','required','onkeyup'=>'cekdiskon4()'])); ?>

                                </div>
                            </div> 

                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo e(Form::label('ongkos_angkut', 'Ongkos Angkut:')); ?>

                                    <?php echo e(Form::text('ongkos_angkut', 0, ['class'=> 'form-control','id'=>'ongkosangkut1', 'autocomplete'=>'off','required'])); ?>

                                </div>
                            </div> 

                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php echo e(Form::label('Deskripsi', 'Deskripsi:')); ?>

                                    <?php echo e(Form::textarea('deskripsi', null, ['class'=> 'form-control','rows'=>'4','id'=>'Deskripsi1', 'placeholder'=>'Deskripsi', 'autocomplete'=>'off'])); ?>

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
                                        <?php echo e(Form::label('No Pembelian', 'No Pembelian:')); ?>

                                        <?php echo e(Form::text('no_pembelian', null, ['class'=> 'form-control','id'=>'Pembelian','readonly'])); ?>

                                    </div>
                                </div> 

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('Tanggal Pembelian', 'Tanggal Pembelian:')); ?>

                                        <?php echo e(Form::date('tanggal_pembelian', null,['class'=> 'form-control','id'=>'Tanggal'])); ?>

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('jenis_po', 'Jenis PO:')); ?>

                                        <?php echo e(Form::select('jenis_po', ['Stock' => 'Stock','Jasa' => 'Jasa','Non-Stock' => 'Non-Stock'], null, ['class'=> 'form-control select2','style'=>'width: 100%','id'=>'Jenis'])); ?>

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('Kode Vendor', 'Vendor:')); ?>

                                        <?php echo e(Form::select('kode_vendor',$Vendor,null, ['class'=> 'form-control select2','style'=>'width: 100%','id'=>'Vendor'])); ?>

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('No Penawaran', 'No Ref. Penawaran:')); ?>

                                        <?php echo e(Form::text('no_penawaran', null, ['class'=> 'form-control','id'=>'Ref', 'autocomplete'=>'off','required'])); ?>

                                     </div>
                                </div> 

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('TOP', 'TOP:')); ?>

                                        <?php echo e(Form::text('top', null, ['class'=> 'form-control','id'=>'TOP','onchange'=>"hitung2();", 'autocomplete'=>'off'])); ?>

                                     </div>
                                </div> 

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('Due Date', 'Due Date:')); ?>

                                        <?php echo e(Form::text('due_date', null, ['class'=> 'form-control','id'=>'Due','readonly'])); ?>

                                     </div>
                                </div> 

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php echo e(Form::label('Diskon', 'Diskon(%):')); ?>

                                        <?php echo e(Form::text('diskon_persen', null, ['class'=> 'form-control','id'=>'Diskon', 'autocomplete'=>'off','required','onkeyup'=>'cekdiskone()'])); ?>

                                     </div>
                                </div> 

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php echo e(Form::label('Diskons', 'Diskon(Rp):')); ?>

                                        <?php echo e(Form::text('diskon_rp', null, ['class'=> 'form-control','id'=>'Diskonrp', 'autocomplete'=>'off','required','onkeyup'=>'cekdiskon2e()'])); ?>

                                     </div>
                                </div> 

                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <?php echo e(Form::label('PPN', 'PPN(%):')); ?>

                                        <?php echo e(Form::text('ppn', null, ['class'=> 'form-control','id'=>'PPN', 'autocomplete'=>'off','required'])); ?>

                                     </div>
                                </div> 

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php echo e(Form::label('pbbkb', 'PBBKB(%):')); ?>

                                        <?php echo e(Form::text('pbbkb', null, ['class'=> 'form-control','id'=>'pbbkb', 'autocomplete'=>'off','required','onkeyup'=>'cekdiskon3e()'])); ?>

                                     </div>
                                </div> 

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php echo e(Form::label('pbbkb_rp', 'PBBKB(Rp):')); ?>

                                        <?php echo e(Form::text('pbbkb_rp', null, ['class'=> 'form-control','id'=>'pbbkbrp', 'autocomplete'=>'off','required','onkeyup'=>'cekdiskon4e()'])); ?>

                                    </div>
                                </div> 

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php echo e(Form::label('ongkos_angkut', 'Ongkos Angkut:')); ?>

                                        <?php echo e(Form::text('ongkos_angkut', null, ['class'=> 'form-control','id'=>'ongkosangkut', 'autocomplete'=>'off','required'])); ?>

                                     </div>
                                </div> 
                            <?php if (auth()->user()->level == 'ap') { ?>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <?php echo e(Form::label('no_ap', 'No AP:')); ?>

                                        <?php echo e(Form::text('no_ap', null, ['class'=> 'form-control','id'=>'Ap','onkeypress'=>"return pulsar(event,this)"])); ?>

                                    </div>
                                </div>
                            <?php } ?>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <?php echo e(Form::label('Deskripsi', 'Deskripsi:')); ?>

                                        <?php echo e(Form::textarea('deskripsi', null, ['class'=> 'form-control','rows'=>'4','id'=>'Deskripsi', 'autocomplete'=>'off'])); ?>

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

            .print-button {
                background-color: #F63F3F;
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
            <?php if (app('laratrust')->can('update-pembelian')) : ?>
            <button type="button" class="btn btn-warning btn-xs edit-button" id="editpembelian" data-toggle="modal" data-target="">EDIT <i class="fa fa-edit"></i></button>
            <?php endif; // app('laratrust')->can ?>

            <?php if (app('laratrust')->can('delete-pembelian')) : ?>
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

            <?php if (app('laratrust')->can('view-pembelian')) : ?>
            <button type="button" class="btn btn-primary btn-xs view-button" id="button5">VIEW <i class="fa fa-eye"></i></button>
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

        function load(){
            startTime();
            $('.tombol1').hide();
            $('.tombol2').hide();
            $('.add-button').hide();
            $('.hapus-button').hide();
            $('.edit-button').hide();
            $('.print-button').hide();
            $('.view-button').hide();
            $('.back2Top').show();
        }

        $(function() {
            $("#data-table").DataTable({
                "bPaginate": true,
                "bFilter": true,
                "order": [[14, "desc"]],
                ajax: '<?php echo route('pembelian.data'); ?>',
                data:[],
                fnRowCallback: function (row, data, iDisplayIndex, iDisplayIndexFull) {
                    if (data['status'] == "OPEN") {
                        $('td', row).css('background-color', '#ffdbd3');
                    }
                },

                columns: [
                    { data: 'no_pembelian', 
                        render: function( data, type, full ) {
                        return formatNomor(data); }
                    },
                    { data: 'tanggal_pembelian', name: 'tanggal_pembelian' },
                    { data: 'nama_vendor', name: 'nama_vendor' },
                    { data: 'jenis_po', name: 'jenis_po' },
                    { data: 'total_item', name: 'total_item' },
                    { data: 'diskon_persen', name: 'diskon_persen' },
                    { data: 'diskon_rp', 
                        render: function( data, type, full ) {
                        return formatNumber(data); }
                    },
                    { data: 'ppn', name: 'ppn' },
                    { data: 'pbbkb', name: 'pbbkb' },
                    { data: 'pbbkb_rp', 
                        render: function( data, type, full ) {
                        return formatNumber(data); }
                    },
                    { data: 'ongkos_angkut', 
                        render: function( data, type, full ) {
                        return formatNumber(data); }
                    },
                    { data: 'grand_total', 
                        render: function( data, type, full ) {
                        return formatNumber(data); }
                    },
                    { data: 'no_ap', name: 'no_ap' },
                    { data: 'status', 
                        render: function( data, type, full ) {
                        return formatStatus(data); }
                    },
                    { data: 'created_at', name: 'created_at', visible: false },
                ]
            });
        });

        function getkode(){
            swal({
                title: "Get New Kode?",
                text: "New Kode",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Ya, Update!",
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
                    $.ajax({
                        url:'<?php echo route('pembelian.getkode'); ?>',
                        type:'POST',
                        success: function(result) {
                            swal("Berhasil!", result.message, "success");
                            refreshTable();
                        },
                    });
                } else {
                    e.dismiss;
                }
            }, function (dismiss) {
                return false;
            })
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
            }else{
                var stat = "<span style='color:#1a80c9'><b>RECEIVED</b></span>";
                return n.replace(/RECEIVED/, stat);
            }
        }

        function formatNomor(n) {
            var res = n.substr(2, 4);
            if(res != 'POGA'){
                return n;
            }else{
                var str = n;
                var result = str.fontcolor( "#0eab25" );
                return result;
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
            grand_total = formatRupiah(total_harga);

        });

        var my_table = "";

        $.each( result, function( key, row ) {
                    my_table += "<tr>";
                    my_table += "<td>"+row.produk+"</td>";
                    my_table += "<td>"+row.satuan+"</td>";
                    my_table += "<td>"+row.qty+"</td>";
                    my_table += "<td>Rp "+formatRupiah(row.harga)+"</td>";
                    my_table += "<td>Rp "+row.subtotal+"</td>";
                    my_table += "<td>"+row.qty_received+"</td>";
                    my_table += "</tr>";
            });

            my_table = '<table id="table-fixed" class="table table-bordered table-hover" cellpadding="5" cellspacing="0" border="1" style="padding-left:50px; font-size:12px">'+ 
                        '<thead>'+
                           ' <tr class="bg-info">'+
                                '<th>Produk</th>'+
                                '<th>Satuan</th>'+
                                '<th>Qty</th>'+
                                '<th>Harga Satuan</th>'+
                                '<th>Subtotal</th>'+
                                '<th>Qty Received</th>'+
                            '</tr>'+
                        '</thead>'+
                        '<tbody>' + my_table + '</tbody>'+
                       ' <tfoot>'+
                            '<tr class="bg-info">'+
                                '<th class="text-center" colspan="2">Total</th>'+
                                '<th></th>'+
                                '<th></th>'+
                                '<th>Rp '+grand_total+'</th>'+
                                '<th></th>'+
                            '</tr>'+
                            '</tfoot>'+
                        '</table>';

                    // $(document).append(my_table);
            
            return my_table;
            // mytable.appendTo("#box");           
        
        }

        $(document).ready(function() {
            $("#back2Top").click(function(event) {
                event.preventDefault();
                $("html, body").animate({ scrollTop: 0 }, "slow");
                return false;
            });
            
            var table = $('#data-table').DataTable();
            var post = document.getElementById("button1");
            var unpost = document.getElementById("button2");

            $('#data-table tbody').on( 'click', 'tr', function () {
                if ( $(this).hasClass('selected bg-gray text-bold') ) {
                    $(this).removeClass('selected bg-gray text-bold');
                    $('.tombol1').hide();
                    $('.tombol2').hide();
                    $('.add-button').hide();
                    $('.hapus-button').hide();
                    $('.edit-button').hide();
                    $('.print-button').hide();
                    $('.view-button').hide();
                }
                else {
                    table.$('tr.selected').removeClass('selected bg-gray text-bold');
                    $(this).addClass('selected bg-gray text-bold');
                    var select = $('.selected').closest('tr');
                    
                    closeOpenedRows(table, select);
                    
                    var colom = select.find('td:eq(13)').text();
                    var colom2 = select.find('td:eq(4)').text();
                    var no_pembelian = select.find('td:eq(0)').text();
                    var add = $("#addpembelian").attr("href","http://localhost/gui_inventory_laravel/admin/pembelian/"+no_pembelian+"/detail");
                    var print = $("#printpembelian").attr("href","http://localhost/gui_inventory_laravel/admin/pembelian/exportpdf?no_pembelian="+no_pembelian);
                    var status = colom;
                    var item = colom2;
                    if(status == 'POSTED' && item > 0){
                        $('.tombol1').hide();
                        $('.tombol2').show();
                        $('.add-button').hide();
                        $('.hapus-button').hide();
                        $('.edit-button').hide();
                        $('.print-button').show();
                        $('.view-button').show();
                    }else if(status =='OPEN' && item > 0){
                        $('.tombol1').show();
                        $('.tombol2').hide();
                        $('.add-button').show();
                        $('.hapus-button').hide();
                        $('.edit-button').show();
                        $('.print-button').hide();
                        $('.view-button').show();
                    }else if(status =='OPEN' && item == 0){
                        $('.tombol1').hide();
                        $('.tombol2').hide();
                        $('.add-button').show();
                        $('.hapus-button').show();
                        $('.edit-button').show();
                        $('.print-button').hide();
                        $('.view-button').hide();
                    }else if(status =='CLOSED' || status =='RECEIVED'){
                        $('.tombol1').hide();
                        $('.tombol2').hide();
                        $('.add-button').hide();
                        $('.hapus-button').hide();
                        $('.edit-button').hide();
                        $('.print-button').show();
                        $('.view-button').show();
                    }                
                }
            } );            
        
           $('#button1').click( function () {
                var select = $('.selected').closest('tr');
                var colom = select.find('td:eq(0)').text();
                var no_pembelian = colom;
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
                            showConfirmButton: false
                            })
                            
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                // alert( table.rows('.selected').data().length +' row(s) selected' );
                        $.ajax({
                            url: '<?php echo route('pembelian.post'); ?>',
                            type: 'POST',
                            data : {
                                'id': no_pembelian
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
                var no_pembelian = colom;
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
                            showConfirmButton: false
                            })
                            
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: '<?php echo route('pembelian.unpost'); ?>',
                            type: 'POST',
                            data : {
                                'id': no_pembelian
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

            $('#button5').click( function () {
                var select = $('.selected').closest('tr');
                var no_pembelian = select.find('td:eq(0)').text();
                var row = table.row( select );
                $.ajax({
                    url: '<?php echo route('pembelian.showdetail'); ?>',
                    type: 'POST',
                    data : {
                        'id': no_pembelian
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
                var no_pembelian = select.find('td:eq(0)').text();
                var row = table.row( select );
                $.ajax({
                    url: '<?php echo route('pembelian.edit_pembelian'); ?>',
                    type: 'POST',
                    data : {
                        'id': no_pembelian
                    },
                    success: function(results) {
                        $('#editform').modal('show');
                        $('#Pembelian').val(results.no_pembelian);
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
                        $('#Status').val(results.status);
                        $('#Jenis').val(results.jenis_po).trigger('change');
                        }
         
                });
            });

            $('#hapuspembelian').click( function () {
                var select = $('.selected').closest('tr');
                var no_pembelian = select.find('td:eq(0)').text();
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
                            url: '<?php echo route('pembelian.hapus_pembelian'); ?>',
                            type: 'POST',
                            data : {
                                'id': no_pembelian
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
            $('.add-button').hide();
            $('.hapus-button').hide();
            $('.edit-button').hide();
            $('.print-button').hide();
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
                url:'<?php echo route('pembelian.get_ppn'); ?>',
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
                url:'<?php echo route('pembelian.get_ppn'); ?>',
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
                    showConfirmButton: false
            })
            e.preventDefault();
            var registerForm = $("#ADD");
            var formData = registerForm.serialize();

                $.ajax({
                    url:'<?php echo route('pembelian.store'); ?>',
                    type:'POST',
                    data:formData,
                    success:function(data) {
                        // $('#Kode1').val('');
                        $('#addform').modal('show');
                        $('#Tanggal1').val('');
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
                    url:'<?php echo route('pembelian.updateajax'); ?>',
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