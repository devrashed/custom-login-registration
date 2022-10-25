<?php
    $allusers = array();
	$user_args = array(
        'orderby'   => 'meta_value',
        'meta_key'  => 'user_earn',
        'order'     => 'ASC',
	);
    $top_users = get_users($user_args);
    // echo json_encode($top_users);
	if ($top_users) {
		foreach($top_users as $key=>$user){
            $allusers[$key] = $user;
		    $current_id_user = $user->ID;   
			$allusers[$key]->birthday = get_user_meta($current_id_user,'birthday',true);
			$allusers[$key]->address = get_user_meta($current_id_user,'address',true);
            $allusers[$key]->user_earn = get_user_meta($current_id_user,'user_earn',true);
			$allusers[$key]->image = get_user_meta($current_id_user, 'image',true);	
			if ($allusers[$key]->image) {
				$allusers[$key]->image = wp_get_attachment_image_src($allusers[$key]->image)[0];
				$img_scr  = $allusers[$key]->image;
			} else {
				$img_scr = get_site_url().'/wp-content/plugins/buyer-seller-items/noprofile.png';
			}
        }
    } else {
	    echo 'Sorry, No Users Found';
	}
    array_multisort(array_column($allusers, 'user_earn'), SORT_DESC, $allusers);
?>  
<div id="content" class="content-with-sidebar-left blog-page-list">
    <div class="sh-group blog-list blog-style-masonry masonry2">
        <?php foreach($allusers as $key=>$user){ ?>
            <article>
                <div class="post-container">
                    <div class="post-meta-thumb">
                        <img src="<?php echo $img_scr;?>" >
                    </div>
                    <div class="user_title">
                        <h2>Name</h2>
                        <h2><?php echo $user->user_login ;?></h2>
                    </div>
                    <?php
                    if ($user->user_earn) {
                        $user_earn = $user->user_earn;
                    } else {
                        $user_earn = 0;
                    }
                    ?>
                    <div class="earning">
                        <h2>Earning</h2>
                        <h2><?php echo '£'.$user_earn ; ?></h2>
                    </div>
                    <div class="post-meta post-meta-two">
                        <span><a href="<?php echo get_site_url().'/user-details/?user='; ?><?php echo $user->user_login; ?>">Contact</a></span>
                    </div>
                </div>
            </article>
            <?php } ?>
	</div>
</div>
    <style>			
    .Filter_form {
        margin-bottom: 44px;
    } 
    select {
        width: 23%;
    }
    .Filter_form input[type="search"] , .Filter_form input[type="submit"] { 
        width: 23%;
        flex-wrap: wrap;
    }
    	#content.content-with-sidebar-left {
        width: 100%;
        padding-left: 2%;
       /* float: right;*/
    }

    .blog-style-masonry {
        margin: 0 -15px;
        position: relative;
        height: auto;
    }
       .post-meta-thumb {
        box-shadow: 0px 15px 45px -9px rgb(0 0 0 / 20%);
        position: relative;
        display: block;
        overflow: hidden;
        max-height: 700px;
        overflow: hidden;
        display: -webkit-flex;
        display: -moz-flex;
        display: -ms-flex;
        display: -o-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-flex-direction: column;
        -moz-flex-direction: column;
        -ms-flex-direction: column;
        -o-flex-direction: column;
        flex-direction: column;
        -webkit-flex-direction: column;
        -moz-justify-content: center;
        -ms-justify-content: center;
        -o-justify-content: center;
        -webkit-justify-content: center;
        -ms-flex-pack: center;
        justify-content: center;
    }
    .post-meta-thumb img {
        object-fit: contain;
        width: 100%;
        min-width: 100%;
        height: 233px;
        transition: all .3s ease-in-out;
        margin-bottom: 0;
    }
    .masonry2 article .post-content-container {
        transition: .3s all ease-in-out;
        box-shadow: 0px 15px 45px -9px rgba(0,0,0,.2);
        overflow: hidden;
        position: relative;
    }
    .masonry2 article .post-content-container {
        padding-left: 13%;
        padding-right: 13%;
        padding-top: 32px;
        background-color: #fff;
    }
    .post-meta.post-meta-one {
        font-family: Montserrat;
    }
    .masonry2 article h2 {
        font-size: 28px;
        margin-top: 12px;
        margin-bottom: 14px;
        line-height: 100%!important;
        font-family: "Raleway";
        color: black;
        text-align: center;
    }
    .post-meta.post-meta-one span {
        color: #8d8d8d!important;
        margin-left: 10px;
    }
    .post-meta.post-meta-two {
        font-family: "Raleway";
        color: #8d8d8d;
        font-size: 14px;
    }
    .post-meta.post-meta-two span {
        text-transform: uppercase;
        border-width: 0;
        box-shadow: none;
        border-radius: 5px;
        padding: 0 12px;
        line-height: 32px;
        background-color: #f0f0f0;
        transition: .3s all ease-in-out;
        display: inline-block;
        position: relative;
        padding: 0 10px;
        line-height: 30px;
        background-color: #f4f4f4;
        color: #8d8d8d;
        /* margin-right: 10px; */
        font-size: 13px!important;
        margin-bottom: 12px;
        border-radius: 100px;
        border: 3px solid #fff;
        box-shadow: 0px 1px 4px 1px rgba(0,0,0,.1);
        font-weight: 700;
    }
    .post-container {
        padding: 5px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .blog-style-masonry article {
        width: 80%;
        margin-left: auto;
        margin-right: auto;
        border: 2px solid gray;
        margin-bottom: 36px;
        border-radius: 8px;
    }

    .post-meta-thumb {
        box-shadow: 0px 15px 45px -9px rgb(0 0 0 / 20%);
        max-height: 150px;
        padding: 10px;
        /* width: auto; */
		width: 150px;
    height: 150px;
    border-radius: 50%;
    }
    .user_title {
        width: 20%;
        color: back;
    }
    .earning {
        width: 20%;
    }       
    @media screen and (max-width: 668px) {
        .masonry2 article h2 {
            font-size: 18px;
        }
    }
    @media screen and (max-width: 546px) {
        .user_title , .earning{
            width: 100%;
        }
        .post-container {
            display: block;
        }
    }
</style>