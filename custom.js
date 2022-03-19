function formatTime(time) {
    return (time < 10 ? "0" + time: time);
}

function updateWebTime() {
    var today = new Date();
    var time = formatTime(today.getHours()) + ":" + formatTime(today.getMinutes()) + ":" + formatTime(today.getSeconds());
    document.getElementById("time").innerHTML = time;
}

$(document).ready(function(){
    updateWebTime();
    setInterval(updateWebTime, 1000);
});

function changeColour(theme){
    if(theme === "dark")
    {
        document.getElementById("background").style.backgroundColor = "black";
        document.getElementById("background").style.color = "white";
    }
    else
    {
        document.getElementById("background").style.backgroundColor = "white";
        document.getElementById("background").style.color = "black";
    }    
}

var tasks = []

class Task{
    constructor(title, priority, description, isActive){
        this.title = title;
        this.priority = priority;
        this.description = description;
        if(isActive != "")
        {
            this.isActive = isActive;
        }
        else
        {
            this.isActive = true;
        }        
    }
}

function createTask()
{ 
    title = document.getElementById("title").value;
    priority = document.getElementById("priority").value;
    desc = document.getElementById("description").value;
    
    t = new Task(title,priority,desc);
    tasks.push(t)
    displayTasks()
}


function displayTasks() {
    var table = document.getElementById("tasks");
    table.innerHTML = "";
    var tableBody = document.createElement("tbody");

    for (var i = 0; i < tasks.length; i++) {
        // creates a table row
        var row = document.createElement("tr");

        var title = document.createElement("td");    
        var titleText = document.createTextNode("Title: "+tasks[i].title);
        title.appendChild(titleText);
        row.appendChild(title)

        var priority = document.createElement("td");    
        var pText = document.createTextNode("Priority: "+tasks[i].priority);
        priority.appendChild(pText);
        row.appendChild(priority)

        var desc = document.createElement("td");    
        var descText = document.createTextNode("Description: "+tasks[i].description);
        desc.appendChild(descText);
        row.appendChild(desc);

        // add the row to the end of the table body
        tableBody.appendChild(row);
    }
  
    // put the <tbody> in the <table>
    table.appendChild(tableBody);
  }
