var source, chattext, prevLine, last_data, chat_btn, conx_btn, disconx_btn, text;
var xr = new XMLHttpRequest();
text = document.getElementById("text");
chattext = document.getElementById("chattext");
peopletext = document.getElementById("peopletext");
modalOpen = false;


function sendChallenge(foe, player){
    xr.open("POST", "/Models/challenge_model.php");
    xr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xr.send("foe="+foe+"&player="+player);
}

function cancelChallenge(){
    xr.open("POST", "/Models/challenge_model.php");
    xr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xr.send("action=cancel");
}


function openModal(){
    if (!modalOpen) {
        toggleModal()
        modalOpen = true;
    }
}

function openmodal(){
for (var i = 0; i < openmodal.length; i++) {
  openmodal[i].addEventListener('click', function(event){
    event.preventDefault()
    toggleModal()
    modalOpen = true;
  })
}
}

const overlay = document.querySelector('.modal-overlay')
overlay.addEventListener('click', toggleModal)

var accept = document.querySelectorAll('.modal-accept')
for (var i = 0; i < accept.length; i++) {
    accept[i].addEventListener('click', function(event){
        beginChallenge()
    })
}

var closemodal = document.querySelectorAll('.modal-close')
for (var i = 0; i < closemodal.length; i++) {
  closemodal[i].addEventListener('click', function(event){ 
    cancelChallenge()  
    toggleModal()
    modalOpen = false;
  })
}

document.onkeydown = function(evt) {
  evt = evt || window.event
  var isEscape = false
  if ("key" in evt) {
    isEscape = (evt.key === "Escape" || evt.key === "Esc")
  } else {
    isEscape = (evt.keyCode === 27)
  }
  if (isEscape && document.body.classList.contains('modal-active')) {
    toggleModal()
    modalOpen = false;
  }
};


function toggleModal () {
  const body = document.querySelector('body')
  const modal = document.querySelector('.modal')
  modal.classList.toggle('opacity-0')
  modal.classList.toggle('pointer-events-none')
  body.classList.toggle('modal-active')
}