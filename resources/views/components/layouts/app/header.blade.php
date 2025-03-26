<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <style>
            /* Glassmorphism Navbar */
            .glass-navbar {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            }

            /* RGB Animated Border */
            .rgb-border {
                position: relative;
            }
            .rgb-border::before {
                content: "";
                position: absolute;
                inset: -2px;
                border-radius: inherit;
                padding: 2px;
                background: linear-gradient(45deg, #ff0000, #ff7300, #ffeb00, #47ff00, #00ffdc, #002bff, #7a00ff, #ff00c8, #ff0000);
                background-size: 400% 400%;
                animation: rgb-glow 6s linear infinite;
                -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
                -webkit-mask-composite: destination-out;
                mask-composite: exclude;
            }
            
            @keyframes rgb-glow {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }
        </style>
    </head>
    <body class="min-h-screen bg-gray-50 dark:bg-zinc-800">
        <flux:header container class="glass-navbar rgb-border p-4 rounded-lg">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
            
            <flux:navbar class="max-lg:hidden">
                <flux:navbar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                </flux:navbar.item>
            </flux:navbar>
            
            <flux:spacer />
            
            <flux:dropdown position="top" align="end">
                <flux:profile class="cursor-pointer" :initials="auth()->user()->initials()" />
                <flux:menu>
                    <flux:menu.radio.group>
                        <flux:menu.item href="/settings/profile" icon="cog" wire:navigate>
                            {{ __('Settings') }}
                        </flux:menu.item>
                    </flux:menu.radio.group>
                    <flux:menu.separator />
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>
        
        <div class="p-6">
            {{ $slot }}
        </div>
    </body>
</html>
