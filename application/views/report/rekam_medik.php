<head>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/css/bootstrap.css">
	<title>Cetak Data Rekam Medik</title>
</head>
<body>
	<h5 class="text-center text-uppercase">REKAM MEDIK <?=$perawatan['status_perawatan']?></h5>
	<h5 class="text-center">RUMAH SAKIT CUT MEUTIA</h5>
	<hr>
	<br>
	<table>
		<tr>
			<th width="200px">Nama Pasien</th>
			<td width="320px">: <?=$perawatan['nama_pasien']?></td>
			<th width="200px">Kode Pasien</th>
			<td>: <?=$perawatan['kode_pasien']?></td>
		</tr>
		<tr>
			<th width="200px">Tempat/Tanggal Lahir</th>
			<td>: <?=$perawatan['ttl'] ?> </td>
		</tr>
		<tr>
			<th width="200px">Usia</th>
			<td>: <?=$perawatan['usia'] ?> Tahun</td>
		</tr>
		<tr>
			<th width="200px">Jenis Kelamin</th>
			<td>: <?=$perawatan['jk']?></td>
		</tr>
		<tr>
			<th width="200px">Status Pernikahan</th>
			<td>: <?=$perawatan['status']?></td>
		</tr>
		<tr>
			<th width="200px">Pekerjaan</th>
			<td>: <?=$perawatan['pekerjaan']?></td>
		</tr>
	</table>
	<hr>
	<table>
		<tr>
			<th width="200px">Dokter yang menangani</th>
			<td width="320px">: <?=$perawatan['nama_dokter']?></td>
			<th width="200px">Diagnosa</th>
			<td>: <?=$perawatan['diagnosa']?></td>
		</tr>
		<tr>
			<th width="200px">Spesialis / Klinik</th>
			<td width="320px">: <?=$perawatan['spesialisasi']." / ".$perawatan['klinik'] ?></td>
			<th width="200px">Cara Masuk</th>
			<td>: <?=$perawatan['cara_masuk']?></td>
		</tr>
		<tr>
			<td colspan="2" width="520px"></td>
			<th width="200px">Cara Keluar</th>
			<td>: <?=$perawatan['cara_keluar']?></td>
		</tr>
		<tr>
			<td colspan="2" width="520px"></td>
			<th width="200px">Keadaan Saat Keluar</th>
			<td>: <?=$perawatan['keadaan']?></td>
		</tr>
	</table>
	<hr>
	<table>
		<tr>
			<th width="200px">Lama Perawatan</th>
			<td width="320px">: <?=$perawatan['lama_perawatan']?></td>
			<th width="200px">Penanggung Jawab</th>
			<td>: <?=$perawatan['pj']?></td>
		</tr>	
		<tr>
			<th width="200px">T otal Biaya Perawatan</th>
			<td width="320px">: Rp. <?=$perawatan['total_biaya']?></td>
		</tr>
	</table>
	<br>
	<table border="1px">
		<tr bgcolor="yellow">
			<th width="100px" class="text-center">No</th>
			<th width="400px" class="text-center">Tanggal Perawatan</th>
			<th width="470px" class="text-center">Kondisi Pasien</th>
		</tr>
		<?php $no =1; foreach ($perawatan['harian'] as $key => $value): ?>
			<tr>
				<td class="text-center"><?=$no?></td>
				<td class="text-center"><?=$value['tanggal']?></td>
				<td><?=$value['kondisi']?></td>
			</tr>
			<tr>
				<th colspan="2" class="text-center" bgcolor="yellow">Obat Yang Digunakan</th>
				<td style="text-align: right">
				<?php if (isset($perawatan['harian'][$key]['obat'])) : ?>
				<?php foreach ($perawatan['harian'][$key]['obat'] as $key => $value2): ?>
					<?=$value2['obat']. ", "?>
				<?php endforeach ?>
				<?php endif ?>
				</td>
			</tr>
		<?php $no++; endforeach; ?>
	</table>
	<?php foreach ($perawatan['harian'] as $key => $value): ?>
	<?php endforeach ?>
</body>