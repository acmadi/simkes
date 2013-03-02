<html>
    <head>

<script src="<?php echo base_url();?>asset/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>asset/js/jquery-ui-1.8.2.custom.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>asset/js/jquery.layout.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>asset/js/i18n/grid.locale-en.js" type="text/javascript"></script>

        <script type="text/javascript">
         function tesajax()
       {
           $.ajax(
            {
                url : "<?php echo base_url() ?>index.php/master/user/tesajax",
               data : "oper=add",
                type: "post",
                datatype: "json",
             success: function(data)
                    {
                    alert ("Data udah dikirim");
                    alert(data.pesan);
                    //$('#listuser').trigger('reloadGrid'); //Triger Untuk Reload List JQGrid
                    //$('#u').hide();
                    //$("#wil").html(data);
                    },
               error: function(e)
                    {
                   alert("Data belum Diambil");
                    }
            }
            );
       }
        </script>
    </head>
    <body>
    <div>
    <form>
        <input type="submit" value="tes" onclick="tesajax();">
    </form>
     </div>
    </body>
</html>
