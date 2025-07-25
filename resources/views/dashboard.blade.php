@extends('layouts.plantilla')

@section('title', 'Dashboard - SolidApp')

@section('content')
<div class="dashboard-container">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Bienvenido a SolidApp</h1>
                <p class="hero-subtitle">Conectando corazones solidarios con causas que transforman el mundo</p>
            </div>
        </div>
    </section>

    <!-- Stats Grid -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">{{ $totalCampaigns ?? '0' }}</h3>
                        <p class="stat-label">Campañas Activas</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">{{ $totalDonors ?? '0' }}</h3>
                        <p class="stat-label">Donantes</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">${{ number_format($totalDonations ?? 0, 0) }}</h3>
                        <p class="stat-label">Total Recaudado</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">{{ $totalFoundations ?? '0' }}</h3>
                        <p class="stat-label">Fundaciones</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Actions -->
    <section class="actions-section">
        <div class="container">
            <h2 class="section-title">Acciones Rápidas</h2>
            <div class="actions-grid">
                <a href="{{ route('campaigns.create') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <h3 class="action-title">Nueva Campaña</h3>
                    <p class="action-description">Crea una nueva campaña de donación</p>
                </a>
                
                <a href="{{ route('donations.create') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <h3 class="action-title">Hacer Donación</h3>
                    <p class="action-description">Contribuye a una causa</p>
                </a>
                
                <a href="{{ route('foundation-profiles.create') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3 class="action-title">Registrar Fundación</h3>
                    <p class="action-description">Añade una nueva organización</p>
                </a>
                
                <a href="{{ route('campaigns.index') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="action-title">Explorar Campañas</h3>
                    <p class="action-description">Descubre causas importantes</p>
                </a>
            </div>
        </div>
    </section>

    <!-- Recent Activity -->
    <section class="activity-section">
        <div class="container">
            <div class="activity-grid">
                <!-- Recent Campaigns -->
                <div class="activity-card">
                    <div class="activity-header">
                        <h3 class="activity-title">Campañas Recientes</h3>
                        <a href="{{ route('campaigns.index') }}" class="view-all-link">Ver todas</a>
                    </div>
                    <div class="activity-content">
                        @forelse($recentCampaigns ?? [] as $campaign)
                            <div class="activity-item">
                                <div class="activity-item-icon">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <div class="activity-item-content">
                                    <p class="activity-item-title">{{ $campaign->title }}</p>
                                    <p class="activity-item-meta">{{ $campaign->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <i class="fas fa-heart-broken"></i>
                                <p>No hay campañas recientes</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Donations -->
                <div class="activity-card">
                    <div class="activity-header">
                        <h3 class="activity-title">Donaciones Recientes</h3>
                        <a href="{{ route('donations.index') }}" class="view-all-link">Ver todas</a>
                    </div>
                    <div class="activity-content">
                        @forelse($recentDonations ?? [] as $donation)
                            <div class="activity-item">
                                <div class="activity-item-icon">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <div class="activity-item-content">
                                    <p class="activity-item-title">${{ number_format($donation->amount, 0) }}</p>
                                    <p class="activity-item-meta">{{ $donation->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <i class="fas fa-hand-holding"></i>
                                <p>No hay donaciones recientes</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('styles')
<style>
/* Dashboard Estilo Apple */
.dashboard-container {
    background: var(--bg-secondary);
    min-height: 100vh;
}

/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, #007AFF 0%, #5856D6 100%);
    padding: 4rem 0;
    color: white;
    text-align: center;
}

.hero-content {
    max-width: 800px;
    margin: 0 auto;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 600;
    letter-spacing: -0.02em;
    margin-bottom: 1rem;
    line-height: 1.1;
}

.hero-subtitle {
    font-size: 1.25rem;
    font-weight: 400;
    opacity: 0.9;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.5;
}

/* Stats Section */
.stats-section {
    padding: 4rem 0;
    background: var(--bg-secondary);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.stat-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    display: flex;
    align-items: center;
    gap: 1.5rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.04);
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
}

.stat-icon {
    width: 64px;
    height: 64px;
    background: linear-gradient(135deg, #007AFF, #5856D6);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.stat-icon i {
    font-size: 1.5rem;
    color: white;
}

.stat-content {
    flex: 1;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.25rem;
    letter-spacing: -0.02em;
    line-height: 1;
}

.stat-label {
    font-size: 1rem;
    color: var(--text-secondary);
    font-weight: 500;
    margin: 0;
}

/* Actions Section */
.actions-section {
    padding: 4rem 0;
    background: white;
}

.section-title {
    font-size: 2rem;
    font-weight: 600;
    color: var(--text-primary);
    text-align: center;
    margin-bottom: 3rem;
    letter-spacing: -0.02em;
}

.actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.action-card {
    background: var(--bg-secondary);
    border-radius: 20px;
    padding: 2.5rem 2rem;
    text-align: center;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.04);
    display: block;
}

.action-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
    text-decoration: none;
}

.action-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #007AFF, #5856D6);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    transition: all 0.3s ease;
}

