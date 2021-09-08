<html>
	<head>
		<?php
		header("Content-Type: application/vnd.ms-excel; charset=utf-8");
		header("Content-Disposition: attachment;filename=Laporan-MainRootCause-TS.xls");
		header("Cache-Control: private",false);
		?>
	</head>
	<body>
    <table id="rpt" class="table">
				<thead>
				<tr>
				<th>No</th><th>Kd Ticket</th><th>Nama</th><th>Sub Root Cause</th><th>Follow Ups</th>
				</tr>
				</thead>
				<tbody>					
					<?php $c=0;?>
					<?php $tempheader = ''?>
					<?php foreach($tickets as $ticket){?>
						<?php $c++;?>
						<?php if($tempheader != $ticket->mainrootcause){?>
						<tr><th colspan=5><?php echo $ticket->mainrootcause;?></th></tr>
						<?php }?>
						<?php $tempheader = $ticket->mainrootcause ;?>
                        <tr trid="<?php echo $ticket->kdticket;?>">
                            <th><?php echo $c;?>.</th>
                            <td>
                            <span class="causedetail"><?php echo $ticket->kdticket;?></span>
                            </td>
                            <td>
							<span class="causedetail"><?php echo $ticket->name;?></span>
                            </td>
                            <td>
                            <span class="causedetail"><?php echo $ticket->subrootcause;?></span>
                            </td>
                            <td>
								<table>
								<thead>
								<tr>
								<th>Action</th><th>Kesimpulan</th>
								</tr>
								</thead>
	                            <?php foreach(getfus($ticket->id) as $fu){?>
								<tr>
									<td><?php echo $fu->description;?></td>
									<td><?php echo $fu->conclusion;?></td>
								</tr>
								<?php }?>
								</table>
                            </td>
                        </tr>
					<?php }?>
				</tbody>
			</table>
	</body>
</html>
