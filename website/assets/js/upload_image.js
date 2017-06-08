var abc = 0; //Declaring and defining global increement variable

$(document).ready(function() {

//following function will executes on change event of file input to select different file
$('body').on('change', '.upload_main_imagem', function(){
            if (this.files && this.files[0]) {
                abc += 1; //increementing global variable by 1
				
		var z = abc - 1;
                //var x = $(this).parent().find('#previewimg' + z).remove();
		$(this).parent().find(".glyphicon").remove();
		$(this).parent().find("#imageHelper").remove();
		$(this).parent().find("img").remove();
               	$(this).before("<img style='max-height: 190px;' id='previewimg" + abc + "' class='col-xs-12' src=''/>");
               	
			    var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
               
			    $(this).hide();
                $("#abcd"+ abc).append($("<img/>", {id: 'img', src: 'x.png', alt: 'delete'}).click(function() {
                $(this).parent().parent().remove();
                }));
            }
        });
	
$('body').on('change', '.upload_imagem', function(){
            if (this.files && this.files[0]) {
                 abc += 1; //increementing global variable by 1
				
				var z = abc - 1;
                //var x = $(this).parent().find('#previewimg' + z).remove();
		$(this).parent().find(".glyphicon").remove();
		$(this).parent().find("#imageHelper").remove();
		$(this).parent().find("img").remove();
		$(this).before("<img class='col-xs-12' style='max-height: 80px;' id='previewimg" + abc + "' src=''/>");
               	
			    var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
               
			    $(this).hide();
                $("#abcd"+ abc).append($("<img/>", {id: 'img', src: 'x.png', alt: 'delete'}).click(function() {
                $(this).parent().parent().remove();
                }));
            }
        });

//To preview image     
    function imageIsLoaded(e) {
        $('#previewimg' + abc).attr('src', e.target.result);
    };

    $('#upload').click(function(e) {
        var name = $(":file").val();
        if (!name)
        {
            alert("First Image Must Be Selected");
            e.preventDefault();
        }
    });
});
