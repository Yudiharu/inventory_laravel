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
            <th>Kode Mobil</th>
            <th>Nopol</th>
            <th>No Asset Mobil</th>
            <th>Kode Lokasi</th>
            <th>Tahun</th>
            <th>Terakhir diubah</th>
            <th>Diubah Oleh</th>
            <th>Status Mobil</th>
        </tr>
    </thead>

    <tbody>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($item->kode_mobil); ?></td>
                <td><?php echo e($item->nopol); ?></td>
                <td><?php echo e($item->no_asset_mobil); ?></td>
                <td><?php echo e($item->kode_lokasi); ?></td>
                <td><?php echo e($item->tahun); ?></td>
                <td><?php echo e($item->updated_at); ?></td>
                <td><?php echo e($item->updated_by); ?></td>
                <td><?php echo e($item->status_mobil); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<hr>
</body>
</html>