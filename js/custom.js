jQuery(document).ready(function(){
	jQuery('.navbar-toggle').on('click', function(){
		jQuery('.navbar-toggle').toggleClass('active');
	});

  //popup
  jQuery('.popwindow').on('click', function(e){
    e.preventDefault();
    title = jQuery(this).data('title');
    type = jQuery(this).data('type');
    send_url = jQuery(this).data('url');
    media = jQuery(this).data('media');
    showPopup = "popupWindow";
    showSettings = "width=483,height=350,scrollbars=yes";
    
    if ( type == "twitter" ) {
        window.open( ("https://twitter.com/intent/tweet?text=" + title + "&amp;url=" +  send_url ), showPopup, showSettings);
        return false;
    }
    else if ( type == "facebook"  ) {
        window.open( ("https://www.facebook.com/sharer/sharer.php?u=" + send_url ), showPopup, showSettings);
        return false;
    }
    else if ( type == "google"  ) {
        window.open( ("https://plus.google.com/share?url=" + send_url ), showPopup, showSettings);
        return false;
    }
    else if ( type == "linkedin"  ) {
        window.open( ("https://www.linkedin.com/shareArticle?mini=true&url=" + send_url + "&amp;title=" +  title ), showPopup, showSettings);
        return false;
    }
    else if ( type == "pinterest"  ) {
        window.open( ("https://pinterest.com/pin/create/button/?url=" + send_url + "&amp;media=" +  media + '&amp;description=' +  send_url), showPopup, showSettings);
        return false;
    }
  });
  
});