<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    <meta charset="utf-8" />
    <title>LAPORAN TRANSAKSI <?php echo e($nama); ?></title>
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

    <h1>LAPORAN TRANSAKSI <?php echo e($nama); ?></h1>
    <p>Periode: <?php echo ($tanggal_awal);?> s/d <?php echo ($tanggal_akhir);?></p>
    <br>
	<table class="grid1" style="margin-bottom: 25px;width: 100%; font-size: 10px">
			 <thead>
		<tr style="background-color: #e6f2ff">
			<th>Tanggal Transaksi</th>
            <th>No Transaksi</th>
            <th>Kode Produk</th>
            <th>Nama Produk</th>
			<th>Qty Transaksi</th>
            <th>Satuan</th>
            <?php if (app('laratrust')->can('read-hpp')) : ?>
            <th>Harga Transaksi</th>
			<th>Total Transaksi</th>
			<?php endif; // app('laratrust')->can ?>
            <?php
                if ($lokasi == 'SEMUA') {?>
                    <th>Kode Lokasi</th>
            <?php } ?>
		</tr>
	</thead>
	<tbody>
		<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><?php echo e($item->tanggal_transaksi); ?></td>
                <td><?php echo e($item->no_transaksi); ?></td>
                <td><?php echo e($item->kode_produk); ?></td>
                <td><?php echo e($item->produk->nama_produk); ?></td>
                <td><?php echo e($item->qty_transaksi); ?></td>
                <td><?php echo e($item->produk->kode_satuan); ?></td>
                <?php if (app('laratrust')->can('read-hpp')) : ?>
                <td><?php echo e(number_format($item->harga_transaksi,'2','.',',')); ?></td>
                <td><?php echo e(number_format($item->total_transaksi,'2','.',',')); ?></td>
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