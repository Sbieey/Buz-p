document.getElementById("submit").disabled = true;

function check_user(){
    var user_name = document.getElementById('uid').value ;
    
    //here we will send the data to (user_check.php) file

    $.post("sub_file/user_check.php" ,
    {
        user: user_name
    },
    
    //in here we will recieve data in this function
        function (data, status){
            if(data=='<p style="color:red">User already registered</p>'){
                document.getElementById("submit").disabled = true;
            }else{
                document.getElementById("submit").disabled = false;
            }
            document.getElementById("checking").innerHTML = data ;
        }
    );
}