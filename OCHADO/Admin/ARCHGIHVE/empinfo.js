const Addemp = document.getElementById("Addemp")
const magic_opener = document.getElementsByClassName("magic_opener")[0]
const cancel = document.getElementById("cancel")

Addemp.addEventListener('click',(e)=>{
    e.preventDefault();
    magic_opener.style.display = "block"
    document.getElementById("headerbox").innerHTML = "Adding Employee";
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
    const gender = document.querySelector('#gender');
    gender.value = 'Male'
    const position = document.querySelector('#position');   
    position.value = 'Employee'

})

var table = document.getElementsByTagName("table")[0];
table.addEventListener("click", (e)=>{
    e.preventDefault()

    let thisid = ""
    if (e.target.tagName == "I") {
        thisid = e.target.parentElement.id

    }else if (e.target.tagName == "BUTTON"){
        thisid = e.target.id
    }else{
        return 0
    }

    let emailTr = table.rows[parseInt(thisid)];
    //let emailTd = emailTr.cells[9].innerHTML;

    document.getElementById("fname").value = emailTr.cells[9].innerHTML;
    document.getElementById("lname").value = emailTr.cells[10].innerHTML;
    document.getElementById("mname").value = emailTr.cells[11].innerHTML;
    document.getElementById("dob").value = emailTr.cells[1].innerHTML;
    document.getElementById("address").value = emailTr.cells[3].innerHTML;
    document.getElementById("email").value = emailTr.cells[4].innerHTML;
    document.getElementById("phone").value = emailTr.cells[5].innerHTML;
    const gender = document.querySelector('#gender');
    gender.value = emailTr.cells[2].innerHTML
    const position = document.querySelector('#position');   
    position.value = emailTr.cells[6].innerHTML

    //document.getElementById("ids").value = emailTr.cells[12].innerHTML;
    //alert(emailTr.cells[12].innerHTML)
    alert(1234)


    magic_opener.style.display = "block"
    document.getElementById("headerbox").innerHTML = "Edit Employee";
})

