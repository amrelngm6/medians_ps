    

function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
  ev.preventDefault();
  var data = ev.dataTransfer.getData("text");
  ev.target.appendChild(document.getElementById(data));
}

    function handleResponse(html)
    {
        if (html.success)
        {
            
            (html.reload) ? window.location.reload() : '';

            (html.redirect) ? (window.location.href = html.redirect) : '';

            Swal.fire({ title: html.result, confirmButtonClass: "btn btn-primary text-white text-md px-4 py-2", buttonsStyling: !1 })

        } else if (html.error) {
            
            Swal.fire({ title: html.result, confirmButtonClass: "btn btn-danger text-white text-md px-4 py-2", buttonsStyling: !1 })

        } else  {
            return null;
        }
    }


    function setDigits(val) 
    {
        return (val > 9) ? val : "0" + val;
    }

    function printDiv(divId) 
    {

        var divToPrint=document.getElementById(divId);

        var newWin=window.open('','Print-Window');

        newWin.document.open();

        newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

        newWin.document.close();

        setTimeout(function(){newWin.close();},10);

    }

    function countDown(id, time = 0) {

        var countDownDate = new Date(time).getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            // var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // if (!hours && !minutes && !seconds)
            if (distance < 1) 
            {
                document.getElementById(id).innerHTML =  'Done'; 
                return 1;
            }

            // Output the result in an element with id="demo"
            document.getElementById(id).innerHTML =  ((hours > 0) ? setDigits(hours) + " : "  : '') 
            + 
            + setDigits(minutes) 
            + " : " 
            + setDigits(seconds);
            
            // If the count down is over, write some text 
        }, 1000);

    }

    
    jQuery(document).ready(function(e){

        var x = document.getElementsByClassName("counter-down");
        var i;
        for (i = 0; i < x.length; i++) {
            countDown(jQuery(x[i]).attr('id'), jQuery(x[i]).attr('data-time'));
        }
        
    });


    jQuery(document).on('click', 'a', function(e){
        e.preventDefault();
        if (jQuery(this).attr('data-ajax'))
        {
            if (jQuery(this).attr('data-confirm'))
            {

                var msg = confirm('Are you sure ?');

                if (!msg)
                {
                    return 'canceled';
                }
                
            }
            
            if (jQuery(this).attr('data-type') && jQuery(this).attr('data-type') == 'post')
            {
                let postURL = jQuery(this).attr('href') != '#!' ? jQuery(this).attr('href') : '{{app.CONF.url}}'; 

                $.ajax({
                    url: postURL,
                    type: "POST",             
                    data: {
                     type: jQuery(this).attr('data-request-type'),
                     params: { 
                        id: jQuery(this).attr('data-request-id'),
                        type: jQuery(this).attr('data-request-type')
                        },
                    },
                    dataType: "json",
                    success: function(html) 
                    {
                        handleResponse(html);
                    }
                });

            } else {

                $.get( jQuery(this).attr('href'), function( data ) {
                    console.log(data);
                    jQuery( "#main-forms-container" ).html( data );
                });
            }
        } else {
            window.location.href = jQuery(this).attr('href');
        }
    });



    jQuery(document).on('submit','form.disable', function(e){
        e.preventDefault();
    });

    jQuery(document).on('submit','form#redirect-form', function(e){
        e.preventDefault();

        if (jQuery(this).find('#redirect-value').val())
        {
            window.location.href =  '{{app.CONF.url}}' + jQuery(this).attr('data-redirect') + jQuery(this).find('#redirect-value').val();
        }
    });

    jQuery(document).on('submit','form#add-device-form, .ajax-form', function(e){
        e.preventDefault();

        let action = $(this).attr('action');

        $.ajax({
            url: action,
            type: "POST",             
            data: new FormData(this),
            dataType: "json",
            contentType: false,       
            cache: false,             
            processData:false, 
            success: function(html) 
            {
                handleResponse(html);

            }
        });
    });


    jQuery(document).on('click','.ToggleItem', function(e){
        jQuery(jQuery(this).attr('data-toggle-target')).toggleClass(jQuery(this).attr('data-toggle-class'));
    });

