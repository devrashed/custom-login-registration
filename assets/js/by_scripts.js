// AJAX url

let ajax_url = bs_ajax_object.ajax_url;
let userId = bs_ajax_object.userID;

jQuery(document).on('click', '#bs_registeration', function () {



	jQuery('#bs_error_message').text('');

	let bs_username = document.getElementById('bs_username').value;

	let bs_fullname = document.getElementById('bs_fullname').value;  

	//let bs_phonenumber = document.getElementById('bs_phonenumber').value;

	let bs_email = document.getElementById('bs_email').value;

	let bs_password = document.getElementById('bs_password').value;

	let bs_dob = document.getElementById('bs_dob').value;

	//let bs_address = document.getElementById('bs_address').value;

	//let bs_image = jQuery('#bs_userprofile').prop('files')[0];

	//console.log(bs_image);


							

	if (bs_username === '' || bs_fullname === '' || bs_email === '' || bs_password === '') {

		jQuery('#bs_error_message').text('All above Fields are Required');

	} else {

		if (IsEmail(bs_email) == false) {

			jQuery('#bs_error_message').text('email is not valid');

		} else {

			jQuery('form').append(`<div class="loader"></div>`);

			jQuery("#bs_registeration").attr("disabled", true);

			// jQuery('#bs_error_message').text('Processing');

			var form_data = new FormData();

			form_data.append('action', 'bs_registeration_callback');

			form_data.append('bs_username', bs_username); 

			form_data.append('bs_fullname', bs_fullname); 

			//form_data.append('bs_phonenumber', bs_phonenumber); 

			form_data.append('bs_email', bs_email);

			form_data.append('bs_password', bs_password);

			//form_data.append('bs_dob', bs_dob);

			//form_data.append('bs_address', bs_address);

			//form_data.append('bs_image', bs_image);



			jQuery.ajax({

				url: ajax_url,

				type: 'POST',

				contentType: false,

				processData: false,

				data: form_data,

				success: function (response) {

					jQuery('.loader').remove();

					//if (response == 'You have registered Successfully') {
					if (response == 'Thank you for registering at FREESALE!  Please check your emails to verify your account') {	
					

						jQuery("form").trigger("reset");

						jQuery('#bs_error_message').text(response);

						setTimeout(function () {

							window.location.replace("https://free.dizmak.com/login/");

						}, 1000);


					} else {

						jQuery("#bs_registeration").removeAttr("disabled");

						jQuery('#bs_error_message').text(response);

					}

				}

			});

		}

	}

});



function IsEmail(email) {

	var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

	if (!regex.test(email)) {

		return false;

	} else {

		return true;

	}

}







// ===========  let bs_login = document.getElementById('bs_login');

jQuery(document).on('click', '#bs_login', function () {

	jQuery('#bs_error_message').text('');

	// e.preventDefault();

	//alert('successfully run');



	let bs_email = document.getElementById('bs_email').value;

	let bs_password = document.getElementById('bs_password').value;





	if (bs_email == '' || bs_password == '') {

		jQuery('#bs_error_message').text('Both Fields are Required');

	} else {

		// jQuery('form').append(`<div class="loader"></div>`);

		jQuery("#bs_login").attr("disabled", true);

		jQuery('#bs_error_message').text('Processing');

		// if(IsEmail(bs_email)==false){

		//         jQuery('#bs_error_message').text('email is not valid');

		//       } else {

		var data = {

			'action': 'bs_login_callback',

			'bs_email': bs_email,

			'bs_password': bs_password,

		};



		// Send Ajax Request

		jQuery.post(ajax_url, data, function (response) {

			// jQuery('.loader').remove();

			jQuery('#bs_error_message').text(response);

			jQuery("#bs_login").removeAttr("disabled");

			if (response == 'Logged in successfully') {

				setTimeout(function () {

					window.location.replace("https://free.dizmak.com/my-profile/");

				}, 1000);

			}

		});

		//}

	}

});













