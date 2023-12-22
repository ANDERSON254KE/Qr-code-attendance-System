function validateForm() {
     var Fname = document.getElementById('Fname').value;
     var Sname = document.getElementById('Sname').value;
     var S_ID = document.getElementById('ID').value;
     var email = document.getElementById('email').value;
     var Unit = document.getElementById('Unit').value;
     var date = document.getElementById('date').value;
     var Time = document.getElementById('time').value;
 
     if (Fname === '' || Sname === '' || S_ID === '' || email === '' || Unit === '' || date === '' || Time === '') {
         alert('Please fill in all fields');
         return false;
     }
 
     return true;
 }
 