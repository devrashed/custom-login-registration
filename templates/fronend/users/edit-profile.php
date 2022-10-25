<?php 
    if ( !is_user_logged_in() ) { 
    echo '<h6>You Need to login</h6>';
    } else { 
        $current_user = wp_get_current_user();
        $current_id_user = $current_user->ID ;
        $image = get_user_meta($current_id_user, 'image',true);    
        if ($image) {
           $img = wp_get_attachment_image_src($image);
           $img_scr  = $img[0];
        }
        $user  = get_user_by( 'id', $current_id_user );
        $birthday = get_user_meta($current_id_user,'birthday',true);
        $address = get_user_meta($current_id_user,'address',true);

        $fullname = get_user_meta($current_id_user,'fullname',true);  //Rashed code
        $phonenumber = get_user_meta($current_id_user,'phonenumber',true);  //Rashed code

    ?>
        <div class="buyer_seller_reg_form">
    	    <h3>Update Account</h3>
            <form method="POST" name="user_registeration" enctype="multipart/form-data">
                <label>Username*</label>  
                <input type="text" name="username" placeholder="Enter Your Username" 
                id="bs_username" value="<?php echo $user->user_login;?>" disabled/>
                <br/>

                <label>Full Name*</label>  
                <input type="text" name="phonenumber" placeholder="Enter Your Fullname" 
                id="bs_fullname" value="<?php echo $user->fullname;?>"/>
                <br/>

               <!--  <label>Phone Number*</label>  
                <input type="text" name="phonenumber" placeholder="Enter Your Fullname" 
                id="bs_phonenumber" value="<?php echo $user->phonenumber;?>"/>
                 -->
                <br/>                   
                <label>Email address*</label>
                <input type="text" name="useremail" id="bs_email" placeholder="Enter Your Email" 
                value="<?php echo $user->user_email;?>" />
                <!-- <br/>
                <label>City/Town*</label>
                <input type="text" name="bs_address" placeholder="Enter Address" id="bs_address" value="<?php //echo $address; ?>" />  -->

                <?php ?>
                <br>
                <label>Profile Photo</label>
                <div class="remove_img">
                    <?php
                        if ($image) {
                        $img = wp_get_attachment_image_src($image);
                        $img_scr  = $img[0]; ?>
                        <a id="img_del_user">X</a>
                        <img src="<?php echo $img_scr ;?>" style="width: 150px;height: 150px;">
                    <?php   
                        }
                    ?>
                </div>
                <label>Upload Profile Photo</label>
                <input type="file" name="file" id="bs_userprofile">
                <input type="hidden" name="" value="<?php echo $current_id_user; ?>" id="current_user_id">
                <input type="button" id="bs_update_profile" value="Update Profile" />
            </form>
            <span id="bs_error_message"></span>
        </div>
    <?php
    } 
?>