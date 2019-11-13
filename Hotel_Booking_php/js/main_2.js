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