<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Monthly Stock <?php echo e($request); ?> - <?php echo e($req); ?> </title>

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

    <div class="title">
    <h1>Monthly Stock <?php echo e($request); ?> - <?php echo e($req); ?> </h1>
    </div>
  <hr>
	<table rules="rows" class="grid" style="font-size: 10pt; vertical-align: top; width: 27cm" border="1">
			 <thead>
		<tr>
			<th>Periode</th>
			<th>Kode Produk</th>
			<th>Begin Stock</th>
			<th>Begin Amount</th>
            <th>In Stock</th>
			<th>In Amount</th>
            <th>Out Stock</th>
            <th>Out Amount</th>
            <th>Adjustment Stock</th>
            <th>Adjustment Amount</th>
            <th>Stock Opname</th>
            <th>Amount Opname</th>
            <th>Ending Stock</th>
            <th>Ending Amount</th>
		</tr>
		
	</thead>
	<tbody>
		<?php $__currentLoopData = $opnamedetail_cetak; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><?php echo e($item->periode); ?></td>
				<td><?php echo e($item->produk->nama_produk); ?></td>
                <td><?php echo e($item->begin_stock); ?></td>
                <td><?php echo e($item->begin_amount); ?></td>
                <td><?php echo e($item->in_stock); ?></td>
                <td><?php echo e($item->in_amount); ?></td>
                <td><?php echo e($item->out_stock); ?></td>
                <td><?php echo e($item->out_amount); ?></td>
                <td><?php echo e($item->adjustment_stock); ?></td>
                <td><?php echo e($item->adjustment_amount); ?></td>
                <td><?php echo e($item->stock_opname); ?></td>
                <td><?php echo e($item->amount_opname); ?></td>
                <td><?php echo e($item->ending_stock); ?></td>
				<td><?php echo e($item->ending_amount); ?></td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
<hr>
</body>
</html>