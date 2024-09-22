let feature_s_form = document.getElementById("feature_s_form");
let facilities_s_form = document.getElementById("facilities_s_form");

feature_s_form.addEventListener("submit", function (e) {
    e.preventDefault();
    add_feature();
});

facilities_s_form.addEventListener("submit", function (e) {
    e.preventDefault();
    add_facilities();
});

function add_feature() {
    let data = new FormData();
    data.append("name", feature_s_form.elements["feature_name"].value);
    data.append("add_feature", "");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);

    xhr.onload = function () {
    var myModal = document.getElementById("feature-s");
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    if (this.responseText == 1) {
        alert("success", "New feature added!");
        feature_s_form.elements["feature_name"].value = "";
        feature_s_form.reset();
        get_features();
    } else {
        alert("error", "Server down!");
    }
    };
    xhr.send(data);
}

function get_features() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
    document.getElementById("feature-data").innerHTML = this.responseText;
    };

    xhr.send("get_features");
}

function edit_feature(id, name) {
    let myModal = new bootstrap.Modal(document.getElementById('edit-feature-s'));
    document.getElementById('edit_feature_s_form').elements['edit_feature_name'].value = name;
    document.getElementById('edit_feature_s_form').elements['feature_id'].value = id;
    myModal.show();
}

let edit_feature_s_form = document.getElementById("edit_feature_s_form");

edit_feature_s_form.addEventListener("submit", function (e) {
    e.preventDefault();
    update_feature();
});

function update_feature() {
    let data = new FormData();
    data.append("id", edit_feature_s_form.elements["feature_id"].value);
    data.append("name", edit_feature_s_form.elements["edit_feature_name"].value);
    data.append("update_feature", "");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);

    xhr.onload = function () {
        var myModal = document.getElementById("edit-feature-s");
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1) {
            alert("success", "Feature updated successfully!");
            edit_feature_s_form.reset();
            get_features();
        } else {
            alert("error", "Server down!");
        }
    };
    xhr.send(data);
}


function rem_feature(val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
    if (this.responseText == 1) {
        alert("success", "Feature removed!");
        get_features();
    } else if (this.responseText == "room_added") {
        alert("error", "Facilities is added in room!");
    } else {
        alert("error", "Server down!");
    }
    };

    xhr.send("rem_feature=" + val);
}

function add_facilities() {
    let data = new FormData();
    data.append("name", facilities_s_form.elements["facilities_name"].value);
    data.append("icon",facilities_s_form.elements["facilities_icon"].files[0]);
    data.append("desc", facilities_s_form.elements["facilities_desc"].value);
    data.append("add_facilities", "");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);

    xhr.onload = function () {
    var myModal = document.getElementById("facilities-s");
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    if (this.responseText == "inv_img") {
        alert("error", "Only JPG and PNG image are allowed!");
    } else if (this.responseText == "inv_size") {
        alert("error", "Image should be less than 1MB!");
    } else if (this.responseText == "upd_failed") {
        alert("error", "Image upload failed. Server Down!");
    } else {
        alert("success", "New facilities added!");
        facilities_s_form.reset();
        get_facilities();
    }
    };
    xhr.send(data);
}

function get_facilities() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
    document.getElementById("facilities-data").innerHTML = this.responseText;
    };

    xhr.send("get_facilities");
}

function edit_facilities(id, name, desc) {
    let myModal = new bootstrap.Modal(document.getElementById('edit-facilities-s'));
    document.getElementById('edit_facilities_s_form').elements['edit_facilities_name'].value = name;
    document.getElementById('edit_facilities_s_form').elements['edit_facilities_desc'].value = desc;
    document.getElementById('edit_facilities_s_form').elements['facilities_id'].value = id;
    myModal.show();
}

function edit_facilities_image(id, currentImagePath) {
    let myModal = new bootstrap.Modal(document.getElementById('edit-facilities-image-s'));
    document.getElementById('current_facilities_image').src = currentImagePath;
    document.getElementById('edit_facilities_image_s_form').elements['facilities_id'].value = id;
    myModal.show();
}

let edit_facilities_s_form = document.getElementById("edit_facilities_s_form");
let edit_facilities_image_s_form = document.getElementById("edit_facilities_image_s_form");

edit_facilities_s_form.addEventListener("submit", function (e) {
    e.preventDefault();
    update_facilities();
});

edit_facilities_image_s_form.addEventListener("submit", function (e) {
    e.preventDefault();
    update_facilities_image();
});

function update_facilities() {
    let data = new FormData();
    data.append("id", edit_facilities_s_form.elements["facilities_id"].value);
    data.append("name", edit_facilities_s_form.elements["edit_facilities_name"].value);
    data.append("desc", edit_facilities_s_form.elements["edit_facilities_desc"].value);
    data.append("update_facilities", "");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);

    xhr.onload = function () {
        var myModal = document.getElementById("edit-facilities-s");
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1) {
            alert("success", "Facilities updated successfully!");
            edit_facilities_s_form.reset();
            get_facilities();
        } else {
            alert("error", "Server down!");
        }
    };
    xhr.send(data);
}

function update_facilities_image() {
    let data = new FormData();
    data.append("id", edit_facilities_image_s_form.elements["facilities_id"].value);
    data.append("icon", edit_facilities_image_s_form.elements["facilities_icon"].files[0]);
    data.append("update_facilities_image", "");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);

    xhr.onload = function () {
        var myModal = document.getElementById("edit-facilities-image-s");
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == "inv_img") {
            alert("error", "Only JPG and PNG image are allowed!");
        } else if (this.responseText == "inv_size") {
            alert("error", "Image should be less than 1MB!");
        } else if (this.responseText == "upd_failed") {
            alert("error", "Image upload failed. Server Down!");
        } else {
            alert("success", "Facilities image updated!");
            edit_facilities_image_s_form.reset();
            get_facilities();
        }
    };
    xhr.send(data);
}



function rem_facilities(val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
    if (this.responseText==1) {
        alert("success", "Facilities removed!");
        get_facilities();
    } else if (this.responseText == "room_added") {
        alert("error", "Facilities is added in room!");
    } else {
        alert("error", "Server down!");
    }
    };

    xhr.send("rem_facilities=" + val);
}

window.onload = function () {
    get_features();
    get_facilities();
};
