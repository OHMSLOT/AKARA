<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="scripts/scripts.js"></script>
<script>
    function alert(type, msg, position = 'body') {
        let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
        let element = document.createElement('div');
        element.innerHTML = `
            <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
                <strong class="me-3">${msg}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;

        if (position == 'body') {
            document.body.append(element);
            element.classList.add('custom-alert');
        } else {
            document.getElementById(position).appendChild(element);
        }
        setTimeout(remAlert, 2000);
    }

    function remAlert() {
        document.getElementsByClassName('alert')[0].remove();
    }

    // function setActive() {
    //     let navbar = document.getElementById('dashboard-menu');
    //     let a_tags = navbar.getElementsByTagName('a');

    //     // ดึง path ของไฟล์จาก URL ปัจจุบัน
    //     let currentPage = window.location.pathname.split("/").pop();

    //     for (let i = 0; i < a_tags.length; i++) {
    //         let file = a_tags[i].href.split("/").pop(); // ดึงชื่อไฟล์จาก href ของแต่ละลิงก์

    //         // ตรวจสอบว่าชื่อไฟล์ตรงกับ URL ปัจจุบันหรือไม่
    //         if (file === currentPage) {
    //             a_tags[i].classList.add('active'); // ถ้าตรงกัน เพิ่มคลาส active
    //         }
    //     }
    // }

    // // เรียกใช้ฟังก์ชันเมื่อโหลดหน้าเว็บเสร็จสิ้น
    // setActive();
</script>