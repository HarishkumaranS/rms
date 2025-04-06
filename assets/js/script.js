// logout yes or no button 
document.addEventListener('DOMContentLoaded', function () {
    var logout = document.getElementById('logout');
    logout.addEventListener('click', function () {
        var button = confirm("Do you want to logout.....!");
        if (button) {
            window.location.href = "login_logout.php?logout";
        }
    });
});