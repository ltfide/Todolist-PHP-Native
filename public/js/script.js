const clickBtn = document.querySelectorAll("#cekbox");
const clicked = document.querySelectorAll(".coret");
const tabsNav = document.querySelectorAll(".nav-item");
const navLink = document.querySelectorAll(".nav-link");
const tabPane = document.querySelectorAll(".tab-content .tab-pane");
const btn = document.querySelector(".tab-content ul li form p");
const deleteBtn = document.querySelectorAll("i");
const sendBtn = document.querySelectorAll("#deleteBtn");

for (let i = 0; i < clickBtn.length; i++) {
  clickBtn[i].addEventListener("click", () => {
    clicked[i].classList.toggle("aktif");
  });
}

tabsNav.forEach((m, i) =>
  m.addEventListener("click", () => {
    if (navLink[i].textContent == "All") {
      navLink[0].classList.add("active");
      navLink[1].classList.remove("active");
      navLink[2].classList.remove("active");
      tabPane[0].classList.add("show", "active");
      tabPane[1].classList.remove("show", "active");
      tabPane[2].classList.remove("show", "active");
    } else if (navLink[i].textContent == "Active") {
      navLink[1].classList.add("active");
      navLink[0].classList.remove("active");
      navLink[2].classList.remove("active");
      tabPane[1].classList.add("show", "active");
      tabPane[0].classList.remove("show", "active");
      tabPane[2].classList.remove("show", "active");
    } else {
      navLink[2].classList.add("active");
      navLink[1].classList.remove("active");
      navLink[0].classList.remove("active");
      tabPane[2].classList.add("show", "active");
      tabPane[0].classList.remove("show", "active");
      tabPane[1].classList.remove("show", "active");
    }
  })
);

deleteBtn.forEach((m, i) =>
  m.addEventListener("click", () => {
    let id = sendBtn[i].getAttribute("data-id");
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire("Deleted!", "Your file has been deleted.", "success");
        setTimeout(() => {
          window.location = `/delete/${id}`;
        }, 1000);
      }
    });
  })
);
