<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <title>LAPORAN DATA PENERIMAAN BARANG</title>
    <style>
        .header, h1 {
            font-size: 11pt;
            margin-bottom: 0px;
        }

        .header, p {
            font-size: 10pt;
            margin-top: 0px;
        }
        .table_content {
            color: #232323;
            border-collapse: collapse;
            font-size: 8pt;
            margin-top: 15px;
        }

        .table_content, .border {
            border: 1px solid black;
            padding: 4px;
        }
        .table_content, thead, th {
            padding: 7px;
            text-align: center;

        }
        ul li {
            display:inline;
            list-style-type:none;
        }

        table.grid1 {
          font-family: sans-serif;
          border-collapse: collapse;
          width: 100%;
        }

        table.grid1 td, table.grid1 th {
          border: 1px solid #dddddd;
          text-align: left;
          padding: 4px;
        }

        table.grid1 tr:nth-child(even) {
          background-color: #dddddd;
        }

        body{        
            padding-top: 110px;
            font-family: sans-serif;
        }
        .fixed-header, .fixed-footer{
            width: 100%;
            position: fixed;       
            padding: 10px 0;
            text-align: center;
        }
        .fixed-header{
            top: 0;
        }
        .fixed-footer{
            bottom: 0;
        }

        #header .page:after {
          content: counter(page, decimal);
        }

        .page_break { page-break-after: always; }
    </style>
</head>
<body>

<div class="fixed-header">
        <div style="float: left">
            <img src="<?php echo e(asset('css/logo_gui.png')); ?>" alt="" height="25px" width="25px" align="left">
            <p id="color" style="font-size: 8pt;" align="left"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($nama2) ?></b><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lokasi: <?php echo ($nama) ?></p>
        </div>

        <div id="header">
            <p class="page" style="float: right; font-size: 9pt;"><b>Date :</b> <?php echo date_format($dt,"d/m/Y") ?>&nbsp;&nbsp;&nbsp;
            <b>Time :</b> <?php echo date_format($dt,"H:i:s") ?>&nbsp;&nbsp;&nbsp;
            <b>Page :</b> </p>
        </div>

        <br><br>
            <?php
                if ($kategori != 'SEMUA') {?>
                    <h1>LAPORAN PENERIMAAN BARANG KATEGORI <?php echo $kategori; ?></h1>
            <?php } 
                else{?>
                    <h1>LAPORAN PENERIMAAN BARANG</h1>
            <?php } ?>

            <p>Periode: <?php echo ($tanggal_awal) ?> s.d <?php echo ($tanggal_akhir) ?></p>
        
    </div>


