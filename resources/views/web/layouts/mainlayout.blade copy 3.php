<!DOCTYPE html>
<html lang="en">
@include('web.layouts.header')
@include('web.layouts.footer')
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />

    <meta name="description" content="CPSU Official Website" />
    <title>CPSU</title>

    <link rel="shortcut icon" href="{{ asset('images/cpsu-logo.png') }}" type="image/png">

    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.nice-number.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    <style>
        .chat-container {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 400px;
            height: 560px;
            background: #ffffff;
            border-radius: 18px;
            display: none;
            flex-direction: column;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.18);
            overflow: hidden;
            z-index: 1000;
            border: 1px solid rgba(0, 0, 0, 0.08);
        }

        .chat-container.chat-open {
            display: flex;
        }

        .chat-header {
            background: linear-gradient(135deg, #198754, #28a745);
            color: #fff;
            padding: 14px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            user-select: none;
        }

        .chat-header .header-left {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
        }

        .chat-header img {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
        }

        .chat-title-wrap {
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .chat-title {
            font-size: 16px;
            font-weight: 700;
            line-height: 1.2;
        }

        .chat-subtitle {
            font-size: 12px;
            opacity: 0.9;
            line-height: 1.2;
        }

        .chat-header-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .chat-icon-btn {
            border: none;
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .chat-icon-btn:hover,
        .chat-icon-btn:focus {
            background: rgba(255, 255, 255, 0.24);
            transform: scale(1.03);
            outline: none;
        }

        .chat-body {
            flex: 1;
            padding: 14px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 10px;
            background: #f7f9fb;
            scroll-behavior: smooth;
        }

        .chat-body::-webkit-scrollbar {
            width: 6px;
        }

        .chat-body::-webkit-scrollbar-thumb {
            background: #c2c7cf;
            border-radius: 8px;
        }

        .message-row {
            display: flex;
            width: 100%;
        }

        .message-row.user {
            justify-content: flex-end;
        }

        .message-row.bot {
            justify-content: flex-start;
        }

        .message {
            max-width: 84%;
            padding: 11px 14px;
            border-radius: 16px;
            line-height: 1.5;
            font-size: 14px;
            word-break: break-word;
            box-shadow: 0 1px 2px rgba(0,0,0,0.04);
        }

        .user-message {
            background: #dcf8c6;
            color: #1d1d1d;
            border-bottom-right-radius: 4px;
        }

        .bot-message {
            background: #ffffff;
            color: #222;
            border-bottom-left-radius: 4px;
        }

        .message p:last-child {
            margin-bottom: 0;
        }

        .message ul,
        .message ol {
            padding-left: 18px;
            margin-bottom: 0.5rem;
        }

        .message a {
            color: #0d6efd;
            text-decoration: underline;
            word-break: break-all;
        }

        .message pre {
            background: #1f2937;
            color: #f9fafb;
            padding: 10px;
            border-radius: 10px;
            overflow-x: auto;
            margin-top: 8px;
        }

        .message code {
            white-space: pre-wrap;
        }

        .chat-footer {
            padding: 12px;
            border-top: 1px solid #e5e7eb;
            background: #fff;
        }

        .chat-input-wrap {
            display: flex;
            align-items: flex-end;
            gap: 8px;
        }

        .chat-footer textarea {
            flex: 1;
            resize: none;
            border: 1px solid #ced4da;
            border-radius: 18px;
            padding: 10px 14px;
            outline: none;
            font-size: 15px;
            line-height: 1.4;
            min-height: 44px;
            max-height: 120px;
            overflow-y: auto;
        }

        .chat-footer textarea:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.12);
        }

        .chat-send-btn {
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 50%;
            width: 44px;
            height: 44px;
            min-width: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.2s ease;
        }

        .chat-send-btn:hover:not(:disabled) {
            background-color: #218838;
            transform: translateY(-1px);
        }

        .chat-send-btn:disabled {
            background-color: #b8c2cc;
            cursor: not-allowed;
        }

        .chat-hint {
            margin-top: 8px;
            font-size: 12px;
            color: #6c757d;
            text-align: center;
        }

        .loading {
            color: #6c757d;
            font-style: italic;
        }

        .typing-dots::after {
            content: "";
            animation: typingDots 1.2s infinite;
        }

        @keyframes typingDots {
            0% { content: ""; }
            25% { content: "."; }
            50% { content: ".."; }
            75% { content: "..."; }
            100% { content: ""; }
        }

        .chat-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 62px;
            height: 62px;
            background: linear-gradient(135deg, #198754, #28a745);
            color: white;
            border: none;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.18);
            z-index: 999;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .chat-toggle:hover,
        .chat-toggle:focus {
            transform: scale(1.05);
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.22);
            outline: none;
        }

        .chat-toggle img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .chat-empty-state {
            text-align: center;
            color: #6b7280;
            font-size: 13px;
            padding: 20px 10px;
        }

        body.chat-opened {
            overflow: hidden;
        }

        @media (max-width: 768px) {
            .chat-container {
                width: calc(100vw - 24px);
                height: 72vh;
                right: 12px;
                left: 12px;
                bottom: 92px;
            }
        }

        @media (max-width: 480px) {
            .chat-container {
                height: 76vh;
                border-radius: 14px;
            }

            .message {
                max-width: 90%;
            }
        }
    </style>
