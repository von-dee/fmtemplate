/*
  Root Javascript File for Framework 3
  Created By Reggie @ Orcons Systems
  Date: 17-12-2019
*/


function push(params) {
  document.getElementById("keys").value = params.keys;
  document.getElementById("view").value = params.view;
  document.getElementById("viewpage").value = params.viewpage;
  document.myform.submit();
}//---> Function to route to pages in a module. accepts json eg.{'view':'add'}

function pop() {
  document.getElementById("view").value = "";
  document.myform.submit();
}//---> Function to route back to lists page

function popTo(params) {
  document.getElementById("view").value = params.view;
  document.myform.submit();
}//---> Function to route to a specific page

function deleteData(action,keys){
  Swal.fire({
      title: 'Deleting this record?',
      text: 'Are you sure you want to delete this record?',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '',
      confirmButtonText: 'Yes, Delete',
      closeOnConfirm: false
  }).then((result)=>{
      if(result.value){
          document.getElementById('viewpage').value = action;
          document.getElementById('keys').value = keys;
          document.myform.submit();
      }
  });
}//---> Function to confirm submission of form with sweetalert2

function logout() {
  Swal.fire({
      title: "Are you sure?",
      text: "You want to logout of the system?",
      type: "warning",
      showCancelButton: !0,
      confirmButtonColor: "#6F42C1",
      cancelButtonColor: "#CAD0E8",
      confirmButtonText: "Logout!"
  }).then(function (t) {
      console.log(t.value);
      if (t.value === true) {
          window.location.href = 'index.php?action=logout';
      }
  });
}//---> Function to prompt user using sweetalert2 to logout

