var lname = document.getElementById('lname')
var fname = document.getElementById('fname')

fname.addEventListener("input",()=>{
    fname.value = fname.value.toUpperCase();
})
lname.addEventListener("input",()=>{
    lname.value = lname.value.toUpperCase();
})


function requiredpattern(event){
    return /[A-Za-z ]/i.test(event.key)
}