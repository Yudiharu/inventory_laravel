<!DOCTYPE html>
<html lang="en">
<head>
	<style> 
        
     @page  {
            border: solid 1px #0b93d5;

        }

        .title {
            margin-top: 0.5cm;
        }
        .title h1 {
            text-align: left;
            font-size: 14pt;
            
        }
        

        .header {
            margin-left: 50px;
            margin-right: 0px;
            /*font-size: 10pt;*/
            padding-top: 10px;
            /*border: solid 1px #0b93d5;*/
        }

        .left {
            float: left;
        }

        .right {
            float: right;
        }

        .clearfix {
            overflow: auto;
        }

        .content {
                margin-left: 10px;
            padding-top: 10px
        }
        .catatan {
            font-size: 10pt;
        }

        footer {
                position: fixed; 
                top: 19cm; 
                left: 0cm; 
                right: 0cm;
                height: 2cm;
            }

        /* Table desain*/
        table.grid {
            width: 100%;
        }
</style>
</head>
<body>

	<table class="table_content" style="margin-bottom: 25px;width: 100%;">
        <thead>
        <tr class="border" style="background-color: #e6f2ff">
            <th class="border" width="">NO</th>
            <th class="border" width="">No Transaksi</th>
            <th class="border" width="">Tanggal Transaksi</th>
            <th class="border" width="">Status</th>
            <th class="border" width="">Nopol</th>
            <th class="border" width="">No Aset Mobil</th>
            <th class="border" width="">Nma Alat</th>
            <th class="border" width="">No Aset Alat</th>
            <th class="border" width="">Kode Produk</th>
            <th class="border" width="">Nama Produk</th>
            <th class="border"  width="">Serial Number</th>
            <th class="border"  width="">Kode Satuan</th>
            <th class="border"  width="">Qty</th>
            <?php if (app('laratrust')->can('read-hpp')) : ?>
            <th class="border" width="">Harga</th>
            <th class="border" width="">Subtotal</th>
            <?php endif; // app('laratrust')->can ?>
            <?php if (app('laratrust')->can('read-excelharga')) : ?>
            <th class="border" width="">Harga</th>
            <th class="border" width="">Subtotal</th>
            <?php endif; // app('laratrust')->can ?>
            <th class="border" width="">Kode Lokasi</th>
        </tr>
        </thead>

        <?php foreach ($data as $key => $row) : ?>
        <tbody>

        ?>

            <tr class="border">
                <td class="border"><?php echo $key+1 ?></td>
                <td class="border" align="left"><?php echo $row->no_pemakaianban?></td>
                <td class="border" align="left"><?php echo $row->tanggal_pemakaianban?></td>
                <td class="border" align="left"><?php echo $row->status?></td>
                <td class="border" align="left"><?php echo $row->nopol?></td>
                <td class="border" align="left"><?php echo $row->no_asset_mobil?></td>
                <td class="border" align="left"><?php echo $row->nama_alat?></td>
                <td class="border" align="left"><?php echo $row->no_asset_alat?></td>
                <td class="border" align="left"><?php echo $row->kode_produk?></td>
                <td class="border" align="left"><?php echo $row->nama_produk?></td>
                <td class="border" align="left"><?php echo "'".$row->partnumberbaru ?></td>
                <td class="border" align="center"><?php echo $row->kode_satuan?></td>
                <td class="border" align="center"><?php echo $row->qty?></td>
                <?php if (app('laratrust')->can('read-hpp')) : ?>
                <td class="border" align="right"><?php echo $row->harga ?></td>
                <td class="border" align="right"><?php echo $total = $row->harga * $row->qty ?></td>
                <?php endif; // app('laratrust')->can ?>
                <?php if (app('laratrust')->can('read-excelharga')) : ?>
                <td class="border" align="right"><?php echo $row->harga ?></td>
                <td class="border" align="right"><?php echo $total = $row->harga * $row->qty ?></td>
                <?php endif; // app('laratrust')->can ?>
                <td class="border" align="center"><?php echo $row->kode_lokasi?></td>
            </tr>

            <?php
            $subqty = 0;
            $subtotal = 0;
            $subqty += (float) $row->qty;
            $subtotal += $row->harga * $row->qty;

            //$grandtotalqty += $subqty;
            //$grandtotaljumlah += $subtotal;
            ?>

        </tbody>
        <?php endforeach; ?>

        <tfoot>
        
        </tfoot>

    </table>
<hr>
</body>
</html>