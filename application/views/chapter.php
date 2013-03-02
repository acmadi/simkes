<html>
<head>
</head>
<body>
<?php  echo form_open_multipart('chapter') . "\n"; ?>
<table>
  <tr>
  <td><input type="file" id="file_upload" name="fileupload" size="20" /></td>
  
  </tr>
   <tr>
   <td>&nbsp;</td>
   <td valign="top" >
   <?php echo form_submit('submit', 'Upload'); ?></td>
 </tr>
</table>
<?php echo form_close(); ?>
<?php
if ($this->session->flashdata('msg_excel')){
?>
<div class="msg"><?php echo $this->session->flashdata('msg_excel'); ?></div>
<?php } ?></body>
</html>