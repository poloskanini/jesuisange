setTimeout(() => {
  document.querySelector('.loader').style.display = 'none';
}, 6500)

// Container Scores
let wrapperTop = document.querySelector('.wrapper');

const launch = () => {
  let valueDisplays = document.querySelectorAll('.num');

  // Rallonger interval pour ralentir le compteur
  let interval = 2500;

  valueDisplays.forEach((valueDisplay) => {
    let startValue = 0;
    let endValue = parseInt(valueDisplay.getAttribute("data-val"));
    let duration = Math.floor(interval / endValue);

    let counter = setInterval(function() {
      startValue += 1;
      valueDisplay.textContent = startValue;
      if(startValue == endValue) {
        clearInterval(counter);
      }
    }, duration)
  })
}

let options = {
  root: null,
  rootMargin: "0px",
  threshold: .5,
};

const observer = new IntersectionObserver((entries) => {
  for(const entry of entries) {
    if(entry.isIntersecting) {
      entry.target.classList.add("is-visible");
      launch();
      // observer.unobserve(entry.target);
    }
  }
}, options)

observer.observe(wrapperTop);