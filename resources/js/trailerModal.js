let modal = document.getElementById("modal");
let closeBtn = document.getElementById("closeBtn");
let iframe = document.getElementById("iframe");

// Function to open the modal with the video
function openModal(videoKey) {
  iframe.src = "https://www.youtube.com/embed/" + videoKey;
  modal.style.display = "block";
}

// Function to close the modal and stop the video
function closeModal() {
  modal.style.display = "none";
  // Pause the video
  iframe.src = "";
}

let playTrailerButton = document.getElementById("playTrailerBtn");
playTrailerButton.addEventListener("click", function () {
  let movieId = this.dataset.movieId;
  console.log(movieId);
  fetch("/movies/" + movieId + "/videos")
    .then((response) => {
      if (!response.ok) {
        throw new Error("Failed to fetch videos");
      }
      return response.json();
    })
    .then((data) => {
      let videos = data.videos;
      if (videos.length > 0) {
        let videoKey = videos[0].key;
        console.log(videoKey);
        openModal(videoKey);
      } else {
        throw new Error("No videos available");
      }
    })
    .catch((error) => {
      console.error(error.message);
    });
});

closeBtn.addEventListener("click", function () {
  closeModal();
});

// Close the modal if user clicks outside the modal content
window.addEventListener("click", function (event) {
  if (event.target === modal) {
    closeModal();
  }
});
