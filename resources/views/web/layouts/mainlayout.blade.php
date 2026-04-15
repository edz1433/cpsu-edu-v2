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
   
    <!-- DESCRIPTION -->
    <meta name="description" content="CPSU Official Website" />
   
    <!-- DESCRIPTION -->
    <title>CPSU</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{ asset('images/cpsu-logo.png') }}" type="image/png">
       
    <!--====== Slick css ======-->
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <!--====== Animate css ======-->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <!--====== Nice Select css ======-->
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <!--====== Nice Number css ======-->
    <link rel="stylesheet" href="{{ asset('css/jquery.nice-number.min.css') }}">
    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!--====== Fontawesome css ======-->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <!--====== Default css ======-->
    <link rel="stylesheet" href="{{ asset('css/default.css') }}">
    <!--====== Style css ======-->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!--====== Responsive css ======-->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Chatbot Marked.js -->
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <!-- Chatbot Styles -->
    <style>
        /* Chatbot Floating Container */
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
            display: none; /* Initially hidden; JS adds display:flex via .chat-open class */
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
        /* NEW: Citation Styles for Relevant Items */
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
            font-size: 16px; /* Prevent zoom on iOS */
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
            min-width: 44px; /* Touch target size */
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
        /* Floating Toggle Button */
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
        /* Scrollbar for chat body */
        .chat-body::-webkit-scrollbar {
            width: 6px;
        }
        .chat-body::-webkit-scrollbar-thumb {
            background: #bbb;
            border-radius: 3px;
        }
        /* Ensure no conflicts with existing body styles */
        body {
            position: relative;
        }
        /* Responsive Design for Smaller Screens */
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
        /* Landscape orientation on mobile */
        @media (max-height: 500px) and (orientation: landscape) {
            .chat-container {
                height: 80vh;
            }
        }
        /* Accessibility Focus Styles */
        .chat-toggle:focus,
        .chat-footer button:focus,
        .chat-footer input:focus,
        .chat-header:focus {
            outline: 2px solid #ffffff00;
            outline-offset: 2px;
        }
        /* High contrast mode support */
        @media (prefers-contrast: high) {
            .chat-header {
                border-bottom: 2px solid #000;
            }
            .message {
                border: 1px solid #000;
            }
        }
        /* Reduced motion for animations */
        @media (prefers-reduced-motion: reduce) {
            .chat-toggle {
                transition: none;
            }
            .chat-footer button {
                transition: none;
            }
        }
    </style>
