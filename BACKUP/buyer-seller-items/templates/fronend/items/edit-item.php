<?php
	if ($_GET['post_id']) {	
		$id =  $_GET['post_id'];
		// $post_tite = get_the_title( $post = 0 )
	}
	if (!is_user_logged_in() && !empty($id) ) { 
	    echo '<h6>You need to login first</h6>';
 	} else { 
 	$current_user = wp_get_current_user();
 	$current_id_user = $current_user->ID;
 	$post_tite = get_the_title($id);
 	$tags  = get_post_meta($id , 'item_tags', true);
	$imag = get_the_post_thumbnail_url($id,'full');
	$location = get_post_meta($id, 'item_location', true);
	$bs_product_type = get_post_meta($id, 'bs_product_type', true);
	$bs_product_a_distribute = get_post_meta($id, 'a_distribute', true);
	$bs_product_bs_link = get_post_meta($id, 'bs_link', true);
	$bs_quantity = get_post_meta($id, 'bs_quantity', true);
	$bs_unlimited_qty = get_post_meta( $id, 'bs_unlimited_qty', true );
	$sales_cats = wp_get_object_terms( $id, 'sales_categories' );
	$terms = get_terms( array(
	    'taxonomy' => 'sales_categories',
	    'hide_empty' => false,
	));
	$added_cats = array();
	if(! empty($sales_cats)){
		foreach ($sales_cats as $value) 
			$added_cats[] = $value->term_id;
		}
	}
	$content_post = get_post($id);
 	$content = $content_post->post_content;
?>
 	<div class="add_product_page" id="add_product_item">
	<form method="POST" enctype="multipart/form-data">
		<div>
			<label>Product Name</label><br>
			<input type="text" name="title" id="bs_item_title" placeholder="Product Name" value="<?php echo $post_tite; ?>">
			<br>
			<label>Product Categories</label><br>
	        <?php
				echo "<select data-placeholder='Choose a Category...' class='chosen-select' id='category_select' multiple tabindex='4'>";
				if(! empty($terms)){
					foreach ( $terms as $term ) {
						if(! empty($sales_cats)){
								$sel = '';
								if (in_array($term->term_id, $added_cats)){
									$sel = 'selected';
								}else{
									$sel = '';
								}
							    echo "<option value='".$term->term_id."' ".$sel.">".$term->name."</option>";
						}else{
						    echo "<option value='".$term->term_id."'>".$term->name."</option>";
						}
					}
				}
				echo "</select>";
			?>
			<br>
			<label>City/Town*</label>
	            <select name="location" value="<?php echo $location; ?>" id="bs_location" required style="">
	                <option value="Bath">Bath</option>
	                <option value="Birmingham">Birmingham</option>
	                <option value="Bradford">Bradford</option>
	                <option value="Brighton & Hove">Brighton & Hove</option>
	                <option value="Bristol">Bristol</option>
	                <option value="Cambridge">Cambridge</option>
	                <option value="Canterbury">Canterbury</option>
	                <option value="Carlisle">Carlisle</option>
	                <option value="Chelmsford">Chelmsford</option>
	                <option value="Chester">Chester</option>
	                <option value="Chichester">Chichester</option>
	                <option value="Coventry">Coventry</option>
	                <option value="Derby">Derby</option>
	                <option value="Durham">Durham</option>
	                <option value="Ely">Ely</option>
	                <option value="Exeter">Exeter</option>
	                <option value="Gloucester">Gloucester</option>
	                <option value="Hereford">Hereford</option>
	                <option value="Kingston-upon-Hull">Kingston-upon-Hull</option>
	                <option value="Lancaster">Lancaster</option>
	                <option value="Leeds">Leeds</option>
	                <option value="Leicester">Leicester</option>
	                <option value="Lichfield">Lichfield</option>
	                <option value="Lincoln">Lincoln</option>
	                <option value="Liverpool">Liverpool</option>
	                <option value="London">London</option>
	                <option value="Manchester">Manchester</option>
	                <option value="Newcastle-upon-Tyne">Newcastle-upon-Tyne</option>
	                <option value="Norwich">Norwich</option>
	                <option value="Nottingham">Nottingham</option>
	                <option value="Oxford">Oxford</option>
	                <option value="Peterborough">Peterborough</option>
	                <option value="Plymouth">Plymouth</option>
	                <option value="Portsmouth">Portsmouth</option>
	                <option value="Preston">Preston</option>
	                <option value="Ripon">Ripon</option>
	                <option value="Salford">Salford</option>
	                <option value="Salisbury">Salisbury</option>
	                <option value="Sheffield">Sheffield</option>
	                <option value="Southampton">Southampton</option>
	                <option value="St Albans">St Albans</option>
	                <option value="Stoke-on-Trent">Stoke-on-Trent</option>
	                <option value="Sunderland">Sunderland</option>
	                <option value="Truro">Truro</option>
	                <option value="Wakefield">Wakefield</option>
	                <option value="Wells">Wells</option>
	                <option value="Westminster">Westminster</option>
	                <option value="Winchester">Winchester</option>
	                <option value="Wolverhampton">Wolverhampton</option>
	                <option value="Worcester">Worcester</option>
	                <option value="York">York</option>
	            </select>
			<br>
			<label>Product Type</label>
			<br>
			<input type="radio" name="product_type" value="selling"  <?php if($bs_product_type=='selling'){ echo "checked=checked";}  ?> id="product_type_offer">Make Offer
			<input type="radio" name="product_type" value="offered"  <?php if($bs_product_type=='offered'){ echo "checked=checked";}  ?> id="product_type_request">Offers Required
			<br>
			<div class="desc">
				<label>Description</label>
				<textarea id="desc"><?php echo  html_entity_decode($content); ?></textarea>
			</div>
			<br>
			<div class="reveal-if-active">
				<input type="checkbox" name="auto_distribute" <?php echo ($bs_product_a_distribute ? 'checked' : ''); ?> value="true" id="a_distribute" data-require-pair="#product_type_offer"> Auto Distribute
				<br	>
				<input type="text" name="link" id="bs_link" value="<?php echo ($bs_product_a_distribute ? $bs_product_bs_link  : ''); ?>" placeholder="Add link to e-product, e-vouchers, e-ticket" data-require-pair="#product_type_offer">
				<br>
				<input type="checkbox" name="bs_unlimited_qty" <?php echo ($bs_unlimited_qty ? 'checked' : ''); ?> value="<?php echo ($bs_unlimited_qty ? 'true' : 'false'); ?>" id="bs_unlimited_qty"> Distribute Unlimited Quantity
				<br>
				<input type="number" name="bs_quantity" value="<?php echo ($bs_product_a_distribute ? $bs_quantity  : ''); ?>" placeholder="Quantity" id="bs_quantity">
				<br>
			</div>
			<label>Product Image</label>
			<div class="img_del">
				<?php
				if (!empty($imag)) { ?>
					<a id="img_del">X</a>
					<img src="<?php echo $imag ;?>">
				<?php	
				}
				?>
			</div>
			<label>Upload Product Image</label>
			<input type="file" name="file" id="bs_item_img">
			<input type="hidden" name="" id="current_user" value="<?php echo $current_id_user; ?>">
			<input type="hidden" name="" id="current_post" value="<?php echo $id; ?>">
			<input type="button" name="submit" value="Update Product" id="bs_update_item">
		</div>
		<span id="bs_error_message"></span>
	</form>
</div>