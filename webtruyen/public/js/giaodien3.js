let calcScrollValue = () => {
    let scrollProgress = document.getElementById("progress");
    let progressValue = document.getElementById("progress-value");
    let scrollMenu = document.getElementById("menuchapter");
    let pos = document.documentElement.scrollTop;
    let pop = document.documentElement.scrollTop;
    let calcHeight =
      document.documentElement.scrollHeight -
      document.documentElement.clientHeight;
    let scrollValue = Math.round((pos * 100) / calcHeight);
    if (pos > 100) {
      scrollProgress.style.display = "grid";
    } else {
      scrollProgress.style.display = "none";
    }

    if (pop > 300) {
        scrollMenu.style.display = "flex";
    }
    else {
        scrollMenu.style.display = "none";
    }
    scrollProgress.addEventListener("click", () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    scrollProgress.style.background = `conic-gradient(#483d8b ${scrollValue}%, #ffff ${scrollValue}%)`;
  };
  
  window.onscroll = calcScrollValue;
  window.onload = calcScrollValue;
