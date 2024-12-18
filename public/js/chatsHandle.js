//NEW CHAT CODE
const urlParams = new URLSearchParams(window.location.search);
const userId = urlParams.get("user");
let intervalId = null;
let lastChatId = null;

const formatChatDateTime = (datetime) => {
  const date = new Date(datetime);
  return date.toLocaleTimeString("id-ID", {
    hour: "2-digit",
    minute: "2-digit",
  });
};

const scrollToBottom = (selector) => {
  const element = $(selector);
  element.scrollTop(element.prop("scrollHeight"));
};

const showChat = (user_id) => {
  $.get(`/web_rekost/getchat/${user_id}`).done((data) => {
    const messages = JSON.parse(data).messages;

    if (
      messages.length > 0 &&
      messages[messages.length - 1].time !== lastChatId
    ) {
      $("#chat-messages").empty();
      messages.forEach((message) => generateChat(message, user_id));
      lastChatId = messages[messages.length - 1].time; // Perbarui ID pesan terakhir
      scrollToBottom("#chat-messages");
    }
  });
};

const generateChat = (chat, userId) => {
  const alignment =
    chat.id_sender == userId ? "justify-content-start" : "justify-content-end";
  const messageClass =
    chat.id_sender == userId ? "bg-light " : "sent   bg-primary text-white";

  const messageElement = `
    <div class="chat-message d-flex ${alignment} mb-3">
      <div class="message-content d-flex align-items-end ${messageClass} p-2 rounded">
        <p class="m-0">${chat.message}</p>
        <small class="ms-2" style="margin-top: 5px">${formatChatDateTime(
    chat.time
  )}</small>
      </div>
    </div>
  `;
  $("#chat-messages").append(messageElement);
};

const sendMessage = (e) => {
  e.preventDefault();
  const message = e.target.message.value.trim();
  if (!message) return;

  $.post(`/web_rekost/sendchat/${userId}`, { message }).done(() => {
    e.target.reset();
    showChat(userId);
  });
};

const init = () => {
  clearInterval(intervalId);
  $(".chat-input").show();
  showChat(userId);

  intervalId = setInterval(() => {
    showChat(userId);
  }, 500);
};

// Event listeners
$("#input-form").on("submit", sendMessage);

// Initialize chat
if (userId) {
  init();
}
