const Addemp = document.getElementById("Addemp")
const magic_opener = document.getElementsByClassName("magic_opener")[0]
const cancel = document.getElementById("cancel")

Addemp.addEventListener('click',(e)=>{
    e.preventDefault();
    magic_opener.style.display = "block"
});

cancel.addEventListener("click",(e)=>{
    e.preventDefault();
    magic_opener.style.display = "none"

    
    document.getElementById("fname").value = "";
    document.getElementById("lname").value = "";
    document.getElementById("mname").value = "";
    document.getElementById("dob").value = "";
    document.getElementById("email").value = "";
    document.getElementById("phone").value = "";
    document.getElementById("address").value = "";
    document.getElementById("deleteid").disabled = true;
    const gender = document.querySelector('#gender');
    gender.value = 'MALE'
    const position = document.querySelector('#position');   
    position.value = 'EMPLOYEE'

})