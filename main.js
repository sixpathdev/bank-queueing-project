
function changePage(x) {
    document.location.href = x;
}

function validateCustomerInfo() {
    var customerName = document.forms["customer_form"]["customer_name"].value;
    var phoneNumber = document.forms["customer_form"]["phone_number"].value;

    if (customerName == null || customerName == "") {
        alert("Please enter a name.");
        return false;
    }

    if (customerName.length >= 30) {
        alert("Name must be less than 30 characters.")
        return false;
    }

    if (phoneNumber == null || phoneNumber == "") {
        alert("Please enter a phone number.");
        return false;
    }
    
    if (phoneNumber.length != 11) {
        alert("Phone number requires 11 digits.");
        return false;
    }

    return true;

}

function $(id) {
    return document.getElementById(id);
}

$('assign_customer').addEventListener("click", displayAssignCustomer);
$('remove_customer').addEventListener("click", displayRemoveCustomer);
$('alter_customer').addEventListener("click", displayAlterCustomer);

function displayAssignCustomer() {
    displayContainer($('assign_container'));
    hideContainers($('remove_container'), $('alter_container'));
}

function displayRemoveCustomer() {
    displayContainer($('remove_container'));
    hideContainers($('assign_container'), $('alter_container'));
}

function displayAlterCustomer() {
    displayContainer($('alter_container'));
    hideContainers($('assign_container'), $('remove_container'));
}

function displayAlterInfo() {
    displayContainer($('alter_selected_customer_container'));
    $('alter_container').style.display = "none";
}

function hideContainers(div1, div2) {
    div1.style.display = "none";
    div2.style.display = "none";
}

function displayContainer(div) {
    if (div.style.display === "inline-block") {
        div.style.display = "none";
    } else {
        div.style.display = "inline-block";
    }
}

function onClickForRestartDay() {
    if (confirm("Are you sure you want to restart?")) {
        window.location.href = "includes/restart_day.php";
    }
}

function onClickForClearQueue() {
    if (confirm("Are you sure you want to clear Queue?")) {
        if (confirm("Are you sure?")) {
            window.location.href = "includes/clear_queue.php";
        }
    }
}