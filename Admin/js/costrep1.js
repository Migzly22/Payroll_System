const specialtable = document.getElementById("specialtable");
specialtable.addEventListener('click',(e)=>{
    

    if (e.target.type != 'submit' && e.target.disabled != false){
        e.preventDefault();
        return true;
    }

    let thisid = e.target.id
    document.getElementById('magicthingyid').value = String(thisid)

    document.getElementById('formprint').action = "./Lazaro/getpdfprint.php";
    document.getElementById('costrepprintid').click();
    
})