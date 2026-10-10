@extends('layouts.app')

@section('title', 'Kalender')

@section('content')
<div class="container">
    <h1 class="calendar-page-title">Jadwal Akademik & Tugas</h1>

    <div class="calendar-main-layout">
        <div class="calendar-left-pane">
            <div class="calendar-nav-container">
                <button class="calendar-nav-btn" onclick="location.href='{{ route('calendar', ['bulan' => $prev]) }}'">
                    <i class="ri-arrow-left-s-line"></i> Prev
                </button>
                <h2>{{ $monthLabel }}</h2>
                <button class="calendar-nav-btn" onclick="location.href='{{ route('calendar', ['bulan' => $next]) }}'">
                    Next <i class="ri-arrow-right-s-line"></i>
                </button>
            </div>

            <div class="calendar-container">
                @foreach ($daysOfWeek as $dayName)
                    <div class="day header-day">{{ $dayName }}</div>
                @endforeach

                @for ($i = 0; $i < $startDay; $i++)
                    <div class="day empty"></div>
                @endfor

                @for ($d = 1; $d <= $daysInMonth; $d++)
                    @php
                        $iso = $month->copy()->day($d)->toDateString();
                        $hasTask = $tasks->contains(fn ($t) => $t['date'] === $iso);
                    @endphp
                    <div class="day {{ $hasTask ? 'has-task' : '' }}" data-date="{{ $d }} {{ $monthLabel }}">{{ $d }}</div>
                @endfor
            </div>
        </div>

        <div class="calendar-right-pane" id="rightPane">
            <div class="task-form-container is-hidden" id="formBox">
                <div class="form-header">
                    <h2 id="formTitle">Tambah Tugas</h2>
                    <span id="dateBadge"></span>
                </div>
                <form id="taskForm">
                    <div class="form-group">
                        <label>Nama Tugas / Alarm</label>
                        <input name="title" type="text" placeholder="cth: Kuis Kalkulus" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Waktu</label>
                            <input name="time" type="time" required>
                        </div>
                        <div class="form-group">
                            <label>Prioritas</label>
                            <select name="priority">
                                <option value="Tinggi">Tinggi</option>
                                <option value="Sedang">Sedang</option>
                                <option value="Rendah">Rendah</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Catatan Tambahan</label>
                        <textarea name="note" rows="4" placeholder="Deskripsi tugas..."></textarea>
                    </div>
                    <button type="submit" id="submitBtn" class="btn-primary">Simpan Jadwal</button>
                    <button type="button" id="cancelBtn" class="btn-secondary">Batal</button>
                </form>
            </div>

            <div class="form-placeholder" id="placeholder">
                <i class="ri-calendar-check-line"></i>
                <p>Pilih tanggal pada kalender untuk <br><strong>mulai mengatur tugas</strong>.</p>
            </div>
        </div>
    </div>

    <div class="task-summary-section">
        <div class="task-summary-header">
            <h3><i class="ri-alarm-line"></i> Daftar Alarm & Tugas Terjadwal</h3>
        </div>
        <div class="task-grid" id="taskGrid">
            @forelse ($tasks as $task)
                @php
                    $dateLabel = \Carbon\Carbon::parse($task['date'])->locale('id')->translatedFormat('j F Y');
                @endphp
                <div class="task-card priority-{{ strtolower($task['priority']) }}"
                     data-title="{{ $task['title'] }}" data-time="{{ $task['time'] }}"
                     data-priority="{{ $task['priority'] }}" data-note="{{ $task['note'] }}" data-date="{{ $dateLabel }}">
                    <div class="task-card-header">
                        <div>
                            <h4>{{ $task['title'] }}</h4>
                            <span class="time-tag"><i class="ri-alarm-line"></i> {{ $task['time'] }}</span>
                        </div>
                        <div class="task-card-actions">
                            <button data-action="edit" class="btn-card-action btn-card-edit" title="Edit"><i class="ri-edit-line"></i></button>
                            <button data-action="delete" class="btn-card-action btn-card-delete" title="Hapus"><i class="ri-delete-bin-line"></i></button>
                        </div>
                    </div>
                    <p>{{ $task['note'] }}</p>
                    <span class="date-tag"><i class="ri-calendar-line"></i> {{ $dateLabel }}</span>
                </div>
            @empty
                <div id="emptyState">
                    <i class="ri-calendar-todo-line"></i>
                    Belum ada jadwal yang diset.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const rightPane = document.getElementById('rightPane');
    const formBox = document.getElementById('formBox');
    const placeholder = document.getElementById('placeholder');
    const form = document.getElementById('taskForm');
    const grid = document.getElementById('taskGrid');
    const emptyHTML = `<div id="emptyState">
        <i class="ri-calendar-todo-line"></i>
        Belum ada jadwal yang diset.</div>`;
    let selectedDate = null;
    let editingCard = null;

    const esc = s => String(s).replace(/[&<>"']/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));

    function buildCard(t) {
        const wrap = document.createElement('div');
        wrap.innerHTML = `<div class="task-card priority-${esc(t.priority.toLowerCase())}"
            data-title="${esc(t.title)}" data-time="${esc(t.time)}" data-priority="${esc(t.priority)}" data-note="${esc(t.note)}" data-date="${esc(t.date)}">
            <div class="task-card-header">
                <div><h4>${esc(t.title)}</h4><span class="time-tag"><i class="ri-alarm-line"></i> ${esc(t.time)}</span></div>
                <div class="task-card-actions">
                    <button data-action="edit" class="btn-card-action btn-card-edit" title="Edit"><i class="ri-edit-line"></i></button>
                    <button data-action="delete" class="btn-card-action btn-card-delete" title="Hapus"><i class="ri-delete-bin-line"></i></button>
                </div>
            </div>
            <p>${esc(t.note)}</p>
            <span class="date-tag"><i class="ri-calendar-line"></i> ${esc(t.date)}</span></div>`;
        return wrap.firstElementChild;
    }

    function showForm(dateLabel) {
        selectedDate = dateLabel;
        document.getElementById('dateBadge').textContent = dateLabel;
        document.getElementById('formTitle').textContent = editingCard ? 'Edit Tugas' : 'Tambah Tugas';
        document.getElementById('submitBtn').textContent = editingCard ? 'Update Jadwal' : 'Simpan Jadwal';
        formBox.classList.remove('is-hidden');
        placeholder.style.display = 'none';
        rightPane.classList.add('active');
        document.querySelectorAll('.day[data-date]').forEach(d => {
            const on = d.dataset.date === selectedDate;
            d.classList.toggle('selected', on);
        });
    }

    function hideForm() {
        selectedDate = null;
        editingCard = null;
        formBox.classList.add('is-hidden');
        placeholder.style.display = '';
        rightPane.classList.remove('active');
        document.querySelectorAll('.day[data-date]').forEach(d => {
            d.classList.remove('selected');
        });
    }

    function refresh() {
        const cards = [...grid.querySelectorAll('.task-card')];
        cards.sort((a, b) => a.dataset.time.localeCompare(b.dataset.time)).forEach(c => grid.appendChild(c));
        const dates = new Set(cards.map(c => c.dataset.date));
        document.querySelectorAll('.day[data-date]').forEach(d => d.classList.toggle('has-task', dates.has(d.dataset.date)));
        if (cards.length === 0 && !document.getElementById('emptyState')) grid.innerHTML = emptyHTML;
    }

    document.querySelectorAll('.day[data-date]').forEach(day => day.addEventListener('click', () => {
        editingCard = null;
        showForm(day.dataset.date);
    }));

    document.getElementById('cancelBtn').addEventListener('click', hideForm);

    form.addEventListener('submit', e => {
        e.preventDefault();
        const t = {
            date: selectedDate,
            title: form.elements.title.value,
            time: form.elements.time.value,
            priority: form.elements.priority.value,
            note: form.elements.note.value,
        };
        const card = buildCard(t);
        if (editingCard) {
            editingCard.replaceWith(card);
            editingCard = null;
        } else {
            document.getElementById('emptyState')?.remove();
            grid.appendChild(card);
        }
        form.reset();
        showForm(selectedDate);
        refresh();
    });

    grid.addEventListener('click', e => {
        const btn = e.target.closest('[data-action]');
        if (!btn) return;
        const card = btn.closest('.task-card');
        if (btn.dataset.action === 'delete') {
            if (confirm('Hapus jadwal ini?')) { card.remove(); refresh(); }
        } else {
            editingCard = card;
            showForm(card.dataset.date);
            form.elements.title.value = card.dataset.title;
            form.elements.time.value = card.dataset.time;
            form.elements.priority.value = card.dataset.priority;
            form.elements.note.value = card.dataset.note;
        }
    });
</script>
@endpush