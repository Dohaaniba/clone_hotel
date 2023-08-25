//scroll effect ou dakchi
ScrollReveal({
    reset: true,
    distance :'140px',
    duration: 2000,
    delay: 200
});
ScrollReveal().reveal('.title h1 , .info ,.Gallery h3 , .contact h3', { origin:'top'});
ScrollReveal().reveal('.title h3 ,.photo ,  .box , .formulaire2', { origin:'left'});
ScrollReveal().reveal('.landing-page h1', { origin:'top'});
ScrollReveal().reveal('.formulaire1 form,#container1 , .formulaire3 #textt', { origin:'right'});


// the response div
const check_available = document.getElementById('check');
const response = document.getElementById('response');
const response_close = document.getElementById('response-close');
const check_in = document.getElementById('date');
const check_out = document.getElementById('date2');


let check_in_value = check_in.value;
let check_out_value = check_out.value;
check_available.addEventListener('click', function() {
  if (check_in_value !== "" && check_out_value !== "") {
    response.style.display = 'flex';
  
  }  
});

response_close.addEventListener('click', function() {
  // setTimeout(function() {
  //   response.style.display = 'none';
  // }, 2000);
  response.style.display = 'none';

}); 