jQuery(document).on('click', '#bs_add_item', function () {

	jQuery('#bs_error_message').text('');

	// let choosen_cat = jQuery('form .chosen-select').val();
	let choosen_cat = jQuery("#category_select").chosen().val();
	console.log(choosen_cat);


	let bs_item_title = document.getElementById('bs_item_title').value;

	// let bs_tags = document.getElementById('bs_tags').value;

	let bs_location = document.getElementById('bs_location').value;

	let current_user = document.getElementById('current_user').value;

	let bs_item_img = jQuery('#bs_item_img').prop('files')[0];

	let product_type = jQuery("input[name='product_type']:checked").val();

	let description = jQuery.trim(jQuery("#desc").val());
	let a_distribute = jQuery("input[name=auto_distribute]:checked").val();
	let bs_link = '';
	let bs_quantity = 0;
	let bs_unlimited_qty = document.getElementById('bs_unlimited_qty').value;
	if (a_distribute) {
		bs_link = document.getElementById('bs_link').value;
		if (bs_unlimited_qty) {
			bs_quantity = 0;
		} else {
			bs_quantity = document.getElementById('bs_quantity').value;
		}

	}
	//console.log(bs_item_img);



	if ((document.getElementById('a_distribute').checked == true && bs_link == '') || bs_item_title == '' || choosen_cat == '' || bs_location == '' || typeof product_type == 'undefined') {

		jQuery('#bs_error_message').text('Above Fields are Required');

	} else {

		jQuery('form').append(`<div class="loader"></div>`);


		jQuery("#bs_add_item").attr("disabled", true);

		var form_data = new FormData();

		form_data.append('action', 'bs_add_item_callback');

		form_data.append('bs_item_title', bs_item_title);

		form_data.append('bs_choosen_cat', choosen_cat);

		form_data.append('current_user', current_user);

		form_data.append('bs_location', bs_location);

		form_data.append('bs_item_img', bs_item_img);

		form_data.append('product_type', product_type);

		form_data.append('description', description);

		form_data.append('a_distribute', a_distribute);

		form_data.append('bs_link', bs_link);

		form_data.append('bs_quantity', bs_quantity);

		form_data.append('bs_unlimited_qty', bs_unlimited_qty);

		jQuery.ajax({

			url: ajax_url,

			type: 'POST',

			contentType: false,

			processData: false,

			data: form_data,

			success: function (response) {
				//delay(1000).fadeIn();
				jQuery('.loader').remove();

				jQuery("#bs_add_item").removeAttr("disabled");

				jQuery('#bs_error_message').text(response);

				if (response == 'Product Created Successfully') {

					jQuery("form").trigger("reset");
					
				}
				window.location = '/my-profile';
			}

		});

	}

});





// Delete Post Thumbnail





jQuery(document).on('click', '#img_del', function () {

	jQuery('#bs_error_message').text('');

	let current_post = document.getElementById('current_post').value;

	// jQuery('#bs_error_message').text('Processing');

	var form_data = new FormData();

	form_data.append('action', 'bs_delete_thumnail_callback');

	form_data.append('current_post', current_post);

	jQuery.ajax({

		url: ajax_url,

		type: 'POST',

		contentType: false,

		processData: false,

		data: form_data,

		success: function (response) {

			if (response == 'succ') {

				jQuery('.img_del').remove();

			}

		}

	});

});







// Update_Item



jQuery(document).on('click', '#bs_update_item', function () {

	jQuery('#bs_error_message').text('');

	// e.preventDefault();

	//alert('successfully run');

	let choosen_cat = jQuery("#category_select").chosen().val();
	console.log(choosen_cat);


	let bs_item_title = document.getElementById('bs_item_title').value;

	// let bs_tags = document.getElementById('bs_tags').value;

	let bs_location = document.getElementById('bs_location').value;

	let current_user = document.getElementById('current_user').value;

	let bs_item_img = jQuery('#bs_item_img').prop('files')[0];

	let current_post_id = document.getElementById('current_post').value;

	let product_type = jQuery("input[name='product_type']:checked").val();

	let description = jQuery.trim(jQuery("#desc").val());

	let a_distribute = jQuery("input[name=auto_distribute]:checked").val();
	let bs_link = '';
	let bs_quantity = 0;
	let bs_unlimited_qty = document.getElementById('bs_unlimited_qty').value;
	if (a_distribute) {
		bs_link = document.getElementById('bs_link').value;
		if (bs_unlimited_qty) {
			bs_quantity = 0;
		} else {
			bs_quantity = document.getElementById('bs_quantity').value;
		}

	}

	//console.log(bs_item_img);



	if (bs_item_title == '' || choosen_cat == '' || bs_location == '') {

		jQuery('#bs_error_message').text('Both Fields are Required');

	} else {


		jQuery('form').append(`<div class="loader"></div>`);


		jQuery("#bs_update_item").attr("disabled", true);



		var form_data = new FormData();

		form_data.append('action', 'bs_update_item_callback');

		form_data.append('bs_item_title', bs_item_title);

		form_data.append('bs_choosen_cat', choosen_cat);

		form_data.append('current_user', current_user);

		form_data.append('bs_location', bs_location);

		form_data.append('bs_item_img', bs_item_img);

		form_data.append('current_post_id', current_post_id);

		form_data.append('product_type', product_type);

		form_data.append('description', description);

		form_data.append('a_distribute', a_distribute);

		form_data.append('bs_link', bs_link);

		form_data.append('bs_quantity', bs_quantity);

		form_data.append('bs_unlimited_qty', bs_unlimited_qty);

		jQuery.ajax({

			url: ajax_url,

			type: 'POST',

			contentType: false,

			processData: false,

			data: form_data,

			success: function (response) {



				jQuery('.loader').remove();

				jQuery("#bs_update_item").removeAttr("disabled");

				jQuery('#bs_error_message').text(response);

				// if (response == 'Product Created Successfully') {

				// 	jQuery("form").trigger("reset");

				// }

			}

		});

	}

});









// Delete Post 



