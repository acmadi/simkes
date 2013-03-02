<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div id='form_login'>
    <div class='title'>Login Form</div>
    <div class='the_content'>
        <?php echo form_open('home/do_login',array('name'=>'login_form'));?>
        <table class='myform' style='width:100%'>
            <tr>
                <td class='a_right' valign='top'>Username:</td>
                <td class='a_left' valign='top'><input type='text' name='username' style='width:97%' /><?php echo form_error('username');?></td>
            </tr>
            <tr>
                <td class='a_right' valign='top'>Password:</td>
                <td class='a_left' valign='top'><input type='password' name='password' style='width:97%' /><?php echo form_error('password');?></td>
            </tr>
            <tr>
                <td class='a_right' valign='top'><?php echo  $cap['image'] ?></td>
                <td class='a_left' valign='top'><input type='text' name='captcha' style='width:97%' /><?php echo form_error('captcha');?></td>
            </tr>
        </table>
     
        <div class='the_footer a_right'>
            <a class='button buttonblue mediumbtn' href='javascript:void(0)' onclick='document.login_form.submit()'>Masuk</a>
        </div>
    </div>
</div>