// ===== Live Time =====
setInterval(() => {
  const timeBox = document.getElementById('live-time');
  if (timeBox) {
    timeBox.textContent = new Date().toLocaleString();
  }
}, 1000);

// ===== Font Size Control =====
function adjustFont(size) {
  const body = document.querySelector("body");
  let currentSize = parseFloat(window.getComputedStyle(body).fontSize);
  if (size === '+') body.style.fontSize = (currentSize + 1) + "px";
  else if (size === '-') body.style.fontSize = (currentSize - 1) + "px";
}

// ===== Local Chat Box =====
function sendMessage() {
  const msgBox = document.getElementById('chat-input');
  const messages = document.getElementById('chat-messages');
  if (msgBox.value.trim() !== "") {
    messages.innerHTML += `<div><strong>You:</strong> ${msgBox.value}</div>`;
    msgBox.value = "";
  }
}

// ===== Auto Image Slider =====
let currentIndex = 0;

function autoSlide() {
  const slides = document.querySelectorAll('.slide');
  if (slides.length === 0) return;

  currentIndex = (currentIndex + 1) % slides.length;
  const wrapper = document.getElementById('slide-wrapper');
  if (wrapper) {
    wrapper.style.transform = `translateX(-${currentIndex * 100}%)`;
  }
}

setInterval(autoSlide, 3000);
function sendMessage() {
  const input = document.getElementById("chat-input");
  const messages = document.getElementById("chat-messages");
  if (input.value.trim() !== "") {
    const newMsg = document.createElement("div");
    newMsg.textContent = "You: " + input.value;
    messages.appendChild(newMsg);
    input.value = "";
    messages.scrollTop = messages.scrollHeight;
  }
}

// Dark mode toggle
function toggleDarkMode() {
  document.body.classList.toggle('dark-mode');
}
function fetchMessages() {
  fetch('fetch_messages.php')
    .then(response => response.json())
    .then(data => {
      const container = document.getElementById('chat-messages');
      container.innerHTML = '';
      data.forEach(msg => {
        const div = document.createElement('div');
        div.textContent = `${msg.sender}: ${msg.message}`;
        container.appendChild(div);
      });
      container.scrollTop = container.scrollHeight;
    });
}

function sendMessage() {
  const input = document.getElementById("chat-input");
  const msg = input.value.trim();
  if (msg === '') return;

  fetch('send_message.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `message=${encodeURIComponent(msg)}`
  }).then(() => {
    input.value = '';
    fetchMessages();
  });
}

setInterval(fetchMessages, 3000); // Auto-refresh every 3s
window.onload = fetchMessages;