jQuery(document).on('click', '.delted_curent_post', function () {



	let current_post = jQuery(this).attr("id");

	// jQuery('#bs_error_message').text('Processing');

	var form_data = new FormData();

	form_data.append('action', 'bs_delete_post');

	form_data.append('current_post', current_post);

	jQuery.ajax({

		url: ajax_url,

		type: 'POST',

		contentType: false,

		processData: false,

		data: form_data,

		success: function (response) {

			if (response == 'succ') {

				jQuery(`#sing_${current_post}`).remove();

			}

		}

	});

});







//============= Upadate Profile ===========





jQuery(document).on('click', '#bs_update_profile', function () {



	jQuery('#bs_error_message').text('');

	let bs_username = document.getElementById('bs_username').value;

	let bs_email = document.getElementById('bs_email').value;

	// let bs_password = document.getElementById('bs_password').value;

	let bs_fullname = document.getElementById('bs_fullname').value;

	//let bs_phonenumber = document.getElementById('bs_phonenumber').value;

	//let bs_dob = document.getElementById('bs_dob').value;

	//let bs_address = document.getElementById('bs_address').value;

	let bs_image = jQuery('#bs_userprofile').prop('files')[0];

	let current_user_id = document.getElementById('current_user_id').value;

	//console.log(bs_image);



	if (bs_username == '' || bs_email == '' || bs_fullname == '' ) {

		jQuery('#bs_error_message').text('All above Fields are Required');

	} else {

		if (IsEmail(bs_email) == false) {

			jQuery('#bs_error_message').text('email is not valid');

		} else {

			jQuery('#bs_error_message').text('Processing');

			var form_data = new FormData();

			form_data.append('action', 'bs_update_profile_callback');

			form_data.append('bs_username', bs_username);

			form_data.append('bs_email', bs_email);

			form_data.append('bs_fullname', bs_fullname);

			//form_data.append('bs_phonenumber', bs_phonenumber);

			// form_data.append('bs_password', bs_password);

			//form_data.append('bs_dob', bs_dob);

			//form_data.append('bs_address', bs_address);

			form_data.append('bs_image', bs_image);

			form_data.append('current_user_id', current_user_id);



			jQuery.ajax({

				url: ajax_url,

				type: 'POST',

				contentType: false,

				processData: false,

				data: form_data,

				success: function (response) {

					jQuery('#bs_error_message').text(response);

					setTimeout(function () {

							window.location.replace("https://free.dizmak.com/my-profile");

					 }, 100);

				}

			});

		}

	}

});







// Delete user Image

jQuery(document).on('click', '#img_del_user', function () {



	let current_post = document.getElementById('current_user_id').value;

	// jQuery('#bs_error_message').text('Processing');

	var form_data = new FormData();

	form_data.append('action', 'bs_delete_user_imge');

	form_data.append('current_post', current_post);

	jQuery.ajax({

		url: ajax_url,

		type: 'POST',

		contentType: false,

		processData: false,

		data: form_data,

		success: function (response) {

			if (response == 'succ') {

				jQuery(`.remove_img`).remove();

			}

		}

	});

});

jQuery(document).ready(function () {
	var html = '<a id="notification-bell" href="/my-profile/"><div class="notifier new"><i style="font-family: FontAwesome;" class="bell fa fa-bell-o"></i><div id="badgenotifier" class="badge"></div></div></a>';

	// 	document.getElementById("badgenotifier").style.display = 'none';
	jQuery('header.aux-elementor-header').append('<li class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-10 current_page_item menu-item-266 aux-menu-depth-0 aux-menu-root-5 aux-menu-item" style="position: absolute;list-style: none;right: 50px;top: 50px;">' + html + '</li>');
	jQuery('#badgenotifier').css('display', 'none');
	jQuery.ajax({
		type: "POST",
		url: ajax_url,
		data: { 'action': 'call_getOutStandingForms', 'userId': userId },
		success: function (response) {
			jQuery('#badgenotifier').append((response.data.rec + response.data.rev));
			if ((response.data.rec + response.data.rev) > 0) {
				jQuery('#badgenotifier').css('display', 'block');
                jQuery('#badgenotifier').css('top', '-40px');
                jQuery('#badgenotifier').css('left', '12');
			}
		}
	})
	jQuery.post(ajax_url, {action: 'is_user_logged_in'}, function (response) {
		if (response == 'yes') {
			jQuery('#notification-bell').css('display', 'inline-block');
		} else {
			jQuery('#notification-bell').css('display', 'none');
		}
	});
});

jQuery(document).ready(function() {
	jQuery('#a_distribute').change(function () {
		
	if(jQuery("#a_distribute").is(':checked')) {
		jQuery('#bs_link').attr('required', true);
	} else {
		jQuery('#bs_link').removeAttr('required');
		}
	});

	jQuery('#bs_unlimited_qty').change(function () {
	if(jQuery("#bs_unlimited_qty").is(':checked')) {
		jQuery('#bs_quantity').attr('disabled', true);
		jQuery('#bs_unlimited_qty').attr('value', true);
	} else {
		jQuery('#bs_quantity').removeAttr('disabled');
		jQuery('#bs_unlimited_qty').attr('value', false);
		}
	});
});

jQuery(".chosen-select").chosen({no_results_text: "Oops, nothing found!"});