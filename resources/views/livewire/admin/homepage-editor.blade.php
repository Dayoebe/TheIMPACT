<div class="homepage-editor" x-data="{ section: 'hero' }">
    <section class="admin-editor-heading">
        <div><p class="eyebrow">Website content</p><h1>Edit homepage.</h1><p>Manage every visible homepage message, label, image and repeatable content block.</p></div>
        <div class="admin-editor-heading-actions"><a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer">Preview homepage ↗</a><button type="button" wire:click="save" wire:loading.attr="disabled"><span wire:loading.remove wire:target="save">Save all changes</span><span wire:loading wire:target="save">Saving…</span></button></div>
    </section>

    @if($errors->any())<div class="admin-alert is-error" role="alert">Some fields need attention. Review the highlighted inputs and save again.</div>@endif

    <div class="homepage-editor-layout">
        <nav class="homepage-editor-nav" aria-label="Homepage sections">
            @foreach(['hero' => 'Hero', 'philosophy' => 'Philosophy', 'about' => 'Who we are', 'founder' => 'President & Convener', 'purpose' => 'Vision & mission', 'focus' => 'Focus areas', 'journey' => 'The journey', 'programmes' => 'Programmes', 'mentorship' => 'Mentorship', 'participate' => 'Where to begin', 'closing' => 'Closing message'] as $key => $label)
                <button type="button" @click="section = '{{ $key }}'; document.getElementById('editor-{{ $key }}').scrollIntoView({ behavior: 'smooth' })" :class="{ 'is-active': section === '{{ $key }}' }"><span>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>{{ $label }}</button>
            @endforeach
        </nav>

        <form wire:submit="save" class="homepage-editor-form">
            <section id="editor-hero" class="editor-section" @mouseenter="section = 'hero'">
                <div class="editor-section-heading"><div><span>01</span><h2>Hero section</h2><p>The first message and visual visitors see.</p></div><x-admin-icon name="home" /></div>
                <div class="editor-field-grid">
                    <label class="is-wide">Eyebrow<input type="text" wire:model="content.hero.eyebrow"></label>
                    <label>Headline — first line<input type="text" wire:model="content.hero.title_line_one"></label><label>Headline — second line<input type="text" wire:model="content.hero.title_line_two"></label>
                    <label>Highlighted phrase<input type="text" wire:model="content.hero.title_emphasis"></label><label>Primary button label<input type="text" wire:model="content.hero.primary_button_label"></label>
                    <label class="is-wide">Introduction<textarea rows="3" wire:model="content.hero.description"></textarea></label>
                    <label>Secondary button label<input type="text" wire:model="content.hero.secondary_button_label"></label><label>Network label — first line<input type="text" wire:model="content.hero.footnote_line_one"></label>
                    <label>Network label — second line<input type="text" wire:model="content.hero.footnote_line_two"></label><label>Bottom statement<input type="text" wire:model="content.hero.bottom_statement"></label>
                </div>
                <div class="editor-image-control"><div class="editor-image-preview"><img src="{{ $heroImage?->temporaryUrl() ?? $this->imageUrl($content['hero']['image']) }}" alt="Current hero preview"></div><div><h3>Hero image</h3><p>JPG, PNG or WebP. Maximum 5 MB. The current image remains until you save.</p><label class="editor-file-button">Choose replacement<input type="file" wire:model="heroImage" accept="image/jpeg,image/png,image/webp"></label><div wire:loading wire:target="heroImage" class="editor-uploading">Preparing image…</div>@error('heroImage')<small class="editor-error">{{ $message }}</small>@enderror</div></div>
                <div class="editor-field-grid"><label class="is-wide">Image alternative text<textarea rows="2" wire:model="content.hero.image_alt"></textarea></label><label>Image badge<input type="text" wire:model="content.hero.badge"></label><label>Caption eyebrow<input type="text" wire:model="content.hero.caption_eyebrow"></label><label class="is-wide">Caption title<input type="text" wire:model="content.hero.caption_title"></label></div>
            </section>

            <section id="editor-philosophy" class="editor-section" @mouseenter="section = 'philosophy'">
                <div class="editor-section-heading"><div><span>02</span><h2>Philosophy strip</h2><p>Edit the six-stage progression beneath the hero.</p></div><x-admin-icon name="philosophy" /></div>
                <div class="editor-repeat-grid philosophy-edit-grid">@foreach($content['philosophy'] as $index => $value)<label><span>0{{ $index + 1 }}</span><input type="text" wire:model="content.philosophy.{{ $index }}"></label>@endforeach</div>
            </section>

            <section id="editor-about" class="editor-section" @mouseenter="section = 'about'">
                <div class="editor-section-heading"><div><span>03</span><h2>Who we are</h2><p>Control the homepage introduction to the organisation.</p></div><x-admin-icon name="about" /></div>
                <div class="editor-field-grid"><label class="is-wide">Section label<input type="text" wire:model="content.about.label"></label><label>Heading<input type="text" wire:model="content.about.title_line_one"></label><label>Highlighted heading<input type="text" wire:model="content.about.title_emphasis"></label><label class="is-wide">Lead paragraph<textarea rows="3" wire:model="content.about.lead"></textarea></label>@foreach($content['about']['paragraphs'] as $index => $paragraph)<label class="is-wide">Body paragraph {{ $index + 1 }}<textarea rows="4" wire:model="content.about.paragraphs.{{ $index }}"></textarea></label>@endforeach<label class="is-wide">Link label<input type="text" wire:model="content.about.link_label"></label></div>
                <div class="editor-image-control"><div class="editor-image-preview"><img src="{{ $aboutImage?->temporaryUrl() ?? $this->imageUrl($content['about']['image']) }}" alt="Current about-section preview"></div><div><h3>Community image</h3><p>Use a landscape image that reflects service and community.</p><label class="editor-file-button">Choose replacement<input type="file" wire:model="aboutImage" accept="image/jpeg,image/png,image/webp"></label><div wire:loading wire:target="aboutImage" class="editor-uploading">Preparing image…</div>@error('aboutImage')<small class="editor-error">{{ $message }}</small>@enderror</div></div>
                <div class="editor-field-grid"><label class="is-wide">Image alternative text<textarea rows="2" wire:model="content.about.image_alt"></textarea></label><label class="is-wide">Image caption<input type="text" wire:model="content.about.image_caption"></label></div>
            </section>

            <section id="editor-founder" class="editor-section" @mouseenter="section = 'founder'">
                <div class="editor-section-heading"><div><span>04</span><h2>President &amp; Convener</h2><p>Introduce the person behind the initiative.</p></div><x-admin-icon name="leadership" /></div>
                <div class="editor-field-grid"><label class="is-wide">Section label<input type="text" wire:model="content.founder.eyebrow"></label><label>Name<input type="text" wire:model="content.founder.name"></label><label>Role<input type="text" wire:model="content.founder.role"></label><label>Heading<input type="text" wire:model="content.founder.title_line_one"></label><label>Highlighted heading<input type="text" wire:model="content.founder.title_emphasis"></label><label class="is-wide">Introduction<textarea rows="4" wire:model="content.founder.description"></textarea></label><label>Leadership link label<input type="text" wire:model="content.founder.link_label"></label></div>
                <div class="editor-image-control"><div class="editor-image-preview is-portrait"><img src="{{ $founderImage?->temporaryUrl() ?? $this->imageUrl($content['founder']['image']) }}" alt="Current President and Convener portrait preview"></div><div><h3>President portrait</h3><p>Use a clear portrait in JPG, PNG or WebP format, up to 5 MB.</p><label class="editor-file-button">Choose replacement<input type="file" wire:model="founderImage" accept="image/jpeg,image/png,image/webp"></label><div wire:loading wire:target="founderImage" class="editor-uploading">Preparing image…</div>@error('founderImage')<small class="editor-error">{{ $message }}</small>@enderror</div></div>
                <div class="editor-field-grid"><label class="is-wide">Image alternative text<textarea rows="2" wire:model="content.founder.image_alt"></textarea></label></div>
            </section>

            <section id="editor-purpose" class="editor-section" @mouseenter="section = 'purpose'">
                <div class="editor-section-heading"><div><span>05</span><h2>Vision & mission</h2><p>Edit both purpose statements and their supporting captions.</p></div><x-admin-icon name="vision" /></div>
                <div class="editor-two-column">@foreach(['vision' => 'Vision', 'mission' => 'Mission'] as $key => $label)<fieldset><legend>{{ $label }}</legend><label>Eyebrow<input type="text" wire:model="content.{{ $key }}.eyebrow"></label><label>Title<input type="text" wire:model="content.{{ $key }}.title"></label><label>Statement<textarea rows="8" wire:model="content.{{ $key }}.statement"></textarea></label><label>Caption<input type="text" wire:model="content.{{ $key }}.caption"></label></fieldset>@endforeach</div>
            </section>

            <section id="editor-focus" class="editor-section" @mouseenter="section = 'focus'">
                <div class="editor-section-heading"><div><span>05</span><h2>Focus areas</h2><p>Manage the introduction and all five focus panels.</p></div><x-admin-icon name="programmes" /></div>
                <div class="editor-field-grid"><label>Section label<input type="text" wire:model="content.focus.label"></label><label>Heading<input type="text" wire:model="content.focus.title_line_one"></label><label>Highlighted heading<input type="text" wire:model="content.focus.title_emphasis"></label><label>Programme link label<input type="text" wire:model="content.focus.link_label"></label><label class="is-wide">Introduction<textarea rows="3" wire:model="content.focus.introduction"></textarea></label></div>
                <div class="editor-stack">@foreach($content['focus']['areas'] as $index => $area)<fieldset><legend><span>0{{ $index + 1 }}</span>{{ $area['name'] }}</legend><div class="editor-field-grid"><label>Name<input type="text" wire:model="content.focus.areas.{{ $index }}.name"></label><label>Small heading<input type="text" wire:model="content.focus.areas.{{ $index }}.eyebrow"></label><label class="is-wide">Main heading<input type="text" wire:model="content.focus.areas.{{ $index }}.title"></label><label class="is-wide">Description<textarea rows="4" wire:model="content.focus.areas.{{ $index }}.description"></textarea></label></div></fieldset>@endforeach</div>
            </section>

            <section id="editor-journey" class="editor-section" @mouseenter="section = 'journey'">
                <div class="editor-section-heading"><div><span>06</span><h2>The journey</h2><p>Manage the journey headline and its five action steps.</p></div><x-admin-icon name="leadership" /></div>
                <div class="editor-field-grid"><label>Section label<input type="text" wire:model="content.journey.label"></label><label>Heading — first line<input type="text" wire:model="content.journey.title_line_one"></label><label>Heading — second line<input type="text" wire:model="content.journey.title_line_two"></label><label>Highlighted phrase<input type="text" wire:model="content.journey.title_emphasis"></label><label class="is-wide">Introduction<textarea rows="3" wire:model="content.journey.introduction"></textarea></label></div>
                <div class="editor-stack">@foreach($content['journey']['steps'] as $index => $step)<fieldset><legend><span>0{{ $index + 1 }}</span>{{ $step['name'] }}</legend><div class="editor-field-grid"><label>Name<input type="text" wire:model="content.journey.steps.{{ $index }}.name"></label><label>Supporting label<input type="text" wire:model="content.journey.steps.{{ $index }}.label"></label><label class="is-wide">Description<textarea rows="3" wire:model="content.journey.steps.{{ $index }}.description"></textarea></label></div></fieldset>@endforeach</div>
            </section>

            <section id="editor-programmes" class="editor-section" @mouseenter="section = 'programmes'">
                <div class="editor-section-heading"><div><span>08</span><h2>Programme pathways</h2><p>Introduce the programme cards. Programme names and descriptions come from the Programme manager.</p></div><x-admin-icon name="programmes" /></div>
                <div class="editor-field-grid"><label>Section label<input type="text" wire:model="content.programmes.label"></label><label>Heading<input type="text" wire:model="content.programmes.title_line_one"></label><label>Highlighted heading<input type="text" wire:model="content.programmes.title_emphasis"></label><label>Button label<input type="text" wire:model="content.programmes.button_label"></label><label class="is-wide">Introduction<textarea rows="3" wire:model="content.programmes.introduction"></textarea></label></div>
            </section>

            <section id="editor-mentorship" class="editor-section" @mouseenter="section = 'mentorship'">
                <div class="editor-section-heading"><div><span>09</span><h2>Mentorship invitation</h2><p>Connect homepage visitors to the mentorship initiative.</p></div><x-admin-icon name="mentorship" /></div>
                <div class="editor-field-grid"><label>Eyebrow<input type="text" wire:model="content.mentorship.eyebrow"></label><label>Heading<input type="text" wire:model="content.mentorship.title_line_one"></label><label>Highlighted heading<input type="text" wire:model="content.mentorship.title_emphasis"></label><label>Button label<input type="text" wire:model="content.mentorship.button_label"></label><label class="is-wide">Lead paragraph<textarea rows="3" wire:model="content.mentorship.lead"></textarea></label><label class="is-wide">Description<textarea rows="4" wire:model="content.mentorship.description"></textarea></label></div>
            </section>

            <section id="editor-participate" class="editor-section" @mouseenter="section = 'participate'">
                <div class="editor-section-heading"><div><span>10</span><h2>Where to begin</h2><p>Manage the three clear routes visitors can take from the homepage.</p></div><x-admin-icon name="external" /></div>
                <div class="editor-field-grid"><label>Section label<input type="text" wire:model="content.participate.label"></label><label>Heading<input type="text" wire:model="content.participate.title_line_one"></label><label>Highlighted heading<input type="text" wire:model="content.participate.title_emphasis"></label><label class="is-wide">Introduction<textarea rows="3" wire:model="content.participate.introduction"></textarea></label></div>
                <div class="editor-stack">@foreach($content['participate']['pathways'] as $index => $pathway)<fieldset><legend><span>0{{ $index + 1 }}</span>{{ $pathway['title'] }}</legend><div class="editor-field-grid"><label class="is-wide">Title<input type="text" wire:model="content.participate.pathways.{{ $index }}.title"></label><label class="is-wide">Description<textarea rows="3" wire:model="content.participate.pathways.{{ $index }}.description"></textarea></label><label>Button label<input type="text" wire:model="content.participate.pathways.{{ $index }}.button_label"></label></div></fieldset>@endforeach</div>
            </section>

            <section id="editor-closing" class="editor-section" @mouseenter="section = 'closing'">
                <div class="editor-section-heading"><div><span>11</span><h2>Closing message</h2><p>The final invitation at the bottom of the homepage.</p></div><x-admin-icon name="external" /></div>
                <div class="editor-field-grid"><label class="is-wide">Eyebrow<input type="text" wire:model="content.closing.eyebrow"></label><label>First line<input type="text" wire:model="content.closing.title_line_one"></label><label>Second line<input type="text" wire:model="content.closing.title_line_two"></label><label>Highlighted final line<input type="text" wire:model="content.closing.title_emphasis"></label><label>Button label<input type="text" wire:model="content.closing.button_label"></label></div>
            </section>

            <div class="editor-save-bar"><div><strong>Ready to publish?</strong><span>Saving updates the public homepage immediately.</span></div><button type="submit" wire:loading.attr="disabled"><span wire:loading.remove wire:target="save">Save all changes</span><span wire:loading wire:target="save">Saving…</span></button></div>
            <div class="editor-danger-zone"><div><strong>Restore original homepage copy</strong><p>This replaces every edited field and removes uploaded homepage images.</p></div><button type="button" wire:click="restoreDefaults" wire:confirm="Restore all original homepage content? This cannot be undone.">Restore defaults</button></div>
        </form>
    </div>
</div>
