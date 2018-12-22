$(init);

var exsistingDimensions = ["7", "4"];

function init() {
    $('#submitEmail').click(function() {
        subscribeUser($('#emailInput').val());
    });

    if($(document).attr('title') == "Jadu Heart | 7 Dimensions"){
        getDimensions();
    }
}

function subscribeUser(userEmail) {
    console.log(userEmail);
    if(validEmail()){
        $.ajax("php/addSubscriber.php", {
            method: "POST",
            data: "email=" + userEmail,
            success: function() {
                alert('Thank you!');
            },
            error: function(error) {
                console.log(error);
                // Log the error, show an alert, whatever works for you
            }
        });
    }
}

function validEmail() {
    return true;
}

function getDimensions(){
    $.ajax("php/getDimensions.php", {
        method: "GET",
        success: function(data) {
            $('body').html(data);
        },
        error: function(error) {
            console.log(error);
            // Log the error, show an alert, whatever works for you
        }
    });
}
    
function showDimension(dimension){

    $('.dimensionContent').hide();
    $('#Dimension'+ dimension).show();
    $('#dimensionContainer').show();
    
}

function hideDimension() {
    $('#dimensionContainer').hide();
}