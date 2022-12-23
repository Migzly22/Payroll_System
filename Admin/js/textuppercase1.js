let magic_opener1 = document.getElementsByClassName("magic_opener")[0]


magic_opener1.addEventListener('input',(e)=>{
    let texttype = e.target.type

    if(texttype != "text") {
        if( texttype != "email") {
            return true;
        }
    }
    e.target.value = e.target.value.toUpperCase();
})

