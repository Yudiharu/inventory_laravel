<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    <meta charset="utf-8" />
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
            padding: -10px 0;
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

<?php
$grandtotaljumlah = 0;
?>
    <table class="grid1" style="font-size: 11px; vertical-align: top; width: 27cm">
        <thead>
            <tr>
                <th>Tanggal Transaksi</th>
                <th>Jam Transaksi</th>
                <th>Nomor Transaksi</th>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Qty Transaksi</th>
                <th>Satuan</th>
                <th>Hpp</th>
                <th>Total Transaksi</th>
                
                <?php
                    if ($lokasi == 'SEMUA') {?>
                        <th>Kode Lokasi</th>
                <?php } ?>
            </tr>
        </thead>
<?php
$subtotalbegin = 0;
$subqty = 0;
$subtotal = 0;
$subtotalending = 0;
?>
                <tr align="left">
                    <td colspan="8" style="font-weight: bold; text-align: center">BEGIN</td>
                    <?php $__currentLoopData = $kartustok_saldo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $subtotalbegin += intval($item->begin_amount) ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <td align="right"><b><?php echo e(number_format($subtotalbegin)); ?></b></td>
                    <?php
                        if ($lokasi == 'SEMUA') {?>
                            <td></td>
                    <?php } ?>
                </tr>
                
        <tbody>
            <?php $__currentLoopData = $kartustok_cetak; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item->tanggal_transaksi); ?></td>
                    <td><?php echo e($item->jam_transaksi); ?></td> 
                    <td><?php echo e($item->no_transaksi); ?></td>
                    <td><?php echo e($item->kode_produk); ?></td>
                    <td><?php echo e($item->nama_produk); ?></td>
                    <td align="right"><?php echo e($item->qty_transaksi); ?></td>
                    <td align="right"><?php echo e($item->kode_satuan); ?></td>
                   
                    <td align="right"><?php echo e(number_format($item->harga_transaksi,'2','.',',')); ?></td>
                    <td align="right"><?php echo e(number_format($item->total_transaksi,'2','.',',')); ?></td>
                    
                    <?php echo e($subqty += $item->qty_transaksi); ?>

                    <?php echo e($subtotal += $item->total_transaksi); ?>

                    <?php
                        if ($lokasi == 'SEMUA') {?>
                            <td><?php echo e($item->kode_lokasi); ?></td>
                    <?php } ?>
                </tr>

                <?php
                    $grandtotaljumlah += $subtotal;
                ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        
<?php $__currentLoopData = $kartustok_saldo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php echo e($subtotalending += $item->ending_amount); ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tfoot>
        <tr>
            <td colspan="5" style="font-weight: bold; text-align: center">ENDING</td>
            <td align="right"><b><?php echo e(number_format($subqty)); ?></b></td>
            <td colspan="2" style="font-weight: bold; text-align: center"></td>
            <td align="right"><b><?php echo e(number_format($subtotalending)); ?></b></td>
            <?php
                if ($lokasi == 'SEMUA') {?>
                    <td></td>
            <?php } ?>
        </tr>
        </tfoot>
    </table>
</body>
</html>