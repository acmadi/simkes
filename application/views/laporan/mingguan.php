<script type="text/javascript">
    var tanggal1=null;
    var tanggal2=null;
    $( "#laporanmingguantanggal1" ).datepicker({
                //dateFormat  : "dd MM yy",
                changeMonth: true,
                changeYear: true,
                showOn: "button",
                buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",
                buttonImageOnly : true
                });
      $( "#laporanmingguantanggal2" ).datepicker({
                //dateFormat  : "dd MM yy",
                changeMonth: true,
                changeYear: true,
                showOn: "button",
                buttonImage : "<?php echo base_url();?>asset/images/calendar.gif",
                buttonImageOnly : true
                });
      $(".button").button();
      function ekspormingguan()
      {
          if ($('#laporanmingguantanggal1').val() == '') {
                alert('Tanggal harus di isi');
                $('#laporanmingguantanggal1').focus();

                return false;
          }
          if ($('#laporanmingguantanggal2').val() == '') {
                alert('Tanggal harus di isi');
                $('#laporanmingguantanggal2').focus();
                return false;
          }
          tanggal1 = $('#laporanmingguantanggal1').val();
          tanggal2 = $('#laporanmingguantanggal2').val();
          
      }

</script>

        <form id="sheet" method="post" action="<?php echo base_url() ?>index.php/laporan/mingguan/laporanmingguan">
            <table>
            <tr>
            <td>Dari Tanggal</td>
            <td>:</td>
            <td><input type="text" id="laporanmingguantanggal1" name="tanggal1" /></td>
            </tr>
            <tr>
            <td>Sampai Tanggal</td>
            <td>:</td>
            <td><input type="text" id="laporanmingguantanggal2" name="tanggal2" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            <!--<td><input type="submit" value="export" /></td>
            -->
            <td><input type="submit" value="export" class="button" onclick="ekspormingguan();"/></td>

            </tr>
            </table>
        </form>
   