</head>
<body id="bg">
    <div class="page-wraper">
        @yield('header')
        @yield('content')
        @yield('footer')

        <div id="cookie-popup" class="cookie-popup">
            <div class="cookie-content">
                <p>This website uses cookies to ensure you get the best experience on our website.</p>
                <div class="button-group">
                    <button onclick="acceptCookies()">Accept</button>
                    <a href="https://cpsu.edu.ph/view-sublink-content/84" target="_blank" rel="noopener noreferrer">Privacy Policy</a>
                </div>
            </div>
        </div>
        <div class="cookie-overlay"></div>
    </div>

    <button
        class="chat-toggle"
        id="chatToggle"
        type="button"
        title="Open CPSU ChatBot"
        aria-label="Open CPSU ChatBot"
        aria-expanded="false"
        aria-controls="chatContainer"
    >
        <img src="{{ asset('Uploads/chatbot.png') }}" alt="CPSU ChatBot" aria-hidden="true">
    </button>

    <div
        class="chat-container"
        id="chatContainer"
        role="dialog"
        aria-modal="true"
        aria-labelledby="chatHeaderTitle"
        aria-hidden="true"
    >
        <div class="chat-header" id="chatHeader">
            <div class="header-left">
                <img src="{{ asset('Uploads/chatbot.png') }}" alt="" aria-hidden="true">
                <div class="chat-title-wrap">
                    <span class="chat-title" id="chatHeaderTitle">Kaloy - CPSU ChatBot</span>
                    <span class="chat-subtitle" id="chatStatus">Online</span>
                </div>
            </div>

            <div class="chat-header-actions">
                <button type="button" class="chat-icon-btn" id="clearChatBtn" title="Clear chat" aria-label="Clear chat">↺</button>
                <button type="button" class="chat-icon-btn" id="closeChatBtn" title="Close chat" aria-label="Close chat">×</button>
            </div>
        </div>

        <div class="chat-body" id="chatBody" role="log" aria-live="polite" aria-relevant="additions">
        </div>

        <div class="chat-footer">
            <div class="chat-input-wrap">
                <textarea
                    id="userInput"
                    rows="1"
                    placeholder="Type your message..."
                    aria-label="Type your message to the chatbot"
                ></textarea>

                <button type="button" class="chat-send-btn" aria-label="Send message" id="sendBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.5 13a.5.5 0 0 1-.92.01L7.03 8.53 1.146 6.146a.5.5 0 0 1 .01-.92l13-5.5a.5.5 0 0 1 .698.42zM6.75 8.75l2.23 5.527L14.482 1.52 6.75 8.75z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    @if(request('page') !== null)
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var latestUpdatesElement = document.querySelector(".latest-updates");
            if (latestUpdatesElement) {
                latestUpdatesElement.scrollIntoView({ behavior: "smooth" });
            }
        });
    </script>
    @endif

    <script src="{{ asset('js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nice-number.min.js') }}"></script>
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('js/validator.min.js') }}"></script>
    <script src="{{ asset('js/ajax-contact.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const cookiePopup = document.getElementById("cookie-popup");
            const cookieOverlay = document.querySelector(".cookie-overlay");

            if (!localStorage.getItem("cookiesAccepted")) {
                cookiePopup.classList.add("show");
                cookieOverlay.style.display = "block";
            }
        });

        function acceptCookies() {
            const cookiePopup = document.getElementById("cookie-popup");
            const cookieOverlay = document.querySelector(".cookie-overlay");
            cookiePopup.classList.remove("show");
            cookieOverlay.style.display = "none";
            localStorage.setItem("cookiesAccepted", "true");
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const CHAT_ROUTE = "{{ route('chatbot.chat') }}";
            const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]')?.content || "";

            const CACHE_KEY = "cpsu_chat_history_v2";
            const CACHE_TIME_KEY = "cpsu_chat_timestamp_v2";
            const OPEN_STATE_KEY = "cpsu_chat_open_v2";
            const CACHE_DURATION = 4 * 60 * 60 * 1000;
            const MAX_HISTORY_ITEMS = 12; // 6 turns
            const MAX_RENDERED_MESSAGES = 40;

            const chatContainer = document.getElementById("chatContainer");
            const chatToggle = document.getElementById("chatToggle");
            const closeChatBtn = document.getElementById("closeChatBtn");
            const clearChatBtn = document.getElementById("clearChatBtn");
            const chatBody = document.getElementById("chatBody");
            const userInput = document.getElementById("userInput");
            const sendBtn = document.getElementById("sendBtn");
            const chatStatus = document.getElementById("chatStatus");

            let isWaiting = false;
            let conversationHistory = [];
            let lastUserMessage = "";

            const defaultWelcomeMessage = "Hi! I'm Kaloy 👋 I'm your CPSU ChatBot. How can I help you today?";

            if (typeof marked !== "undefined") {
                marked.setOptions({
                    breaks: true,
                    gfm: true
                });

                marked.use({
                    renderer: {
                        link({ href, title, text }) {
                            const safeHref = href || "#";
                            const safeTitle = title ? ` title="${escapeHtml(title)}"` : "";
                            return `<a href="${escapeAttribute(safeHref)}"${safeTitle} target="_blank" rel="noopener noreferrer">${text || safeHref}</a>`;
                        }
                    }
                });
            }

            function escapeHtml(str = "") {
                return String(str)
                    .replace(/&/g, "&amp;")
                    .replace(/</g, "&lt;")
                    .replace(/>/g, "&gt;")
                    .replace(/"/g, "&quot;")
                    .replace(/'/g, "&#039;");
            }

            function escapeAttribute(str = "") {
                return String(str).replace(/"/g, "&quot;");
            }

            function parseMarkdown(text = "") {
                if (typeof marked !== "undefined" && typeof marked.parse === "function") {
                    return marked.parse(text);
                }
                return escapeHtml(text).replace(/\n/g, "<br>");
            }

            function scrollChatToBottom(smooth = true) {
                if (!chatBody) return;
                chatBody.scrollTo({
                    top: chatBody.scrollHeight,
                    behavior: smooth ? "smooth" : "auto"
                });
            }

            function autoResizeTextarea() {
                userInput.style.height = "44px";
                userInput.style.height = Math.min(userInput.scrollHeight, 120) + "px";
            }

            function openChat() {
                chatContainer.classList.add("chat-open");
                chatContainer.setAttribute("aria-hidden", "false");
                chatToggle.setAttribute("aria-expanded", "true");
                document.body.classList.add("chat-opened");
                localStorage.setItem(OPEN_STATE_KEY, "1");
                scrollChatToBottom(false);
                setTimeout(() => userInput.focus(), 100);
            }

            function closeChat() {
                chatContainer.classList.remove("chat-open");
                chatContainer.setAttribute("aria-hidden", "true");
                chatToggle.setAttribute("aria-expanded", "false");
                document.body.classList.remove("chat-opened");
                localStorage.setItem(OPEN_STATE_KEY, "0");
                chatToggle.focus();
            }

            function toggleChat() {
                if (chatContainer.classList.contains("chat-open")) {
                    closeChat();
                } else {
                    openChat();
                }
            }

            function createMessageElement(role, content, isHtml = false, extraClass = "") {
                const row = document.createElement("div");
                row.className = `message-row ${role === "user" ? "user" : "bot"}`;

                const bubble = document.createElement("div");
                bubble.className = `message ${role === "user" ? "user-message" : "bot-message"} ${extraClass}`.trim();

                if (isHtml) {
                    bubble.innerHTML = content;
                } else {
                    bubble.textContent = content;
                }

                row.appendChild(bubble);
                return row;
            }

            function renderWelcome() {
                chatBody.innerHTML = "";
                chatBody.appendChild(
                    createMessageElement("assistant", parseMarkdown(defaultWelcomeMessage), true)
                );
            }

            function renderConversation() {
                chatBody.innerHTML = "";

                if (!conversationHistory.length) {
                    renderWelcome();
                    return;
                }

                const messagesToRender = conversationHistory.slice(-MAX_RENDERED_MESSAGES);

                messagesToRender.forEach(item => {
                    const role = item.role === "user" ? "user" : "assistant";
                    const content = role === "user"
                        ? escapeHtml(item.content)
                        : parseMarkdown(item.content);

                    chatBody.appendChild(
                        createMessageElement(role, content, true)
                    );
                });

                scrollChatToBottom(false);
            }

            function addMessage(role, content, isMarkdown = false, extraClass = "") {
                const html = isMarkdown ? parseMarkdown(content) : escapeHtml(content);
                const normalizedRole = role === "user" ? "user" : "assistant";

                chatBody.appendChild(
                    createMessageElement(normalizedRole, html, true, extraClass)
                );

                scrollChatToBottom();
            }

            function addTypingIndicator() {
                removeTypingIndicator();

                const row = document.createElement("div");
                row.className = "message-row bot";
                row.id = "typingRow";

                const bubble = document.createElement("div");
                bubble.className = "message bot-message loading";
                bubble.innerHTML = `Kaloy is typing<span class="typing-dots"></span>`;

                row.appendChild(bubble);
                chatBody.appendChild(row);
                scrollChatToBottom();
            }

            function removeTypingIndicator() {
                const existing = document.getElementById("typingRow");
                if (existing) existing.remove();
            }

            function loadConversation() {
                try {
                    const rawHistory = localStorage.getItem(CACHE_KEY);
                    const rawTime = localStorage.getItem(CACHE_TIME_KEY);
                    const timestamp = rawTime ? Number(rawTime) : 0;

                    if (!rawHistory || !timestamp) return [];

                    const expired = Date.now() - timestamp > CACHE_DURATION;
                    if (expired) {
                        localStorage.removeItem(CACHE_KEY);
                        localStorage.removeItem(CACHE_TIME_KEY);
                        return [];
                    }

                    const parsed = JSON.parse(rawHistory);
                    return Array.isArray(parsed) ? parsed : [];
                } catch (error) {
                    return [];
                }
            }

            function saveConversation() {
                try {
                    const trimmed = conversationHistory.slice(-MAX_HISTORY_ITEMS);
                    localStorage.setItem(CACHE_KEY, JSON.stringify(trimmed));
                    localStorage.setItem(CACHE_TIME_KEY, String(Date.now()));
                } catch (error) {
                    console.error("Failed to save chat history:", error);
                }
            }

            function clearConversation() {
                conversationHistory = [];
                localStorage.removeItem(CACHE_KEY);
                localStorage.removeItem(CACHE_TIME_KEY);
                renderWelcome();
                userInput.focus();
            }

            async function callChatAPI(history, message) {
                const response = await fetch(CHAT_ROUTE, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": CSRF_TOKEN,
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        message,
                        history
                    })
                });

                let payload = {};
                try {
                    payload = await response.json();
                } catch (error) {}

                if (!response.ok) {
                    const fallbackMessage =
                        payload.reply ||
                        payload.message ||
                        `Request failed with status ${response.status}`;
                    throw new Error(fallbackMessage);
                }

                return payload.reply || "Sorry, I couldn't generate a response.";
            }

            function setWaitingState(waiting) {
                isWaiting = waiting;
                sendBtn.disabled = waiting;
                userInput.disabled = waiting;
                chatStatus.textContent = waiting ? "Thinking..." : "Online";
            }

            async function sendMessage(messageOverride = null) {
                const rawMessage = messageOverride !== null ? messageOverride : userInput.value;
                const message = String(rawMessage || "").trim();

                if (!message || isWaiting) return;

                lastUserMessage = message;
                setWaitingState(true);

                if (messageOverride === null) {
                    userInput.value = "";
                    autoResizeTextarea();
                }

                addMessage("user", message, false);

                conversationHistory.push({
                    role: "user",
                    content: message
                });

                conversationHistory = conversationHistory.slice(-MAX_HISTORY_ITEMS);
                saveConversation();

                addTypingIndicator();

                try {
                    const reply = await callChatAPI(conversationHistory, message);

                    removeTypingIndicator();
                    addMessage("assistant", reply, true);

                    conversationHistory.push({
                        role: "assistant",
                        content: reply
                    });

                    conversationHistory = conversationHistory.slice(-MAX_HISTORY_ITEMS);
                    saveConversation();
                } catch (error) {
                    removeTypingIndicator();

                    const errorHtml = `
                        <div>❌ ${escapeHtml(error.message || "Unable to connect right now. Please try again shortly.")}</div>
                        <div style="margin-top:8px;">
                            <button type="button" id="retryLastMessageBtn" style="border:none;background:#198754;color:#fff;padding:6px 12px;border-radius:8px;cursor:pointer;">
                                Retry
                            </button>
                        </div>
                    `;

                    chatBody.appendChild(
                        createMessageElement("assistant", errorHtml, true)
                    );
                    scrollChatToBottom();

                    setTimeout(() => {
                        const retryBtn = document.getElementById("retryLastMessageBtn");
                        if (retryBtn) {
                            retryBtn.addEventListener("click", () => {
                                retryBtn.disabled = true;
                                retryBtn.textContent = "Retrying...";
                                sendMessage(lastUserMessage);
                            }, { once: true });
                        }
                    }, 0);
                } finally {
                    setWaitingState(false);
                    userInput.disabled = false;
                    userInput.focus();
                }
            }

            chatToggle.addEventListener("click", toggleChat);
            closeChatBtn.addEventListener("click", closeChat);

            clearChatBtn.addEventListener("click", () => {
                // if (confirm("Clear this chat conversation?")) {
                    clearConversation();
                // }
            });

            document.addEventListener("keydown", (event) => {
                if (event.key === "Escape" && chatContainer.classList.contains("chat-open")) {
                    closeChat();
                }
            });

            userInput.addEventListener("input", autoResizeTextarea);

            userInput.addEventListener("keydown", (event) => {
                if (event.key === "Enter" && !event.shiftKey) {
                    event.preventDefault();
                    sendMessage();
                }
            });

            sendBtn.addEventListener("click", () => sendMessage());

            conversationHistory = loadConversation();
            renderConversation();
            autoResizeTextarea();

            const shouldOpen = localStorage.getItem(OPEN_STATE_KEY) === "1";
            if (shouldOpen) {
                openChat();
            }
        });
    </script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    @if(request()->is('gad'))
    <script>
        $(document).ready(function() {
            $('#alltablegendercampus').DataTable({
                ajax: {
                    url: '{{ $apicoasUrl }}/gad-gender-student-count',
                    type: 'GET'
                },
                destroy: true,
                info: false,
                responsive: true,
                lengthChange: true,
                searching: false,
                paging: false,
                columns: [
                    { data: 'campus' },
                    { data: 'male' },
                    { data: 'female' },
                ],
                createdRow: function(row, data) {
                    $(row).attr('id', 'tr-' + data.id);
                }
            });
        });
    </script>
    @endif
</body>
</html>