<?php
$grandtotalqty = 0;
$grandtotaljumlah = 0;
?>
    <table class="grid1" style="margin-bottom: 25px;width: 100%; font-size: 11px">
        <thead>
        <tr style="background-color: #e6f2ff">
            <th>NO</th>
            <th>No Penerimaan</th>
            <th>No Pembelian</th>
            <th>Tanggal Transaksi</th>
            <th>Status</th>
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Partnumber</th>
            <?php
                if ($kategori == 'SEMUA') {?>
                    <th>Kode Kategori</th>
            <?php } ?>
            <th>Kode Satuan</th>
            <th>Qty</th>
            <?php if (app('laratrust')->can('read-hpp')) : ?>
            <th>Harga</th>
            <th>Landed Cost</th>
            <th>Subtotal</th>
            <?php endif; // app('laratrust')->can ?>
        </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $penerimaandetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <tr class="border">
                <td><?php echo $key+1 ?></td>
                <td><?php echo $row->no_penerimaan?></td>
                <td><?php echo $row->no_pembelian?></td>
                <td><?php echo $row->tanggal_penerimaan?></td>
                <?php
                    if ($row->qty_retur > 0) {?>
                        <td>RETUR</td>
                <?php } 
                    else{ ?>
                        <td><?php echo e($row->status); ?></td>
                <?php } ?>
                <td><?php echo $row->kode_produk?></td>
                <td><?php echo $row->nama_produk?></td>
                <td><?php echo $row->partnumber?></td>
                <?php
                    if ($kategori == 'SEMUA') {?>
                        <td><?php echo e($row->kode_kategori); ?></td>
                <?php } ?>
                <td><?php echo $row->kode_satuan?></td>
                <td><?php echo $row->qty?></td>
                <?php if (app('laratrust')->can('read-hpp')) : ?>
                <td><?php echo number_format($row->harga,'0',',','.') ?></td>
                <td><?php echo number_format($row->landedcost,'0',',','.') ?></td>
                <td><?php echo number_format(($row->harga * $row->qty) + ($row->landedcost * $row->qty),'0',',','.') ?></td>
                <?php endif; // app('laratrust')->can ?>
            </tr>

            <?php
            $subqty = 0;
            $subtotal = 0;
            $subqty += (float) $row->qty;
            $subtotal += ($row->harga * $row->qty) + ($row->landedcost * $row->qty);

            $grandtotalqty += $subqty;
            $grandtotaljumlah += $subtotal;
            $landedcost = $row->landedcost;
            ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>

        <tfoot>
        <tr style="background-color: #F5D2D2">
            <?php
                if ($kategori != 'SEMUA') {?>
                    <td colspan="9" style="font-weight: bold; text-align: center">Total</td>
            <?php } 
                else{?>
                    <td colspan="10" style="font-weight: bold; text-align: center">Total</td>
            <?php } ?>
            <td><?php echo number_format((float)$grandtotalqty, 0, ',', '.');;?></td>
            <?php if (app('laratrust')->can('read-hpp')) : ?>
            <td colspan="2"></td>
            <td>&nbsp;<?php echo number_format($grandtotaljumlah,'0',',','.');?></td>
            <?php endif; // app('laratrust')->can ?>
        </tr>
        </tfoot>

    </table>

    <?php
        if ($format_ttd != 1) {?>
            <br><br>
            <table width="100%" style="font-size:10pt; text-align: center; bottom: 0">
                <tr>
                    <td width="30%">Dibuat,</td>
                    <td width="30%">Disetujui,</td>
                </tr>
                <tr><td colspan="3"><br><br><br></td></tr>
                <tr>
                    <td><?php echo $ttd; ?></td>
                    <td><?php echo $limit3->mengetahui; ?></td>
                </tr>
            </table>
        <?php } 
        else{?>
            <div class="page_break"></div>
            <?php if (app('laratrust')->can('read-hpp')) : ?>
            <table class="grid1" style="margin-left: auto; margin-right: auto; width: 25%; font-size: 11px;">
                <tfoot>
                    <tr style="background-color: #e6f2ff">
                        <td style="font-weight: bold; text-align: center">Grand Total</td>
                    </tr>
                    <tr style="background-color: #F5D2D2">
                        <td style="font-weight: bold; text-align: center">&nbsp;<?php echo number_format($grandtotaljumlah,'0',',','.');?></td>
                    </tr>
                </tfoot>
            </table>
            <?php endif; // app('laratrust')->can ?>
            <!--<?php if (app('laratrust')->can('read-excelharga')) : ?>-->
            <!--<table class="grid1" style="margin-left: auto; margin-right: auto; width: 25%; font-size: 11px;">-->
            <!--    <tfoot>-->
            <!--        <tr style="background-color: #e6f2ff">-->
            <!--            <td style="font-weight: bold; text-align: center">Grand Total</td>-->
            <!--        </tr>-->
            <!--        <tr style="background-color: #F5D2D2">-->
            <!--            <td style="font-weight: bold; text-align: center">&nbsp;<?php echo number_format($grandtotaljumlah,'0',',','.');?></td>-->
            <!--        </tr>-->
            <!--    </tfoot>-->
            <!--</table>-->
            <!--<?php endif; // app('laratrust')->can ?>-->
            <br><br>
            <table width="100%" style="font-size:10pt; text-align: center; bottom: 0">
                <tr>
                    <td width="30%">Dibuat,</td>
                    <td width="30%">Disetujui,</td>
                </tr>
                <tr><td colspan="3"><br><br><br></td></tr>
                <tr>
                    <td><?php echo $ttd; ?></td>
                    <td><?php echo $limit3->mengetahui; ?></td>
                </tr>
            </table>
    <?php } ?>
</body>
</html>