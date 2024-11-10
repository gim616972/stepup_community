const showSidebarBtn = document.getElementById("sidebarShowbtn");
const sidebar = document.getElementById("fixSidebar");
const overlayEffect = document.querySelector(".overlay");

showSidebarBtn.addEventListener('click', function(){
    sidebar.classList.toggle('showSidebar');
    overlayEffect.classList.toggle('show');
});


overlayEffect.onclick = function(){
    overlayEffect.classList.remove('show');
    sidebar.classList.remove('showSidebar');
}


//select all anchor element
const activeButton = document.querySelectorAll(".sidebarContent > a");

// Function to set the active button based on index
function setActiveButton(index) {
  activeButton.forEach(element => element.classList.remove('active'));
  activeButton[index].classList.add('active');
  // Save the active button index in localStorage
  localStorage.setItem('activeButtonIndex', index);
}

// Load the active button index from localStorage on page load
window.addEventListener('DOMContentLoaded', () => {
  const savedIndex = localStorage.getItem('activeButtonIndex');
  if (savedIndex !== null) {
    setActiveButton(parseInt(savedIndex));
  }
});

// Add click event listeners to each button
activeButton.forEach((element, index) => {
  element.addEventListener("click", () => {
    setActiveButton(index);
  });
});