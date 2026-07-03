<x-base-layout>
<link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.snow.css">

    <div class="ca-wrap">
        <div class="ca-inner">

            <h1 class="ca-title">Teksten beheren</h1>

            @if(session('success'))
                <div class="ca-success">{{ session('success') }}</div>
            @endif

            <form id="content-form" method="POST" action="{{ route('admin.content.update') }}">
                @csrf

                {{-- ==================== HOME ==================== --}}
                <div class="ca-section">
                    <h2 class="ca-section__title">Homepage</h2>

                    <div class="ca-field">
                        <label class="ca-label">Sectietitel boven <span class="ca-hint">(bijv. "Meest gezochte bedrijven")</span></label>
                        <input type="text" name="home_section_top" class="ca-input"
                               value="{{ $content['home_section_top'] ?? 'Meest gezochte bedrijven' }}">
                    </div>

                    <div class="ca-field">
                        <label class="ca-label">Sectietitel onder <span class="ca-hint">(bijv. "Meest recente bedrijven")</span></label>
                        <input type="text" name="home_section_bottom" class="ca-input"
                               value="{{ $content['home_section_bottom'] ?? 'Meest recente bedrijven' }}">
                    </div>

                    <div class="ca-field">
                        <label class="ca-label">CTA-tekst</label>
                        <input type="text" name="home_cta_text" class="ca-input"
                               value="{{ $content['home_cta_text'] ?? 'Wilt u uw bedrijf zichtbaar maken op ons platform?' }}">
                    </div>

                    <div class="ca-field">
                        <label class="ca-label">CTA-knop tekst</label>
                        <input type="text" name="home_cta_button" class="ca-input" style="max-width:260px"
                               value="{{ $content['home_cta_button'] ?? 'Aanmelden' }}">
                    </div>
                </div>

                {{-- ==================== OVER ONS ==================== --}}
                <div class="ca-section">
                    <h2 class="ca-section__title">Over ons</h2>

                    <div class="ca-field">
                        <label class="ca-label">Paginatitel</label>
                        <input type="text" name="about_title" class="ca-input" style="max-width:260px"
                               value="{{ $content['about_title'] ?? 'Over ons' }}">
                    </div>

                    <div class="ca-field">
                        <label class="ca-label">Hero koptekst</label>
                        <input type="text" name="about_hero_headline" class="ca-input"
                               value="{{ $content['about_hero_headline'] ?? 'Medium length hero headline' }}">
                    </div>

                    <div class="ca-field">
                        <label class="ca-label">Hero alinea</label>
                        <div class="ca-quill" id="editor-about_hero_text"></div>
                        <input type="hidden" name="about_hero_text" id="hidden-about_hero_text"
                               value="{{ $content['about_hero_text'] ?? 'Lorem ipsum dolor sit amet...' }}">
                    </div>

                    <div class="ca-field">
                        <label class="ca-label">Tweede titel</label>
                        <input type="text" name="about_second_title" class="ca-input"
                               value="{{ $content['about_second_title'] ?? 'Tweede titel' }}">
                    </div>

                    <div class="ca-field">
                        <label class="ca-label">Tweede alinea</label>
                        <div class="ca-quill" id="editor-about_second_text"></div>
                        <input type="hidden" name="about_second_text" id="hidden-about_second_text"
                               value="{{ $content['about_second_text'] ?? 'Lorem ipsum dolor sit amet...' }}">
                    </div>

                    <div class="ca-field">
                        <label class="ca-label">Derde titel</label>
                        <input type="text" name="about_third_title" class="ca-input"
                               value="{{ $content['about_third_title'] ?? 'Derde titel' }}">
                    </div>

                    <div class="ca-field">
                        <label class="ca-label">Derde alinea</label>
                        <div class="ca-quill" id="editor-about_third_text"></div>
                        <input type="hidden" name="about_third_text" id="hidden-about_third_text"
                               value="{{ $content['about_third_text'] ?? 'Lorem ipsum dolor sit amet...' }}">
                    </div>

                    <div class="ca-field">
                        <label class="ca-label">CTA-tekst</label>
                        <input type="text" name="about_cta_text" class="ca-input"
                               value="{{ $content['about_cta_text'] ?? 'Wilt u uw bedrijf zichtbaar maken op ons platform?' }}">
                    </div>

                    <h3 class="ca-subsection">Veel gestelde vragen</h3>

                    <div class="ca-field">
                        <label class="ca-label">FAQ-sectietitel</label>
                        <input type="text" name="about_faq_title" class="ca-input"
                               value="{{ $content['about_faq_title'] ?? 'Veel gestelde vragen' }}">
                    </div>

                    <input type="hidden" name="about_faq_count" id="about_faq_count" value="{{ $content['about_faq_count'] ?? 3 }}">

                    <div id="faq-container">
                        @php $faqCount = (int) ($content['about_faq_count'] ?? 3); @endphp
                        @for($i = 1; $i <= $faqCount; $i++)
                        <div class="ca-faq-block">
                            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                                <strong class="faq-label">Vraag {{ $i }}</strong>
                                <button type="button" onclick="removeFaqBlock(this)" class="ca-remove-btn">Verwijderen</button>
                            </div>
                            <div class="ca-field">
                                <label class="ca-label">Vraag</label>
                                <input type="text" class="ca-input faq-question"
                                       value="{{ $content['about_faq_'.$i.'_question'] ?? 'Vraag '.$i }}">
                            </div>
                            <div class="ca-field">
                                <label class="ca-label">Antwoord</label>
                                <div class="ca-quill faq-quill-editor"></div>
                                <input type="hidden" class="faq-answer-hidden"
                                       value="{{ $content['about_faq_'.$i.'_answer'] ?? '' }}">
                            </div>
                        </div>
                        @endfor
                    </div>

                    <button type="button" onclick="addFaqBlock()" class="ca-add-btn" style="margin-top:12px;">+ Vraag toevoegen</button>
                </div>

                {{-- ==================== CONTACT ==================== --}}
                <div class="ca-section">
                    <h2 class="ca-section__title">Contact</h2>

                    <div class="ca-field">
                        <label class="ca-label">Paginatitel</label>
                        <input type="text" name="contact_title" class="ca-input" style="max-width:260px"
                               value="{{ $content['contact_title'] ?? 'Contact' }}">
                    </div>

                    <div class="ca-field">
                        <label class="ca-label">Adres</label>
                        <input type="text" name="contact_address" class="ca-input"
                               value="{{ $content['contact_address'] ?? '2134FD Nijmegen teststraat 42' }}">
                    </div>

                    <div class="ca-field">
                        <label class="ca-label">E-mailadres</label>
                        <input type="text" name="contact_email" class="ca-input"
                               value="{{ $content['contact_email'] ?? 'test@gmail.com' }}">
                    </div>

                    <div class="ca-field">
                        <label class="ca-label">Telefoonnummer</label>
                        <input type="text" name="contact_phone" class="ca-input"
                               value="{{ $content['contact_phone'] ?? '06 123456' }}">
                    </div>

                    <div class="ca-field">
                        <label class="ca-label">KVK-nummer</label>
                        <input type="text" name="contact_kvk" class="ca-input"
                               value="{{ $content['contact_kvk'] ?? '7239456846' }}">
                    </div>
                </div>

                <button type="submit" class="ca-save-btn">Opslaan</button>

            </form>
        </div>
    </div>

    <style>
        .ca-wrap {
            display: flex;
            justify-content: center;
            padding: 60px 20px 100px;
        }
        .ca-inner {
            width: 100%;
            max-width: 860px;
        }
        .ca-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: #111;
        }
        .ca-success {
            background: #d1fae5;
            border: 1px solid #34d399;
            color: #065f46;
            padding: 12px 18px;
            border-radius: 6px;
            margin-bottom: 24px;
            font-weight: 600;
        }
        .ca-section {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 28px;
            margin-bottom: 24px;
            background: #fff;
        }
        .ca-section__title {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0 0 20px;
            color: #111;
        }
        .ca-subsection {
            font-size: 0.95rem;
            font-weight: 700;
            color: #555;
            margin: 24px 0 12px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }
        .ca-faq-block {
            background: #f9fafb;
            border-radius: 6px;
            padding: 16px;
            margin-bottom: 16px;
        }
        .ca-field {
            margin-bottom: 20px;
        }
        .ca-field:last-child {
            margin-bottom: 0;
        }
        .ca-label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
            font-size: 0.9rem;
        }
        .ca-hint {
            font-weight: 400;
            color: #888;
            font-size: 0.82rem;
        }
        .ca-input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.95rem;
            outline: none;
            box-sizing: border-box;
        }
        .ca-input:focus {
            border-color: #111;
        }
        .ca-quill {
            border: 1px solid #d1d5db;
            border-radius: 0 0 6px 6px;
            min-height: 120px;
            background: #fff;
        }
        .ca-quill .ql-toolbar {
            border-radius: 6px 6px 0 0;
            border-color: #d1d5db;
        }
        .ca-quill .ql-container {
            border-color: #d1d5db;
            font-size: 0.95rem;
        }
        .ca-save-btn {
            padding: 14px 40px;
            background: #111;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        .ca-save-btn:hover {
            background: #333;
        }
        .ca-add-btn {
            padding: 8px 16px;
            background: #fff;
            color: #111;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
        }
        .ca-add-btn:hover {
            background: #f3f4f6;
        }
        .ca-remove-btn {
            padding: 4px 10px;
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fca5a5;
            border-radius: 4px;
            font-size: 0.82rem;
            cursor: pointer;
        }
        .ca-remove-btn:hover {
            background: #fecaca;
        }
    </style>

    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        const toolbarOptions = [
            ['bold', 'italic', 'underline'],
            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
            ['link'],
            ['clean']
        ];

        // Vaste rich text velden
        const richFields = [
            'about_hero_text',
            'about_second_text',
            'about_third_text',
        ];

        const editors = {};

        richFields.forEach(function(field) {
            const editorEl = document.getElementById('editor-' + field);
            if (!editorEl) return;
            const quill = new Quill(editorEl, { theme: 'snow', modules: { toolbar: toolbarOptions } });
            const hiddenInput = document.getElementById('hidden-' + field);
            if (hiddenInput && hiddenInput.value) {
                quill.clipboard.dangerouslyPasteHTML(hiddenInput.value);
            }
            editors[field] = quill;
        });

        // FAQ dynamisch beheer
        const faqEditors = new Map();

        function initFaqQuill(block) {
            const editorEl = block.querySelector('.faq-quill-editor');
            const hiddenInput = block.querySelector('.faq-answer-hidden');
            const quill = new Quill(editorEl, { theme: 'snow', modules: { toolbar: toolbarOptions } });
            if (hiddenInput && hiddenInput.value) {
                quill.clipboard.dangerouslyPasteHTML(hiddenInput.value);
            }
            faqEditors.set(block, quill);
        }

        document.querySelectorAll('.ca-faq-block').forEach(initFaqQuill);

        function addFaqBlock() {
            const container = document.getElementById('faq-container');
            const num = container.querySelectorAll('.ca-faq-block').length + 1;
            const block = document.createElement('div');
            block.className = 'ca-faq-block';
            block.innerHTML = `
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                    <strong class="faq-label">Vraag ${num}</strong>
                    <button type="button" onclick="removeFaqBlock(this)" class="ca-remove-btn">Verwijderen</button>
                </div>
                <div class="ca-field">
                    <label class="ca-label">Vraag</label>
                    <input type="text" class="ca-input faq-question" value="">
                </div>
                <div class="ca-field">
                    <label class="ca-label">Antwoord</label>
                    <div class="ca-quill faq-quill-editor"></div>
                    <input type="hidden" class="faq-answer-hidden" value="">
                </div>`;
            container.appendChild(block);
            initFaqQuill(block);
            renumberFaqBlocks();
        }

        function removeFaqBlock(button) {
            const block = button.closest('.ca-faq-block');
            faqEditors.delete(block);
            block.remove();
            renumberFaqBlocks();
        }

        function renumberFaqBlocks() {
            document.querySelectorAll('.ca-faq-block').forEach(function(block, index) {
                block.querySelector('.faq-label').textContent = 'Vraag ' + (index + 1);
            });
        }

        // Bij opslaan: veldnamen instellen en count bijwerken
        document.getElementById('content-form').addEventListener('submit', function() {
            // Vaste editors
            Object.keys(editors).forEach(function(field) {
                const hidden = document.getElementById('hidden-' + field);
                const html = editors[field].root.innerHTML;
                hidden.value = (html === '<p><br></p>') ? '' : html;
            });

            // FAQ editors + veldnamen nummeren
            const blocks = document.querySelectorAll('.ca-faq-block');
            document.getElementById('about_faq_count').value = blocks.length;
            blocks.forEach(function(block, index) {
                const num = index + 1;
                const quill = faqEditors.get(block);
                const html = quill ? quill.root.innerHTML : '';
                block.querySelector('.faq-question').name = 'about_faq_' + num + '_question';
                const answerHidden = block.querySelector('.faq-answer-hidden');
                answerHidden.name = 'about_faq_' + num + '_answer';
                answerHidden.value = (html === '<p><br></p>') ? '' : html;
            });
        });
    </script>

</x-base-layout>
