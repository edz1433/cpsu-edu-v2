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
            bottom: 80px;
            right: 20px;
            width: 400px;
            height: 500px;
            background: #ffffff;
            border-radius: 15px;
            flex-direction: column;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            z-index: 1000;
            display: none;
        }

        .chat-container.chat-open {
            display: flex;
        }

        .chat-header {
            background-color: #28a745;
            color: white;
            padding: 15px;
            font-size: 1.2em;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chat-header .header-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .chat-header img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }

        .chat-header .close-btn {
            cursor: pointer;
            font-size: 1.5em;
            font-weight: bold;
            transition: opacity 0.2s ease;
        }

        .chat-header .close-btn:hover {
            opacity: 0.7;
        }

        .chat-body {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 10px;
            scroll-behavior: smooth;
        }

        .message {
            max-width: 80%;
            padding: 10px 15px;
            border-radius: 15px;
            line-height: 1.4;
            font-size: 15px;
            word-wrap: break-word;
        }

        .user-message {
            align-self: flex-end;
            background-color: #dcf8c6;
            border-bottom-right-radius: 0;
        }

        .bot-message {
            align-self: flex-start;
            background-color: #f0f0f0;
            border-bottom-left-radius: 0;
        }

        .bot-message p:last-child,
        .bot-message ul:last-child,
        .bot-message ol:last-child {
            margin-bottom: 0;
        }

        .bot-message a {
            color: #007bff;
            text-decoration: none;
        }

        .bot-message a:hover {
            text-decoration: underline;
        }

        .citations {
            margin-top: 8px;
            padding: 8px;
            background-color: #e9ecef;
            border-radius: 8px;
            font-size: 12px;
            line-height: 1.3;
        }

        .citations a {
            color: #007bff;
            text-decoration: none;
            margin-right: 8px;
        }

        .citations a:hover {
            text-decoration: underline;
        }

        .chat-footer {
            display: flex;
            padding: 10px;
            background-color: #fafafa;
            border-top: 1px solid #ddd;
        }

        .chat-footer input {
            flex: 1;
            border: 1px solid #ccc;
            border-radius: 20px;
            padding: 10px 15px;
            outline: none;
            font-size: 16px;
        }

        .chat-footer button {
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-left: 8px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s;
            min-width: 44px;
            min-height: 44px;
        }

        .chat-footer button:hover {
            background-color: #218838;
        }

        .chat-footer button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        .loading {
            color: #888;
            font-style: italic;
        }

        .chat-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            z-index: 999;
            transition: transform 0.3s;
            min-width: 44px;
            min-height: 44px;
        }

        .chat-toggle:hover {
            transform: scale(1.05);
        }

        .chat-toggle img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .chat-body::-webkit-scrollbar {
            width: 6px;
        }

        .chat-body::-webkit-scrollbar-thumb {
            background: #bbb;
            border-radius: 3px;
        }

        body {
            position: relative;
        }

        @media (max-width: 768px) {
            .chat-container {
                width: calc(100vw - 40px);
                height: 70vh;
                bottom: 80px;
                right: 20px;
                left: 20px;
                max-width: none;
            }

            .chat-header {
                font-size: 1.1em;
                padding: 12px;
            }

            .chat-header img {
                width: 25px;
                height: 25px;
            }

            .chat-body {
                padding: 10px;
            }

            .message {
                font-size: 14px;
                padding: 8px 12px;
            }

            .citations {
                font-size: 11px;
                padding: 6px;
            }

            .chat-footer {
                padding: 8px;
            }

            .chat-footer input {
                padding: 12px 15px;
                font-size: 16px;
            }

            .chat-footer button {
                width: 44px;
                height: 44px;
                margin-left: 8px;
            }

            .chat-toggle {
                bottom: 20px;
                right: 20px;
                width: 56px;
                height: 56px;
            }

            .chat-toggle img {
                width: 36px;
                height: 36px;
            }
        }

        @media (max-width: 480px) {
            .chat-container {
                bottom: 70px;
                height: 60vh;
                border-radius: 10px;
            }

            .chat-header {
                font-size: 1em;
                padding: 10px;
            }

            .chat-header img {
                width: 22px;
                height: 22px;
            }

            .chat-body {
                padding: 8px;
                gap: 8px;
            }

            .message {
                max-width: 90%;
                font-size: 13px;
                padding: 6px 10px;
            }

            .citations {
                font-size: 10px;
                padding: 4px;
            }

            .chat-footer {
                padding: 6px;
            }

            .chat-footer input {
                padding: 10px 12px;
            }
        }

        @media (max-height: 500px) and (orientation: landscape) {
            .chat-container {
                height: 80vh;
            }
        }

        .chat-toggle:focus,
        .chat-footer button:focus,
        .chat-footer input:focus,
        .chat-header:focus {
            outline: 2px solid #ffffff00;
            outline-offset: 2px;
        }

        @media (prefers-contrast: high) {
            .chat-header {
                border-bottom: 2px solid #000;
            }

            .message {
                border: 1px solid #000;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .chat-toggle,
            .chat-footer button {
                transition: none;
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
                    <a href="https://cpsu.edu.ph/view-sublink-content/84" target="_blank">Privacy Policy</a>
                </div>
            </div>
        </div>

        <div class="cookie-overlay"></div>
    </div>

    <button class="chat-toggle" onclick="toggleChat()" title="Open CPSU ChatBot" aria-label="Open CPSU ChatBot" aria-expanded="false">
        <img src="{{ asset('Uploads/chatbot.png') }}" alt="CPSU ChatBot" aria-hidden="true">
    </button>

    <div class="chat-container" id="chatContainer" role="dialog" aria-modal="true" aria-labelledby="chatHeader" aria-hidden="true">
        <div class="chat-header" id="chatHeader" tabindex="0" role="button" aria-label="Close CPSU ChatBot">
            <div class="header-left">
                <img src="{{ asset('Uploads/chatbot.png') }}" alt="" aria-hidden="true">
                <span>CPSU ChatBot</span>
            </div>
            <span class="close-btn" aria-label="Close" tabindex="0" role="button">×</span>
        </div>

        <div class="chat-body" id="chatBody" role="log" aria-live="polite">
            <div class="bot-message message">
                Hi! 👋 I'm Kaloy, your CPSU ChatBot. How can I help you today?
            </div>
        </div>

        <div class="chat-footer">
            <input
                type="text"
                id="userInput"
                placeholder="Type your message..."
                aria-label="Type your message to the chatbot"
            />
            <button onclick="sendMessage()" aria-label="Send message" id="sendBtn">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                    <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.5 13a.5.5 0 0 1-.92.01L7.03 8.53 1.146 6.146a.5.5 0 0 1 .01-.92l13-5.5a.5.5 0 0 1 .698.42zM6.75 8.75l2.23 5.527L14.482 1.52 6.75 8.75z"/>
                </svg>
            </button>
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
    function toggleChat() {
        var chatContainer = document.getElementById("chatContainer");
        var chatToggle = document.querySelector(".chat-toggle");
        var chatBody = document.getElementById("chatBody");

        if (!chatContainer) return;

        var isOpen = chatContainer.classList.contains("chat-open");

        if (isOpen) {
            chatContainer.classList.remove("chat-open");
            chatContainer.setAttribute("aria-hidden", "true");
            if (chatToggle) chatToggle.setAttribute("aria-expanded", "false");
        } else {
            chatContainer.classList.add("chat-open");
            chatContainer.setAttribute("aria-hidden", "false");
            if (chatToggle) chatToggle.setAttribute("aria-expanded", "true");
            if (chatBody) chatBody.scrollTop = chatBody.scrollHeight;
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        const chatContainer = document.getElementById("chatContainer");
        const chatToggle = document.querySelector(".chat-toggle");
        const chatHeader = document.querySelector(".chat-header");
        const closeBtn = document.querySelector(".chat-header .close-btn");
        const chatBody = document.getElementById("chatBody");
        const userInput = document.getElementById("userInput");
        const sendBtn = document.getElementById("sendBtn");

        const CACHE_KEY = "cpsu_chat_history";
        const CACHE_TIME_KEY = "cpsu_chat_timestamp";
        const CACHE_DURATION = 4 * 60 * 60 * 1000;

        let isWaiting = false;
        let conversationHistory = [];
        let activeLoadingDiv = null;

        if (closeBtn) {
            closeBtn.addEventListener("click", (e) => {
                e.stopPropagation();
                toggleChat();
            });
        }

        if (chatHeader) {
            chatHeader.addEventListener("click", (e) => {
                if (e.target !== closeBtn) toggleChat();
            });
        }

        const loadConversation = () => {
            try {
                const data = localStorage.getItem(CACHE_KEY);
                const time = +localStorage.getItem(CACHE_TIME_KEY);

                if (data && time && Date.now() - time < CACHE_DURATION) {
                    return JSON.parse(data);
                }
            } catch (error) {
                console.error("Failed to load chat history:", error);
            }

            return [];
        };

        const saveConversation = (history) => {
            try {
                localStorage.setItem(CACHE_KEY, JSON.stringify(history));
                localStorage.setItem(CACHE_TIME_KEY, Date.now().toString());
            } catch (error) {
                console.error("Failed to save chat history:", error);
            }
        };

        conversationHistory = loadConversation();

        if (typeof marked !== "undefined") {
            marked.use({
                breaks: true,
                gfm: true,
                renderer: {
                    link({ href, title, text }) {
                        const safeHref = href || "#";
                        const safeTitle = title ? ` title="${title}"` : "";
                        return `<a href="${safeHref}"${safeTitle} target="_blank" rel="noopener noreferrer">${text || safeHref}</a>`;
                    }
                }
            });
        }

        const escapeHtml = (text) => {
            const div = document.createElement("div");
            div.textContent = text ?? "";
            return div.innerHTML;
        };

        const parseMarkdown = (text) => {
            const safeText = text ?? "";
            if (typeof marked !== "undefined" && marked.parse) {
                return marked.parse(safeText);
            }
            return escapeHtml(safeText).replace(/\n/g, "<br>");
        };

        const removeLoading = () => {
            if (activeLoadingDiv?.parentNode) {
                activeLoadingDiv.parentNode.removeChild(activeLoadingDiv);
            }
            activeLoadingDiv = null;
        };

        const normalizeCitations = (citations) => {
            if (!Array.isArray(citations)) return [];

            return citations
                .map((item) => {
                    if (!item) return null;

                    if (typeof item === "string") {
                        return { title: item, url: "#" };
                    }

                    return {
                        title: item.title || item.label || item.name || "Source",
                        url: item.url || "#"
                    };
                })
                .filter(Boolean);
        };

        const normalizeApiResponse = (data) => {
            if (typeof data === "string") {
                return {
                    reply: data,
                    citations: []
                };
            }

            if (!data || typeof data !== "object") {
                return {
                    reply: "I'm sorry, I couldn't process your request.",
                    citations: []
                };
            }

            return {
                reply: data.reply || "I'm sorry, I couldn't process your request.",
                citations: normalizeCitations(data.citations || data.sources || data.references || [])
            };
        };

        const renderCitations = (citations) => {
            if (!citations.length) return "";

            const links = citations.map((citation, index) => {
                const title = escapeHtml(citation.title || `Source ${index + 1}`);
                const url = citation.url || "#";

                if (!url || url === "#") {
                    return `<span>${title}</span>`;
                }

                return `<a href="${url}" target="_blank" rel="noopener noreferrer">${title}</a>`;
            });

            return `
                <div class="citations">
                    <strong>Sources:</strong><br>
                    ${links.join(" ")}
                </div>
            `;
        };

        const appendMessage = (role, content, citations = []) => {
            const div = document.createElement("div");
            div.className = role === "user" ? "user-message message" : "bot-message message";

            if (role === "user") {
                div.textContent = content;
            } else {
                div.innerHTML = parseMarkdown(content) + renderCitations(citations);
            }

            chatBody.appendChild(div);
            chatBody.scrollTop = chatBody.scrollHeight;
        };

        const renderHistory = () => {
            if (!chatBody) return;

            chatBody.innerHTML = `
                <div class="bot-message message">
                    Hi! 👋 I'm Kaloy, your CPSU ChatBot. How can I help you today?
                </div>
            `;

            conversationHistory.forEach((item) => {
                if (!item || !item.role || !item.content) return;

                appendMessage(
                    item.role,
                    item.content,
                    item.citations || []
                );
            });
        };

        const callChatAPI = async (history, message) => {
            const token = document.querySelector('meta[name="csrf-token"]')?.content || "";

            const res = await fetch("{{ route('chatbot.chat') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token
                },
                body: JSON.stringify({
                    message,
                    history
                })
            });

            if (!res.ok) {
                throw new Error("Server error " + res.status);
            }

            const data = await res.json();
            return normalizeApiResponse(data);
        };

        const sendMessage = async () => {
            const msg = userInput.value.trim();

            if (!msg || isWaiting) return;

            isWaiting = true;
            sendBtn.disabled = true;
            userInput.value = "";

            appendMessage("user", msg);

            removeLoading();
            activeLoadingDiv = document.createElement("div");
            activeLoadingDiv.className = "bot-message message loading";
            activeLoadingDiv.textContent = "Kaloy is typing...";
            chatBody.appendChild(activeLoadingDiv);
            chatBody.scrollTop = chatBody.scrollHeight;

            try {
                const response = await callChatAPI(conversationHistory, msg);

                removeLoading();

                appendMessage("assistant", response.reply, response.citations);

                conversationHistory.push(
                    {
                        role: "user",
                        content: msg
                    },
                    {
                        role: "assistant",
                        content: response.reply,
                        citations: response.citations
                    }
                );

                saveConversation(conversationHistory);
            } catch (err) {
                console.error(err);

                removeLoading();

                appendMessage(
                    "assistant",
                    "❌ Unable to connect right now. Please try again shortly."
                );
            } finally {
                isWaiting = false;
                sendBtn.disabled = false;
                if (userInput) userInput.focus();
            }
        };

        window.sendMessage = sendMessage;

        if (userInput) {
            userInput.addEventListener("keypress", (e) => {
                if (e.key === "Enter") {
                    e.preventDefault();
                    sendMessage();
                }
            });
        }

        if (sendBtn) {
            sendBtn.addEventListener("click", sendMessage);
        }

        renderHistory();
    });
    </script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    @if(request()->is('gad'))
    <script>
        $(document).ready(function() {
            var dataTable = $('#alltablegendercampus').DataTable({
                "ajax": {
                    "url": '{{ $apicoasUrl }}/gad-gender-student-count',
                    "type": "GET",
                },
                destroy: true,
                info: false,
                responsive: true,
                lengthChange: true,
                searching: false,
                paging: false,
                "columns": [
                    {data: 'campus'},
                    {data: 'male'},
                    {data: 'female'},
                ],
                "createdRow": function (row, data, index) {
                    $(row).attr('id', 'tr-' + data.id);
                }
            });
        });
    </script>
    @endif
</body>
</html>