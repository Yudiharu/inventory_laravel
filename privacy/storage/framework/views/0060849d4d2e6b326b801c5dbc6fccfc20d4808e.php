<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <title>LAPORAN DATA PRODUK</title>
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
                    <h1>LAPORAN PRODUK KATEGORI <?php echo $kategori; ?></h1>
            <?php } 
                else{?>
                    <h1>LAPORAN PRODUK</h1>
            <?php } ?>
    </div>


    <table class="grid1" style="margin-bottom: 25px;width: 100%; font-size: 11px">
    <thead>
        <tr style="background-color: #e6f2ff">
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Part Number</th>
            <?php
                if ($kategori == 'SEMUA') {?>
                    <th>Kode Kategori</th>
            <?php } ?>
            <th>Kode Satuan</th>
            <th>Stock</th>
            <?php
                if ($lokasi == 'SEMUA') {?>
                    <th>Kode Lokasi</th>
            <?php } ?>
        </tr>
    </thead>

    <tbody>
        <?php $__currentLoopData = $monthly; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($item->kode_produk); ?></td>
                <td><?php echo e($item->nama_produk); ?></td>
                <td><?php echo e($item->partnumber); ?></td>
                <?php
                    if ($kategori == 'SEMUA') {?>
                        <td><?php echo e($item->kode_kategori); ?></td>
                <?php } ?>
                <td><?php echo e($item->kode_satuan); ?></td>
                <td><?php echo e($item->ending_stock); ?></td>
                <?php
                    if ($lokasi == 'SEMUA') {?>
                        <td><?php echo e($item->kode_lokasi); ?></td>
                <?php } ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
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