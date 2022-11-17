const eye = document.getElementById("eye")
const pass = document.getElementById('passwordid')

eye.addEventListener("click",(e)=>{

    if (pass.getAttribute("type") == "text"){
        pass.setAttribute("type","password")
    }else{
        pass.setAttribute("type","text")
    }
})