</head>
<body id="bg">
    <div class="page-wraper">
        <!--<div id="loading-icon-bx"></div>-->
        <!-- Header Top ==== -->
        @yield('header')
        <!-- Header Top END ==== -->
       
        <!-- Content -->
        @yield('content')
        <!-- Content END-->
   
        <!-- Footer ==== -->
        @yield('footer')
        <!-- Footer END ==== -->
        {{-- <button class="back-to-top fa fa-chevron-up" ></button> --}}
        <div id="cookie-popup" class="cookie-popup">
            <div class="cookie-content">
                <p>This website uses cookies to ensure you get the best experience on our website.</p>
                <div class="button-group">
                    <button onclick="acceptCookies()">Accept</button>
                    <a href="https://cpsu.edu.ph/view-sublink-content/84" target="_blank">Privacy Policy</a>
                </div>
            </div>
        </div>
        <!-- Cookie Overlay -->
        <div class="cookie-overlay"></div>
    </div>
    <!-- Chatbot Toggle Button -->
    <button class="chat-toggle" onclick="toggleChat()" title="Open CPSU ChatBot" aria-label="Open CPSU ChatBot" aria-expanded="false">
        <img src="{{ asset('Uploads/chatbot.png') }}" alt="CPSU ChatBot" aria-hidden="true">
    </button>
    <!-- Chatbot Container -->
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
                Hi! I'm Kaloy👋 I'm your CPSU ChatBot. How can I help you today?
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
    <!--====== FOOTER PART ENDS ======-->
   
    <!--====== BACK TO TOP PART START ======-->
    {{-- <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a> --}}
    <!--====== BACK TO TOP PART ENDS ======-->
    <!--====== jquery js ======-->
    <script src="{{ asset('js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>
    <!--====== Bootstrap js ======-->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!--====== Slick js ======-->
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <!--====== Magnific Popup js ======-->
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <!--====== Counter Up js ======-->
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <!--====== Nice Select js ======-->
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <!--====== Nice Number js ======-->
    <script src="{{ asset('js/jquery.nice-number.min.js') }}"></script>
    <!--====== Count Down js ======-->
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <!--====== Validator js ======-->
    <script src="{{ asset('js/validator.min.js') }}"></script>
    <!--====== Ajax Contact js ======-->
    <script src="{{ asset('js/ajax-contact.js') }}"></script>
    <!--====== Main js ======-->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const cookiePopup = document.getElementById("cookie-popup");
        const cookieOverlay = document.querySelector(".cookie-overlay");
        // Check if the user has already accepted cookies
        if (!localStorage.getItem("cookiesAccepted")) {
            cookiePopup.classList.add("show"); // Show the popup
            cookieOverlay.style.display = "block"; // Show the overlay
        }
    });
    function acceptCookies() {
        const cookiePopup = document.getElementById("cookie-popup");
        const cookieOverlay = document.querySelector(".cookie-overlay");
        // Hide the popup and overlay
        cookiePopup.classList.remove("show");
        cookieOverlay.style.display = "none";
        // Set a flag to remember that the user accepted cookies
        localStorage.setItem("cookiesAccepted", "true");
    }
    </script>

    <!-- Active Chatbot Script (fixed syntax) -->
    <script>
    /* ================= TOGGLE (global — must be defined before DOMContentLoaded) ================= */
    function toggleChat() {
        var chatContainer = document.getElementById("chatContainer");
        var chatToggle    = document.querySelector(".chat-toggle");
        var chatBody      = document.getElementById("chatBody");
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

        /* ================= ELEMENTS ================= */
        const chatContainer = document.getElementById("chatContainer");
        const chatToggle = document.querySelector(".chat-toggle");
        const chatHeader = document.querySelector(".chat-header");
        const closeBtn = document.querySelector(".chat-header .close-btn");
        const chatBody = document.getElementById("chatBody");
        const userInput = document.getElementById("userInput");
        const sendBtn = document.getElementById("sendBtn");

        closeBtn.addEventListener("click", (e) => { e.stopPropagation(); toggleChat(); });
        chatHeader.addEventListener("click", e => { if(e.target !== closeBtn) toggleChat(); });

        /* ================= CONFIG ================= */
        const CACHE_KEY      = "cpsu_chat_history";
        const CACHE_TIME_KEY = "cpsu_chat_timestamp";
        const CACHE_DURATION = 4 * 60 * 60 * 1000; // 4 hours

        let isWaiting           = false;
        let conversationHistory = [];
        let activeLoadingDiv    = null;

        /* ================= CONVERSATION CACHE ================= */
        const loadConversation = () => {
            try {
                const d = localStorage.getItem(CACHE_KEY);
                const t = +localStorage.getItem(CACHE_TIME_KEY);
                if (d && t && Date.now() - t < CACHE_DURATION) return JSON.parse(d);
            } catch {}
            return [];
        };
        const saveConversation = h => {
            localStorage.setItem(CACHE_KEY, JSON.stringify(h));
            localStorage.setItem(CACHE_TIME_KEY, Date.now());
        };

        conversationHistory = loadConversation();

        /* ================= MARKDOWN ================= */
        if (typeof marked !== "undefined") {
            marked.use({
                renderer: {
                    link({ href, title, text }) {
                        const t = title ? ` title="${title}"` : "";
                        return `<a href="${href}"${t} target="_blank" rel="noopener noreferrer">${text || href}</a>`;
                    }
                }
            });
        }
        const parseMarkdown = txt =>
            (typeof marked !== "undefined" && marked.parse)
                ? marked.parse(txt)
                : txt.replace(/\n/g, "<br>");

        const removeLoading = () => {
            if (activeLoadingDiv?.parentNode) activeLoadingDiv.parentNode.removeChild(activeLoadingDiv);
            activeLoadingDiv = null;
        };

        /* ================= CALL LOCAL CLAUDE ENDPOINT ================= */
        const callChatAPI = async (history, message) => {
            const token = document.querySelector('meta[name="csrf-token"]').content;
            const res = await fetch("{{ route('chatbot.send') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token
                },
                body: JSON.stringify({ message, history })
            });
            if (!res.ok) throw new Error("Server error " + res.status);
            const data = await res.json();
            return data.reply || "I'm sorry, I couldn't process your request.";
        };

        /* ================= SEND MESSAGE ================= */
        const sendMessage = async () => {
            const msg = userInput.value.trim();
            if (!msg || isWaiting) return;

            isWaiting = true;
            sendBtn.disabled = true;
            userInput.value = "";

            const userDiv = document.createElement("div");
            userDiv.className = "user-message message";
            userDiv.textContent = msg;
            chatBody.appendChild(userDiv);
            chatBody.scrollTop = chatBody.scrollHeight;

            removeLoading();
            activeLoadingDiv = document.createElement("div");
            activeLoadingDiv.className = "bot-message message loading";
            activeLoadingDiv.textContent = "Kaloy is typing...";
            chatBody.appendChild(activeLoadingDiv);
            chatBody.scrollTop = chatBody.scrollHeight;

            try {
                const reply = await callChatAPI(conversationHistory, msg);

                removeLoading();
                const botDiv = document.createElement("div");
                botDiv.className = "bot-message message";
                botDiv.innerHTML = parseMarkdown(reply);
                chatBody.appendChild(botDiv);
                chatBody.scrollTop = chatBody.scrollHeight;

                conversationHistory.push(
                    { role: "user",      content: msg   },
                    { role: "assistant", content: reply }
                );
                saveConversation(conversationHistory);

            } catch (err) {
                removeLoading();
                const errDiv = document.createElement("div");
                errDiv.className = "bot-message message";
                errDiv.textContent = "❌ Unable to connect right now. Please try again shortly.";
                chatBody.appendChild(errDiv);
            } finally {
                isWaiting = false;
                sendBtn.disabled = false;
            }
        };

        userInput?.addEventListener("keypress", e => { if (e.key === "Enter") { e.preventDefault(); sendMessage(); } });
        sendBtn?.addEventListener("click", sendMessage);

    });
    </script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
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
</body>
</html>