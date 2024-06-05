document.querySelectorAll(".text-toggle").forEach((link) => {
  link.addEventListener("click", function () {
    const text = this.previousElementSibling;
    if (text.style.maxHeight === "none") {
      text.style.maxHeight = "4.5rem";
      this.innerHTML = 'Read more <i class="fa-solid fa-arrow-right"></i>';
    } else {
      text.style.maxHeight = "none";
      this.innerHTML = 'Read less <i class="fa-solid fa-arrow-left"></i>';
    }
  });
});
