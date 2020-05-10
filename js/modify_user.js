//Important stuff, class = "user_data" | email = change_email | tele = change_tele
window.onload = function () {
    var submitBttn = document.getElementById("makeChanges");
    submitBttn.addEventListener("click", function(event){
        console.clear()
        let eFlag = false;
        let tFlag = false;
        let empFlag = false;
        let dFlag = false;
        let email = document.getElementById("change_email").value;
        let tele = document.getElementById("change_tele").value;
        let dob = document.getElementById("change_dob").value;
        let today = new Date();
        let formatted_today = today.getFullYear() + "-" + (today.getMonth()+1) + "-" + today.getDate();
        let email_regex = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
        let tele_regex = /^[(]{0,1}\d{3}[)]{0,1}\d{3}[-]{1}\d{4}$/;
        //console.log(email);
        //console.log(tele);
        console.log(dob);
        console.log(formatted_today);
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
        var regFields = document.getElementsByClassName("registration");
        for (var x=0;x<regFields.length-1;x++)
        {
            console.log(regFields[x].value);
            if (regFields[x].value === "")
            {
                empFlag = true;
            } 
        }
        if (dob > formatted_today)
        {
            dFlag = true;
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
    });
}
