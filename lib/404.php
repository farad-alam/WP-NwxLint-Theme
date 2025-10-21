<?php
get_header();
?>

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .float-animation {
        animation: float 3s ease-in-out infinite;
    }
    .fade-in {
        animation: fadeIn 0.8s ease-out forwards;
    }
    .delay-1 { animation-delay: 0.2s; opacity: 0; }
    .delay-2 { animation-delay: 0.4s; opacity: 0; }
    .delay-3 { animation-delay: 0.6s; opacity: 0; }
</style>

<main class="flex items-center justify-center min-h-screen px-4 py-16">
    <div class="text-center max-w-2xl">
        
        <!-- 404 Illustration -->
        <div class="mb-8 float-animation">
            <svg class="w-64 h-64 mx-auto" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Planet/Circle -->
                <circle cx="100" cy="100" r="80" fill="#E0E7FF" opacity="0.5"/>
                <circle cx="100" cy="100" r="60" fill="#C7D2FE"/>
                
                <!-- Craters -->
                <circle cx="80" cy="85" r="12" fill="#A5B4FC" opacity="0.6"/>
                <circle cx="115" cy="95" r="8" fill="#A5B4FC" opacity="0.6"/>
                <circle cx="95" cy="120" r="10" fill="#A5B4FC" opacity="0.6"/>
                
                <!-- Rocket -->
                <g transform="translate(140, 50)">
                    <rect x="10" y="20" width="15" height="35" rx="3" fill="#EF4444"/>
                    <polygon points="17.5,10 10,20 25,20" fill="#DC2626"/>
                    <circle cx="17.5" cy="35" r="4" fill="#FEF3C7"/>
                    <rect x="5" y="55" width="8" height="12" fill="#F59E0B"/>
                    <rect x="22" y="55" width="8" height="12" fill="#F59E0B"/>
                    <path d="M 10 67 Q 13 75 17.5 73 Q 22 75 25 67" fill="#FBBF24"/>
                </g>
                
                <!-- Stars -->
                <circle cx="30" cy="40" r="2" fill="#FBBF24"/>
                <circle cx="170" cy="60" r="2" fill="#FBBF24"/>
                <circle cx="160" cy="140" r="2" fill="#FBBF24"/>
                <circle cx="40" cy="150" r="2" fill="#FBBF24"/>
                <circle cx="180" cy="110" r="2" fill="#FBBF24"/>
            </svg>
        </div>

        <!-- 404 Text -->
        <div class="mb-8">
            <h1 class="text-8xl md:text-9xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 mb-4 fade-in">
                404
            </h1>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 fade-in delay-1">
                Oops! Page Not Found
            </h2>
            <p class="text-lg text-gray-600 mb-8 fade-in delay-2">
                The page you're looking for seems to have drifted into space. Don't worry, we'll help you get back on track!
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center fade-in delay-3">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Go Home
                </span>
            </a>
            <a href="javascript:history.back()" class="px-8 py-4 bg-white text-gray-700 font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300 border-2 border-gray-200">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Go Back
                </span>
            </a>
        </div>

        <!-- Search Box -->
        <div class="mt-12 fade-in delay-3">
            <p class="text-gray-600 mb-4">Or try searching for what you need:</p>
            <form class="max-w-md mx-auto" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                <div class="relative">
                    <input 
                        type="search" 
                        name="s"
                        placeholder="Search..." 
                        class="w-full px-6 py-4 rounded-full border-2 border-gray-200 focus:border-purple-500 focus:outline-none shadow-md text-gray-700 placeholder-gray-400"
                    >
                    <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-gradient-to-r from-blue-600 to-purple-600 text-white p-3 rounded-full hover:shadow-lg transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Popular Links -->
        <div class="mt-12 fade-in delay-3">
            <p class="text-gray-600 mb-4">Or check out these popular pages:</p>
            <div class="flex flex-wrap gap-3 justify-center">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="px-4 py-2 bg-white rounded-full text-sm text-gray-700 hover:bg-purple-100 hover:text-purple-700 transition-colors shadow-sm">Home</a>
                <a href="<?php echo esc_url(home_url('/blog')); ?>" class="px-4 py-2 bg-white rounded-full text-sm text-gray-700 hover:bg-purple-100 hover:text-purple-700 transition-colors shadow-sm">Blog</a>
                <a href="<?php echo esc_url(home_url('/about')); ?>" class="px-4 py-2 bg-white rounded-full text-sm text-gray-700 hover:bg-purple-100 hover:text-purple-700 transition-colors shadow-sm">About</a>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="px-4 py-2 bg-white rounded-full text-sm text-gray-700 hover:bg-purple-100 hover:text-purple-700 transition-colors shadow-sm">Contact</a>
            </div>
        </div>

    </div>
</main>

<?php
get_footer();
?>