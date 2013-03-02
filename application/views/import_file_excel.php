<html>
<head>
</head>
<body>
   
 
  Contoh untuk import excel
  <?php echo form_open('impor/read_file');
        echo form_fieldset('IMPORT FILE '); ?>
  <table>
    <tr> 
      <td>Upload file (*.xls) : </td> 
      <td><input name="userfile" method="post" type="file"></td>
      <td><input name="upload" type="submit" value="import"></td>
    </tr>
  </table>
  <?php echo form_fieldset_close();
        echo form_close();?>
</body>
</html>