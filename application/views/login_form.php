<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login Simkes</title>

<link href="<?php echo base_url();?>asset/css/login-box.css" rel="stylesheet" type="text/css" />
</head>
<body>
   <div id="body">
        <form method="post" id="login" action="<?php echo base_url();?>index.php/home/login">
            <div id="login-box">

                <H2>Login</H2>
                <br />
                <br />
                <div id="login-box-name" style="margin-top:20px;">Username:</div><div id="login-box-field" style="margin-top:20px;"><input name="username" class="form-login" title="Username" value="" size="30" maxlength="2048" /></div>
                <div id="login-box-name">Password:</div><div id="login-box-field"><input name="password" type="password" class="form-login" title="Password" value="" size="30" maxlength="2048" /></div>
                <input type="submit" id="tombol_login" value="LOGIN" ></input>                
            </div>
        </form>
    </div>
</body>
</html>
