		<script type="text/javascript">
                $('#sem').hide();
                var bulan1='';
                var tahun1='';
                var summary='';
                $(document).ready(function()
                {
			summary = $('#jns_summary').val();
                        setexcutive();
                        
	        
                });



                function setlaporanqbulan()
                {
                    //bulan= document.getElementById('laporandiagnosabulan');
                    bulan1 = $('#laporanqbulan').val();
                    $('#isi_summary').load("<?php base_url()?>laporan/executive/"+summary+"?bulan="+bulan1+"&tahun="+tahun1);
                }

                function setlaporanqtahun()
                {
                     tahun1 = $('#laporanqtahun').val();
                      $('#isi_summary').load("<?php base_url()?>laporan/executive/"+summary+"?bulan="+bulan1+"&tahun="+tahun1);
               
                }

                function setexcutive()
                {
                     summary = $('#jns_summary').val();
                     //$('#isi_summary').load("<?php base_url()?>laporan/executive/"+summary);
                     $('#isi_summary').load("<?php base_url()?>laporan/executive/"+summary+"?bulan="+bulan1+"&tahun="+tahun1);
                     return false;
                }


		</script>
<form>
    <table border="0">
        <tr>
            
            <td width="200">
                Bulan :
                <select id="laporanqbulan" onchange="setlaporanqbulan();">
                    <option value="" selected>Pilih Bulan</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </td>
            <td width="200">
                Tahun :
                <select id="laporanqtahun" onchange="setlaporanqtahun();">
                    <option value='' selected> - </option>
                    <?php
                    $tahun=date('Y');
                    for($i=2011;$i<=$tahun;$i++)
                    {?>
		     <option value="<?php echo $i;?>">
                     <?php	echo $i; ?></option>

		    <?php
		     }
                    ?>
                </select>
            </td>
            <td width="200">
                Jenis Summary :
                <select id="jns_summary" onchange="setexcutive();">
                    <option value="dokter_keluarga">Dokter Keluarga</option>
                    <option value="potret_kunjungan">Biaya Potret Kunjungan</option>
                    <option selected value="penyakit_obat">10 Penyakit Terbanyak dan Obat Terbanyak</option>
                    <option value="rincian_rirj">Rincian Rawat Indap dan Rawat Jalan</option>
                    <option value="post_biaya">Post Biaya</option>
                    <option value="ad_biaya">Hasil Audit dan Distribusi Biaya</option>
                    <option value="biaya_perjabatan">Biaya Terbesar Perjabatan</option>
                    <option value="kesehatan_tahunan">Biaya Kesehatan Tahunan</option>
                </select>
            </td>
            
            
        </tr>
    </table>
    
</form>
<div id="isi_summary" style="width: auto;overflow: auto">
</div>

