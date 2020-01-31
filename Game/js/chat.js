var source, chattext, prevLine, last_data, chat_btn, conx_btn, disconx_btn, text;
var xr = new XMLHttpRequest();
text = document.getElementById("text");
chattext = document.getElementById("chattext");
peopletext = document.getElementById("peopletext");
modalOpen = false;

function connect(){
    scrollSmoothToBottom("chattext");

    if(window.EventSource){
        //gets chat
        source = new EventSource("/Models/lobbychatin_model.php");
        source.addEventListener("message", function (event){
            if(event.data != last_data && event.data != ""){
                chattext.innerHTML = event.data;
                scrollSmoothToBottom("chattext");
            }
            last_data = event.data;
        });
    } else {
        alert("Please use a modern browser, your browser is outdated");
    }
}

function sendChat(username, room){
    xr.open("POST", "/Models/chat_model.php");
    xr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xr.onreadystatechange = function(){
        if(xr.readyState == 4 & xr.status == 200){
            text.value = "";
        }
    }
    xr.send("text="+text.value+"&room="+room+"&username="+username);
}

function scrollToBottom (id) {
   var div = document.getElementById(id);
   div.scrollTop = div.scrollHeight - div.clientHeight;
}

function scrollSmoothToBottom (id) {
   var div = document.getElementById(id);
   $('#' + id).animate({
      scrollTop: div.scrollHeight - div.clientHeight
   }, 500);
}

const node = document.getElementsByClassName("textInput")[0];
node.addEventListener("keyup", function(event) {
    if (event.key === "Enter") {
        sendChat(player,gameId);
    }
});