$(init);

var url;
var sessionTok;

function init() {

    if($(document).attr('title') == "Jadu Heart | Admin Panel"){
        refreshData("subscriber");
        refreshData("dimension");
    } else {
        sessionStart();
    }

    $('#adminLoginButton').click(function(){
        if(validateForm("adminLogin") == true) {
            $.ajax("php/login.php", {
                method: "POST",
                data: {
                    username : $('#username').val(),
                    password : $('#password').val(),
                    t : sessionTok
                },
                success: function(data) {
                    if(data == "logged in"){
                        window.location.replace("core.php");
                    }
                },
                error: function(error) {
                    console.log(error);
                    // Log the error, show an alert, whatever works for you
                }
            });
        }
    });

    $('#addDimensionViewButton').click(function() {
        showDimensionAddView();
    });

    $('#closeDimension').click(function() {
        showDimensionAddView();
    });

    $('#addDimension').click(function() {
        var dimensionType = $("input[name='dimensionType']:checked").val();
        if(validateForm("newDimension") == true){
            $.ajax("php/addDimension.php", {
                method: "POST",
                data: {
                    title : $('#title').val(),
                    body : $('#body').val(),
                    dimensionType : dimensionType
                },
                success: function(data) {
                },
                error: function(error) {
                    console.log(error);
                    // Log the error, show an alert, whatever works for you
                }
            }).done(uploadImage());
        }
    });
}

// function checkAdminLog() {
//     var result = "false";
//     $.ajax ("php/checkLoginStatus.php",{
//         method: "GET",
//         success: function(data) {
//             if (data == "true") {
                
//             } else {
//                 window.location.replace("core.html");
//             }
//         }
//     }).done(function(data){
//         result = data;
//         console.log(result);
//         return result;
//     });
// }

function sessionStart() {

    startTime = new Date().valueOf();
    
	$.ajax ("php/login.php",{
        method: "POST",
        data: { session : "setSession" },
        success: function(data) {
            sessionTok = data
        }
    });

    console.log(sessionTok);
}

function refreshData(type) {

    if (type === "subscriber"){
        url = "php/refreshData.php?type=subscriber";
    } else if (type === "dimension") {
        url = "php/refreshData.php?type=dimension";
    } else {
        return;
    }

    $.ajax(url, {
        method: "GET",
        success: function(data) {
            $('#'+ type +'List').html(data)
        },
        error: function(error) {
            console.log(error);
            // Log the error, show an alert, whatever works for you
        }
    });
}

function showDimensionAddView() {
    if ($('#addDimensionView').hasClass('show')){
        $('#addDimensionView').removeClass('show');
    } else {
        $('#addDimensionView').addClass('show');
    }
}

function validateForm(form) {
    var status = true;
    $("#" + form + " > input").each(function(){
        if ($(this).val() == ""){
            $(this).css("border", "1px solid red");
            status = false;
        }
    });

    return status
}

function removeItem(type, id) {

    $.ajax("php/removeItem.php", {
        method: "POST",
        data: {type : type, id : id},
        success: function() {
            $('#'+type+id).remove();
        },
        error: function(error) {
            console.log(error);
            // Log the error, show an alert, whatever works for you
        }
    });
}

function uploadImage() {
    if(imageIsSet() == true){
        var ajaxData = new FormData($("#imageUpload")[0]);
        $.ajax("php/addDimension.php", {
            method: "POST",
            processData: false,
            contentType: false,
            data: ajaxData,
            success: function(data) {
            },
            error: function(error) {
                console.log(error);
                // Log the error, show an alert, whatever works for you
            }
        });
    }
}

function imageIsSet() {
    return true;
}
