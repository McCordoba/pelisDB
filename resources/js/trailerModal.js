const modal = document.getElementById("modalTrailer");
const closeBtn = document.getElementById("closeBtnMT");
const iframe = document.getElementById("iframe");
const playTrailerButton = document.getElementById("playTrailerBtn");

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

// Sends a request when the "Play Trailer" button is clicked
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

// Close the modal if user clicks on the modal "X" button
closeBtn.addEventListener("click", function () {
  closeModal();
});

// Close the modal if user clicks outside the modal content
window.addEventListener("click", function (event) {
  if (event.target === modal) {
    closeModal();
  }
});