.action-card:hover .action-icon {
    transform: scale(1.1);
}

.action-icon i {
    font-size: 2rem;
    color: white;
}

.action-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.75rem;
    letter-spacing: -0.01em;
}

.action-description {
    font-size: 1rem;
    color: var(--text-secondary);
    line-height: 1.5;
    margin: 0;
}

/* Activity Section */
.activity-section {
    padding: 4rem 0;
    background: var(--bg-secondary);
}

.activity-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.activity-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
    border: 1px solid rgba(0, 0, 0, 0.04);
}

.activity-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(0, 0, 0, 0.06);
}

.activity-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0;
    letter-spacing: -0.01em;
}

.view-all-link {
    color: #007AFF;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.9rem;
    transition: opacity 0.2s ease;
}

.view-all-link:hover {
    opacity: 0.7;
    text-decoration: none;
}

.activity-content {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.activity-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.75rem;
    border-radius: 12px;
    transition: background-color 0.2s ease;
}

.activity-item:hover {
    background: rgba(0, 122, 255, 0.04);
}

.activity-item-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #007AFF, #5856D6);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.activity-item-icon i {
    font-size: 0.9rem;
    color: white;
}

.activity-item-content {
    flex: 1;
}

.activity-item-title {
    font-size: 1rem;
    font-weight: 500;
    color: var(--text-primary);
    margin-bottom: 0.25rem;
    line-height: 1.3;
}

.activity-item-meta {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin: 0;
}

.empty-state {
    text-align: center;
    padding: 3rem 1rem;
    color: var(--text-secondary);
}

.empty-state i {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: 0.3;
}

.empty-state p {
    font-size: 1rem;
    margin: 0;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.125rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .stat-card {
        padding: 1.5rem;
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .actions-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .action-card {
        padding: 2rem 1.5rem;
    }
    
    .activity-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .activity-card {
        padding: 1.5rem;
    }
}

@media (max-width: 480px) {
    .hero-section {
        padding: 3rem 0;
    }
    
    .stats-section,
    .actions-section,
    .activity-section {
        padding: 3rem 0;
    }
    
    .container {
        padding: 0 1rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animación de números contador
    const statNumbers = document.querySelectorAll('.stat-number');
    
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px 0px -100px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;
                const finalNumber = target.textContent.replace(/[^0-9]/g, '');
                
                if (finalNumber) {
                    animateNumber(target, parseInt(finalNumber));
                }
                
                observer.unobserve(target);
            }
        });
    }, observerOptions);
    
    statNumbers.forEach(stat => observer.observe(stat));
    
    function animateNumber(element, target) {
        let current = 0;
        const increment = target / 100;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            
            const prefix = element.textContent.includes('$') ? '$' : '';
            element.textContent = prefix + Math.floor(current).toLocaleString();
        }, 20);
    }
    
    // Efecto de aparición suave para las cards
    const cards = document.querySelectorAll('.stat-card, .action-card, .activity-card');
    
    const cardObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
                cardObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    
    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'all 0.6s ease-out';
        cardObserver.observe(card);
    });
});
</script>
@endpush
@endsection