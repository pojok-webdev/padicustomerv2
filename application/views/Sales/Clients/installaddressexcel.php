<html>
	<head>
		<?php
		header("Content-Type: application/vnd.ms-excel; charset=utf-8");
		header("Content-Disposition: attachment;filename=".$filename."".".xls");
		header("Cache-Control: private",false);
		?>
	</head>
	<body>
		<table>
			<thead>
				<tr><th colspan=6><?php echo $subject;?></th></tr>
                <tr>
                   <th>No</th>
                   <th>ID</th>
                   <th>Nama</th>
                   <th>Alias</th>
                   <th>Alamat</th>
                   <th>Email SUpport</th>
                </tr>
			</thead>
			<tbody>
                <?php $c=0;?>
                <?php foreach($objs as $obj){?>
                <?php $c++;?>
                <tr>
                    <td><?php echo $c;?></td>
                    <td><?php echo $obj->id;?></td>
                    <td><?php echo $obj->name;?></td>
                    <td><?php echo $obj->alias;?></td>
                    <td><?php echo $obj->address;?></td>
                    <td><?php echo $obj->email;?></td>
                </tr>
                <?php }?>
			</tbody>
		</table>
	</body>
</html>

