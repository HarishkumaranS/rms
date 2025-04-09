// Change Status in Admin Login
function change(a_id) {
    var title_value = confirm('Do you want to Chage Status');
    if (title_value == true) {
        // js href link
        window.location.href = 'index.php?ADid=' + a_id;
    }
}

// stock update function
function stock(a) {
    window.location.href = "index.php?view_product&stock_id=" + a;
}

// Product Delete
function del_product(product_id) {
    var title_value = confirm('Do you want to delete?');
    if (title_value === true) {
        window.location.href = 'index.php?PDid=' + product_id;
    }
}

// Category Delete
function del_cat(cat_id) {
    var title_value = confirm('Do you want to Delete');
    if (title_value == true) {
        // js href link
        window.location.href = 'index.php?CDid=' + cat_id;
    }
}

// Event Delete
function del_event(e_id) {
    var title_value = confirm('Do you want to Delete');
    if (title_value == true) {
        // js href link
        window.location.href = 'index.php?EDid=' + e_id;
    }
}
// Category Remove From Delete
function rdel_cat(cat_id) {
    var title_value = confirm('Do you want to Remove from Delete');
    if (title_value == true) {
        // js href link
        window.location.href = 'index.php?CUDid=' + cat_id;
    }
}

// Event Remove From Delete
function rdel_event(e_id) {
    var title_value = confirm('Do you want to Remove from Delete');
    if (title_value == true) {
        // js href link
        window.location.href = 'index.php?EUDid=' + e_id;;
    }
}

// Product Remove From Delete
function rdel_product(product_id) {
    var title_value = confirm('Do you want to Remove From delete?');
    if (title_value === true) {
        // Correctly concatenate the product_id variable
        window.location.href = 'view_del_product.php?PUDid=' + product_id;
    }
}

// Edit profile
// validation for new pass and confirm pass
function checkPasswordMatch() {
    var newPassword = document.getElementById("new_pass").value;
    var confirmPassword = document.getElementById("con_pass").value;
    var passwordHelp = document.getElementById("passwordHelp");

    if (newPassword !== confirmPassword) {
        passwordHelp.textContent = "Passwords do not match!";
    } else {
        passwordHelp.textContent = "";
    }
}

function validatePassword() {
    var newPassword = document.getElementById("new_pass").value;
    var confirmPassword = document.getElementById("con_pass").value;

    if (newPassword !== confirmPassword) {
        alert("New Password and Confirm Password must be the same!");
        return false; // Prevent form submission
    }
    return true; // Allow form submission
}

//   pending order
function validateCheckboxes() {
    const checkboxes = document.querySelectorAll('.checkbox');
    let isChecked = false;

    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            isChecked = true;
        }
    });

    if (!isChecked) {
        alert("Please select at least one Pending order");
        return false; // Prevent form submission
    }

    return true; // Allow form submission
}
