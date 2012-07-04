jQuery(document).ready(function($) {

    jQuery('form[name=wpideaforge_form]').submit( function() {
        var idea = jQuery('input[name=idea]').val();
        var hstart = '<span>';
        var hend   = '</span>';
        if( idea != '' ) {
            var data = {
                    action: 'wpideaforge_save',
                    wpidea_nonce : cfg.wpidea_nonce,
                    idea: idea
            };
            jQuery.post( cfg.ajaxurl, data, function(response) { 
                if( response.success == true ) {
                    jQuery('div#wpideaforge_form div#error').html('');
                    jQuery('div#wpideaforge_form div#success').html(hstart + cfg.txt_success + hend);
                    jQuery('input[name=idea]').val('');
                } else {
                    jQuery('div#wpideaforge_form div#error').html(hstart + cfg.txt_nosuccess + hend);
                    jQuery('div#wpideaforge_form div#success').html('');
                }		
            });           
        } else {
            // Empty Input results in Error
            jQuery('div#wpideaforge_form div#error').html(hstart + cfg.txt_nosuccess + hend);
        }
        return false;
    })
    
    jQuery('form.wpideaforge_vote').submit( function() {
        var form = jQuery(this);
        var countEl = jQuery(form).find('div.wpideaforge_vote_counter');
        // Update Counter
        var counter = jQuery(countEl).html();
        counter++;
        jQuery(countEl).html(counter)
        // Submit Counter
        var postId = jQuery(form).find('input[name=postId]').val();
        var data = {
                action: 'wpideaforge_counter',
                wpidea_nonce : cfg.wpidea_nonce,
                postId: postId
        };
        jQuery.post( cfg.ajaxurl, data, function(response) { 
            console.log(response);
        });           
        //
        return false;
    });

});