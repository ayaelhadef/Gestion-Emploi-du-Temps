<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Emploi du Temps</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/headfoot.css') }}">       
</head>

<body id="appBody">

<button id="toggleSidebar" class="toggle-btn">☰</button>

<div id="sidebar" class="sidebar">

    <div id="sidebarTitle" class="navnav">
        <span></span>
        <span>Gestion Emploi du Temps</span> 
    </div>

    <a href="/admin"><span>🏠</span><span>Dashboard</span></a>
    <a href="/etudiants"><span>🎓</span><span>Etudiants</span></a>
    <a href="/enseignants"><span>👨‍🏫</span><span>Enseignants</span></a>
    <a href="/filieres"><span>🏫</span><span>Filières</span></a>
    <a href="/cours"><span>📚</span><span>Cours</span></a>
    <a href="/salles"><span>🚪</span><span>Salles</span></a>
    <a href="/emplois"><span>🗓️</span><span>Emplois</span></a>
    <a href="/admin/messages"><span>📩</span><span>Message</span>
    </a>
    <a href=""><form method="POST" action="/logout" class="logout-form">
    @csrf

    <button type="submit" class="logout-btn-sidebar">

        <span>
            <i class="bi bi-box-arrow-right"></i>
        </span>

        <span>Logout</span>

    </button>
</form></a>

</div>

<div class="page-wrapper">

    <div class="content">
        @yield('content')
    </div>

    <footer>
    <div class="container p-4">
        <div class="row">

            <div class="col-md-6">
                <h5 class="text-uppercase">Contact</h5>
                <p class="mb-1">📞 Téléphone : +212 6 00 00 00 00</p>
                <p class="mb-1">📍 Adresse : ENSIASD, Taroudant</p>
                <p class="mb-1">✉ Email : contact@ensiasd.ma</p>
                <p class="mb-1">@ENSIASD</p>
            </div>

            <div class="col-md-6 text-md-end text-center">
                <h5 class="text-uppercase">Suivez-nous</h5>

                <a href="#" class="text-white me-3 fs-4">
                    <i class="bi bi-facebook"></i>
                </a>

                <a href="#" class="text-white me-3 fs-4">
                    <i class="bi bi-instagram"></i>
                </a>

                <a href="#" class="text-white me-3 fs-4">
                    <i class="bi bi-twitter-x"></i>
                </a>

                <a href="#" class="text-white fs-4">
                    <i class="bi bi-linkedin"></i>
                </a>
            </div>

        </div>
    </div>

    <div class="text-center bg-secondary p-2">
        © {{ date('Y') }} Gestion Emploi du Temps | ENSIASD
    </div>
</footer>

</div>

<!-- JS -->
<script>
const sidebar = document.getElementById("sidebar");
const body = document.getElementById("appBody");
const toggleBtn = document.getElementById("toggleSidebar");
const sidebarTitle = document.getElementById("sidebarTitle");

const isCollapsed = localStorage.getItem("sidebarCollapsed") === "true";

if (isCollapsed) {
    sidebar.classList.add("collapsed");
    body.classList.add("sidebar-collapsed");
}

sidebarTitle.addEventListener("click", () => {
    sidebar.classList.add("collapsed");
    body.classList.add("sidebar-collapsed");
    localStorage.setItem("sidebarCollapsed", true);
});

toggleBtn.addEventListener("click", () => {
    sidebar.classList.remove("collapsed");
    body.classList.remove("sidebar-collapsed");
    localStorage.setItem("sidebarCollapsed", false);
});
toggleBtn.addEventListener("click", () => {
    sidebar.classList.toggle("show");
});
document.querySelectorAll(".sidebar a").forEach(link => {
    link.addEventListener("click", () => {
        if (window.innerWidth <= 480) {
            sidebar.classList.remove("show");
        }
    });
});
</script>

</body>
</html>