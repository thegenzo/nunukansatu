<?php

namespace App\Http\Requests;

use App\Models\Announcement;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveAnnouncementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('announcement_admin')->check();
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'document_source' => $this->input('document_source', $this->filled('pdf_url') ? 'url' : 'file'),
            'is_active' => $this->input('is_active', false),
            'show_qr' => $this->input('show_qr', false),
        ]);
    }

    public function rules(): array
    {
        $existing = $this->route('announcement');
        $needsUpload = $this->input('document_source') === 'file'
            && (! ($existing instanceof Announcement) || ! $existing->pdf_path);

        return [
            'title' => ['required', 'string', 'max:200'],
            'subtitle' => ['nullable', 'string', 'max:500'],
            'message' => ['nullable', 'string', 'max:3000'],
            'reference_number' => ['nullable', 'string', 'max:150'],
            'published_on' => ['nullable', 'date_format:Y-m-d'],
            'is_active' => ['required', 'boolean'],
            'show_qr' => ['required', 'boolean'],
            'starts_at' => ['nullable', 'date_format:Y-m-d\TH:i'],
            'ends_at' => ['nullable', 'date_format:Y-m-d\TH:i', Rule::when($this->filled('starts_at'), 'after:starts_at')],
            'document_source' => ['required', Rule::in(['file', 'url'])],
            'pdf' => [Rule::requiredIf($needsUpload), 'nullable', 'file', 'mimes:pdf', 'mimetypes:application/pdf', 'max:20480'],
            'pdf_url' => [Rule::requiredIf($this->input('document_source') === 'url'), 'nullable', 'url:http,https', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul pengumuman wajib diisi.',
            'pdf.required' => 'Unggah file PDF untuk pengumuman ini.',
            'pdf.mimes' => 'Lampiran harus berupa file PDF.',
            'pdf.mimetypes' => 'Lampiran harus berupa file PDF yang valid.',
            'pdf.max' => 'Ukuran file PDF maksimal 20 MB.',
            'pdf_url.required' => 'Isi tautan PDF pengumuman.',
            'pdf_url.url' => 'Gunakan tautan PDF dengan awalan https:// atau http://.',
            'ends_at.after' => 'Jadwal selesai harus sesudah jadwal mulai.',
        ];
    }

    public function announcementData(): array
    {
        $data = $this->safe()->except(['pdf', 'document_source', 'pdf_url']);
        foreach (['starts_at', 'ends_at'] as $field) {
            $data[$field] = $this->filled($field)
                ? Carbon::createFromFormat('Y-m-d\TH:i', $this->input($field), 'Asia/Makassar')->setSecond(0)->timezone(config('app.timezone'))
                : null;
        }
        $data['pdf_url'] = $this->input('document_source') === 'url' ? $this->validated('pdf_url') : null;

        return $data;
    }
}
