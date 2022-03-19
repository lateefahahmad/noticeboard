function changeColour(theme){
    if(theme === "dark")
    {
        document.getElementById("background").style.backgroundColor = "black";
        document.getElementById("background").style.color = "white";
    }
    else
    {
        document.getElementById("background").style.backgroundColor = "cadetblue";
        document.getElementById("background").style.color = "black";
    }    
}
