//get a list of vehicles in inventory based on the classificationId
let email = document.querySelector("#email");
email.addEventListener("change", function () {
  let change = encodeURIComponent(email.value);
  console.log(change);
  let uniqueEmailURL = "/phpmotors/accounts/index.php?action=uniqueEmail&clientEmail=" + change;
  fetch(uniqueEmailURL)
  .then(function (response) {  
    if (response.ok) {
      return response.text();
    }
    throw Error("Network response was not OK");
  })
  .then(function (data) {
    console.log(data)
    if (data == 0) {
      document.getElementById('errdiv').innerText = "";
      document.getElementById('update').disabled = false;
    } else {
      document.getElementById('update').disabled = true;
      document.getElementById('errdiv').innerText = "That email address already exists.";
    }
  })

  .catch(function (error) {
    console.log('There was a problem: ', error.message)
  })
})