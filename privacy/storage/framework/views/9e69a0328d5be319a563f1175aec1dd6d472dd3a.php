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

    <table rules="rows" class="grid" style="font-size: 10pt; vertical-align: top; width: 27cm" border="1">
             <thead>
        <tr>
            <th>Periode</th>
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Part Number</th>
            <th>Kategori</th>
            <th>Begin Stock</th>
            <?php if (app('laratrust')->can('read-hpp')) : ?>
            <th>Begin Amount</th>
            <?php endif; // app('laratrust')->can ?>
            <th>In Stock</th>
            <?php if (app('laratrust')->can('read-hpp')) : ?>
            <th>In Amount</th>
            <?php endif; // app('laratrust')->can ?>
            <th>Out Stock</th>
            <?php if (app('laratrust')->can('read-hpp')) : ?>
            <th>Out Amount</th>
            <?php endif; // app('laratrust')->can ?>
            <th>Sale Stock</th>
            <?php if (app('laratrust')->can('read-hpp')) : ?>
            <th>Sale Amount</th>
            <?php endif; // app('laratrust')->can ?>
            <th>Transfer In Stock</th>
            <?php if (app('laratrust')->can('read-hpp')) : ?>
            <th>Transfer In Amount</th>
            <?php endif; // app('laratrust')->can ?>
            <th>Transfer Out Stock</th>
            <?php if (app('laratrust')->can('read-hpp')) : ?>
            <th>Transfer Out Amount</th>
            <?php endif; // app('laratrust')->can ?>
            <th>Adjustment Stock</th>
            <?php if (app('laratrust')->can('read-hpp')) : ?>
            <th>Adjustment Amount</th>
            <?php endif; // app('laratrust')->can ?>
            <th>Stock Opname</th>
            <?php if (app('laratrust')->can('read-hpp')) : ?>
            <th>Amount Opname</th>
            <?php endif; // app('laratrust')->can ?>
            <th>Retur Beli Stock</th>
            <?php if (app('laratrust')->can('read-hpp')) : ?>
            <th>Retur Beli Amount</th>
            <?php endif; // app('laratrust')->can ?>
            <th>Retur Jual Stock</th>
            <?php if (app('laratrust')->can('read-hpp')) : ?>
            <th>Retur Jual Amount</th>
            <?php endif; // app('laratrust')->can ?>
            <th>Disassembling Stock</th>
            <?php if (app('laratrust')->can('read-hpp')) : ?>
            <th>Disassembling Amount</th>
            <?php endif; // app('laratrust')->can ?>
            <th>Assembling Stock</th>
            <?php if (app('laratrust')->can('read-hpp')) : ?>
            <th>Assembling Amount</th>
            <?php endif; // app('laratrust')->can ?>
            <th>Ending Stock</th>
            <?php if (app('laratrust')->can('read-hpp')) : ?>
            <th>Ending Amount</th>
            <th>Hpp</th>
            <?php endif; // app('laratrust')->can ?>
            <th>Kode Lokasi</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($item->periode); ?></td>
                <td><?php echo e($item->kode_produk); ?></td>
                <td><?php echo e($item->produk->nama_produk); ?></td>
                <td><?php echo e($item->partnumber); ?></td>
                <td><?php echo e($item->produk->kode_kategori); ?></td>
                <td><?php echo e($item->begin_stock); ?></td>
                <?php if (app('laratrust')->can('read-hpp')) : ?>
                <td><?php echo e($item->begin_amount); ?></td>
                <?php endif; // app('laratrust')->can ?>
                <td><?php echo e($item->in_stock); ?></td>
                <?php if (app('laratrust')->can('read-hpp')) : ?>
                <td><?php echo e($item->in_amount); ?></td>
                <?php endif; // app('laratrust')->can ?>
                <td><?php echo e($item->out_stock); ?></td>
                <?php if (app('laratrust')->can('read-hpp')) : ?>
                <td><?php echo e($item->out_amount); ?></td>
                <?php endif; // app('laratrust')->can ?>
                <td><?php echo e($item->sale_stock); ?></td>
                <?php if (app('laratrust')->can('read-hpp')) : ?>
                <td><?php echo e($item->sale_amount); ?></td>
                <?php endif; // app('laratrust')->can ?>
                <td><?php echo e($item->trf_in); ?></td>
                <?php if (app('laratrust')->can('read-hpp')) : ?>
                <td><?php echo e($item->trf_in_amount); ?></td>
                <?php endif; // app('laratrust')->can ?>
                <td><?php echo e($item->trf_out); ?></td>
                <?php if (app('laratrust')->can('read-hpp')) : ?>
                <td><?php echo e($item->trf_out_amount); ?></td>
                <?php endif; // app('laratrust')->can ?>
                <td><?php echo e($item->adjustment_stock); ?></td>
                <?php if (app('laratrust')->can('read-hpp')) : ?>
                <td><?php echo e($item->adjustment_amount); ?></td>
                <?php endif; // app('laratrust')->can ?>
                <td><?php echo e($item->stock_opname); ?></td>
                <?php if (app('laratrust')->can('read-hpp')) : ?>
                <td><?php echo e($item->amount_opname); ?></td>
                <?php endif; // app('laratrust')->can ?>
                <td><?php echo e($item->retur_beli_stock); ?></td>
                <?php if (app('laratrust')->can('read-hpp')) : ?>
                <td><?php echo e($item->retur_beli_amount); ?></td>
                <?php endif; // app('laratrust')->can ?>
                <td><?php echo e($item->retur_jual_stock); ?></td>
                <?php if (app('laratrust')->can('read-hpp')) : ?>
                <td><?php echo e($item->retur_jual_amount); ?></td>
                <?php endif; // app('laratrust')->can ?>
                <td><?php echo e($item->disassembling_stock); ?></td>
                <?php if (app('laratrust')->can('read-hpp')) : ?>
                <td><?php echo e($item->disassembling_amount); ?></td>
                <?php endif; // app('laratrust')->can ?>
                <td><?php echo e($item->assembling_stock); ?></td>
                <?php if (app('laratrust')->can('read-hpp')) : ?>
                <td><?php echo e($item->assembling_amount); ?></td>
                <?php endif; // app('laratrust')->can ?>
                <td><?php echo e($item->ending_stock); ?></td>
                <?php if (app('laratrust')->can('read-hpp')) : ?>
                <td><?php echo e($item->ending_amount); ?></td>
                <td><?php echo e($item->hpp); ?></td>
                <?php endif; // app('laratrust')->can ?>
                <td><?php echo e($item->kode_lokasi); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<hr>
</body>
</html>