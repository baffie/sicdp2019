<ol class="breadcrumb">
    <li><a href="<?php echo site_url()?>">Home</a></li>
    <li class="active"><?php echo lang('forgot_password_heading');?></li>
</ol>
<div class="row mt20">
    <div class="col-md-6 col-sm-8 col-md-offset-3 col-sm-offset-2">
        <div class="panel panel-success">
            <div class="panel-body">
                <p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>
                <?php echo form_open("auth/forgot_password");?>
                <?php echo $message;?>
                <p>
                    <label for="Username">Username</label> <br />
                    <input type="text" name="identity" value="" id="identity" class="form-control"  />
                </p>
                <!--<p>
                    <label for="identity"><?php echo (($type=='email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label));?></label> <br />
                    <?php echo form_input($identity);?>
                </p>-->
                <p><button type="submit" class="btn btn-success"><?php echo lang('forgot_password_submit_btn');?></button></p>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>