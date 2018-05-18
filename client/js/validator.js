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
                return response === "OK";
            }
        });
    }
    else
    {
        $( '#name_status' ).html("");
        return false;
    }
}

function checkemail()
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
                return response === "OK";
            }
        });
    }
    else
    {
        $( '#email_status' ).html("");
        return false;
    }
}

function checkall()
{
    var namehtml=document.getElementById("name_status").innerHTML;
    var emailhtml=document.getElementById("email_status").innerHTML;

    if((namehtml && emailhtml)==="OK")
    {
        return true;
    }
    else
    {
        return false;
    }
}