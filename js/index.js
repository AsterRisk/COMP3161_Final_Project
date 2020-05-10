window.onload = function(){
    /*var address = document.getElementById("register_address").value;
    var bday = document.getElementById("register_birthday").value;*/
    
    var regBttn = document.getElementById("register-button");
    regBttn.addEventListener("click", function(event){
        console.clear();
        let pFlag = false;
        let eFlag = false;
        let tFlag = false;
        let dFlag = flase;
        let today = new Date();
        let empFlag = false;
        var email = document.getElementById("register_email").value;
        var user_dob = document.getElementById("register_birthday");
        var pass1 = document.getElementById("register_password").value;
        var pass2 = document.getElementById("double_register_password").value;
        var tele = document.getElementById("register_tele").value;
        var secretField = document.getElementById("secret-field").value;
        var email_regex = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
        var tele_regex = /^[(]{0,1}\d{3}[)]{0,1}\d{3}[-]{1}\d{4}$/;
        console.log(secretField);
        console.log("FRESH RUN");
        console.log("password: " + pass1);
        console.log("password-re: " + pass2);
        if (pass1 != pass2)
        {
            pFlag = true;
            console.log("Hey password");
            
        }
        if(email_regex.test(email) != true)
        {
            eFlag = true;
            //console.log(eFlag)
            console.log(email_regex);
        }
        if(tele_regex.test(tele) != true)
        {
            console.log(tele_regex);
            tFlag = true;
            //console.log(tFlag);
        }
        if(user_dob > now)
        {
            dFlag = true;
        }
        //console.log("Hey password");
        //console.log("PFLAG: " + pFlag);
        //console.log("EFLAG: " + eFlag);
        //console.log("TFLAG: " + tFlag);

        var regFields = document.getElementsByClassName("registration");
        for (var x=0;x<regFields.length-1;x++)
        {
            console.log(regFields[x].value);
            if (regFields[x].value === "")
            {
                empFlag = true;
            } 
        }

        if (empFlag)
        {
            alert("Error. Please fill in all the fields.");
            event.preventDefault();
        }
        if(tFlag)
        {
            alert("Error. Please enter your telephone number in the format '(XXX)XXX-XXXX'.");
            event.preventDefault();
        }
        if(pFlag)
        {
            alert("Error. The passwords do not match.");
            event.preventDefault();
        }
        if(eFlag)
        {
            alert("Error. Please enter an actual email address.");
            event.preventDefault();
        }
        if (dFlag)
        {
            alert("Error. New users can't be born in the future.");
            event.preventDefault();
        }
        if(secretField !== "6eb6ac241942dc7226aeb")
        {
            alert("Tampering attempt detected. Form has not been submitted.");
            window.location.href = 'https://google.com';
            event.preventDefault();
        }
        
        
        
    });
}