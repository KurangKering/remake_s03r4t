<!DOCTYPE html>
<html>
<head>
	<title></title>

	<style type="text/css" >
		body 
		{
			font-family: "Times New Roman";
			width: 800px;
			margin: auto auto;
		}
		p
		{
			text-align: center
		}

		.satu 
		{
			table-layout: fixed;
			border-collapse: collapse;
			width: 100%;
		}
		
		.satu td,
		.satu th {
			border: 1px solid #000;
			padding: 8px;
			
		}

		.dua 
		{
			table-layout: fixed;
			border-collapse: collapse;
			width: 100%;
		}
		
		.dua td,
		.dua th {
			border: 1px solid #000;
			padding: 8px;
			
		}

	</style>
</head>
<body onload="window.print()">
	<div class="print_area">
		<p style="font-weight: bold">PENGADILAN TINGGI PEKANBARU <br> DI PEKANBARU</p>


		<table  class="satu">
			<tr>
				<th colspan="3"><span>LEMBAR DISPOSISI - TUDAL SURAT KELUAR</span></th>
			</tr>
			<tr>
				
				<td width="38%"><span>Indeks</span> &ensp;&ensp;&ensp;&ensp;: <?php echo $data_disposisi[0]['tujuan_id'] ?>
				</td>
				<td width="28%"><span>Tgl</span> &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&nbsp;: <?php echo date('d-m-Y'); ?>
					<br> 
					No. Urut &emsp;: <?php echo $data_disposisi[0]['id_surat_masuk'] ?>
				</td>
				<td style="text-align: center"><span>Kode</span> :  <br>
					OT/HM/KP/KU/KS/PL/HK/PP/PB/PS
				</td>
			</tr>
			<tr>
				<td style="height: 50px;  vertical-align: text-top;" colspan="3">
					<span>Isi Ringkas</span> &ensp;: <?php echo $data_disposisi[0]['perihal'] ?>
				</td>
			</tr>


			<table class="dua">

				<tr>
					<td style="border-top: none">
						<span>Dari</span> &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;: <?php echo $data_disposisi[0]['pengirim'] ?>
					</td>
					<td style="border-top: none">
						<span>Kepada</span> &ensp;&ensp;: <?php echo $data_disposisi[0]['disposisi_tujuan_id'] ?>
					</td>
				</tr>
				<tr>
					<td style="border-top: none">
						<span>Tanggal</span> &ensp;&ensp;&ensp;&nbsp;: <?php echo $data_disposisi[0]['tgl_masuk'] ?>
					</td>
					<td style="border-top: none">
						<span>No. Surat</span> &nbsp;: <?php echo $data_disposisi[0]['no_lembar_disposisi'] ?>
					</td>
				</tr>
				<tr>
					<td style="padding-bottom: 0px; text-align: center; border-bottom: none; " colspan="2">
						<span style="font-weight: bold; text-decoration: underline">INSTRUKSI / INFORMASI</span>
					</td>

				</tr>
				<tr>
					<td style="border-top: none; border-bottom: none; vertical-align: text-top; text-align: center">
						<span style="font-size: 14px; font-weight: bold; text-decoration: underline">KETUA PENGADILAN TINGGI PEKANBARU</span>
					</td>
					<td style="border-top: none; border-bottom: none; vertical-align: text-top; text-align: center">
						<span style="font-size: 14px; font-weight: bold; text-decoration: underline">PANITERA / SEKRETARIS</span>

					</td>
					
				</tr>
				<div>
					

					<tr >
					<td rowspan="2" style="height: 200px; border-top: none; vertical-align: text-top; text-align: center; ">
							<span style="font-size: 14px; "><?php echo $isi_satu?></span>
						</td>
						<td style="border-top: none; height: 100px; vertical-align: text-top; text-align: center">
							<span style="font-size: 14px;  "><?php echo $isi_dua ?></span>

						</td>

					</tr>
					<tr>
						<td style="border-top: none; height: 100px; vertical-align: text-top; text-align: center">
							<span style="font-size: 14px; "><?php echo $isi_tiga ?></span>

						</td>

					</tr>
				</div>
				<tr>
					<td><span>Paraf</span> : </td>
					<td><span>Catatan</span> : <?php echo $data_disposisi[0]['catatan_tambahan'] ?></td>
					
				</tr>
			</table>

		</table>
	</div>
</body>
</html>