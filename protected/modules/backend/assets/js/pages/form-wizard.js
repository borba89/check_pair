var buttonLabel = 'Сохранить';
$( document ).ready(function() {
    var form = $("#blog-article-form");
    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "fade",
        labels:
        {
            finish: buttonLabel,
            next: "Продолжить",
            previous: "Назад"
        },
        onStepChanging: function (event, currentIndex, newIndex)
        {
            var data = checkErrors(currentIndex);
            var obj = $.parseJSON(data);

            if (typeof(obj.type) != 'undefined') { // data[0] != '[' && data[0] != '{'
                if (obj.type == 'image') {
                    $('.image_add').html(obj.content);
                } else if (obj.type == 'preview') {
                    $('.preview .wizardTerms').html(obj.content);
                    $('.slider').slider();
                }
                return true;
            }
            return data.length == 2 ? true : false;
        },
        onFinishing: function (event, currentIndex)
        {
            submitWizard();
        },
        onFinished: function (event, currentIndex)
        {
            alert("Submitted!");
        }
    });
    
    $(".wizard .actions ul li a").addClass("waves-effect waves-blue btn-flat");
    $(".wizard .steps ul").addClass("tabs z-depth-1");
    $(".wizard .steps ul li").addClass("tab");
    $('ul.tabs').tabs();
    $('select').material_select();
    $('.select-wrapper.initialized').prev( "ul" ).remove();
    $('.select-wrapper.initialized').prev( "input" ).remove();
    $('.select-wrapper.initialized').prev( "span" ).remove();
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
    });

    $(".realty-content #Realty_type").on('change', function () {
        var val = $(this).val();

        $.ajax({
            url: '/realty/realty/addDetailDescription',
            dataType: 'json',
            type: 'GET',
            data: {type: val},
            success: function (data) {
                $('#steps-uid-0-p-1').html(data.responce);
                $('select').material_select();
            }
        });
        return false;
    });

    $(".realty-offer-video-delete").on('click', function (event) {
        event.preventDefault();
        var url = this.href;

        $.ajax({
            url: url,
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                if(data.success == 1){
                    $('.for-del-'+data.id).remove();
                }else {
                    console.log(data.error);
                }
            }
        });
        return false;
    });
});

function formErrors(data,form) {
    var summary = '';
    summary="<p>Please solve following errors:</p>";

    $('.help-block.error').hide();//css({display:'none'});
    $('.help-block.error').text('');

    $.each(data, function(key, val) {
        $(form+" #"+key+"_em_").html(val.toString());
        $(form+" #"+key+"_em_").show();

        $("#"+key).parent().addClass("error");
        summary = summary + "<ul><li>" + val.toString() + "</li></ul>";
    });
    $(form+"_es_").html(summary.toString());
    $(form+"_es_").show();
}

function hideFormErrors(form) {
    $(form+"_es_").html('');
    $(form+"_es_").hide();
    $("[id$='_em_']").html('');
}
