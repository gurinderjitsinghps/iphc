const BASE_URL = 'http://'+window.location.host;
const formDataAppend = (selector) =>{
    var formData = new FormData();
    const formFields = $(''+selector+' input, textarea, select, file');
formFields.each((index, field) => {
  const name = $(field).attr('name');
  const value = $(field).val();

  // If the field is a file input, append the file itself.
  if (name !== undefined) {
    if (field.type === 'file' && field.files.length > 0) {
        for (let i = 0; i < field.files.length; i++) {
            console.log('ff',field.files[i]);
          formData.append(name, field.files[i]);
        }
      } else {
        if(value !=''){
    formData.append(name, value);
        }
  }
}
});
return formData;
}

const postReq = (e,urlPath,formSelector,extraFormData =false) => {
    let eHtml = e.html();
    let btnCont = e.parents('.btnCont');
    e.prop('disabled',true);
    e.html('loading..');
    // return false;
    let formData = formDataAppend(formSelector);


// Unset the key `table` from FormData
if(extraFormData){
    for (let obj of extraFormData) {
        // Loop through each key-value pair in the object using Object.entries()
        for (let [key, value] of Object.entries(obj)) {
            formData.append(key,value);
        //   console.log(`Key: ${key}, Value: ${value}`);
        }
      }
}
let dTable = false;
if(formData.has('dTable')){
 dTable = formData.get('dTable');
 formData.delete('dTable');
}
let bModal = false;
let bModalData = false;
if(formData.has('bModal')){
 bModal = formData.get('bModal');
 formData.delete('bModal');
}
if(formData.has('bModalData')){
 bModalData = formData.get('bModalData');
 formData.delete('bModalData');
}
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    // console.log(BASE_URL);
    let reqUrl = ""+BASE_URL+'/'+urlPath; 
    axios.post(reqUrl,formData,{
        headers: {
          "Content-Type": "multipart/form-data", // Important for file uploads
          'X-CSRF-TOKEN': csrfToken, // Include the CSRF token
        },
      })
    .then(response => {
        e.prop('disabled',false);
        e.html(eHtml);
        btnCont.find('.message').remove();
         console.log(response);
        if(response.data.errors){
            btnCont.prepend('<div class="message red">'+renderErrors(response.data.errors)+'</div>');
        }
        if(response.data.status && response.data.data){
            // console.log('mm',bModalData);

            if(bModalData){
                $(''+bModalData+'').modal('show'); 
                bModalRender(bModalData,response.data.data);
            }
        }
        if(response.data.status && response.data.message){
            btnCont.prepend('<div class="message green">'+(response.data.message)+'</div>');
            // formFields.val('');
          
            if(bModal){
                $(''+bModal+'').modal('hide'); 
                $(''+bModal+' input').val('');
                $(''+bModal+' img#preview').attr('src','');
                $(''+bModal+' .btnCont .message').remove();
            }
            if(dTable){
                $(dTable).DataTable().ajax.reload();
                
            }else{
            setTimeout(() => {
                window.location.reload();
         }, 2500);
        }
           
        }else{
            btnCont.prepend('<div class="message red">'+(response.data.message)+'</div>');
        }
    })
    .catch(error => {
        // Handle error, e.g., show an error message or log the error
        let res = error.response;
        // console.log('sss',error);
        e.prop('disabled',false);
        e.html(eHtml);
        btnCont.find('.message').remove();
        if(res && !res.data.status && res.data.errors){
            btnCont.prepend('<div class="message red">'+renderErrors(res.data.errors)+'</div>');
        }
    });
}
const bModalRender = (modal,data) => {
    console.log(data);
    if(data.membership_plans){
        $('#tmp-form-table tbody').html('');
    $.each(data.membership_plans, function(mk, mv) {
        console.log('mv',mv);
        $('#tmp-form-table tbody').prepend(' <tr><td><input type="text" name="plans['+mk+'][month]" class="form-control" value="'+mv.month+'" /></td><td><input type="text" name="plans['+mk+'][amount_min]" class="form-control" value="'+mv.amount_min+'" /></td><td><input type="text" name="plans['+mk+'][amount_max]" class="form-control" value="'+mv.amount_max+'" /></td><td><div class="ml-1 cp deletetcmp"  fid="'+mv.id+'"><span class="zmdi zmdi-delete text-danger icon-trash icons"></span></div></td></tr>');
        // $(modal).find('input[name='+k+']').val(v);
    });
}
    $.each(data, function(k, v) {
                console.log(k,v);
        if(k=='thumbnail' || k=='image'){
            $(modal).find('img#preview,.image-preview img').attr('src','/storage/'+v);
        }else{
            $(modal).find('input[name='+k+']').val(v);
        }
        
    });
}
function previewImage(inputFile) {
    if (inputFile && inputFile[0].files && inputFile[0].files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        inputFile.parents('.image-upload-box').find('.image-preview img').attr('src',e.target.result);
      };

      reader.readAsDataURL(inputFile[0].files[0]);
    }
  }

const renderErrors = (errors) => {
    let eHtml='';
    for (const fieldName in errors) {
        if (errors.hasOwnProperty(fieldName)) {
            const errorMessages = errors[fieldName];

            // $("<p>").text(`Field: ${fieldName}`).appendTo($fieldContainer);

            // Loop through the error messages for this field
            for (const errorMessage of errorMessages) {
                eHtml += `<div> ${errorMessage}</div>`;
            }
        }
    }
    return eHtml;
   }

   $(document).on('click','.closeaeModal', function(){
    $(this).parents('.modal').modal('hide');
  });
   $(document).on('click','.resetform', function(){
    resetForm($(this).parents('.modal').find('.modal-body'));
  });

  function resetForm(formSelector) {
    var form = $(formSelector);
  
    // Reset all input fields
    $("input, textarea, select", form).each(function() {
      var type = this.type;
      var tag = this.tagName.toLowerCase();
      switch (type) {
        case "text":
        case "password":
        case "email":
        case "number":
        case "textarea":
          this.value = "";
          break;
        case "checkbox":
        case "radio":
          this.checked = false;
          break;
        case "select-one":
          this.selectedIndex = 0;
          break;
        case "select-multiple":
          for (var i = 0; i < this.options.length; i++) {
            this.options[i].selected = false;
          }
          break;
      }
    });
  
    return form;
  }
  