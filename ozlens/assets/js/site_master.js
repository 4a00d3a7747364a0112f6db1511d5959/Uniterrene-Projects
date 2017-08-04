// validation start
j(document).ready(function(){
    // binds form submission and fields to the validation engine

    j("#loginFrm,#memberSignupFrm,#forgotPassword,#memberProfileFrm,#storyFrm").validationEngine('attach',{
       ajaxFormValidationMethod: 'post'
        /*autoHidePrompt: true,
        autoHideDelay:5000*/

    });

    j('input').attr('data-prompt-position','topRight');
    j('input').data('promptPosition','topRight');
    j('textarea').attr('data-prompt-position','topRight');
    j('textarea').data('promptPosition','topRight');
    j('select').attr('data-prompt-position','topRight');
    j('select').data('promptPosition','topRight');


    /*j('input').attr('data-prompt-position','bottomLeft');
     j('input').data('promptPosition','bottomLeft');
     j('select').attr('data-prompt-position','bottomLeft');
     j('select').data('promptPosition','bottomLeft');*/
});
// validation end

// General functions start
function generateSlug(field_id,Text)
{
    document.getElementById(field_id).value = Text.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');
}

function refresh_content(resultDiv, url)
{
    j.ajax
    ({
        /*beforeSend: function()
         {
         j('.ajax-loader').show();
         },
         complete: function(){
         j('.ajax-loader').hide();
         },*/
        type: "POST",
        url: url,
        cache: false,
        success: function(html)
        {
            j("#"+resultDiv).html(html);

        }
    });

}
// General functions end