//get a list of vehicles in inventory based on the classificationId
let email = document.querySelector("#email");
email.addEventListener("change", function () {
  let change = encodeURIComponent(email.value);
  console.log(change);
  let uniqueEmailURL = "/phpmotors/accounts/index.php?action=uniqueEmail&clientEmail=" + change;
  fetch(uniqueEmailURL)
  .then(function (response) {  
    let newEmail = decodeURIComponent(change);
  console.log(newEmail);

    if (response.ok) {
      return response.json();
    }
    throw Error("Network response was not OK");
  })
  .then(function (data) {
    console.log(data);
  })
  .catch(function (error) {
    console.log('There was a problem: ', error.message)
  })
})