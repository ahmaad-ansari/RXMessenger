//=================================================================================================================
// Updates greeting on webpage based on time of day
//=================================================================================================================
greeting();

function greeting(){
    var today = new Date();
    var timeH = today.getHours();
    const greeting = document.getElementById("greeting");

    if(timeH >= 4 && timeH <= 11){
        greeting.innerHTML = "<i class='fa-solid fa-sun'></i> Good Morning";
    }
    else if(timeH >= 12 && timeH <= 16){
        greeting.innerHTML = "<i class='fa-solid fa-cloud-sun'></i> Good Afternoon";
    }
    else if(timeH >= 17 && timeH <= 21){
        greeting.innerHTML = "<i class='fa-solid fa-cloud-moon'></i> Good Evening";
    }
    else{
        greeting.innerHTML = "<i class='fa-solid fa-moon'></i> Good Night";
    }
}
//=================================================================================================================