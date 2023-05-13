const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });
        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });

function ConfrimPassword(){

  var pass= document.getElementById("psswrd");
  var confirmpass= document.getElementById("cnfrmpass");

if(PassLength())
{
  if(pass.value != confirmpass.value){
  
  
  document.getElementById("message").innerHTML="*Passwords do not match";
      confirmpass.value="";
      pass.value="";
  }
    else
    {
      document.getElementById("myForm").submit();
    }

}
}


function PassLength(){

  var pass= document.getElementById("psswrd");
  var confirmpass= document.getElementById("cnfrmpass");


 if( pass.value.length < 4 ){


    document.getElementById("message").innerHTML="*Password should be at least 4 characters";
    pass.value="";
    confirmpass.value="";
    return false;
  }
  else
  {
    return true;
  }
}


