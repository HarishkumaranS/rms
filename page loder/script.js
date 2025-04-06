
    let startTime = Date.now(); // Capture the start time of the loading process

    window.onload = function () {
      let loadTime = Date.now() - startTime; // Calculate time taken for page to load
      let loaderThreshold = 500; // Loader only appears if load time is greater than 500ms

      if (loadTime < loaderThreshold) {
        // Hide loader instantly if the page loads quickly
        document.getElementById("loader").style.display = "none";
        document.getElementById("content").style.display = "block";
      } else {
        // Show loader and remove it after the remaining time
        let remainingTime = 750 - loadTime; // Ensure minimum loader display time
        remainingTime = remainingTime > 0 ? remainingTime : 0;

        setTimeout(() => {
          document.getElementById("loader").style.opacity = "0";
          document.getElementById("loader").style.visibility = "hidden";
          document.getElementById("content").style.display = "block";
        }, remainingTime);
      }
    };
