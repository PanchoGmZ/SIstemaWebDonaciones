<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'SolidApp - Plataforma de Donaciones')</title>
    
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <style>
        :root {
            --primary: #007AFF;
            --primary-dark: #0051D5;
            --secondary: #5856D6;
            --accent: #FF9500;
            --success: #34C759;
            --warning: #FF9500;
            --error: #FF3B30;
            --text-primary: #1d1d1f;
            --text-secondary: #86868b;
            --bg-primary: rgba(255, 255, 255, 0.8);
            --bg-secondary: #f5f5f7;
            --bg-card: #ffffff;
            --border: #d2d2d7;
            --glass-border: rgba(255, 255, 255, 0.18);
            --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-glass: 0 8px 32px rgba(0, 122, 255, 0.15);
            --blur: blur(20px);
            --nav-bg: #1d1d1f;
            --nav-text: #f5f5f7;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--text-primary);
            background-color: var(--bg-secondary);
            overflow-x: hidden;
        }

        /* Animaciones Sofisticadas */
        .fade-in {
            animation: fadeIn 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }

        .slide-up {
            animation: slideUp 1s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }

        .scale-in {
            animation: scaleIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }

        @keyframes fadeIn {
            from { 
                opacity: 0;
                filter: blur(10px);
            }
            to { 
                opacity: 1;
                filter: blur(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.95);
                filter: blur(5px);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
                filter: blur(0);
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.8) rotate(-5deg);
                filter: blur(5px);
            }
            to {
                opacity: 1;
                transform: scale(1) rotate(0deg);
                filter: blur(0);
            }
        }

        /* Header Estático y Profesional */
        .header {
            background: #1d1d1f;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            position: static;
            z-index: 1000;
            box-shadow: 0 1px 0 rgba(255, 255, 255, 0.05);
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.8s ease-in-out;
        }

        .header:hover::before {
            left: 100%;
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 72px;
            position: relative;
        }

        /* Logo Profesional */
        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.75rem;
            font-weight: 600;
            color: #f5f5f7;
            text-decoration: none;
            transition: opacity 0.2s ease;
            letter-spacing: -0.02em;
        }

        .logo:hover {
            opacity: 0.85;
        }

        .logo-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #007AFF 0%, #5856D6 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.3rem;
            box-shadow: 0 2px 8px rgba(0, 122, 255, 0.2);
        }

        /* Menú de Navegación Profesional */
        .nav-menu {
            display: flex;
            list-style: none;
            gap: 0;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        .nav-item {
            position: relative;
        }

        .nav-link {
            color: rgba(245, 245, 247, 0.85);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            padding: 1rem 1.5rem;
            border-radius: 0;
            transition: all 0.2s ease;
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            white-space: nowrap;
            letter-spacing: -0.01em;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 1.5rem;
            right: 1.5rem;
            height: 2px;
            background: #007AFF;
            transform: scaleX(0);
            transition: transform 0.2s ease;
        }

        .nav-link:hover {
            color: #f5f5f7;
            background: rgba(245, 245, 247, 0.06);
        }

        .nav-link:hover::after {
            transform: scaleX(1);
        }

        .nav-link:active {
            background: rgba(245, 245, 247, 0.12);
        }

        /* Iconos profesionales */
        .nav-link i {
            font-size: 0.9rem;
            opacity: 0.7;
            transition: opacity 0.2s ease;
        }

        .nav-link:hover i {
            opacity: 1;
        }

        /* Botones CTA Profesionales */
        .btn {
            padding: 0.7rem 1.4rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            letter-spacing: -0.01em;
        }

        .btn-primary {
            background: #007AFF;
            color: white;
            box-shadow: 0 1px 3px rgba(0, 122, 255, 0.2);
        }

        .btn-primary:hover {
            background: #0051D5;
            box-shadow: 0 2px 6px rgba(0, 122, 255, 0.3);
        }

        .btn-primary:active {
            transform: scale(0.98);
        }

        .btn-outline {
            background: transparent;
            color: #f5f5f7;
            border: 1px solid rgba(245, 245, 247, 0.3);
        }

        .btn-outline:hover {
            background: rgba(245, 245, 247, 0.1);
            border-color: rgba(245, 245, 247, 0.5);
        }

        /* Efecto de ondas en click */
        .ripple {
            position: relative;
            overflow: hidden;
        }

        .ripple::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .ripple:active::after {
            width: 200px;
            height: 200px;
        }

        /* Main Content sin espacio extra */
        .main-content {
            min-height: calc(100vh - 140px);
            padding: 2rem 0;
            background: var(--bg-secondary);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Cards con estilo macOS */
        .card {
            background: var(--bg-card);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0.0, 0.2, 1);
            border: 1px solid var(--border);
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        /* Progress Bar Profesional */
        .progress-container {
            background: #e5e7eb;
            border-radius: 6px;
            height: 6px;
            overflow: hidden;
            margin: 1rem 0;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #007AFF, #5856D6);
            border-radius: 6px;
            transition: width 1s ease-out;
            position: relative;
        }

        .progress-bar::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        /* Grid Layout */
        .grid {
            display: grid;
            gap: 2rem;
        }

        .grid-2 {
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        }

        .grid-3 {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }

        .grid-4 {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }

        /* Typography macOS */
        .title {
            font-size: 2.5rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 1rem;
            line-height: 1.2;
            letter-spacing: -0.025em;
        }

        .subtitle {
            font-size: 1.25rem;
            color: var(--text-secondary);
            margin-bottom: 2rem;
            font-weight: 400;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 3rem;
            text-align: center;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 2px;
        }

        /* Footer estilo macOS */
        .footer {
            background: var(--nav-bg);
            color: var(--nav-text);
            padding: 3rem 0 1rem;
            margin-top: 4rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h3 {
            margin-bottom: 1rem;
            color: var(--primary);
        }

        .footer-section a {
            color: #d1d5db;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-section a:hover {
            color: var(--primary);
            transform: translateX(5px);
        }

        .footer-bottom {
            border-top: 1px solid rgba(55, 65, 81, 0.5);
            padding-top: 1rem;
            text-align: center;
            color: #9ca3af;
        }

        /* Mobile Responsive Profesional */
        @media (max-width: 768px) {
            .nav-container {
                padding: 0 1rem;
                height: 64px;
            }
            
            .nav-menu {
                display: none;
            }
            
            .logo {
                font-size: 1.5rem;
            }
            
            .logo-icon {
                width: 32px;
                height: 32px;
                font-size: 1.1rem;
            }
            
            .title {
                font-size: 2rem;
            }
            
            .card {
                padding: 1rem;
            }
        }

        /* Loading Animation Mejorada */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.2);
            border-radius: 50%;
            border-top-color: var(--primary);
            animation: spin 1s cubic-bezier(0.68, -0.55, 0.265, 1.55) infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Utilities */
        .text-center { text-align: center; }
        .text-primary { color: var(--primary); }
        .text-secondary { color: var(--text-secondary); }
        .mb-4 { margin-bottom: 1rem; }
        .mb-8 { margin-bottom: 2rem; }
        .mt-4 { margin-top: 1rem; }
        .mt-8 { margin-top: 2rem; }
        .p-4 { padding: 1rem; }
        .rounded { border-radius: 0.5rem; }
        .shadow { box-shadow: var(--shadow); }

        /* Micro-animaciones */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .float {
            animation: float 6s ease-in-out infinite;
        }

        /* Efecto parallax sutil */
        .parallax {
            transform: translateZ(0);
            transition: transform 0.1s ease-out;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header class="header fade-in">
        <nav class="nav-container">
            <a href="{{ route('dashboard') }}" class="logo ripple">
                <div class="logo-icon">💝</div>
                SolidApp
            </a>
            
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="{{ route('campaigns.index') }}" class="nav-link ripple">
                        <i class="fas fa-heart"></i>
                        Campañas
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link ripple">
                        <i class="fas fa-building"></i>
                        Organizaciones
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('donations.index') }}" class="nav-link ripple">
                        <i class="fas fa-hand-holding-heart"></i>
                        Donaciones
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('foundation-profiles.index') }}" class="nav-link ripple">
                        <i class="fas fa-users"></i>
                        Fundaciones
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ripple">
                        <i class="fas fa-info-circle"></i>
                        Nosotros
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ripple">
                        <i class="fas fa-envelope"></i>
                        Contacto
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Alerts -->
    @if (session('success'))
        <div class="alert alert-success fade-in" style="background: rgba(16, 185, 129, 0.9); color: white; padding: 1rem; text-align: center; margin: 1rem; border-radius: 12px; backdrop-filter: blur(10px);">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-error fade-in" style="background: rgba(239, 68, 68, 0.9); color: white; padding: 1rem; text-align: center; margin: 1rem; border-radius: 12px; backdrop-filter: blur(10px);">
            {{ session('error') }}
        </div>
    @endif

    <!-- Main Content -->
    <main class="main-content slide-up">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer slide-up">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>SolidApp</h3>
                    <p>Conectando corazones solidarios con causas que transforman el mundo. Juntos podemos hacer la diferencia.</p>
                </div>
                
                <div class="footer-section">
                    <h3>Enlaces Rápidos</h3>
                    <ul style="list-style: none;">
                        <li><a href="{{ route('campaigns.index') }}">Ver Campañas</a></li>
                        <li><a href="{{ route('categories.index') }}">Organizaciones</a></li>
                        <li><a href="{{ route('donations.index') }}">Donaciones</a></li>
                        <li><a href="{{ route('foundation-profiles.index') }}">Fundaciones</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Síguenos</h3>
                    <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                        <a href="#" style="color: var(--primary); transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">📘 Facebook</a>
                        <a href="#" style="color: var(--primary); transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">📷 Instagram</a>
                        <a href="#" style="color: var(--primary); transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🐦 Twitter</a>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} SolidApp. Todos los derechos reservados. Hecho con 💚 para un mundo mejor.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Animación de scroll suave profesional
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Animación de aparición en scroll elegante
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observar elementos con animación
        document.addEventListener('DOMContentLoaded', () => {
            const animatedElements = document.querySelectorAll('.card, .slide-up');
            animatedElements.forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'all 0.6s ease-out';
                observer.observe(el);
            });

            // Auto-dismiss alerts profesional
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-20px)';
                    setTimeout(() => alert.remove(), 300);
                }, 5000);
            });
        });

        // Efecto de progreso animado profesional
        function animateProgress(element, targetWidth) {
            let width = 0;
            const increment = targetWidth / 100;
            const timer = setInterval(() => {
                if (width >= targetWidth) {
                    clearInterval(timer);
                } else {
                    width += increment;
                    element.style.width = width + '%';
                }
            }, 10);
        }

        // Inicializar barras de progreso
        document.addEventListener('DOMContentLoaded', () => {
            const progressBars = document.querySelectorAll('.progress-bar');
            progressBars.forEach(bar => {
                const targetWidth = bar.getAttribute('data-progress') || 0;
                setTimeout(() => animateProgress(bar, targetWidth), 500);
            });
        });

        // Micro-animaciones profesionales
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                if (this.classList.contains('btn-primary')) {
                    this.style.transform = 'translateY(-1px)';
                }
            });
            
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
    @stack('scripts')
</body>
</html>