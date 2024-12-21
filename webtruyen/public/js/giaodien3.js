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

  document.addEventListener('DOMContentLoaded', () => {
    const select = document.getElementById('chapter-select');
    const select2 = document.getElementById('chapter-select2');
    const chapters = document.querySelectorAll('.truyentranh'); 
    const buttonRollback = document.getElementById('buttonrollback');
    const buttonTurnUp = document.getElementById('buttonturnup');
    const buttonRollback2 = document.getElementById('buttonrollback2');
    const buttonTurnUp2 = document.getElementById('buttonturnup2');
  
    function showChapter(chapterIndex) {
      chapters.forEach(chapter => {
        chapter.style.display = chapter.getAttribute('data-chapter') === chapterIndex ? 'block' : 'none';
      });
    }

  function updateChapter(selectElement) {
    const selectedValue = selectElement.value;
    showChapter(selectedValue);
  }
  
    buttonRollback.addEventListener('click', () => {
      if (select.selectedIndex > 0) {
        select.selectedIndex -= 1;
        select2.selectedIndex = select.selectedIndex;
        updateChapter(select);
      }
    });
  
    buttonTurnUp.addEventListener('click', () => {
      if (select.selectedIndex < select.options.length - 1) {
        select.selectedIndex += 1; 
        select2.selectedIndex = select.selectedIndex;
        updateChapter(select);
      }
    });

    buttonRollback2.addEventListener('click', () => {
      if (select2.selectedIndex > 0) {
        select2.selectedIndex -= 1;
        select.selectedIndex = select2.selectedIndex;
        updateChapter(select2);
      }
    });
  
    buttonTurnUp2.addEventListener('click', () => {
      if (select2.selectedIndex < select2.options.length - 1) {
        select2.selectedIndex += 1;
        select.selectedIndex = select2.selectedIndex;
        updateChapter(select2);
      }
    });
  
    select.addEventListener('change', () => {
      select2.selectedIndex = select.selectedIndex; 
      updateChapter(select);
    });
  
    select2.addEventListener('change', () => {
      select.selectedIndex = select2.selectedIndex; 
      updateChapter(select2);
    });
  
    updateChapter(select);
    updateChapter(select2);
  });
  
