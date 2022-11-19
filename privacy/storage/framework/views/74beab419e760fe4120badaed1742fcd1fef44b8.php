<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    <meta charset="utf-8" />
    <title>LAPORAN BULANAN <?php echo e($nama); ?></title>
    <style>
        body {
            font-family: sans-serif;
            /*font-family: courier;*/
            /*font-weight: bold;*/
        }
        .header {
            text-align: center;
        },
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
    </style>
</head>
<body>

<div class="header">
    <img src="<?php echo e(asset('css/logo_gui.png')); ?>" alt="" height="25px" width="25px" align="left">
    <p id="color" style="font-size: 8pt;" align="left"><b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($nama2) ?></b><br>
    &nbsp;&nbsp;&nbsp;&nbsp;Lokasi: <?php echo ($nama1) ?></p>

    <h1>LAPORAN PRODUK BULANAN <?php echo $nama; ?></h1>
    <p>Periode: <?php echo ($awal);?> s/d <?php echo ($akhir);?></p>
    <br>
    <table class="grid1" style="margin-bottom: 25px;width: 100%; font-size: 10px">
             <thead>
        <tr style="background-color: #e6f2ff">
            <th>Periode</th>
            <th>Kode Produk</th>
            <th>Partnumber</th>
            <th>Begin Stock</th>
            <?php if (app('laratrust')->can('read-hpp')) : ?>
            <th>Begin Amount</th>
            <?php endif; // app('laratrust')->can ?>
            <?php
                if ($penerimaan == 'true' || $semua == 'true') {?>  
                    <th>In Stock</th>
                    <?php if (app('laratrust')->can('read-hpp')) : ?>
                    <th>In Amount</th>
                    <?php endif; // app('laratrust')->can ?>
            <?php } ?>   
            <?php
                if ($pemakaian == 'true' || $semua == 'true') {?>
                    <th>Out Stock</th>
                    <?php if (app('laratrust')->can('read-hpp')) : ?>
                    <th>Out Amount</th>
                    <?php endif; // app('laratrust')->can ?>
            <?php } ?>
            <?php
                if ($penjualan == 'true' || $semua == 'true') {?>
                    <th>Sale Stock</th>
                    <?php if (app('laratrust')->can('read-hpp')) : ?>
                    <th>Sale Amount</th>
                    <?php endif; // app('laratrust')->can ?>
            <?php } ?>
            <?php
                if ($transferin == 'true' || $semua == 'true') {?>
                    <th>Tran. In</th>
                    <?php if (app('laratrust')->can('read-hpp')) : ?>
                    <th>Tran. In Amnt</th>
                    <?php endif; // app('laratrust')->can ?>
            <?php } ?>
            <?php
                if ($transferout == 'true' || $semua == 'true') {?>
                    <th>Tran. Out</th>
                    <?php if (app('laratrust')->can('read-hpp')) : ?>
                    <th>Tran. Out Amnt</th>
                    <?php endif; // app('laratrust')->can ?>
            <?php } ?>
            <?php
                if ($adjustment == 'true' || $semua == 'true') {?>
                    <th>Adjust. Stock</th>
                    <?php if (app('laratrust')->can('read-hpp')) : ?>
                    <th>Adjust. Amount</th>
                    <?php endif; // app('laratrust')->can ?>
            <?php } ?>
            <?php
                if ($opname == 'true' || $semua == 'true') {?>
                    <th>Stock Opname</th>
                    <?php if (app('laratrust')->can('read-hpp')) : ?>
                    <th>Amount Opname</th>
                    <?php endif; // app('laratrust')->can ?>
            <?php } ?>
            <?php
                if ($returbeli == 'true' || $semua == 'true') {?>
                    <th>Retur Beli Stock</th>
                    <?php if (app('laratrust')->can('read-hpp')) : ?>
                    <th>Retur Beli Amount</th>
                    <?php endif; // app('laratrust')->can ?>
            <?php } ?>
            <?php
                if ($returjual == 'true' || $semua == 'true') {?>
                    <th>Retur Jual Stock</th>
                    <?php if (app('laratrust')->can('read-hpp')) : ?>
                    <th>Retur Jual Amount</th>
                    <?php endif; // app('laratrust')->can ?>
            <?php } ?>
            <?php
                if ($disassembling == 'true' || $semua == 'true') {?>
                    <th>Disassembling Stock</th>
                    <?php if (app('laratrust')->can('read-hpp')) : ?>
                    <th>Disassembling Amount</th>
                    <?php endif; // app('laratrust')->can ?>
            <?php } ?>
            <?php
                if ($assembling == 'true' || $semua == 'true') {?>
                    <th>Assembling Stock</th>
                    <?php if (app('laratrust')->can('read-hpp')) : ?>
                    <th>Assembling Amount</th>
                    <?php endif; // app('laratrust')->can ?>
            <?php } ?>
            <th>End. Stock</th>
            <?php if (app('laratrust')->can('read-hpp')) : ?>
            <th>End. Amount</th>
            <th>Hpp</th>
            <?php endif; // app('laratrust')->can ?>
            <?php
                if ($lokasi == 'SEMUA') {?>
                    <th>Kode Lokasi</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $monthly; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <?php
                    $d = date_create($item->periode);
                ?>
                <td><?php echo e(date_format($d,'F')); ?></td>
                <td><?php echo e($item->kode_produk); ?></td>
                <td><?php echo e($item->partnumber); ?></td>
                <td><?php echo e($item->begin_stock); ?></td>
                <?php if (app('laratrust')->can('read-hpp')) : ?>
                <td><?php echo e(number_format($item->begin_amount,'2','.',',')); ?></td>
                <?php endif; // app('laratrust')->can ?>
                <?php
                    if ($penerimaan == 'true' || $semua == 'true') {?>  
                        <td><?php echo e($item->in_stock); ?></td>
                        <?php if (app('laratrust')->can('read-hpp')) : ?>
                        <td><?php echo e(number_format($item->in_amount,'2','.',',')); ?></td>
                        <?php endif; // app('laratrust')->can ?>
                <?php } ?>                
                <?php
                    if ($pemakaian == 'true' || $semua == 'true') {?>
                        <td><?php echo e($item->out_stock); ?></td>
                        <?php if (app('laratrust')->can('read-hpp')) : ?>
                        <td><?php echo e(number_format($item->out_amount,'2','.',',')); ?></td>
                        <?php endif; // app('laratrust')->can ?>
                <?php } ?>
                <?php
                    if ($penjualan == 'true' || $semua == 'true') {?>
                        <td><?php echo e($item->sale_stock); ?></td>
                        <?php if (app('laratrust')->can('read-hpp')) : ?>
                        <td><?php echo e(number_format($item->sale_amount,'2','.',',')); ?></td>
                        <?php endif; // app('laratrust')->can ?>
                <?php } ?>
                <?php
                    if ($transferin == 'true' || $semua == 'true') {?>
                        <td><?php echo e($item->trf_in); ?></td>
                        <?php if (app('laratrust')->can('read-hpp')) : ?>
                        <td><?php echo e(number_format($item->trf_in_amount,'2','.',',')); ?></td>
                        <?php endif; // app('laratrust')->can ?>
                <?php } ?>
                <?php
                    if ($transferout == 'true' || $semua == 'true') {?>
                        <td><?php echo e($item->trf_out); ?></td>
                        <?php if (app('laratrust')->can('read-hpp')) : ?>
                        <td><?php echo e(number_format($item->trf_out_amount,'2','.',',')); ?></td>
                        <?php endif; // app('laratrust')->can ?>
                <?php } ?>
                <?php
                    if ($adjustment == 'true' || $semua == 'true') {?>
                        <td><?php echo e($item->adjustment_stock); ?></td>
                        <?php if (app('laratrust')->can('read-hpp')) : ?>
                        <td><?php echo e(number_format($item->adjustment_amount,'2','.',',')); ?></td>
                        <?php endif; // app('laratrust')->can ?>
                <?php } ?>
                <?php
                    if ($opname == 'true' || $semua == 'true') {?>
                        <td><?php echo e($item->stock_opname); ?></td>
                        <?php if (app('laratrust')->can('read-hpp')) : ?>
                        <td><?php echo e(number_format($item->amount_opname,'2','.',',')); ?></td>
                        <?php endif; // app('laratrust')->can ?>
                <?php } ?>
                <?php
                    if ($returbeli == 'true' || $semua == 'true') {?>
                        <td><?php echo e($item->retur_beli_stock); ?></td>
                        <?php if (app('laratrust')->can('read-hpp')) : ?>
                        <td><?php echo e(number_format($item->retur_beli_amount,'2','.',',')); ?></td>
                        <?php endif; // app('laratrust')->can ?>
                <?php } ?>
                <?php
                    if ($returjual == 'true' || $semua == 'true') {?>
                        <td><?php echo e($item->retur_jual_stock); ?></td>
                        <?php if (app('laratrust')->can('read-hpp')) : ?>
                        <td><?php echo e(number_format($item->retur_jual_amount,'2','.',',')); ?></td>
                        <?php endif; // app('laratrust')->can ?>
                <?php } ?>
                <?php
                    if ($disassembling == 'true' || $semua == 'true') {?>
                        <td><?php echo e($item->disassembling_stock); ?></td>
                        <?php if (app('laratrust')->can('read-hpp')) : ?>
                        <td><?php echo e(number_format($item->disassembling_amount,'2','.',',')); ?></td>
                        <?php endif; // app('laratrust')->can ?>
                <?php } ?>
                <?php
                    if ($assembling == 'true' || $semua == 'true') {?>
                        <td><?php echo e($item->assembling_stock); ?></td>
                        <?php if (app('laratrust')->can('read-hpp')) : ?>
                        <td><?php echo e(number_format($item->assembling_amount,'2','.',',')); ?></td>
                        <?php endif; // app('laratrust')->can ?>
                <?php } ?>
                <td><?php echo e($item->ending_stock); ?></td>
                <?php if (app('laratrust')->can('read-hpp')) : ?>
                <td><?php echo e(number_format($item->ending_amount,'2','.',',')); ?></td>
                <td><?php echo e(number_format($item->hpp,'2','.',',')); ?></td>
                <?php endif; // app('laratrust')->can ?>
                <?php
                    if ($lokasi == 'SEMUA') {?>
                        <td><?php echo e($item->kode_lokasi); ?></td>
                <?php } ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>
</html>