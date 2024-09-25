function get_users() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/users.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    document.getElementById("users-data").innerHTML = this.responseText;
  };
  xhr.send("get_users");
}

function rem_user(user_id) {
  if (confirm("Are you sure, you want to remove this user?")) {
    let data = new FormData();
    data.append("user_id", user_id);
    data.append("rem_user", "");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users.php", true);

    xhr.onload = function () {
      if (this.responseText == 1) {
        alert("success", "User Removed!");
        get_users();
      } else {
        alert("error", "Users Removed failed!");
      }
    };
    xhr.send(data);
  }
}

// ฟังก์ชันการค้นหา
function search_user(query) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/users.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    document.getElementById("users-data").innerHTML = this.responseText;
  };

  // ส่งค่าที่ป้อนในช่องค้นหาไปยัง PHP
  xhr.send("search_user=" + query);
}

window.onload = function () {
  get_users();
};
