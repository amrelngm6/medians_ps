//Wizard Init
var form = $("#setup-form");
function submitForm(currentIndex)
{
    var actionurl = form.attr('action');

    let request = form.serialize() + '&step='+currentIndex;
    return  $.ajax({
        url: actionurl,
        type: 'post',
        dataType: 'json',
        data: request,
        error: response => {
        },
        success: response => {
            console.log(response)
            if (response.error)  {
                alert(response.error);
                $("#wizard").steps('previous');
            } else {
                return response;
            }
            // body...
        }
    });
}


$("#wizard").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "none",
    stepsOrientation: "vertical",
    titleTemplate: '<span class="number">#index#</span>',
    onStepChanging: function (event, currentIndex, newIndex) { 
        
        (currentIndex && currentIndex < newIndex) ? submitForm(currentIndex) : null
        
        return true;
    },
    onFinished: function(event, currentIndex) {
        window.location.href = '../';
    },
    
});

//Form control
