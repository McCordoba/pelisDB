const csrfToken = document
  .querySelector('meta[name="csrf-token"]')
  .getAttribute("content");

function sendRequest(url, method, data, csrfToken) {
  return fetch(url, {
    method: method,
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": csrfToken,
    },
    body: JSON.stringify(data),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error(
          `Failed to ${method === "POST" ? "process" : "remove"} the movie`
        );
      }
      return response.json();
    })
    .then((data) => {
      console.log(data.message);
    })
    .catch((error) => {
      console.error("Error:", error.message);
    });
}

const watchButton = document.querySelector(".watch");
const likeButton = document.querySelector(".like");
const watchlistButton = document.querySelector(".watchlist");
const reviewButton = document.querySelector(".review");

// WATCH BUTTON
watchButton.addEventListener("click", function () {
  const movieId = this.getAttribute("data-movie-id");
  const movieTitle = this.getAttribute("data-movie-title");
  const releaseDate = this.getAttribute("data-release-date");
  const posterPath = this.getAttribute("data-poster-path");

  if (this.classList.contains("whatched")) {
    this.classList.remove("whatched");
    this.querySelector("span").innerText = "Watch";
    sendRequest(
      `/watched-movies/${movieId}`,
      "DELETE",
      {
        movie_id: movieId,
        title: movieTitle,
        release_date: releaseDate,
        poster_path: posterPath,
      },
      csrfToken
    );
  } else {
    this.classList.add("whatched");
    this.querySelector("span").innerText = "Watched";
    sendRequest(
      "/watched-movies",
      "POST",
      {
        movie_id: movieId,
        title: movieTitle,
        release_date: releaseDate,
        poster_path: posterPath,
      },
      csrfToken
    );
  }
});

watchButton.addEventListener("mouseenter", function () {
  if (this.classList.contains("whatched")) {
    this.querySelector("span").innerText = "Unwatch";
  }
});

watchButton.addEventListener("mouseleave", function () {
  if (this.classList.contains("whatched")) {
    this.querySelector("span").innerText = "Watched";
  }
});

// LIKE BUTTON
likeButton.addEventListener("click", function () {
  const movieId = this.getAttribute("data-movie-id");
  const movieTitle = this.getAttribute("data-movie-title");
  const releaseDate = this.getAttribute("data-release-date");
  const posterPath = this.getAttribute("data-poster-path");

  if (this.classList.contains("liked")) {
    this.classList.remove("liked");
    this.querySelector("span").innerText = "Like";
    sendRequest(
      `/liked-movies/${movieId}`,
      "DELETE",
      {
        movie_id: movieId,
        title: movieTitle,
        release_date: releaseDate,
        poster_path: posterPath,
      },
      csrfToken
    );
  } else {
    this.classList.add("liked");
    this.querySelector("span").innerText = "Liked";
    sendRequest(
      "/liked-movies",
      "POST",
      {
        movie_id: movieId,
        title: movieTitle,
        release_date: releaseDate,
        poster_path: posterPath,
      },
      csrfToken
    );
  }
});

likeButton.addEventListener("mouseenter", function () {
  if (this.classList.contains("liked")) {
    this.querySelector("span").innerText = "Dislike";
  }
});

likeButton.addEventListener("mouseleave", function () {
  if (this.classList.contains("liked")) {
    this.querySelector("span").innerText = "Liked";
  }
});

// WATCHLIST BUTTON
watchlistButton.addEventListener("click", function () {
  const movieId = this.getAttribute("data-movie-id");
  const movieTitle = this.getAttribute("data-movie-title");
  const releaseDate = this.getAttribute("data-release-date");
  const posterPath = this.getAttribute("data-poster-path");

  if (this.classList.contains("listed")) {
    this.classList.remove("listed");
    this.querySelector("span").innerText = "List";
    sendRequest(
      `/watchlist/${movieId}`,
      "DELETE",
      {
        movie_id: movieId,
        title: movieTitle,
        release_date: releaseDate,
        poster_path: posterPath,
      },
      csrfToken
    );
  } else {
    this.classList.add("listed");
    this.querySelector("span").innerText = "Listed";
    sendRequest(
      "/watchlist",
      "POST",
      {
        movie_id: movieId,
        title: movieTitle,
        release_date: releaseDate,
        poster_path: posterPath,
      },
      csrfToken
    );
  }
});

