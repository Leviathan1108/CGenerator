@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <strong>Whoops!</strong> Ada kesalahan saat mengisi form:
        <ul class="mt-2 list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('templateadmin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf

    <div>
        <label class="block font-semibold text-gray-700 mb-1">Nama Event</label>
        <input type="text" name="event_name" value="{{ old('event_name') }}"
            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
    </div>

    <div>
        <label class="block font-semibold text-gray-700 mb-1">Pilihan Background</label>
        <select name="background_choice" id="background_choice"
            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
            <option value="custom" {{ old('background_choice') == 'custom' ? 'selected' : '' }}>Custom</option>
            <option value="template" {{ old('background_choice') == 'template' ? 'selected' : '' }}>Template</option>
        </select>
    </div>

    <div>
        <label class="block font-semibold text-gray-700 mb-1">Pilih Template</label>
        <select name="selected_template_id" id="selected_template_id"
            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
            <option value="">-- Pilih Template --</option>
            @foreach ($templates as $template)
                <option value="{{ $template->id }}" {{ old('selected_template_id') == $template->id ? 'selected' : '' }}>
                    {{ $template->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block font-semibold text-gray-700 mb-1">Upload Logo (opsional)</label>
        <input type="file" name="logo"
            class="w-full file:border file:rounded-lg file:px-4 file:py-2 file:bg-blue-100 file:text-blue-700 border-gray-300 rounded-lg shadow-sm">
    </div>

    <div>
        <label class="block font-semibold text-gray-700 mb-1">Nama Peserta</label>
        <input type="text" name="participant_name" value="{{ old('participant_name') }}"
            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
    </div>

    <div>
        <label class="block font-semibold text-gray-700 mb-1">Status Sertifikat</label>
        <select name="status"
            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
            <option value="revoked" {{ old('status') == 'revoked' ? 'selected' : '' }}>Revoked</option>
        </select>
    </div>

    <div>
        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-200">
            Simpan Sertifikat
        </button>
    </div>
</form>

<script>
    const bgChoice = document.getElementById('background_choice');
    const templateSelect = document.getElementById('selected_template_id');

    function toggleTemplateRequired() {
        if (bgChoice.value === 'template') {
            templateSelect.setAttribute('required', 'required');
        } else {
            templateSelect.removeAttribute('required');
        }
    }

    bgChoice.addEventListener('change', toggleTemplateRequired);
    window.addEventListener('DOMContentLoaded', toggleTemplateRequired);
</script>
