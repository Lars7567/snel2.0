<x-base-layout>

    <div class="av-wrap">
        <div class="av-inner">
            @if(!empty($avContent))
                <div class="av-content">
                    {!! $avContent !!}
                </div>
            @else
                <p style="color:#888;">Er zijn nog geen algemene voorwaarden ingesteld.</p>
            @endif
        </div>
    </div>

<style>
    .av-wrap { display: flex; justify-content: center; padding: 60px 20px 100px; }
    .av-inner { width: 100%; max-width: 800px; }
    .av-content h1 { font-size: 2rem; font-weight: 700; margin-bottom: 1.5rem; color: #111; }
    .av-content h2 { font-size: 1.4rem; font-weight: 700; margin: 2rem 0 0.75rem; color: #111; border-bottom: 1px solid #e5e7eb; padding-bottom: 6px; }
    .av-content h3 { font-size: 1.1rem; font-weight: 700; margin: 1.5rem 0 0.5rem; color: #222; }
    .av-content p { margin: 0 0 1rem; line-height: 1.75; color: #444; }
    .av-content ul, .av-content ol { margin: 0 0 1rem 1.5rem; }
    .av-content li { margin-bottom: 0.4rem; line-height: 1.7; color: #444; }
    .av-content strong { color: #222; }
    .av-content a { color: inherit; }
</style>

</x-base-layout>
