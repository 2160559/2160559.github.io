function checkname()
{
    var name=document.getElementById( "UserName" ).value;

    if(name)
    {
        $.ajax({
            type: 'post',
            url: 'includes/checkdata.php',
            data: {
                user_name:name,
            },
            success: function (response) {
                $( '#name_status' ).html(response);
                return response === "#2713";
            }
        });
    }
    else
    {
        $( '#name_status' ).html("");
        return false;
    }
}

function checkmail()
{
    let email=document.getElementById( "UserEmail" ).value;

    if(email)
    {
        $.ajax({
            type: 'post',
            url: 'includes/checkdata.php',
            data: {
                user_email:email,
            },
            success: function (response) {
                $( '#email_status' ).html(response);
                return response === "#2713";
            }
        });
    }
    else
    {
        $( '#email_status' ).html("");
        return false;
    }
}
