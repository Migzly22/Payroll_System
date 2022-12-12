
const updateuser = document.getElementById("updateuser");
const successbtn = document.getElementById("successbtn")
const cancelbtn = document.getElementById("cancelbtn")

let fname = document.getElementById("fname")
let varfname = fname.value
let lname = document.getElementById("lname")
let varlname = lname.value
let mname = document.getElementById("mname")
let varmname = mname.value


updateuser.addEventListener('click',(e)=>{
    e.preventDefault()

    let bool1 = fname.disabled
    
    if(bool1) {
        fname.disabled = false;
        lname.disabled = false;
        mname.disabled = false;
        successbtn.disabled = false;
        cancelbtn.disabled = false;

        updateuser.disabled = true;

    }

})

cancelbtn.addEventListener("click",(e)=>{
    e.preventDefault()

    let bool1 = fname.disabled
    
    if(!bool1) {
        fname.disabled = true;
        fname.value = varfname
        lname.disabled = true;
        lname.value = varlname
        mname.disabled = true;
        mname.value = varmname
        successbtn.disabled = true;
        cancelbtn.disabled = true;

        updateuser.disabled = false;

    }

})


const cancelemail = document.getElementById("cancelemail")
const cancelpass = document.getElementById("cancelpass")

cancelemail.addEventListener('click',(e)=>{
    e.preventDefault()
    document.getElementById("email").value = ""
    document.getElementById("nemail").value = ""

})
cancelpass.addEventListener('click',(e)=>{
    e.preventDefault()
    document.getElementById("password").value = ""
    document.getElementById("npassword").value = ""

})