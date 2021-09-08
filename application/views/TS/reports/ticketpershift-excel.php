<html>
	<head>
		<?php
		header("Content-Type: application/vnd.ms-excel; charset=utf-8");
		header("Content-Disposition: attachment;filename=Laporan-Tiket-Per-Shift-".$uridate1."-".$uridate2.".xls");
		header("Cache-Control: private",false);
		?>
	</head>
	<body>
		<div class="container">
		<div class="jumbotron">
		<h3>Laporan Tiket berdasarkan Shift <?php echo $uridate1?> - <?php echo $uridate2?></h3>
		</div>
		<div class="row">
			<table id="rpt" class="table">
				<thead>
                <tr>
                    <td rowspan=2>Kegiatan</td>
                    <?php foreach ($period as $dt) {?>
                        <td colspan=3> <?php echo $dt->format('d/m/Y');?></td>
                    <?php }?>
                    <th colspan=3>Total</th>
                    </tr>
                    <tr>
                    <?php foreach ($period as $dt) { ?>
                    <td>Shift1</td><td>Shift2</td><td>Shift3</td>
                    <?php }?>
                    <th>Shift1</th><th>Shift2</th><th>Shift3</th>
                </tr>
				</thead>
				<tbody>
                <tr>
            <td>Komplain</td>
            <?php 
					$shift1 = 0;$shift2 = 0;$shift3 = 0;
					?>
					<?php foreach ($period as $dt) { ?>
						<?php 
							$shift1+=  $this->pticket->getshiftticketcount('1',$dt);
							$shift2+=  $this->pticket->getshiftticketcount('2',$dt);
							$shift3+=  $this->pticket->getshiftticketcount('3',$dt);
						?>
                <td>
                <?php echo $this->pticket->getshiftticketcount('1',$dt);?>
                </td>
                <td>
                <?php echo $this->pticket->getshiftticketcount('2',$dt);?>
                </td>
                <td>
                <?php echo $this->pticket->getshiftticketcount('3',$dt);?>
                </td>
                <?php }?>
					<th>
					<?php
						echo $shift1;
					?>
					</th>
					<th>
					<?php
						echo $shift2;
					?>
					</th>
					<th>
					<?php
						echo $shift3;
					?>
					</th>
            </tr>
            <tr>
            <td>Follow Up</td>
            <?php 
				$shift1 = 0;$shift2 = 0;$shift3 = 0;
			?>
					<?php foreach ($period as $dt) { ?>
						<?php 
							$shift1+=  $this->pticket->getshiftfucount('1',$dt);
							$shift2+=  $this->pticket->getshiftfucount('2',$dt);
							$shift3+=  $this->pticket->getshiftfucount('3',$dt);
						?>
                <td>
                <?php echo $this->pticket->getshiftfucount('1',$dt);?>
                </td>
                <td>
                <?php echo $this->pticket->getshiftfucount('2',$dt);?>
                </td>
                <td>
                <?php echo $this->pticket->getshiftfucount('3',$dt);?>
                </td>
                <?php }?>
					<th>
					<?php
						echo $shift1;
					?>
					</th>
					<th>
					<?php
						echo $shift2;
					?>
					</th>
					<th>
					<?php
						echo $shift3;
					?>
					</th>
            </tr>
				</tbody>
			</table>
		</div>
		</div>
	</body>
</html>