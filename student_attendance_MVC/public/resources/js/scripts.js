// navigation.js
document.addEventListener("DOMContentLoaded", function () {
  // Add a click event listener to your links
  const navigationLinks = document.querySelectorAll("[data-route]");

  navigationLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      const route = link.getAttribute("data-route");

      // Redirect to the stored URL if available, otherwise, use the link's route
      const redirectUrl = sessionStorage.getItem("redirect_url") || route;
      window.location.href = redirectUrl;
    });
  });
});
