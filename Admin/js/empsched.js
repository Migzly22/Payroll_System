
const magic_opener = document.getElementsByClassName("magic_opener")[0]
const cancel = document.getElementById("cancel")

cancel.addEventListener("click",(e)=>{
    e.preventDefault();
    magic_opener.style.display = "none"

    // reset the value of every time ranges
    for (let i = 2; i < 16; i++) {
        document.getElementsByTagName("input")[i].value = "";
    }
    document.getElementById("empid").value = "";

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

    magic_opener.style.display = "block"
    document.getElementById("empid").value = thisid;

    let specialval = thisid+"row"
    let rowsearch = document.getElementById(specialval)



    document.getElementById("headerbox").innerHTML = rowsearch.cells[0].innerHTML;
    let j = 1;

    for (let i = 2; i < 16; i+=2) {
        if (rowsearch.cells[j].innerHTML != "OFF") {
            let containerval = rowsearch.cells[j].innerHTML
            let timearr = containerval.split(" - ");
            document.getElementsByTagName("input")[i].value = timearr[0];
            document.getElementsByTagName("input")[i+1].value = timearr[1];
        }

        
        j++
    }
    j = 0;//reset the value of j



})


const saving = document.getElementById("saving");
saving.addEventListener('click',(e)=>{
    let bool = false
    for (let i = 2; i < 16; i+=2) {
        let doctar = document.getElementsByTagName("input")
        if (doctar[i].value.length == 0 && doctar[i+1].value.length == 0 ){
            continue
        }else if (doctar[i].value.length > 0 && doctar[i+1].value.length > 0 ){
            continue
        }else{
            bool = true;
        }
        
    }
    if (bool){
        e.preventDefault();
        alert("Please fill up the form before submitting")
    }
})