<?php 
	if (!is_user_logged_in() ) { 
	    echo '<h6>You need to login first</h6>';
	} else { 
 		$current_user = wp_get_current_user();
 		$current_id_user = $current_user->ID ;
		$terms = get_terms( array(
		    'taxonomy' => 'sales_categories',
		    'hide_empty' => false,
	));
?>	
<div class="add_product_page" id="add_product_item">
<form method="POST" enctype="multipart/form-data">
	<div>
        <h3>Create Offer or Request</h3>
        <hr>
		<label>Name of Product/Service</label><br>
		<input type="text" name="title" id="bs_item_title" placeholder="Product Name">
		<br>
		<label>Categories</label><br>
        <?php
			echo "<select data-placeholder='Choose a Category...' class='chosen-select' id='category_select' multiple tabindex='4'>";
			foreach ( $terms as $term ) {
			    echo "<option value='".$term->term_id."'>".$term->name."</option>";
			}
			echo "</select>";
		?>
		 <br>
		<!-- <label>Product Tags</label><br>
		<input type="text" name="tags" id="bs_tags" placeholder="Add meta tags">
		<br> -->
		<label>City/Town*</label>
            <select name="location" id="bs_location" required style="width: 100%">
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
		<input type="radio" name="product_type" value="selling" id="product_type_offer">Make Offer
		<input type="radio" name="product_type" value="offered" id="product_type_request">Request Offers
		<br>
		<div class="desc">
			<label>Description</label>
			<textarea id="desc"></textarea>
		</div>
		<br>
		<form>
		<div class="reveal-if-active">
			<input type="checkbox" name="auto_distribute" value="true" id="a_distribute" data-require-pair="#product_type_offer"> Auto Distribute
			<br	>
			<input type="text" name="link" id="bs_link" placeholder="Add link to e-product, e-vouchers, e-ticket" data-require-pair="#product_type_offer">
			<br>
			<input type="checkbox" name="bs_unlimited_qty" value="false" id="bs_unlimited_qty" > Distribute Unlimited Quantity
			<br>
			<input type="number" name="bs_quantity" placeholder="Quantity" id="bs_quantity">
			<br>
		</div>
		<label>Upload Image (optional)</label>
		<input type="file" name="file" id="bs_item_img">
		<input type="hidden" name="" id="current_user" value="<?php echo $current_id_user; ?>">
		<input type="button" name="submit" value="Add FreeSale" id="bs_add_item">
		</form>
	</div>
	<span id="bs_error_message"></span>
</form>
</div>



<?php } ?>
