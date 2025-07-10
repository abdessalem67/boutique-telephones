<nav class="navbar" x-data="{ open: false }">
    <!-- Primary Navigation Menu -->
    <div class="navbar-container">
        <div class="navbar-content">
            <div class="navbar-left">
                <!-- Logo -->
                <div class="navbar-logo">
                    <a href="{{ route('dashboard') }}">
                        <svg class="logo" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.395 44.428C4.557 40.198 0 32.632 0 24 0 10.745 10.745 0 24 0a23.891 23.891 0 0113.997 4.502c-.2 17.907-11.097 33.245-26.602 39.926z" fill="#1f2937"/>
                            <path d="M14.134 45.885A23.914 23.914 0 0024 48c13.255 0 24-10.745 24-24 0-3.516-.756-6.856-2.115-9.866-4.659 15.143-16.608 27.092-31.75 31.751z" fill="#1f2937"/>
                        </svg>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="navbar-links">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        {{ __('Dashboard') }}
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="navbar-user">
                <div class="dropdown">
                    <button class="dropdown-toggle">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="dropdown-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    
                    <div class="dropdown-menu">
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">
                            {{ __('Profile') }}
                        </a>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="navbar-mobile-toggle">
                <button @click="open = ! open" class="mobile-menu-button">
                    <svg class="mobile-menu-icon" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div x-show="open" class="mobile-menu" x-transition>
        <div class="mobile-menu-links">
            <a href="{{ route('dashboard') }}" class="mobile-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                {{ __('Dashboard') }}
            </a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="mobile-user-menu">
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-email">{{ Auth::user()->email }}</div>
            </div>

            <div class="mobile-user-links">
                <a href="{{ route('profile.edit') }}" class="mobile-user-link">
                    {{ __('Profile') }}
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="mobile-user-link" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>
    /* Base styles */
    .navbar {
        background-color: white;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .navbar-container {
        max-width: 80rem;
        margin: 0 auto;
        padding: 0 1rem;
    }
    
    .navbar-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 4rem;
    }
    
    .navbar-left {
        display: flex;
        align-items: center;
    }
    
    .navbar-logo {
        flex-shrink: 0;
        display: flex;
        align-items: center;
    }
    
    .logo {
        height: 2.25rem;
        width: auto;
        fill: currentColor;
        color: #1f2937;
    }
    
    .navbar-links {
        display: none;
        margin-left: 2.5rem;
    }
    
    @media (min-width: 640px) {
        .navbar-links {
            display: flex;
            gap: 2rem;
        }
    }
    
    .nav-link {
        color: #4b5563;
        text-decoration: none;
        font-weight: 500;
        padding: 0.5rem 0;
        position: relative;
    }
    
    .nav-link:hover {
        color: #111827;
    }
    
    .nav-link.active {
        color: #111827;
        border-bottom: 2px solid #111827;
    }
    
    /* User dropdown */
    .navbar-user {
        display: none;
    }
    
    @media (min-width: 640px) {
        .navbar-user {
            display: flex;
            align-items: center;
            margin-left: 1.5rem;
        }
    }
    
    .dropdown {
        position: relative;
    }
    
    .dropdown-toggle {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 0.75rem;
        border: 1px solid transparent;
        font-size: 0.875rem;
        font-weight: 500;
        border-radius: 0.375rem;
        background-color: white;
        color: #6b7280;
        cursor: pointer;
        transition: color 0.15s ease-in-out;
    }
    
    .dropdown-toggle:hover {
        color: #374151;
    }
    
    .dropdown-arrow {
        fill: currentColor;
        height: 1rem;
        width: 1rem;
        margin-left: 0.25rem;
    }
    
    .dropdown-menu {
        position: absolute;
        right: 0;
        z-index: 10;
        margin-top: 0.5rem;
        min-width: 12rem;
        background-color: white;
        border-radius: 0.375rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
        display: none;
    }
    
    .dropdown:hover .dropdown-menu {
        display: block;
    }
    
    .dropdown-item {
        display: block;
        padding: 0.5rem 1rem;
        color: #4b5563;
        text-decoration: none;
        font-size: 0.875rem;
    }
    
    .dropdown-item:hover {
        background-color: #f9fafb;
        color: #111827;
    }
    
    /* Mobile menu toggle */
    .navbar-mobile-toggle {
        display: flex;
        align-items: center;
        margin-right: -0.5rem;
    }
    
    @media (min-width: 640px) {
        .navbar-mobile-toggle {
            display: none;
        }
    }
    
    .mobile-menu-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem;
        border-radius: 0.375rem;
        color: #9ca3af;
        background-color: transparent;
        border: none;
        cursor: pointer;
    }
    
    .mobile-menu-button:hover {
        color: #6b7280;
        background-color: #f3f4f6;
    }
    
    .mobile-menu-icon {
        height: 1.5rem;
        width: 1.5rem;
        stroke-width: 2;
    }
    
    /* Mobile menu */
    .mobile-menu {
        display: none;
        padding-top: 0.5rem;
        padding-bottom: 0.75rem;
    }
    
    .mobile-menu-links {
        padding: 0.5rem 0;
    }
    
    .mobile-nav-link {
        display: block;
        padding: 0.75rem 1rem;
        color: #4b5563;
        text-decoration: none;
        font-weight: 500;
    }
    
    .mobile-nav-link:hover {
        color: #111827;
        background-color: #f9fafb;
    }
    
    .mobile-nav-link.active {
        color: #111827;
        border-left: 2px solid #111827;
    }
    
    .mobile-user-menu {
        border-top: 1px solid #e5e7eb;
        padding: 1rem 0;
    }
    
    .user-info {
        padding: 0 1rem;
        margin-bottom: 0.75rem;
    }
    
    .user-name {
        font-weight: 500;
        color: #111827;
    }
    
    .user-email {
        font-size: 0.875rem;
        color: #6b7280;
    }
    
    .mobile-user-links {
        display: flex;
        flex-direction: column;
    }
    
    .mobile-user-link {
        display: block;
        padding: 0.75rem 1rem;
        color: #4b5563;
        text-decoration: none;
        font-size: 0.875rem;
    }
    
    .mobile-user-link:hover {
        color: #111827;
        background-color: #f9fafb;
    }
</style>