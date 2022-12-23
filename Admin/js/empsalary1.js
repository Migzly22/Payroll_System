const specialtable = document.getElementById("specialtable");
specialtable.addEventListener('click',(e)=>{
    

    if (e.target.type != 'submit' && e.target.disabled != false){
        e.preventDefault();
        return true;
    }


    let thisid = e.target.id
    document.getElementById('magicthingyid').value = String(thisid)

    if (thisid.includes(":")) {
        document.getElementById('formprint').action = "./PHPS/empsalary.php";
        document.getElementById('paidid').click();
    }else {
        document.getElementById('formprint').target = "_blank";
        document.getElementById('formprint').action = "./Lazaro/getpdfprint.php";
        document.getElementById('printid').click();
    }
})
