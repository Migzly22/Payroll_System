function containsUppercase(str) {
    return /[A-Z]/.test(str);
}
function containsLowercase(str) {
    return /[a-z]/.test(str);
}
function numbers(str) {
    return /[0-9]/.test(str);
}
function lenghty(str){
    if (str.length >= 8) {
        return true
    }
    return false
}

const changepasswordid = document.getElementById('changepasswordid')
changepasswordid.addEventListener('click',(e)=>{
    let password = document.getElementById('password').value;
    
    if(containsLowercase(password) && containsUppercase(password) && numbers(password) && lenghty(password)) {
        alert(True)
    }else{
        e.preventDefault();

        Swal.fire({
            icon: 'warning',
            html:
                '<small>The password should contain atleast 1 lowercase, uppercase and numerical number</small>',
            showConfirmButton: false,
            timer: 2500
        })
    }
})