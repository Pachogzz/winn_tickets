jQuery(document).ready(function(){
	// Add tickets tab under photo / gallery on single product
	jQuery("#event_data_details.first_part").appendTo(".single-product .woocommerce-product-gallery");
	jQuery("#event_description").appendTo("#event_data_details.first_part");
	jQuery("#event_sections_tabs").insertAfter(".single_add_to_cart_button");
});