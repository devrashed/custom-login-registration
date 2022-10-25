<?php
if (isset($_GET['search_title'])) {
    $search_title = $_GET['search_title'];
} else {
    $search_title = '';
}
if (isset($_GET['search_locat'])) {
    $search_locat = $_GET['search_locat'];
} else {
    $search_locat = '';
}
if (isset($_GET['prod_type'])) {
    if ($_GET['prod_type'] == "") {
        $prod_type = array('offered', 'selling');
    } else {
        $prod_type = $_GET['prod_type'];
    }
} else {
    $prod_type = array('offered', 'selling');
}
$args = array(
    'post_type' => 'buy_sell_items',
    'orderby' => 'meta_value_num',
    'meta_key' => 'total_earn',
    'order' => 'ASC',
    's' => $search_title,
    'meta_query' => array(
        array(
            'key' => 'item_location',
            'value' => $searh_locat,
            'compare' => 'LIKE',
        ),
        array(
            'key' => 'bs_product_type',
            'value' => $prod_type,
            'compare' => 'IN',
        ),
    ),
    'posts_per_page' => -1,
);
$the_query = new WP_Query($args);
$all_products = array();
$i = 0;
if ($the_query->have_posts()) {
    while ($the_query->have_posts()) {
        $the_query->the_post();
        $all_products[$i]->ID = get_the_ID();
        $all_products[$i]->title = get_the_title();
        $all_products[$i]->location = get_post_meta(get_the_ID(), 'item_location', true);
        $all_products[$i]->tags = get_post_meta(get_the_ID(), 'item_tags', true);
        $all_products[$i]->bs_product_type = get_post_meta(get_the_ID(), 'bs_product_type', true);
        $all_products[$i]->imag = get_the_post_thumbnail_url(get_the_ID(), 'full');
        $all_products[$i]->auth_name = get_the_author_meta('login');
        $all_products[$i]->auth_earn = get_the_author_meta('user_earn');
        $all_products[$i]->content = substr(get_the_content(), 0, 100);
        $all_products[$i]->permalink = get_permalink();
        $all_products[$i]->content = $all_products[$i]->content . (get_the_content() == $article_data ? '' : '...');
        if (!$all_products[$i]->imag) {
            $all_products[$i]->imag = get_site_url() . '/wp-content/plugins/buyer-seller-items/noprofile.png';
        }
        //echo $all_products[$i]->get_the_ID();
        // var_dump($all_products[$i]);
        wp_reset_postdata();
        $i++;
    }
} else {
    echo 'Sorry, you have no Products';
}
array_multisort(array_column($all_products, 'auth_earn'), SORT_DESC, $all_products);
// echo json_encode($all_products);
?>
<div class="Filter_form">
    <form method="GET">
        <div class="search boxes">
            <input type="search" name="search_title" placeholder="Title Search" value="<?php echo $sear_title; ?>" >
            <input type="search" name="search_locat" placeholder="City Search" value="<?php echo $searh_locat; ?>" >
            <select name="prod_type">
                <option value="">--Select--</option>
                <option <?php if ($prod_type == 'selling') {echo "selected";}?> value="selling">Offers</option>
                <option <?php if ($prod_type == 'offered') {echo "selected";}?> value="offered">Requests</option>
            </select>
            <input type="submit" name="search" value="Search">
        </div>
    </form>
</div>
<div id="content" class="content-with-sidebar-left blog-page-list">
	<div class="sh-group blog-list blog-style-masonry masonry2">
        <?php
foreach ($all_products as $key => $product) { //var_dump($product);?>
			<article>
				<div class="post-container" id="sing_<?php echo $product->ID; ?>">
					<div class="post-meta-thumb">
					    <img src="<?php echo $product->imag; ?>" >
                    </div>
					<div class="post-content-container">
					    <div class="post-meta post-meta-two">
		     				<span>
		     					<?php
if ($product->bs_product_type == 'offered') {
    echo '<a href="' . get_site_url() . '/user-details/?user=' . $product->auth_name . '&prod_id=' . $product->ID . '&type=Offered">Make Offer</a>';
} else {
    echo '<a href="' . get_site_url() . '/user-details/?user=' . $product->auth_name . '&prod_id=' . $product->ID . '">Accept</a>';
}
    ?>
		     				</span>
		     				<span>
		     					<a href="<?php echo get_site_url() . '/user-details/?user='; ?><?php echo $product->auth_name; ?>">Contact</a>
		     				</span>
		     			</div>
                        <h2><?php echo $product->title; ?></h2>
                        <?php
echo '<p>' . $product->content . '</p>';
    echo '<p style="position: absolute;bottom: 0"><a href="' . $product->permalink . '">Read More</a></p>';
    ?>
				    </div>
		 		</div>
		 	</article>
		<?php
}
?>
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
       .post-container {
        margin: 0 15px;
        position: relative;
    }
    .blog-style-masonry article {
       /*float: left;*/
       display:inline-block;
        margin-bottom: 45px;
        width: 24%;
        margin-left: 2px;
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
        height: 300px;
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
        color: #8d8d8d;
        /*text-align: center;*/
    }
    .masonry2 .post-meta-two {
        /*margin-left: -18%;
        margin-right: 92px;
        padding: 19px 0 19px 18%;*/
        position: relative;
    }
    .content-with-sidebar-left.blog-page-list .post-content-container {
        height: 275px !important;
    }
    .post-meta.post-meta-one span {
        color: #8d8d8d!important;
        margin-left: 10px;
    }
    .post-meta.post-meta-two {
        font-family: "Raleway";
        color: #8d8d8d;
        font-size: 14px;
        justify-content: space-between;
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
</style>