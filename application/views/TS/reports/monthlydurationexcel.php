<html>
	<head>
		<?php
		header("Content-Type: application/vnd.ms-excel; charset=utf-8");
		header("Content-Disposition: attachment;filename=Laporan-Bulanan-TS-".$datenospace.".xls");
		header("Cache-Control: private",false);
		?>
	</head>
	<body>
		<table>
			<thead>
			<tr>
				<th rowspan=2>No</th><th rowspan=2>Kd Ticket</th><th rowspan=2>Nama</th><th rowspan=2>Start</th><th rowspan=2>End</th><th colspan=3>Durasi</th>
			</tr>
			<tr>
			<th>Hari</th><th>Jam</th><th>Menit</th>
			</tr>
			</thead>
			<tbody>
				<?php $c=0;?>
				<?php foreach($objs['res'] as $obj){?>
					<?php $c++;?>
				<tr>
					<th><?php echo $c;?>.</th>
					<td><?php echo $obj->kdticket;?></td>
						<td>
							<?php echo $obj->clientname;?>
						</td>
						<td><?php echo $this->common->sql_to_human_datetime($obj->ticketstart);?></td>
						<td><?php echo $this->common->sql_to_human_datetime($obj->ticketend);?></td>
						<td>
							<?php echo $obj->day;?>
						</td>
						<td>
							<?php echo $obj->hour;?>
						</td>
						<td>
							<?php echo $obj->minute;?>
						</td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</body>
</html>
