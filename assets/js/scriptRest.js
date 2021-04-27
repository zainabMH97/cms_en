const form = document.getElementById('form');
const password = document.getElementById('password');
const password2 = document.getElementById('password2'); 
//function showError///

function showError(input,message){
    const formControl = input.parentElement;
    formControl.className = 'form-group error';
    const small = formControl.querySelector('small');
    small.innerText = message;
}

function showSuccess(input){
    const formControl = input.parentElement;
    formControl.className = 'form-group success';
}

function checkLen(input,min,max){
    if(input.value.length < min){
        showError(input,`${getFieldName(input)} must be at least ${min} character `);
    }else if(input.value.length > max){
        showError(input,`${getFieldName(input)} must be less than ${max} character `);
    }else{
        showSuccess(input);
    }
}

function checkPasswordMatch(input1,input2){
    if(input1.value !== input2.value){
        showError(input2,'Passwords do not match');
    } else{
        showSuccess(input2);
    }
}

function getFieldName(input){
    return input.id.charAt(0).toUpperCase() + input.id.slice(1);
}


password.addEventListener('keyup',function(){
  checkLen(password,6,25);

});
password2.addEventListener('keyup',function(){
    checkPasswordMatch(password, password2); 
});