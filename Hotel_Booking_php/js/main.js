var pic1 = document.getElementById("A1");
pic1.addEventListener("mouseover",showPopup1);
pic1.addEventListener("mouseout",hidePopup1);

var pic2 = document.getElementById("A2");
pic2.addEventListener("mouseover",showPopup2);
pic2.addEventListener("mouseout",hidePopup2);

var pic3 = document.getElementById("A3");
pic3.addEventListener("mouseover",showPopup3);
pic3.addEventListener("mouseout",hidePopup3);

var pic4 = document.getElementById("A4");
pic4.addEventListener("mouseover",showPopup4);
pic4.addEventListener("mouseout",hidePopup4);


function hidePopup1() {
    document.getElementById("pop1").style.visibility = "hidden";
}

function showPopup1() {
    document.getElementById("pop1").style.visibility = "visible";
}

function hidePopup2() {
    document.getElementById("pop2").style.visibility = "hidden";
}

function showPopup2() {
    document.getElementById("pop2").style.visibility = "visible";
}

function hidePopup3() {
    document.getElementById("pop3").style.visibility = "hidden";
}

function showPopup3() {
    document.getElementById("pop3").style.visibility = "visible";
}

function hidePopup4() {
    document.getElementById("pop4").style.visibility = "hidden";
}

function showPopup4() {
    document.getElementById("pop4").style.visibility = "visible";
}

function validateLoginForm(){
    var regExUsername = /^(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$/;
    var regExPw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,30}$/;
    
    var usernameinput = document.forms["formlogin"]["username"].value;
    var passwordinput = document.forms["formlogin"]["password"].value;
    
    if (usernameinput === "") {
        alert('Please insert username');
        return false;
    }
    else {
        if (!regExUsername.test(usernameinput)){
            alert('Username is invalid. Please re-enter');
            return false;
        }
    }
    
    if (passwordinput === "") {
        alert('Please insert Password');
        return false;
    }
    else {
        if (!regExPw.test(passwordinput)){
            alert('Password is invalid. Please re-enter. Requires 1 digit, 1 lower case, 1 upper case, min 8 characters');
            return false;
        }
    }
    
}

function validateForgetPasswordForm()
{
    var regEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var emailinput = document.forms["formforgetpass"]["email"].value;
    
    if (emailinput === "") {
        alert('Please insert your email address');
        return false;
    }
    else {
        if (!regEmail.test(emailinput)){
            alert('Email is invalid. Please re-enter');
            return false;
        }
    }
}