watchlistButton.addEventListener("mouseenter", function () {
  if (this.classList.contains("listed")) {
    this.querySelector("span").innerText = "Unlist";
  }
});

watchlistButton.addEventListener("mouseleave", function () {
  if (this.classList.contains("listed")) {
    this.querySelector("span").innerText = "Listed";
  }
});

// REVIEW BUTTON
reviewButton.addEventListener("click", function (e) {
  e.preventDefault(); // Prevent default form submission
  const movieId = this.getAttribute("data-movie-id");
  const movieTitle = this.getAttribute("data-movie-title");
  const releaseDate = this.getAttribute("data-release-date");
  const posterPath = this.getAttribute("data-poster-path");
  const reviewText = document.getElementById("review").value;
  const rating = document.getElementById("score").value;
  console.log(reviewText);
  console.log(rating);

  const requestData = {
    movie_id: movieId,
    title: movieTitle,
    review: reviewText,
    release_date: releaseDate,
    poster_path: posterPath,
  };

  if (rating) {
    requestData.score = rating;
  }

  if (this.classList.contains("reviewed")) {
    this.classList.remove("reviewed");
    this.querySelector("span").innerText = "Review";
    sendRequest(`/review/${movieId}`, "DELETE", requestData, csrfToken);
  } else {
    this.classList.add("reviewed");
    this.querySelector("span").innerText = "Reviewed";
    sendRequest("/review", "POST", requestData, csrfToken);
  }
});

reviewButton.addEventListener("mouseenter", function () {
  if (this.classList.contains("reviewed")) {
    this.querySelector("span").innerText = "Delete review";
  }
});

reviewButton.addEventListener("mouseleave", function () {
  if (this.classList.contains("reviewed")) {
    this.querySelector("span").innerText = "Reviewed";
  }
});

// EDIT BUTTON
const editReviewButton = document.getElementById("editReviewButton");

// Fetch existing review and populate form
const movieId = reviewButton.getAttribute("data-movie-id");
fetch(`/review/${movieId}`, {
  method: "GET",
  headers: {
    "Content-Type": "application/json",
    "X-CSRF-TOKEN": csrfToken,
  },
})
  .then((response) => response.json())
  .then((data) => {
    if (data.review) {
      document.getElementById("review").value = data.review.review;
      document.getElementById("score").value = data.review.score;
      reviewButton.classList.add("reviewed");
      reviewButton.querySelector("span").innerText = "Reviewed";
    }
  })
  .catch((error) => console.error("Error:", error.message));

// Edits the review
editReviewButton.addEventListener("click", function (e) {
  e.preventDefault(); // Prevent default form submission

  const movieId = reviewButton.getAttribute("data-movie-id");
  const movieTitle = reviewButton.getAttribute("data-movie-title");
  const releaseDate = reviewButton.getAttribute("data-release-date");
  const posterPath = reviewButton.getAttribute("data-poster-path");
  const reviewText = document.getElementById("review").value;
  const rating = document.getElementById("score").value;

  const requestData = {
    movie_id: movieId,
    title: movieTitle,
    review: reviewText,
    release_date: releaseDate,
    poster_path: posterPath,
  };

  if (rating) {
    requestData.score = rating;
  }

  // If the review already exists, update it
  if (reviewButton.classList.contains("reviewed")) {
    sendRequest(`/review/${movieId}`, "PUT", requestData, csrfToken);
    editReviewButton.querySelector("span").innerText = "Edited";
  } else {
    // Otherwise, create a new review
    sendRequest("/review", "POST", requestData, csrfToken);
    reviewButton.classList.add("reviewed");
    reviewButton.querySelector("span").innerText = "Reviewed";
  }
});

// MODAL REVIEW
const modalReview = document.getElementById("modalReview");
const closeBtnRW = document.getElementById("closeBtnRW");

const openReviewModal = () => {
  modalReview.style.display = "block";
};

const closeReviewModal = () => {
  modalReview.style.display = "none";
};

closeBtnRW.addEventListener("click", () => {
  closeReviewModal();
});

document.getElementById("reviewModalBtn").addEventListener("click", () => {
  openReviewModal();
});
