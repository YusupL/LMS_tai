<?php

$arp = `arp -a`;
$lines=explode("\n", $arp);
$devices=array();
foreach($lines as $line){
	//echo $arp[0];
	$cols=preg_split('/\s+/', trim($line));
	if (isset($cols[2]) && $cols[2]=='dynamic'){
		$temp=array();
		$temp['ip']=$cols[0];
		$temp['mac']=$cols[1];
		$devices[]=$temp;
	}
}
?>
<div style='margin-top: 50px;'>
	<table>
		<thead>
			<tr>
				<th>IP</th>
				<th>MAC adress</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($devices as $device) {?>
				<tr>
					<td><?php echo $device['ip']; ?></td>
					<td><?php echo $device['mac']; ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>