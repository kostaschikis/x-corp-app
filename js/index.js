function myFunction() {
    var x = document.getElementById("inputState").value;
    if (x == "Doctor" || x == "Radiology Center Staff" || x == "Radiologist")
      document.getElementById("demo").innerHTML = "Login as " +x;
}

$(function() {
    if ($('#errorBanner').length) {

        $('#email').click(function() {
         $('#errorBanner').hide();
        })

        $('#password').click(function() {
            $('#errorBanner').hide();
        })
    }
})