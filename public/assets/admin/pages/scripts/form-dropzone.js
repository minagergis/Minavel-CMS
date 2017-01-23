var FormDropzone = function () {


    return {
        //main function to initiate the module
        init: function () {  

            Dropzone.options.myDropzone = {
                dictDefaultMessage: "",
                init: function() {
                    
                    this.on("success", function(file, responseText) {
                      console.log(responseText.guid);
                        $('.media').prepend('<div class="col-md-2 col-sm-2 col-xs-3"><a data-toggle="modal" data-number="'+responseText.number+'" href="#media-full" class="media-data"><img class="img-responsive" src="http://'+location.hostname+'/laracms/public/uploads/thumbnail/'+responseText.guid+'" /></a></div>')
                    });
/*
                    this.on("addedfile", function(file) {
                        // Create the remove button
                        var removeButton = Dropzone.createElement("<a href='javascript:;'' class='btn red btn-sm btn-block'>Remove</a>");
                        
                        // Capture the Dropzone instance as closure.
                        var _this = this;

                        // Listen to the click event
                        removeButton.addEventListener("click", function(e) {
                          // Make sure the button click doesn't submit the form:
                          e.preventDefault();
                          e.stopPropagation();

                          // Remove the file preview.
                          _this.removeFile(file);
                          // If you want to the delete the file on the server as well,
                          // you can do the AJAX request here.
                        });

                        // Add the button to the file preview element.
                        file.previewElement.appendChild(removeButton);
                    });
*/
                }            
            }
        }
    };
}();

jQuery(document).ready(function() {    
   FormDropzone.init();
});