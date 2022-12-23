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

    
    document.getElementById("leaved").value = "";
    document.getElementById("leavedur").value = "";
    document.getElementById("dol").value = "";
    const gender = document.querySelector('#status');
    gender[0].selected = true
    const position = document.querySelector('#empname');   
    position[0].selected = true

})


const specialtable = document.getElementById('specialtable');

specialtable.addEventListener('click', (e)=>{
    if(e.target.tagName != "INPUT" && e.target.tagName != "I"){
        e.preventDefault(); 
        return true
    } 


    let ids;
    if (e.target.tagName == "I") {
        ids = e.target.parentElement.id
    }else{
        ids = e.target.id
    }

    document.getElementById('deletethisid1').value = ids;
    //alert(e.target.type)//button
})



