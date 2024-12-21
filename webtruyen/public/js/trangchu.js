document.addEventListener('DOMContentLoaded', function () {
    const container = document.querySelector('.type-xephang');
  
    if (container) {
      container.addEventListener('click', (event) => {
        const button = event.target.closest('button');
        if (button) {
          // Xóa lớp "selected" khỏi tất cả các nút
          container.querySelectorAll('button').forEach(btn => btn.classList.remove('selected'));
          
          // Thêm lớp "selected" vào nút được nhấn
          button.classList.add('selected');
        }
      });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const navItems = document.querySelectorAll("nav > div");

    navItems.forEach((item) => {
        item.addEventListener("mouseover", function () {
            const content = this.querySelector(".content");
            if (content) {
                content.style.display = "block";
            }
        });

        item.addEventListener("mouseout", function () {
            const content = this.querySelector(".content");
            if (content) {
                content.style.display = "none";
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const navItems = document.querySelectorAll("nav > div");

    navItems.forEach((item) => {
        item.addEventListener("mouseover", function () {
            const content = this.querySelector(".content2");
            if (content) {
                content.style.display = "block";
            }
        });

        item.addEventListener("mouseout", function () {
            const content = this.querySelector(".content2");
            if (content) {
                content.style.display = "none";
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    let slider = document.querySelector(".slider .list");
    let items = document.querySelectorAll(".slider .list .item");
    let next = document.getElementById("next");
    let prev = document.getElementById("prev");
    let dots = document.querySelectorAll(".slider .dots li");

    let lengthItems = items.length - 1;
    let active = 0;
    next.onclick = function () {
        active = active + 1 <= lengthItems ? active + 1 : 0;
        reloadSlider();
    };
    prev.onclick = function () {
        active = active - 1 >= 0 ? active - 1 : lengthItems;
        reloadSlider();
    };
    let refreshInterval = setInterval(() => {
        next.click();
    }, 5000);
    function reloadSlider() {
        slider.style.left = -items[active].offsetLeft + "px";
        //
        let last_active_dot = document.querySelector(".slider .dots li.active");
        last_active_dot.classList.remove("active");
        dots[active].classList.add("active");

        clearInterval(refreshInterval);
        refreshInterval = setInterval(() => {
            next.click();
        }, 5000);
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const dropdownToggle = document.querySelector(".dropdown-toggle");
    const dropdownMenu = document.querySelector(".dropdown-menu");

    if (dropdownToggle) {
        dropdownToggle.addEventListener("click", function (e) {
            e.preventDefault();
            dropdownMenu.classList.toggle("show");
        });
    }

    // Ẩn menu khi nhấn ngoài
    document.addEventListener("click", function (e) {
        if (
            !dropdownMenu.contains(e.target) &&
            !dropdownToggle.contains(e.target)
        ) {
            dropdownMenu.classList.remove("show");
        }
    });
});

function showContent(id) {
    // Ẩn tất cả nội dung
    const contents = document.querySelectorAll('.topContent');
    contents.forEach(content => {
      content.style.display = 'none';
    });
  
    // Hiển thị nội dung được chọn
    document.getElementById(id).style.display = 'block';
}