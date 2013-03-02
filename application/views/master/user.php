		<script type="text/javascript">
			$(document).ready(function()
			{   $("#usersave").button();
		            $("#userreset").button();


                            $('#formadduser').dialog({
                                        autoOpen:false,
                                        title:"Add User",
                                        resizable:false,
                                        width:400,
                                        show: 'drop',
                                        hide: 'scale',
                                        modal:true
                                        }
                                        );
                           	var grid = $("#listuser");
				grid.jqGrid({
					url: '<?php echo base_url() ?>index.php/master/user/json', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan
					height: "auto", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					mtype: "GET",
					colNames: ['Id','Nama User','Username','Password','Level'],
					colModel: [
						{name:'id', key:true, index:'id', hidden:true,editable:false,editrules:{required:true}},//name untuk variabel post yang dikirim saat menambah data
						{name:'nama',index:'user_name',width:200,editable:true,editrules:{required:true}},//index untuk variabel yang digunakan saat pencarian
						{name:'uername',index:'user_username',width:200,editable:true,editrules:{required:false}},
						{name:'password',index:'user_password',width:200,align:'center',editable:true,editrules:{required:false}},
                                                {name:'level',index:'user_level',width:200,align:'center',editable:true,editrules:{required:false}},

					],
					rownumbers:true,
					rowNum: 10,
					rowList: [10,20,30],
					pager: '#pageruser',
					sortname: 'user_id',
					viewrecords: true,
					sortorder: "desc",
					editurl: '<?php echo base_url() ?>index.php/master/user/crud', //URL Proses CRUD Nya
					multiselect: false,
					caption: "Master User" //Caption List
				});
				grid.jqGrid('navGrid','#pageruser',{view:false,edit:false,add:false,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});
                                jQuery("#listuser").jqGrid('navButtonAdd','#pageruser',{caption:"",buttonicon:"ui-icon-plus",
				onClickButton:function()
				{
				//alert("Berhasil");
                                //$("#formadduser").show();
                                $('#formadduser').dialog('open');
                                return false;
				}
				});
			});

        function pilihwilayah()
        {
            var objmitra = document.getElementById("usermitra");
            var index = $("#usermitra").attr("value");
            //alert(index);

         $.ajax(
         {
               url : "<?php echo base_url(); ?>index.php/master/user/getwilayah",
               data : "id="+index,
               type: 'POST',
               success: function(data)
               {
                     $("#userwilayah").html(data);
               },
               error: function(e)
               {
                   alert("Data belum Diambil");
               }
         }
         );

        }

        function pilihuserrayon()
        {
            var objmitra = document.getElementById("userwilayah");
            var index = $("#userwilayah").attr("value");
            //alert(index);

         $.ajax(
         {
               url : "<?php echo base_url(); ?>index.php/master/user/getrayon",
               data : "id="+index,
               type: 'POST',
               success: function(data)
               {
                     $("#userrayon").html(data);
               },
               error: function(e)
               {
                   alert("Data belum Diambil");
               }
         }
         );

        }
       function resetuser()
       {
           $("#usernama").val("");
           $("#usermitra").val("");
           $("#userusername").val("");
           $("#userpassword").val("");
           $("#userwilayah").val("");
           $("#userrayon").val("");
           $("#userlevel").val("");
       }

       function saveuser()
		{
		 $.ajax(
                {
                url : "<?php echo base_url() ?>index.php/master/user/crud",
               secureuri:false,
               data : $("#useradd").serialize(),
                type: $("#useradd").attr("method"),
                dataType: 'json',
             success: function(data)
                    {
                    alert ("Data udah dikirim");
                    alert(data.userlevel);
                    alert(data.level);
                    resetuser();
                    $('#listuser').trigger('reloadGrid');
                    },
               error: function(e)
                    {
                   alert("Data belum Diambil");
                    resetuser();
                    }
                }
                )
                return false;
		}
                
       



		</script>
<div id="master_user" style="width: auto; height: auto;overflow: auto">
		<table id="listuser" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pageruser" class="scroll" style="text-align:center;"></div>
		
</div>
<div id="formadduser">
    <form method="post" action="#" name="useradd" id="useradd">
        <input type="hidden" name="oper" value="add" />
	<table>
            <tr><td>Nama</td><td>:</td><td><input id="usernama" class="ui-widget ui-widget-content padding ui-corner-all" name="usernama" type="text"></td><td>Mitra</td><td>:</td>
                <td><select id="usermitra" name="usermitra"  class="ui-widget ui-widget-content padding ui-corner-all" onchange="pilihwilayah();">
								<option value="" >Pilih Mitra</option>
                                                                <?php
								for($i=0;$i<count($mitra);$i++)
								{?>
								<option value="<?php echo $mitra[$i]['id_mitra'];?>"><?php	echo $mitra[$i]['nama_mitra']; ?></option>

								<?php
								}
								?>
								</select></td>
        </tr>
        <tr><td>Username</td><td>:</td><td><input id="userusername" name="userusername" class="ui-widget ui-widget-content padding ui-corner-all" type="text">
             <td>Wilayah</td><td>:</td>
                                                                <td><select id="userwilayah" name="userwilayah" length="40" class="ui-widget ui-widget-content padding ui-corner-all" onchange="pilihuserrayon();">
								<option value="" >Pilih Wilayah</option>

								</select></td></tr>
        <tr><td>Password</td><td>:</td><td><input id="userpassword" name="userpassword" class="ui-widget ui-widget-content padding ui-corner-all" type="text">
            <td>Rayon</td><td>:</td>
                                                            <td><select id="userrayon" length="40" class="ui-widget ui-widget-content padding ui-corner-all" name="userrayon" >
								<option value="" >Pilih Rayon</option>

								</select></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;
            <td>Level</td><td>:</td><td><select id="userlevel1" name="userlevel" length="40" class="ui-widget ui-widget-content padding ui-corner-all" >
								<option value="" >Pilih Level</option>
                                                                <option value="1" >Operator</option>
                                                                <option value="2" >Client</option>


								</select></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
            <td>
            <input type="button" id="usersave" value="Save" onclick="saveuser();">
            <input type="button" id="userreset" value="Reset" onclick="resetuser();">
            </td>
        </tr>
    </table>
    </form>
</div>

