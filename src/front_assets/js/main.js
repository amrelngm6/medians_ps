function handleResponse(res)
{
    (res.error ) 
    ? Swal.fire('Error!',res.result, 'error')
    : (Swal.fire(res.title,res.result,  'success'), res.reload ? window.location.reload() : form.reset() );

}

jQuery(document).on('click', '.addQty', function(e){
    let qty = jQuery(e.target).parent().find('input').val();
    jQuery(e.target).parent().find('input').val(++qty);
});

jQuery(document).on('click', '.minusQty', function(e){
    let qty = jQuery(e.target).parent().find('input').val();
    jQuery(e.target).parent().find('input').val((--qty) ? qty : 1);
});

jQuery(document).on('change', 'input', function(e){
    setTimeout(() => {
        jQuery(e.target).data('element') ? submitForm(jQuery(e.target).data('form'), jQuery(e.target).data('element'), ) : null;
    }, 100);
});

jQuery(document).on('submit', '.ajax-form', function(e){
    e.preventDefault();
    submitForm(e.target.id);
});

jQuery(document).on('click', '.ajax-link', function(e){
    e.preventDefault();
    let data = jQuery(this).data('params');
    let path = jQuery(this).attr('href');
    submitLink(path, data);
});

function submitForm(formId, elementId) {
    // Get the form and submit button elements
    const form = document.getElementById(formId);
    const element = document.getElementById(elementId);

    if (!form)
        return null;


    // Get the form data as a FormData object
    const formData = new FormData(form);

    // Send the form data via AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('POST', form.action, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          // Handle the successful response 
          try {
                
            let res = JSON.parse(xhr.responseText);

            handleResponse(res)

          } catch (error) {
            element.innerHTML = xhr.responseText;
          }

        } else {
            element.innerHTML = xhr.responseText;
        }
    };
    xhr.send(new URLSearchParams(formData).toString());
}


// Submit Ajax request
function submitLink(path, data) {
    $.ajax({
      url: path,
      type: 'POST',
      dataType: 'JSON',
      contentType: 'application/json',
      data:  JSON.stringify({params: data}), // Your data to send
      processData:false,
      success: function(data) {
        // Update your UI with the new data
            handleResponse(data)
      },
      error: function(xhr, status, error) {
        console.error('Error fetching data:', error);
      }
    });
  }
  