@extends('layouts.public')

@section('title', $profile ? $profile->name : 'dravide.dev')

@section('content')
<div class="min-h-screen bg-white text-black font-mono selection:bg-black selection:text-white pb-20" x-data="{ selectedProject: null, selectedPost: null }">

    <!-- Header / Logo -->
    <header class="container-custom px-6 py-10">
        <div class="text-xs font-bold tracking-tighter text-accent uppercase">
            // {{ strtoupper(substr($profile->name ?? 'AH', 0, 2)) }}
        </div>
    </header>

    <main class="container-custom px-6">
        <!-- Hero Section -->
        <section class="mb-16">
            @if($profile && $profile->avatar)
                <div class="mb-6">
                    <img src="{{ Storage::url($profile->avatar) }}" alt="{{ $profile->name }}" class="w-16 h-16 rounded-full object-cover grayscale hover:grayscale-0 transition-all duration-500">
                </div>
            @endif

            <h1 class="text-2xl font-bold mb-6">
                Hey, I'm <span class="text-accent underline decoration-2 underline-offset-4">{{ $profile->name ?? 'Admin' }}</span>!
            </h1>

            <div class="space-y-4 text-sm leading-relaxed text-gray-800 mb-8">
                @if($profile && $profile->bio)
                    <p>{{ $profile->bio }}</p>
                @else
                    <p>A passionate developer building web applications.</p>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-4 mb-8">
                <a href="https://wa.me/{{ $profile->whatsapp_number ?? '#' }}" target="_blank" class="bg-black text-white text-xs font-bold px-6 py-2.5 rounded hover:bg-gray-800 transition-colors">
                    Message on WhatsApp
                </a>
                <a href="mailto:{{ $profile->email ?? '#' }}" class="border border-gray-200 text-black text-xs font-bold px-6 py-2.5 rounded hover:bg-gray-50 transition-colors">
                    Send an email
                </a>
            </div>

            <!-- Status Indicator -->
            <div class="flex items-center gap-2 text-[10px] tracking-wide text-gray-400 uppercase">
                <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                Available for new projects, let's talk!
            </div>
        </section>

        <!-- Tech Stack -->
        <section class="mb-16">
            <h2 class="text-[10px] font-bold tracking-[0.2em] text-gray-400 uppercase mb-6">Tech Stack</h2>
            <p class="text-xs text-gray-600 mb-6 font-medium">The tools I use daily:</p>
            <div class="flex flex-wrap gap-2">
                @forelse($techStacks as $tech)
                <div class="flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 border border-gray-100 rounded-lg text-xs font-medium text-gray-700 hover:border-gray-300 transition-all cursor-default">
                    @if($tech->icon)
                        <i class="{{ $tech->icon }}" style="color: {{ $tech->color ?? '#9ca3af' }}"></i>
                    @else
                        <span class="w-1 h-1 rounded-full" style="background-color: {{ $tech->color ?? '#d1d5db' }}"></span>
                    @endif
                    {{ $tech->name }}
                </div>
                @empty
                    <p class="text-[10px] text-gray-400 italic">No tech stack items added yet.</p>
                @endforelse
            </div>
        </section>

        <!-- Projects Section -->
        <section class="mb-16" id="work">
            <h2 class="text-[10px] font-bold tracking-[0.2em] text-gray-400 uppercase mb-6">Projects</h2>
            <p class="text-xs text-gray-600 mb-8 font-medium">These are my personal projects, both past and ongoing:</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @forelse($portfolios as $portfolio)
                <div class="group bg-white border border-gray-100 p-5 rounded-xl hover:border-gray-200 hover:shadow-sm transition-all relative overflow-hidden cursor-pointer" 
                    @click="selectedProject = {{ $portfolio->toJson() }}">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center text-gray-400 group-hover:text-black transition-colors">
                                <i class="{{ $portfolio->category_icon }}"></i>
                            </div>
                            <h3 class="font-bold text-sm">{{ $portfolio->title }}</h3>
                        </div>
                        @if($portfolio->is_visible)
                            <span class="text-[9px] font-bold px-2 py-0.5 bg-green-50 text-green-600 rounded-full tracking-wide">Active</span>
                        @endif
                    </div>
                    <p class="text-xs text-gray-500 leading-relaxed min-h-[40px]">
                        {{ Str::limit($portfolio->description, 80) }}
                    </p>

                    <div class="mt-4 flex items-center text-[10px] font-bold text-accent uppercase tracking-wider group-hover:translate-x-1 transition-transform">
                        Project Details <i class="ti ti-arrow-narrow-right ms-1"></i>
                    </div>
                </div>
                @empty
                <p class="text-xs text-gray-400 italic">No projects added yet.</p>
                @endforelse
            </div>
        </section>

        <!-- Social Links -->
        <section class="mb-16" id="contact">
            <h2 class="text-[10px] font-bold tracking-[0.2em] text-gray-400 uppercase mb-6">Find me on</h2>
            <p class="text-xs text-gray-600 mb-6 font-medium">You can find me on the following social platforms:</p>
            <div class="flex flex-wrap gap-4">
                @if($profile->github_url)
                <a href="{{ $profile->github_url }}" target="_blank" class="flex items-center gap-1.5 text-xs font-bold text-gray-500 hover:text-black transition-colors">
                    <i class="ti ti-brand-github"></i> GitHub
                </a>
                @endif
                @if($profile->linkedin_url)
                <a href="{{ $profile->linkedin_url }}" target="_blank" class="flex items-center gap-1.5 text-xs font-bold text-gray-500 hover:text-black transition-colors">
                    <i class="ti ti-brand-linkedin"></i> LinkedIn
                </a>
                @endif
                @if($profile->twitter_url)
                <a href="{{ $profile->twitter_url }}" target="_blank" class="flex items-center gap-1.5 text-xs font-bold text-gray-500 hover:text-black transition-colors">
                    <i class="ti ti-brand-x"></i> X/Twitter
                </a>
                @endif
                @if($profile->instagram_url)
                <a href="{{ $profile->instagram_url }}" target="_blank" class="flex items-center gap-1.5 text-xs font-bold text-gray-500 hover:text-black transition-colors">
                    <i class="ti ti-brand-instagram"></i> Instagram
                </a>
                @endif
                @if($profile->youtube_url)
                <a href="{{ $profile->youtube_url }}" target="_blank" class="flex items-center gap-1.5 text-xs font-bold text-gray-500 hover:text-black transition-colors">
                    <i class="ti ti-brand-youtube"></i> YouTube
                </a>
                @endif
                @if($profile->facebook_url)
                <a href="{{ $profile->facebook_url }}" target="_blank" class="flex items-center gap-1.5 text-xs font-bold text-gray-500 hover:text-black transition-colors">
                    <i class="ti ti-brand-facebook"></i> Facebook
                </a>
                @endif
                @if($profile->whatsapp_number)
                <a href="https://wa.me/{{ $profile->whatsapp_number }}" target="_blank" class="flex items-center gap-1.5 text-xs font-bold text-gray-500 hover:text-black transition-colors">
                    <i class="ti ti-brand-whatsapp"></i> WhatsApp
                </a>
                @endif
            </div>
        </section>

        <!-- Blog Posts -->
        <section class="mb-16">
            <h2 class="text-[10px] font-bold tracking-[0.2em] text-gray-400 uppercase mb-6">Latest Posts</h2>
            <div class="space-y-6">
                @forelse($blogPosts as $post)
                <article @click="selectedPost = {{ json_encode($post) }}" class="cursor-pointer group">
                    <div class="flex items-baseline justify-between gap-4">
                        <h3 class="text-sm font-bold text-black group-hover:text-accent transition-colors">{{ $post->title }}</h3>
                        <div class="flex-1 border-b border-dashed border-gray-100 mb-1"></div>
                        <span class="text-[10px] text-gray-400 font-medium whitespace-nowrap italic">
                            {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}
                        </span>
                    </div>
                </article>
                @empty
                <p class="text-[10px] text-gray-400 italic">No posts yet.</p>
                @endforelse
            </div>
        </section>

        <!-- Get In Touch -->
        <section class="mb-16">
            <h2 class="text-[10px] font-bold tracking-[0.2em] text-gray-400 uppercase mb-6">Get in touch</h2>
            <div class="space-y-2">
                @if($profile->email)
                <p class="text-xs text-gray-600">
                    You can reach me anytime at <a href="mailto:{{ $profile->email }}" class="text-black font-bold border-b border-black/10 hover:border-black/40 transition-colors">{{ $profile->email }}</a>
                </p>
                @endif
                <p class="text-xs text-gray-600">
                    Or book a call on <a href="#" class="text-black font-bold border-b border-black/10 hover:border-black/40 transition-colors">Cal.com</a>
                </p>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="container-custom px-6 border-t border-gray-50 pt-8 flex items-center justify-between">
        <div class="text-[10px] text-gray-400">
            © {{ date('Y') }} Built with <span class="text-red-500">♥</span> by {{ $profile->name ?? 'Admin' }}
        </div>
        <div class="text-[10px] text-gray-400">
            This website is <a href="#" class="text-black/60 font-medium hover:text-black transition-colors underline underline-offset-4 decoration-black/10 hover:decoration-black/40">open-source</a>
        </div>
    </footer>

    <!-- Project Detail Modal -->
    <template x-teleport="body">
        <div x-show="selectedProject" 
            class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6"
            x-cloak>
            
            <!-- Backdrop -->
            <div x-show="selectedProject" 
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-black/60 backdrop-blur-sm"
                @click="selectedProject = null"></div>

            <!-- Modal Content -->
            <div x-show="selectedProject"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative w-full max-w-2xl bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
                
                <!-- Close Button -->
                <button @click="selectedProject = null" 
                    class="absolute top-4 right-4 z-20 w-8 h-8 bg-white/80 backdrop-blur rounded-full flex items-center justify-center text-gray-500 hover:text-black hover:scale-110 transition-all border border-gray-100">
                    <i class="ti ti-x text-lg"></i>
                </button>

                <!-- Project Image/Placeholder -->
                <div class="relative h-48 sm:h-64 bg-gray-50 flex-shrink-0">
                    <template x-if="selectedProject && selectedProject.image">
                        <img :src="'/storage/' + selectedProject.image" :alt="selectedProject.title" class="w-full h-full object-cover">
                    </template>
                    <template x-if="!selectedProject || !selectedProject.image">
                        <div class="w-full h-full flex items-center justify-center bg-gray-50 text-gray-200">
                            <i :class="selectedProject ? selectedProject.category_icon : 'ti ti-photo-off'" class="text-6xl"></i>
                        </div>
                    </template>
                    <div class="absolute bottom-4 left-4">
                        <span x-show="selectedProject && selectedProject.category" 
                            x-text="selectedProject.category"
                            class="px-3 py-1 bg-black text-white text-[10px] font-bold uppercase tracking-widest rounded-full"></span>
                    </div>
                </div>

                <!-- Content Area -->
                <div class="p-6 sm:p-8 overflow-y-auto">
                    <div class="flex items-center gap-3 mb-4">
                        <h2 x-text="selectedProject ? selectedProject.title : ''" class="text-xl font-bold"></h2>
                    </div>

                    <div class="prose prose-sm max-w-none text-gray-600 mb-8 leading-relaxed">
                        <p x-text="selectedProject ? selectedProject.description : ''"></p>
                    </div>

                    <!-- Footer / Actions -->
                    <div class="flex flex-wrap items-center gap-4 pt-6 border-t border-gray-100">
                        <template x-if="selectedProject && selectedProject.project_url">
                            <a :href="selectedProject.project_url" target="_blank" 
                                class="inline-flex items-center gap-2 bg-black text-white text-xs font-bold px-6 py-3 rounded-lg hover:bg-gray-800 transition-all">
                                <i class="ti ti-external-link"></i> Live Project
                            </a>
                        </template>
                        <template x-if="selectedProject && selectedProject.source_url">
                            <a :href="selectedProject.source_url" target="_blank" 
                                class="inline-flex items-center gap-2 border border-gray-200 text-black text-xs font-bold px-6 py-3 rounded-lg hover:bg-gray-50 transition-all">
                                <i class="ti ti-brand-github"></i> Source Code
                            </a>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <!-- Blog Post Detail Modal -->
    <template x-teleport="body">
        <div x-show="selectedPost" 
            class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6"
            x-cloak>
            
            <!-- Backdrop -->
            <div x-show="selectedPost" 
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-black/60 backdrop-blur-sm"
                @click="selectedPost = null"></div>

            <!-- Modal Content -->
            <div x-show="selectedPost"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative w-full max-w-2xl bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
                
                <!-- Close Button -->
                <button @click="selectedPost = null" 
                    class="absolute top-4 right-4 z-20 w-8 h-8 bg-white/80 backdrop-blur rounded-full flex items-center justify-center text-gray-500 hover:text-black hover:scale-110 transition-all border border-gray-100">
                    <i class="ti ti-x text-lg"></i>
                </button>

                <!-- Featured Image -->
                <div x-show="selectedPost && selectedPost.image" class="relative h-48 sm:h-64 bg-gray-50 flex-shrink-0">
                    <img :src="'/storage/' + (selectedPost ? selectedPost.image : '')" :alt="selectedPost ? selectedPost.title : ''" class="w-full h-full object-cover">
                </div>

                <!-- Content Area -->
                <div class="p-6 sm:p-8 overflow-y-auto">
                    <div class="mb-6">
                        <span x-text="selectedPost ? (selectedPost.published_at ? new Date(selectedPost.published_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : new Date(selectedPost.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })) : ''" 
                            class="text-[10px] text-gray-400 font-bold uppercase tracking-widest block mb-2"></span>
                        <h2 x-text="selectedPost ? selectedPost.title : ''" class="text-xl font-bold text-black leading-tight"></h2>
                    </div>

                    <div class="prose prose-sm max-w-none text-gray-600 leading-relaxed whitespace-pre-wrap font-sans" x-text="selectedPost ? selectedPost.content : ''"></div>
                </div>
            </div>
        </div>
    </template>
</div>

<!-- Tabler Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
